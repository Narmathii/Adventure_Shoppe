<?php

namespace App\Controllers\admin;


class DashboardController extends BaseController
{

    public function shippingstatus()
    {
        $session = \Config\Services::session();

        if ($session->get('login_sts') == "") {
            return redirect()->to('admin');
        } else {
            return view("admin/shippingstatus");
        }

    }


    public function getshippingstatus()
    {
        $db = \Config\Database::connect();
        $query =

            "SELECT a.*, b.*, DATE_FORMAT(a.order_date, '%d-%m-%Y') AS date FROM tbl_orders AS a INNER JOIN 
            tbl_users AS b ON a.`user_id` = b.user_id
            WHERE a.flag = 1 AND b.flag = 1 AND delivery_status = 3";
        $orderDetail = $db->query($query)->getResultArray();

        echo json_encode($orderDetail);
    }

    public function deliverystatus()
    {
        $session = \Config\Services::session();

        if ($session->get('login_sts') == "") {
            return redirect()->to('admin');
        } else {
            return view("admin/deliverystatus");
        }



    }

    public function getDeliverystatus()
    {
        $db = \Config\Database::connect();
        $query =

            "SELECT a.*, b.*, DATE_FORMAT(a.order_date, '%d-%m-%Y') AS date FROM tbl_orders AS a INNER JOIN 
            tbl_users AS b ON a.`user_id` = b.user_id
            WHERE a.flag = 1 AND b.flag = 1 AND delivery_status = 4";
        $orderDetail = $db->query($query)->getResultArray();



        echo json_encode($orderDetail);
    }


    public function notification()
    {
        $db = \Config\Database::connect();
        $res['stock_status'] = $db->query("SELECT `prod_id`, `product_name`, 'tbl_products' as `tbl_name`, `quantity`
                                FROM tbl_products
                                WHERE `flag` = 1 AND `quantity` <= 1
                                UNION 
                                SELECT `prod_id`, `product_name`, 'tbl_accessories_list' as `tbl_name`, `quantity`
                                FROM tbl_accessories_list
                                WHERE `flag` = 1 AND `quantity` <= 1
                                UNION 
                                SELECT `prod_id`, `product_name`, 'tbl_rproduct_list' as `tbl_name`, `quantity`
                                FROM tbl_rproduct_list
                                WHERE `flag` = 1 AND `quantity` <= 1
                                UNION 
                                SELECT `prod_id`, `product_name`, 'tbl_luggagee_products' as `tbl_name`, `quantity`
                                FROM tbl_luggagee_products
                                WHERE `flag` = 1 AND `quantity` <= 1
                                UNION 
                                SELECT `prod_id`, `product_name`, 'tbl_helmet_products' as `tbl_name`, `quantity`
                                FROM tbl_helmet_products
                                WHERE `flag` = 1 AND `quantity` <= 1
                                UNION 
                                SELECT `prod_id`, `product_name`, 'tbl_camping_products' as `tbl_name`, `quantity`
                                FROM tbl_camping_products
                                WHERE `flag` = 1 AND `quantity` <= 1
                                    ")->getResultArray();
        $res['stock_count'] = count($res['stock_status']);
        return view("admin/notification", $res);
    }


    public function getPendingOrder()
    {
        $db = \Config\Database::connect();
        $query =

            "SELECT a.*, b.*, DATE_FORMAT(a.order_date, '%d-%m-%Y') AS date FROM tbl_orders AS a INNER JOIN 
            tbl_users AS b ON a.`user_id` = b.user_id
            WHERE a.flag = 1 AND a.delivery_status =  2 AND b.flag = 1
ORDER BY `order_date` ASC";
        $orderDetail = $db->query($query)->getResultArray();
        echo json_encode($orderDetail);
    }


    public function pendingOrder()
    {
        $session = \Config\Services::session();

        if ($session->get('login_sts') == "") {
            return redirect()->to('admin');
        } else {
            return view('admin/pendingorder');
        }


    }

    public function canceledOrder()
    {
        $db = \Config\Database::connect();

        $query = "SELECT `delivery_status` FROM `tbl_orders` WHERE `flag` = 1";
        $res['del_status'] = $db->query($query)->getResultArray();

        $session = \Config\Services::session();

        if ($session->get('login_sts') == "") {
            return redirect()->to('admin');
        } else {
            return view('admin/canceledOrder', $res);
        }

    }


    public function getcancelledOrder()
    {
        $db = \Config\Database::connect();
        $query =
            "SELECT
            a.*,
            b.*,
            DATE_FORMAT(a.order_date, '%d-%m-%Y') AS DATE
        FROM
            tbl_orders AS a
        INNER JOIN tbl_users AS b
        ON
            a.`user_id` = b.user_id
        WHERE
            a.flag = 1 AND  b.flag = 1 AND a.delivery_status = 5 
        ORDER BY
            `order_date` ASC";
        $CancelOrders = $db->query($query)->getResultArray();


        echo json_encode($CancelOrders);
    }

    public function refundDetails()
    {
        $db = \Config\Database::connect();

        $query = "SELECT `delivery_status` FROM `tbl_orders` WHERE `flag` = 1";
        $res['del_status'] = $db->query($query)->getResultArray();

        $session = \Config\Services::session();

        if ($session->get('login_sts') == "") {
            return redirect()->to('admin');
        } else {
            return view('admin/refundDetails', $res);
        }

    }

    public function getrefundDetails()
    {
        $db = \Config\Database::connect();
        $query =
            "SELECT
            a.*,
            b.*,
            DATE_FORMAT(a.order_date, '%d-%m-%Y') AS DATE
        FROM
            tbl_orders AS a
        INNER JOIN tbl_users AS b
        ON
            a.`user_id` = b.user_id
        WHERE
            a.flag = 1 AND  b.flag = 1 AND `cancel_status` =  1 AND (a.delivery_status = 6  OR a.delivery_status = 7 OR a.delivery_status = 8)
        ORDER BY
            `order_date` ASC";
        $CancelOrders = $db->query($query)->getResultArray();


        echo json_encode($CancelOrders);
    }
}