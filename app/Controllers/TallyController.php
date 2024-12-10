<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class TallyController extends ResourceController
{
    protected $format = 'json';

    public function getTallyData()
    {
        try {
            $db = \Config\Database::connect();

            $finalTallyData = "
                SELECT
                    `order_id`, 
                    `order_no`,
                    `customer_name`,
                    `product_name`,
                    `menu`,
                    `submenu`,
                    `product_price`,
                    `courier_charge`,
                    `total_amount`,
                    `payment_status`,
                    `color`,
                    `size`,
                    `old_quantity`,
                    `new_quantity`,
                    `shipping_qty`
                FROM
                    `tally_details`
                WHERE
                    `flag` = 1 AND `tally_sync_status` = 'pending'
            ";


            $finalResult = $db->query($finalTallyData)->getResultArray();

            if (!empty($finalResult)) {
                $this->respond($finalResult, 200);
                $orderIds = array_column($finalResult, 'order_id');
                if (!empty($orderIds)) {

                    $updateQuery = "UPDATE `tally_details` SET `tally_sync_status` = 'sent' WHERE `order_id` IN ?";

                    $db->query($updateQuery, [$orderIds]);
                }

            } else {
                return $this->respond(['message' => 'No pending data found for syncing.'], 200);
            }

        } catch (\Exception $e) {

            return $this->failServerError("Error occurred: " . $e->getMessage());
        }
    }


    public function syncTallyData()
    {
        try {
            $data = $this->request->getBody();
            $jsonData = json_decode($data, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return ['code' => 400, 'message' => 'Error decoding JSON: ' . json_last_error_msg(), 'status' => 'Failure'];
            }

            if (!is_array($jsonData)) {
                return ['code' => 400, 'message' => 'Invalid JSON data received.', 'status' => 'Failure'];
            }

            $db = \Config\Database::connect();
            $table_names = [
                'tbl_accessories_list',
                'tbl_rproduct_list',
                'tbl_helmet_products',
                'tbl_luggagee_products',
                'tbl_camping_products'
            ];


            $res = [];

            foreach ($jsonData as $item) {
                if (isset($item['item_name'], $item['quantity'])) {
                    $prodName = $item['item_name'];


                    $Tallystock = intval($item['quantity']);
                    $updateProd = "";

                    // Search for product in all tables
                    foreach ($table_names as $table) {
                        $query = $db->query(
                            "SELECT COUNT(*) as count, prod_id, tbl_name, quantity FROM $table WHERE billing_name = ?",
                            [$prodName]
                        );
                        $result = $query->getRow();

                        if ($result && $result->count > 0) {
                            $updateProd = $result;
                            break;
                        }

                    }



                    if ($updateProd) {
                        // Update the product if found
                        $productID = $updateProd->prod_id;
                        $tableName = $updateProd->tbl_name;

                        if ($productID != '' && $tableName != '') {
                            $updateQuery = "UPDATE $tableName SET quantity = ? WHERE billing_name = ?";
                            $db->query($updateQuery, [$Tallystock, $prodName]);

                            $res['code'] = 200;
                            $res['status'] = 'Success';
                            $res['message'] = 'Stock updated successfully.';


                        } else {
                            $res['code'] = 400;
                            $res['status'] = 'Failure';
                            $res['message'] = 'Stock updated Failed';
                        }
                    } else if ($prodName) {
                        // Handle products with sizes
                        $sizePattern = '/(?:^|[\s\-])(?:XS|S|M|L|XL|XXL|XXXL|4XL|5XL|6XL|7XL|8XL|9XL)(?=$|[\s\-])/';
                        preg_match_all($sizePattern, $prodName, $matches);
                        $size = $matches[0];

                        if (empty($size)) {

                            $res['code'] = 400;
                            $res['status'] = 'Failure';
                            $res['message'] = 'Size not detected in product name.';
                            continue;

                        }

                        // Continue processing sizes...
                        $final_size = preg_replace('/-+/', ' ', $size);
                        $productName = preg_replace($sizePattern, '', $prodName);

                        $final_prodname = trim(preg_replace('/-+/', '-', $productName), '- ');



                        if ($final_prodname != '' && $final_size != '') {
                            foreach ($table_names as $table) {
                                $query_res = $db->query(
                                    "SELECT COUNT(*) as count, prod_id, tbl_name, quantity FROM $table WHERE billing_name = ?",
                                    [$final_prodname]
                                )->getRow();


                                if ($query_res && $query_res->count > 0) {
                                    $getconfig_data = $query_res;
                                    break;
                                }
                            }


                            // $Main_QTY = $getconfig_data->quantity;
                            $Config_prodid = $getconfig_data->prod_id;
                            $Config_tblname = $getconfig_data->tbl_name;




                            $configqry = "SELECT * FROM `tbl_configuration` WHERE `prod_id` = ? AND tbl_name = ? AND `flag` = 1;";
                            $getRes = $db->query($configqry, [$Config_prodid, $Config_tblname])->getResultArray();

                            $configID = $getRes[0]['config_id'];


                            $newSizearray = [];
                            $newStockarray = [];

                            if (!empty($getRes)) {
                                $totalSize = $getRes[0]['size'];
                                $totalStock = $getRes[0]['soldout_status'];


                                $totalSize = str_replace(array('[', ']', '"'), '', $totalSize);
                                $totalSize = explode(",", $totalSize);

                                $totalStock = str_replace(array('[', ']', '"'), '', $totalStock);
                                $totalStock = explode(",", $totalStock);


                                // Iterate over each size and update stock
                                for ($i = 0; $i < count($totalSize); $i++) {
                                    $oldSize = $totalSize;

                                    if (trim($oldSize[$i]) == trim($final_size[0])) {

                                        $newStockarray[$i] = (string) $Tallystock;
                                    } else {

                                        $newStockarray[$i] = $totalStock[$i];
                                    }
                                }
                            }

                            $Main_QTY = 0;
                            for ($j = 0; $j < count($newStockarray); $j++) {
                                $Main_QTY += $newStockarray[$j];
                            }



                            $updatedStock = json_encode($newStockarray);


                            $updateConfigqry = "UPDATE tbl_configuration SET soldout_status = ? WHERE  config_id= ? AND tbl_name =? AND prod_id = ?";
                            $updateConfig = $db->query($updateConfigqry, [$updatedStock, $configID, $Config_tblname, $Config_prodid]);
                            $affectedRows = $db->affectedRows();


                            if ($affectedRows > 0) {

                                $UpdateMainprod_qry = "UPDATE $Config_tblname SET quantity =? WHERE prod_id= ? AND tbl_name = ?";
                                $updateData = $db->query($UpdateMainprod_qry, [$Main_QTY, $Config_prodid, $Config_tblname]);
                                $affectedRows2 = $db->affectedRows();

                                if ($affectedRows2 > 0) {
                                    $res['code'] = 200;
                                    $res['status'] = 'Success';
                                    $res['message'] = 'Stock updated successfully.';

                                } else {
                                    $res['code'] = 400;
                                    $res['status'] = 'Failure';
                                    $res['message'] = 'Stock updated Failed';
                                }
                            } else {
                                $res['code'] = 400;
                                $res['status'] = 'Failure';
                                $res['message'] = 'Size Stock updated Failed';
                            }



                        } else {

                            $res['code'] = 400;
                            $res['status'] = 'Failure';
                            $res['message'] = 'Invalid product name or size.';


                        }
                    } else {
                        $res['code'] = 400;
                        $res['status'] = 'Failure';
                        $res['message'] = 'Invalid product name';
                    }
                }
            }
            echo json_encode($res);


        } catch (\Exception $e) {
            return ['code' => 500, 'message' => 'Error occurred: ' . $e->getMessage(), 'status' => 'Failure'];
        }
    }


}
