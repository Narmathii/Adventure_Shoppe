<?php

namespace App\Controllers\admin;


class NewOrderController extends BaseController
{

    public function newOrder()
    {
        $session = \Config\Services::session();

        if ($session->get('login_sts') == "") {
            return redirect()->to('admin');
        } else {
            return view("admin/neworder");
        }

    }

    public function getNewOrder()
    {

        $db = \Config\Database::connect();
        $query =
            "SELECT a.*, b.*, DATE_FORMAT(a.order_date, '%d-%m-%Y') AS date FROM tbl_orders AS a INNER JOIN 
            tbl_users AS b ON a.`user_id` = b.user_id
            WHERE a.flag = 1 AND b.flag = 1 AND a.delivery_status =  1
             ORDER BY `order_date` ASC";
        $orderDetail = $db->query($query)->getResultArray();



        echo json_encode($orderDetail);
    }
}