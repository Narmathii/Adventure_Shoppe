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
                echo 'Error decoding JSON: ' . json_last_error_msg();
                exit;
            }


            if (!is_array($jsonData)) {
                return $this->failValidationError('Invalid JSON data received.');
            }
            $db = \Config\Database::connect();

            $table_names = [
                'tbl_accessories_list',
                'tbl_rproduct_list',
                'tbl_helmet_products',
                'tbl_luggagee_products',
                'tbl_camping_products'
            ];

            // for($i=0;$i < count($jsonData);$i++)
            // {
            //     print_r($jsonData[$i]['item_name'])
            // }

            foreach ($jsonData as $item) {

                if (isset($item['item_name']) && isset($item['quantity'])) {
                    $prodName = $item['item_name'];
                    $Tallystock = intval($item['quantity']);

                    foreach ($table_names as $table) {
                        $query = $db->query(
                            "SELECT COUNT(*) as count, prod_id, tbl_name, quantity FROM $table WHERE product_name = ?",
                            [$prodName]
                        );
                        $result = $query->getRow();



                        $productID = $result->prod_id;
                        $tableName = $result->tbl_name;


                        if ($result && $result->count > 0) {
                            $updateQuery = "UPDATE $table SET quantity = ? WHERE product_name = ?";
                            $db->query($updateQuery, [$Tallystock, $prodName]);
                        } else {

                            $pattern = '/^(.*)-([A-Z]+)-([0-9A-Z]+)$/';
                            if (preg_match($pattern, $prodName, $matches)) {
                                $TallyProductName = $matches[1];
                                $Tallycolor = $matches[2];
                                $Tallysize = $matches[3];


                                $query = $db->query(
                                    "SELECT COUNT(*) as count, prod_id, tbl_name, quantity FROM $table WHERE product_name = ?",
                                    [$TallyProductName]
                                );
                                $getresult = $query->getRow();

                                $TallyproductID = $getresult->prod_id;
                                $tableName = $getresult->tbl_name;
                                $MainQuantity = $getresult->quantity;

                                $configquery = "SELECT * FROM `tbl_configuration` WHERE `tbl_name` = ? AND `prod_id` = ?";
                                $getConfigData = $db->query($configquery, [$tableName, $TallyproductID])->getResultArray();

                                if (count($getConfigData) > 0) {
                                    $size = json_decode($getConfigData[0]['size']);
                                    $color = json_decode($getConfigData[0]['colour']);
                                    $stock = json_decode($getConfigData[0]['soldout_status']);


                                    // getColorName 
                                    $colorName = [];
                                    foreach ($color as $colorID) {
                                        $colorQry = "SELECT `color_name` FROM `tbl_color` WHERE `color_id` = ? AND `flag` = 1";
                                        $getColor = $db->query($colorQry, [$colorID])->getRow();
                                        $colorName[] = $getColor->color_name;
                                    }

                                    $newStock = $stock;


                                    for ($i = 0; $i < count($colorName); $i++) {

                                        if ($colorName[$i] == $Tallycolor && $size[$i] == $Tallysize) {
                                            $oldConfigStock = $stock[$i];
                                            $newStock[$i] = $Tallystock;
                                        }
                                    }


                                    $EncodeStock = json_encode($newStock);

                                    if ($EncodeStock != $stock) {

                                        $query = "UPDATE tbl_configuration SET `soldout_status` = ? 
                                                  WHERE `prod_id` =? AND `tbl_name` = ?";
                                        $updateStockData = $db->query($query, [$EncodeStock, $TallyproductID, $tableName]);
                                        $affectedRows = $db->affectedRows();
                                    }


                                    if ($affectedRows == 1) {
                                        $qty = $MainQuantity - $oldConfigStock;

                                        $newQuantity = $qty + $Tallystock;

                                        $updateMainQty = "UPDATE $tableName SET quantity = ? WHERE prod_id = ? AND tbl_name =?";
                                        $updateData = $db->query($updateMainQty, [$newQuantity, $TallyproductID, $tableName]);
                                    }
                                }
                            }
                        }

                    }

                }
            }

            return $this->respond(['message' => 'Products updated successfully.'], 200);
        } catch (\Exception $e) {
            return $this->failServerError("Error occurred: " . $e->getMessage());
        }
    }

}
