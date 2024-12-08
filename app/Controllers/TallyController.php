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


            $res = []; // Initialize the response array

            foreach ($jsonData as $item) {
                if (isset($item['item_name'], $item['quantity'])) {
                    $prodName = $item['item_name'];


                    $Tallystock = intval($item['quantity']);
                    $updateProd = null;

                    // Search for product in all tables
                    foreach ($table_names as $table) {
                        $query = $db->query(
                            "SELECT COUNT(*) as count, prod_id, tbl_name, quantity FROM $table WHERE product_name = ?",
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
                            $updateQuery = "UPDATE $tableName SET quantity = ? WHERE product_name = ?";
                            $db->query($updateQuery, [$Tallystock, $prodName]);

                            $res['code'] = 200;
                            $res['status'] = 'Success';
                            $res['message'] = 'Quantity updated successfully.';


                        }
                    } else {
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
                                    "SELECT COUNT(*) as count, prod_id, tbl_name, quantity FROM $table WHERE product_name = ?",
                                    [$final_prodname]
                                )->getRow();


                                if ($query_res && $query_res->count > 0) {
                                    $getconfig_data = $query_res;
                                    break;
                                }
                            }



                            $Config_prodid = $getconfig_data->prod_id;
                            $Config_tblname = $getconfig_data->tbl_name;

                            $configqry = "SELECT * FROM `tbl_configuration` WHERE `prod_id` = ? AND tbl_name = ? AND `flag` = 1;";
                            $getRes = $db->query($configqry, [$Config_prodid, $Config_tblname])->getRow();


                            print_r($getRes);

                            // Handle configuration update...
                            // Add results to $res here
                        } else {

                            $res['code'] = 400;
                            $res['status'] = 'Failure';
                            $res['message'] = 'Invalid product name or size.';


                        }
                    }
                }
            }

            return $this->respond($res);
        } catch (\Exception $e) {
            return ['code' => 500, 'message' => 'Error occurred: ' . $e->getMessage(), 'status' => 'Failure'];
        }
    }


}
