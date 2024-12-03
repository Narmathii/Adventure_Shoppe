<?php

namespace App\Controllers\admin;

use App\Models\admin\BrandMasterModel;

class WishlistController extends BaseController
{

    public function wishlistDetails()
    {

        $session = \Config\Services::session();

        if ($session->get('login_sts') == "") {
            return redirect()->to('admin');
        } else {
            return view('admin/wishlist');
        }

    }



    // get Data
    public function getWishlistData()
    {
        $db = \Config\Database::connect();
        $data = $db->query("SELECT `prod_id`, `tbl_name`, COUNT(`prod_id`) AS wishlist FROM `tbl_wishlist` WHERE `flag` = 1 GROUP BY prod_id")->getResultArray();

        $allResults = [];

        for ($i = 0; $i < count($data); $i++) {
            $tableName = $data[$i]['tbl_name'];
            $prodID = $data[$i]['prod_id'];
            $count = $data[$i]['wishlist'];

            $query = "SELECT `product_name`, `product_img` FROM $tableName WHERE `flag` = 1 AND `prod_id` = ? ORDER BY prod_id ASC";
            $getresult = $db->query($query, [$prodID])->getResultArray();

            if (!empty($getresult)) {
                foreach ($getresult as $product) {
                    $allResults[] = [
                        'product_name' => $product['product_name'],
                        'product_img' => $product['product_img'],
                        'wishlist_count' => $count
                    ];
                }
            }
        }

        echo json_encode($allResults);
    }


}