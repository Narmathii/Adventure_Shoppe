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

        $totalAmt = $this->request->getPost('totalamt');
        $courierCharge = $this->request->getPost('courierCharge');
        $random_number = mt_rand();

        $orderNO = "AS2024" . $random_number;


        $userID = session()->get('user_id');
        $getAddreess = $db->query("SELECT `add_id` FROM `tbl_user_address` WHERE `user_id` = $userID  AND  `flag` =1 AND `default_addr` = 1")->getRow();

        $addID = $getAddreess->add_id;

        $OrderData = [
            'order_no' => $orderNO,
            'user_id' => $userID,
            'sub_total' => $totalAmt,
            'add_id' => $addID,
            'order_status' => "initiated",
            'order_date' => date('d-m-Y'),
            'courier_charge' => $courierCharge,
        ];

        $insertOrder = $orderModel->insert($OrderData);
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
                    $res['msg'] = "OrderPlaced";

                } else {
                    $res['code'] = 400;
                    $res['msg'] = "Error while place order";

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