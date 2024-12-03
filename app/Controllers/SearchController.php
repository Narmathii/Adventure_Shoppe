<?php

namespace App\Controllers;

class SearchController extends BaseController
{


    private function headerlist()
    {
        $db = \Config\Database::connect();
        $res['brand_master'] = $db->query('SELECT * FROM `brand_master` WHERE  `flag` =1 ORDER BY brand_name ASC')->getResultArray();
        $res['brand'] = $db->query('SELECT `brand_id`,UPPER(`brand_name`) AS `brand_name` ,`brand_img` FROM `tbl_brand_master` WHERE  `flag` =1 ORDER BY brand_name ASC')->getResultArray();
        $res['modal'] = $db->query('SELECT `modal_id` ,`brand_id`, CONCAT(UPPER(SUBSTRING(modal_name, 1, 1)), LOWER(SUBSTRING(modal_name, 2))) AS `modal_name` FROM `tbl_modal_master` WHERE  `flag` = 1 ORDER BY modal_name ASC ')->getResultArray();

        $res['accessories'] = $db->query('SELECT `access_id`, UPPER(`access_title`) AS `access_title`  FROM `tbl_access_master` WHERE `flag` = 1  ORDER BY  `access_title` ASC;')->getResultArray();
        $res['sub_accessories'] = $db->query('SELECT `sub_access_id`,`access_id`, CONCAT(UPPER(SUBSTRING(`sub_access_name`, 1, 1)), LOWER(SUBSTRING(`sub_access_name`, 2))) AS `sub_access_name`  FROM `tbl_subaccess_master` WHERE `flag` = 1 ORDER BY sub_access_name ASC;')->getResultArray();

        $res['riding_menu'] = $db->query('SELECT `r_menu_id` , UPPER(`r_menu`) AS `r_menu`  FROM `tbl_riding_menu` WHERE `flag` =1 ORDER BY r_menu ASC;')->getResultArray();
        $res['riding_submenu'] = $db->query('SELECT `r_sub_id`,`r_menu_id`,CONCAT(UPPER(SUBSTRING(`r_sub_menu`, 1, 1)), LOWER(SUBSTRING(`r_sub_menu`, 2))) AS `r_sub_menu`  FROM `tbl_riding_submenu` WHERE flag =1 ORDER BY r_sub_menu ASC')->getResultArray();

        $res['lug_menu'] = $db->query('SELECT `lug_menu_id`,UPPER(`lug_menu`) AS `lug_menu`  FROM `tbl_luggage_menu` WHERE  `flag` = 1 ORDER BY lug_menu')->getResultArray();
        $res['lud_submenu'] = $db->query('SELECT `lug_submenu_id`,`lug_menu_id`,CONCAT(UPPER(SUBSTRING(`lug_submenu`, 1, 1)), LOWER(SUBSTRING(`lug_submenu`, 2))) AS `lug_submenu` FROM `tbl_luggage_submenu` WHERE  `flag` =1 ORDER BY lug_submenu ASC')->getResultArray();

        $res['h_menu'] = $db->query('SELECT `h_menu_id`,UPPER(`h_menu`) AS `h_menu` FROM `tbl_helmet_menu` WHERE `flag` = 1 ORDER BY h_menu ASC')->getResultArray();
        $res['h_submenu'] = $db->query('SELECT `h_submenu_id`,`h_menu_id`, CONCAT(UPPER(SUBSTRING(`h_submenu`, 1, 1)), LOWER(SUBSTRING(`h_submenu`, 2))) AS `h_submenu`,`hsubmenu_img`FROM `tbl_helmet_submenu` WHERE `flag` = 1 ORDER BY h_submenu ASC')->getResultArray();

        $res['h_submenu_list'] = $db->query('SELECT `h_submenu_id`,`h_menu_id`, CONCAT(UPPER(SUBSTRING(`h_submenu`, 1, 1)), LOWER(SUBSTRING(`h_submenu`, 2))) AS `h_submenu`,`hsubmenu_img`FROM `tbl_helmet_submenu` WHERE `flag` = 1 AND  `h_menu_id` = 2 ORDER BY h_submenu ASC')->getResultArray();

        $res['camp_menu'] = $db->query('SELECT `camp_menu_id` ,UPPER(`camp_menu`) AS `camp_menu` FROM `tbl_camping_menu` WHERE flag = 1 ORDER BY camp_menu ASC;')->getResultArray();
        $res['camp_submenu'] = $db->query('SELECT `c_submenu_id`,`camp_menuid`,  CONCAT(UPPER(SUBSTRING(`c_submenu`, 1, 1)), LOWER(SUBSTRING(`c_submenu`, 2))) AS `c_submenu`,`csubmenu_img` FROM `tbl_camping_submenu` WHERE flag = 1 ORDER BY `c_submenu` ASC')->getResultArray();
        return $res;
    }
    public function searchData()
    {


        $db = \Config\Database::connect();
        $searchData = $this->request->getPost('search_bar');



        $query1 = "SELECT 
        prod_id, brand_id, modal_id, product_name, billing_name, product_price, 
        offer_price, offer_type, offer_details, arrival_status, stock_status, 
        redirect_url, product_img,  img_1, img_2, img_3, img_4, img_5, img_6, 
           img_7, img_8, img_9, img_10, prod_desc, 
           hot_sale, tbl_name, search_brand, weight, weight_units, quantity, 
           specifications, flag, 1 AS order_col
    FROM 
         tbl_products
         WHERE  `product_name` LIKE ? AND `flag` = 1 
    UNION ALL
    SELECT 
        prod_id, access_id AS brand_id, sub_access_id AS modal_id, product_name, billing_name, product_price, 
        offer_price, offer_type, offer_details, arrival_status, stock_status, 
        redirect_url, product_img,  img_1, img_2, img_3, img_4, img_5, img_6, 
           img_7, img_8, img_9, img_10, prod_desc, 
           hot_sale, tbl_name, search_brand, weight, weight_units, quantity, 
           specifications, flag, 2 AS order_col
    FROM 
        tbl_accessories_list
        WHERE  `product_name` LIKE ? AND `flag` = 1 
    UNION ALL
    SELECT 
        prod_id, r_menu_id AS brand_id, r_sub_id AS modal_id, product_name, billing_name, product_price, 
        offer_price, offer_type, offer_details, arrival_status, stock_status, 
        redirect_url, product_img, img_1, img_2, img_3, img_4, img_5, img_6, 
           img_7, img_8, img_9, img_10, prod_desc, 
           hot_sale, tbl_name, search_brand, weight, weight_units, quantity, 
           specifications, flag,3 AS order_col
    FROM 
        tbl_rproduct_list
        WHERE  `product_name` LIKE ? AND `flag` = 1 
    UNION ALL
    SELECT 
        prod_id, h_menu_id AS brand_id, h_submenu_id AS modal_id, product_name, billing_name, product_price, 
        offer_price, offer_type, offer_details, arrival_status, stock_status, 
        redirect_url, product_img,  img_1, img_2, img_3, img_4, img_5, img_6, 
           img_7, img_8, img_9, img_10, prod_desc, 
           hot_sale, tbl_name, search_brand, weight, weight_units, quantity, 
           specifications, flag, 4 AS order_col
    FROM 
         tbl_helmet_products
         WHERE  `product_name` LIKE ? AND `flag` = 1 
    UNION ALL
    SELECT 
        prod_id, lug_menu_id AS brand_id, lug_submenu_id AS modal_id, product_name, billing_name, product_price, 
        offer_price, offer_type, offer_details, arrival_status, stock_status, 
        redirect_url, product_img, img_1, img_2, img_3, img_4, img_5, img_6, 
           img_7, img_8, img_9, img_10, prod_desc, 
           hot_sale, tbl_name, search_brand, weight, weight_units, quantity, 
           specifications, flag, 5 AS order_col
    FROM 
        tbl_luggagee_products
        WHERE  `product_name` LIKE ? AND `flag` = 1 
    UNION ALL
    SELECT 
        prod_id, camp_menu_id	 AS brand_id, c_submenu_id AS modal_id, product_name, billing_name, product_price, 
        offer_price, offer_type, offer_details, arrival_status, stock_status, 
        redirect_url, product_img, img_1, img_2, img_3, img_4, img_5, img_6, 
           img_7, img_8, img_9, img_10, prod_desc, 
           hot_sale, tbl_name, search_brand, weight, weight_units, quantity, 
           specifications, flag,  6 AS order_col
    FROM 
         tbl_camping_products
         WHERE  `product_name` LIKE ? AND `flag` = 1 
    ORDER BY 
        order_col, prod_id";

        $searchPattern = "%$searchData%";
        $res['search_data'] = $db->query($query1, [
            $searchPattern,
            $searchPattern,
            $searchPattern,
            $searchPattern,
            $searchPattern,
            $searchPattern
        ])->getResultArray();




        $db = \Config\Database::connect();
        $res['brand_master'] = $db->query('SELECT * FROM `brand_master` WHERE  `flag` =1 ORDER BY brand_name ASC')->getResultArray();
        $res['brand'] = $db->query('SELECT `brand_id`,UPPER(`brand_name`) AS `brand_name` ,`brand_img` FROM `tbl_brand_master` WHERE  `flag` =1 ORDER BY brand_name ASC')->getResultArray();
        $res['modal'] = $db->query('SELECT `modal_id` ,`brand_id`, CONCAT(UPPER(SUBSTRING(modal_name, 1, 1)), LOWER(SUBSTRING(modal_name, 2))) AS `modal_name` FROM `tbl_modal_master` WHERE  `flag` = 1 ORDER BY modal_name ASC ')->getResultArray();

        $res['accessories'] = $db->query('SELECT `access_id`, UPPER(`access_title`) AS `access_title`  FROM `tbl_access_master` WHERE `flag` = 1  ORDER BY  `access_title` ASC;')->getResultArray();
        $res['sub_accessories'] = $db->query('SELECT `sub_access_id`,`access_id`, CONCAT(UPPER(SUBSTRING(`sub_access_name`, 1, 1)), LOWER(SUBSTRING(`sub_access_name`, 2))) AS `sub_access_name`  FROM `tbl_subaccess_master` WHERE `flag` = 1 ORDER BY sub_access_name ASC;')->getResultArray();

        $res['riding_menu'] = $db->query('SELECT `r_menu_id` , UPPER(`r_menu`) AS `r_menu`  FROM `tbl_riding_menu` WHERE `flag` =1 ORDER BY r_menu ASC;')->getResultArray();
        $res['riding_submenu'] = $db->query('SELECT `r_sub_id`,`r_menu_id`,CONCAT(UPPER(SUBSTRING(`r_sub_menu`, 1, 1)), LOWER(SUBSTRING(`r_sub_menu`, 2))) AS `r_sub_menu`  FROM `tbl_riding_submenu` WHERE flag =1 ORDER BY r_sub_menu ASC')->getResultArray();

        $res['lug_menu'] = $db->query('SELECT `lug_menu_id`,UPPER(`lug_menu`) AS `lug_menu`  FROM `tbl_luggage_menu` WHERE  `flag` = 1 ORDER BY lug_menu')->getResultArray();
        $res['lud_submenu'] = $db->query('SELECT `lug_submenu_id`,`lug_menu_id`,CONCAT(UPPER(SUBSTRING(`lug_submenu`, 1, 1)), LOWER(SUBSTRING(`lug_submenu`, 2))) AS `lug_submenu` FROM `tbl_luggage_submenu` WHERE  `flag` =1 ORDER BY lug_submenu ASC')->getResultArray();

        $res['h_menu'] = $db->query('SELECT `h_menu_id`,UPPER(`h_menu`) AS `h_menu` FROM `tbl_helmet_menu` WHERE `flag` = 1 ORDER BY h_menu ASC')->getResultArray();
        $res['h_submenu'] = $db->query('SELECT `h_submenu_id`,`h_menu_id`, CONCAT(UPPER(SUBSTRING(`h_submenu`, 1, 1)), LOWER(SUBSTRING(`h_submenu`, 2))) AS `h_submenu`,`hsubmenu_img`FROM `tbl_helmet_submenu` WHERE `flag` = 1 ORDER BY h_submenu ASC')->getResultArray();

        $res['h_submenu_list'] = $db->query('SELECT `h_submenu_id`,`h_menu_id`, CONCAT(UPPER(SUBSTRING(`h_submenu`, 1, 1)), LOWER(SUBSTRING(`h_submenu`, 2))) AS `h_submenu`,`hsubmenu_img`FROM `tbl_helmet_submenu` WHERE `flag` = 1 AND  `h_menu_id` = 2 ORDER BY h_submenu ASC')->getResultArray();

        $res['camp_menu'] = $db->query('SELECT `camp_menu_id` ,UPPER(`camp_menu`) AS `camp_menu` FROM `tbl_camping_menu` WHERE flag = 1 ORDER BY camp_menu ASC;')->getResultArray();
        $res['camp_submenu'] = $db->query('SELECT `c_submenu_id`,`camp_menuid`,  CONCAT(UPPER(SUBSTRING(`c_submenu`, 1, 1)), LOWER(SUBSTRING(`c_submenu`, 2))) AS `c_submenu`,`csubmenu_img` FROM `tbl_camping_submenu` WHERE flag = 1 ORDER BY `c_submenu` ASC')->getResultArray();



        // to get wishlist count prodFilter
        $res['wishlist_count'] = $this->getWishlistCount();

        // toget cart count
        $userID = session()->get('user_id');
        $query = "SELECT * FROM tbl_user_cart WHERE user_id = ? AND flag =1";
        $usercount = $db->query($query, [$userID])->getResultArray();
        if ($usercount > 0) {
            $res['cart_count'] = sizeof($usercount);

        } else {
            $res['cart_count'] = 0;
        }

        return view("searchfiltrView", $res);

    }


    public function getWishlistCount()
    {
        $db = \Config\Database::connect();
        $userID = session()->get('user_id');

        $query = "SELECT * FROM tbl_wishlist WHERE user_id = ? AND flag =1";
        $usercount = $db->query($query, [$userID])->getResultArray();
        if (!empty($usercount)) {
            $res = sizeof($usercount);
        } else {
            $res = 0;
        }
        return $res;
    }

    public function getSuggession()
    {
        $db = \Config\Database::connect();
        $input = $this->request->getpost("data");
        print_r($input);
        exit;

    }

    public function BikeProdFilter()
    {

        $db = \Config\Database::connect();
        $minPrice = $this->request->getPost();


        $minPrice = $this->request->getPost('minimum_price');
        $maxPrice = $this->request->getPost('maximum_price');
        $available = $this->request->getPost('available');
        $brand = $this->request->getPost('brand');
        $orderby = $this->request->getPost('orderby');



        $query = "SELECT a.*, b.modal_name 
                    FROM tbl_accessories_list AS a 
                    LEFT JOIN tbl_common_accessories AS b 
                    ON a.prod_id = b.prod_id 
                    WHERE a.flag = 1 
                    AND b.modal_name = 0";

        if (isset($minPrice, $maxPrice) && !empty($minPrice) && !empty($maxPrice)) {
            $minPrice = $db->escapeString($minPrice);
            $maxPrice = $db->escapeString($maxPrice);
            $query .= " AND a.offer_price BETWEEN '$minPrice' AND '$maxPrice'";
        }


        if (isset($available) && !empty($available)) {
            if (isset($available[0]) && $available[0] == 1) {
                $query .= " AND a.quantity > 0";
            }
            if (isset($available[1]) && $available[1] == 0) {
                $query .= " AND a.quantity <= 0";
            }
        }


        if (isset($brand) && !empty($brand)) {
            $brandFiltr = array_map([$db, 'escapeString'], $brand);
            $brandFiltr = implode("','", $brandFiltr);
            $query .= " AND a.search_brand IN ('" . $brandFiltr . "')";
        }


        if (isset($orderby) && !empty($orderby)) {
            $orderr = ($orderby == 0) ? "ASC" : "DESC";
            $query .= " ORDER BY a.product_name " . $orderr;
        }


        $query = trim($query);


        $resultData = $db->query($query)->getResultArray();

        echo json_encode($resultData);
    }

    public function prodFilter()
    {

        $db = \Config\Database::connect();
        $data = $this->request->getPost();


        $minPrice = $this->request->getPost('minimum_price');
        $maxPrice = $this->request->getPost('maximum_price');
        $available = $this->request->getPost('available');
        $brand = $this->request->getPost('brand');
        $orderby = $this->request->getPost('orderby');
        $tablename = $this->request->getPost('tablename');
        $submenu_id = $this->request->getPost('submenu_id');


        $submenuMap = [
            "tbl_products" => "modal_id",
            "tbl_accessories_list" => "sub_access_id",
            "tbl_rproduct_list" => "r_sub_id",
            "tbl_helmet_products" => "h_submenu_id",
            "tbl_luggagee_products" => "lug_submenu_id",
            "tbl_camping_products" => "c_submenu_id"
        ];

        $submenu = isset($submenuMap[$tablename]) ? $submenuMap[$tablename] : null;

        $query = "SELECT * FROM $tablename WHERE `flag` = 1 AND $submenu = $submenu_id";


        if (isset($minPrice, $maxPrice) && !empty($minPrice) && !empty($maxPrice)) {
            $query .= "
                AND offer_price BETWEEN '" . $minPrice . "' AND '" . $maxPrice . "'
            ";
        }

        if (isset($available) && !empty($available)) {
            if ($available[0] == 1) {
                $query .= " AND quantity > 0";
            } else if ($available[1] == 0) {
                $query .= " AND quantity <= 0";
            }
        }


        if (isset($brand) && !empty($brand)) {

            $brandFiltr = array_map([$db, 'escapeString'], $brand);
            $brandFiltr = implode("','", $brandFiltr);
            $query .= " AND search_brand IN('" . $brandFiltr . "')";
        }


        if ($orderby == "") {
            $query .= "";
        } else if (isset($orderby) && !empty($orderby)) {
            $orderr = ($orderby == 0) ? "ASC " : "DESC";
            $query .= "ORDER BY product_name " . $orderr;
        }

        $resultData = $db->query($query)->getResultArray();

        echo json_encode($resultData);
    }


    public function offersFilter()
    {

        $db = \Config\Database::connect();
        $minPrice = $this->request->getPost('minimum_price');
        $maxPrice = $this->request->getPost('maximum_price');
        $available = $this->request->getPost('available');
        $brand = $this->request->getPost('brand');
        $orderby = $this->request->getPost('orderby');

        $query = "SELECT *
        FROM (
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_products
            WHERE flag = 1 AND offer_type = 0
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_products') . "
            
            UNION 
            
            SELECT * ,offer_type AS otype , offer_price AS oprice
            FROM tbl_accessories_list
            WHERE flag = 1 AND offer_type = 0
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_accessories_list') . "
            
            UNION 
            
            SELECT * ,offer_type AS otype , offer_price AS oprice
            FROM tbl_helmet_products
            WHERE flag = 1 AND offer_type = 0
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_helmet_products') . "
            
            UNION 
            
            SELECT * ,offer_type AS otype , offer_price AS oprice
            FROM tbl_luggagee_products
            WHERE flag = 1 AND offer_type = 0
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_luggagee_products') . "
            
            UNION 
            
            SELECT * ,offer_type AS otype , offer_price AS oprice
            FROM tbl_rproduct_list
            WHERE flag = 1 AND offer_type = 0
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_rproduct_list') . "
            
            UNION
            
            SELECT * ,offer_type AS otype , offer_price AS oprice
            FROM tbl_camping_products
            WHERE flag = 1 AND offer_type = 0
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_camping_products') . "
        ) AS combined_results
    ";

        if (!empty($orderby)) {
            $query .= " ORDER BY product_name {$orderby}";
        }
        $resultData = $db->query($query)->getResultArray();
        echo json_encode($resultData);
    }


    // filter function for all tables
    private function buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, $tableAlias)
    {
        $conditions = "";
        if (isset($minPrice, $maxPrice) && !empty($minPrice) && !empty($maxPrice)) {
            $conditions .= " AND {$tableAlias}.offer_price BETWEEN {$minPrice} AND {$maxPrice}";
        }
        if (isset($available) && !empty($available)) {

            if ($available[0] == 1) {
                $availableCondition = " > 0";
            } else if ($available[0] == 0) {
                $availableCondition = " <= 0";
            }

            $conditions .= " AND {$tableAlias}.quantity {$availableCondition}";
        }
        if (isset($brand) && !empty($brand)) {
            $placeholders = implode("','", $brand);
            $conditions .= " AND {$tableAlias}.search_brand IN ('{$placeholders}')";
        }

        return $conditions;
    }


    public function newArrivalFilter()
    {

        $db = \Config\Database::connect();
        $minPrice = $this->request->getPost('minimum_price');
        $maxPrice = $this->request->getPost('maximum_price');
        $available = $this->request->getPost('available');
        $brand = $this->request->getPost('brand');
        $orderby = $this->request->getPost('orderby');

        $query = "SELECT *
        FROM (
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_products
            WHERE flag = 1 AND arrival_status = 1
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_products') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_accessories_list
            WHERE flag = 1 AND arrival_status = 1
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_accessories_list') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_helmet_products
            WHERE flag = 1 AND arrival_status = 1
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_helmet_products') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_luggagee_products
            WHERE flag = 1 AND arrival_status = 1
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_luggagee_products') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_rproduct_list
            WHERE flag = 1 AND arrival_status = 1
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_rproduct_list') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_camping_products
            WHERE flag = 1 AND arrival_status = 1
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_camping_products') . "
        ) AS combined_results
    ";
        if (!empty($orderby)) {
            $query .= " ORDER BY product_name {$orderby}";
        }
        $resultData = $db->query($query)->getResultArray();
        echo json_encode($resultData);
    }

    public function hotsaleFilter()
    {

        $db = \Config\Database::connect();
        $minPrice = $this->request->getPost('minimum_price');
        $maxPrice = $this->request->getPost('maximum_price');
        $available = $this->request->getPost('available');
        $brand = $this->request->getPost('brand');
        $orderby = $this->request->getPost('orderby');
        $tablename = $this->request->getPost('tablename');


        $query = "SELECT *
        FROM (
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_products
            WHERE flag = 1 AND `hot_sale` =  1
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_products') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_accessories_list
            WHERE flag = 1 AND `hot_sale` =  1
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_accessories_list') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_helmet_products
            WHERE flag = 1 AND `hot_sale` =  1
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_helmet_products') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_luggagee_products
            WHERE flag = 1 AND `hot_sale` =  1
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_luggagee_products') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_rproduct_list
            WHERE flag = 1 AND `hot_sale` =  1
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_rproduct_list') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_camping_products
            WHERE flag = 1 AND `hot_sale` =  1
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_camping_products') . "
        ) AS combined_results
    ";
        if (!empty($orderby)) {
            $query .= " ORDER BY product_name {$orderby}";
        }
        $resultData = $db->query($query)->getResultArray();
        echo json_encode($resultData);
    }

    public function brandFilter()
    {

        $db = \Config\Database::connect();
        $minPrice = $this->request->getPost('minimum_price');
        $maxPrice = $this->request->getPost('maximum_price');
        $available = $this->request->getPost('available');
        $brand = $this->request->getPost('brand');
        $orderby = $this->request->getPost('orderby');



        $query = "SELECT *
        FROM (
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_products
            WHERE flag = 1 
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_products') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_accessories_list
            WHERE flag = 1 
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_accessories_list') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_helmet_products
            WHERE flag = 1 
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_helmet_products') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_luggagee_products
            WHERE flag = 1 
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_luggagee_products') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_rproduct_list
            WHERE flag = 1 
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_rproduct_list') . "
            
            UNION ALL
            
            SELECT *, offer_type AS otype , offer_price AS oprice
            FROM tbl_camping_products
            WHERE flag = 1 
            " . $this->buildAdditionalConditions($minPrice, $maxPrice, $available, $brand, 'tbl_camping_products') . "
        ) AS combined_results
    ";
        if (!empty($orderby)) {
            $query .= " ORDER BY product_name {$orderby}";
        }
        $resultData = $db->query($query)->getResultArray();
        echo json_encode($resultData);
    }
}
