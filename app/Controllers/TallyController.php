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

            foreach ($jsonData as $item) {

                if (isset($item['item_name']) && isset($item['quantity'])) {
                    $prodName = $item['item_name'];
                    $Tallystock = intval($item['quantity']);
                    $updateProd = null; // Initialize variable

                    // Search for product in all tables
                    foreach ($table_names as $table) {
                        $query = $db->query(
                            "SELECT COUNT(*) as count, prod_id, tbl_name, quantity FROM $table WHERE product_name = ?",
                            [$prodName]
                        );
                        $result = $query->getRow();

                        // Check if any result is found
                        if ($result && $result->count > 0) {
                            $updateProd = $result;
                            break; // Found the product, no need to continue loop
                        }
                    }

                    // Process product if found in any table
                    if ($updateProd) {
                        $productID = $updateProd->prod_id;
                        $tableName = $updateProd->tbl_name;

                        if ($productID != '' && $tableName != '') {
                            $updateQuery = "UPDATE $tableName SET quantity = ? WHERE product_name = ?";
                            $db->query($updateQuery, [$Tallystock, $prodName]);
                        }
                    } else {
                        // If not found, handle product name and size extraction
                        $prodName = trim($prodName);
                        $parts = preg_split('/[-\/_]/', $prodName);

                        if (count($parts) >= 2) {
                            // Extract size and product name
                            $Tallysize = $parts[count($parts) - 1];
                            $TallyProductName = implode('-', array_slice($parts, 0, count($parts) - 1));

                            foreach ($table_names as $table) {
                                $query = $db->query(
                                    "SELECT COUNT(*) as count, prod_id, tbl_name, quantity FROM $table WHERE product_name = ?",
                                    [$TallyProductName]
                                );
                                $result = $query->getRow();

                                if ($result && $result->count > 0) {
                                    $updateconfig = $result;
                                    break;
                                }
                            }


                            $TallyproductID = $updateconfig->prod_id;
                            $tableName = $updateconfig->tbl_name;
                            $MainQuantity = $updateconfig->quantity;

                            $configquery = "SELECT * FROM `tbl_configuration` WHERE `tbl_name` = ? AND `prod_id` = ?";
                            $getConfigData = $db->query($configquery, [$tableName, $TallyproductID])->getResultArray();


                            if (count($getConfigData) > 0) {
                                $size = json_decode($getConfigData[0]['size']);
                                $stock = json_decode($getConfigData[0]['soldout_status']);

                                $newStock = $stock;

                                for ($i = 0; $i < count($size); $i++) {

                                    if ($size[$i] == $Tallysize) {
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
            die;


            // return $this->respond(['message' => 'Products updated successfully.'], 200);
        } catch (\Exception $e) {
            return $this->failServerError("Error occurred: " . $e->getMessage());
        }
    }

}
