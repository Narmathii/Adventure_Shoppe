<?php

namespace App\Controllers;

use App\Models\OrdersModel;

class CartCheckoutController extends BaseController
{
    public function cartCheckout()
    {
        $this->session = \Config\Services::session();
        $db = \Config\Database::connect();
        $orderModel = new OrdersModel;

        $data = $this->request->getPost();

        $courierCharge = $this->request->getPost('courierCharge');
        $totalAmt = $this->request->getPost('totalamt');
        $State = $this->request->getPost('stateid');
        $courierType = $this->request->getPost('courier_type');
        $randomNumber = mt_rand(1000, 9999);

        $orderNO = "AS2024" . $randomNumber;
        $userID = session()->get('user_id');

        // Fetch user cart data
        $cartQuery = "SELECT * FROM `tbl_user_cart` WHERE `user_id` = ?";
        $cartData = $db->query($cartQuery, [$userID])->getResultArray();

        if (empty($cartData)) {
            return json_encode(['code' => 400, 'status' => false, 'message' => 'Cart is empty!']);
        }

        $totalWeightKg = 0;
        $finalCourierCharge = 0;
        $OrderPrice = 0;


        // Iterate over cart items to validate and correct data
        foreach ($cartData as $item) {
            $prodID = $item['prod_id'];
            $tblName = $item['table_name'];
            $cartQuantity = $item['quantity'];
            $cartPrice = $item['prod_price'];
            $cartSubtotal = $item['sub_total'];

            // Fetch the original product details for validation
            $originalProductQuery = "SELECT `prod_id`, `quantity`, `offer_price`, `tbl_name`, `weight` 
                             FROM $tblName 
                             WHERE `prod_id` = ?";
            $originalProductData = $db->query($originalProductQuery, [$prodID])->getRow();


            if (!$originalProductData) {
                return json_encode(['code' => 400, 'status' => false, 'message' => 'Invalid product in cart.']);
            }

            $originalQty = $originalProductData->quantity;
            $originalPrice = $originalProductData->offer_price;
            $originalWeight = $originalProductData->weight;

            // Correct cart price and quantity if mismatched
            $finalPrice = ($cartPrice == $originalPrice) ? $cartPrice : $originalPrice;



            if ($cartQuantity <= $originalQty && $cartPrice == $originalPrice) {
                $OrderPrice += $cartSubtotal;
            } else {
                $OrderPrice += $originalPrice * $cartQuantity;
            }


            // Calculate total weight
            if (!empty($originalWeight)) {
                $prodWeightKg = $originalWeight / 1000;
                $totalWeightKg += $cartQuantity * $prodWeightKg;
            }


            // Fetch courier charge for the product
            $courierChargeQuery = "SELECT `charges` 
                           FROM `tbl_courier_charges` 
                           WHERE `flag` = 1 AND `state_id` = ? AND `active_sts` = 1 
                           AND courier_id = ? AND dist_id = 0";
            $courierChargeData = $db->query($courierChargeQuery, [$State, $courierType])->getRow();

            if ($courierChargeData) {
                $finalCourierCharge = $courierChargeData->charges;
            }
        }

        // Calculate courier charges based on total weight
        if ($totalWeightKg <= 1) {
            $totalCharge = $finalCourierCharge;
        } else {
            $totalCharge = $finalCourierCharge * ceil($totalWeightKg);
        }

        // Calculate GST and final total
        $GST = 0.18;
        $gstAmount = $totalCharge * $GST;
        $finalTotal = ceil($totalCharge + $gstAmount + 10);


        // check Courier charge
        if ($finalTotal != $courierCharge) {
            $totalcourierCharge = $finalTotal;
        } else {
            $totalcourierCharge = $courierCharge;
        }

        $finalOrderPrice = $OrderPrice + $totalcourierCharge;


        // Fetch default address for the user
        $addressQuery = "SELECT `add_id` 
                 FROM `tbl_user_address` 
                 WHERE `user_id` = ? AND `flag` = 1 AND `default_addr` = 1";
        $addressData = $db->query($addressQuery, [$userID])->getRow();

        if (!$addressData) {
            return json_encode(['status' => false, 'message' => 'Default address not found!']);
        }

        $addID = $addressData->add_id;

        // Prepare corrected order data
        $orderData = [
            'order_no' => $orderNO,
            'user_id' => $userID,
            'sub_total' => $finalOrderPrice,
            'add_id' => $addID,
            'order_status' => "initiated",
            'order_date' => date('d-m-Y'),
            'courier_charge' => $totalcourierCharge,

        ];

        $insertOrder = $orderModel->insert($orderData);
        $OrderID = $db->insertID();


        $sess = [
            'order_id' => $OrderID,
        ];
        $this->session->set($sess);

        $affectedRows = $db->affectedRows();
        if ($affectedRows) {
            $query = "SELECT a.cart_id, a.`table_name`, a.`prod_id`, a.`quantity`, a.`prod_price`, a.`sub_total`,
            a.color,a.hex_code,a.size , a.config_image1, b.add_id 
            FROM `tbl_user_cart` AS a 
            INNER JOIN tbl_user_address AS b ON a.`user_id` = b.user_id 
            WHERE a.flag = 1 AND b.flag = 1 AND a.user_id = $userID  AND b.default_addr = 1";

            $cartData = $db->query($query)->getResultArray();

            $affectedRows = 0;

            foreach ($cartData as $cartItem) {
                $prodID = $cartItem['prod_id'];
                $tblName = $cartItem['table_name'];
                $qty = $cartItem['quantity'];
                $prodPrice = $cartItem['prod_price'];
                $subTotal = $cartItem['sub_total'];
                $cartID = $cartItem['cart_id'];
                $color = $cartItem['color'];
                $hex_code = $cartItem['hex_code'];
                $size = $cartItem['size'];
                $config_image1 = $cartItem['config_image1'];


                $colorQry = "SELECT `color_name` FROM `tbl_color` WHERE `flag` = 1 AND `color_id` = ?";

                $colorData = $db->query($colorQry, $color)->getRow();
                $colorName = $colorData->color_name;


                $query = "INSERT INTO tbl_order_item (order_id, prod_id, table_name, quantity, prod_price, sub_total, color, hex_code,color_name, size, config_image1) 
                VALUES ('$OrderID', '$prodID', '$tblName', '$qty', '$prodPrice', '$subTotal', '$color', '$hex_code','$colorName', '$size', '$config_image1')";
                $orderItem = $db->query($query);
                $affectedRows = $db->affectedRows();


                if ($affectedRows === 1) {
                    $res['code'] = 200;
                    $res['message'] = "OrderPlaced";

                } else {
                    $res['code'] = 400;
                    $res['message'] = "Error while place order";

                }
            }
            echo json_encode($res);
        }
    }

    public function checkLoginRes()
    {
        $this->session = \Config\Services::session();
        $db = \Config\Database::connect();

        $loginStatus = session()->get('loginStatus');
        if ($loginStatus == "NO") {
            $res['code'] = '400';
            $res['msg'] = 'signin';
            echo json_encode($res);
        } else {
            $res['code'] = '200';
            $res['msg'] = 'success';
            echo json_encode($res);
        }
    }

}