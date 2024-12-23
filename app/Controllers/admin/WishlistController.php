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


    public function getWishlistData()
    {
        $db = \Config\Database::connect();
        $data = $db->query("SELECT `prod_id`, `tbl_name`, `user_id`, COUNT(`prod_id`) AS wishlist FROM `tbl_wishlist` WHERE `flag` = 1 GROUP BY prod_id")->getResultArray();

        $allResults = [];
        for ($i = 0; $i < count($data); $i++) {
            $tableName = $data[$i]['tbl_name'];
            $prodID = $data[$i]['prod_id'];
            $count = $data[$i]['wishlist'];
            $userID = $data[$i]['user_id'];


            $query = "SELECT `product_name`, `product_img` FROM $tableName WHERE `prod_id` = ?";
            $getresult = $db->query($query, [$prodID])->getResultArray();


            $q1 = "SELECT `username`, `email` FROM `tbl_users` WHERE `user_id` = ?";
            $getUserData = $db->query($q1, [$userID])->getResultArray();

            // If no user data, set default values
            if (count($getUserData) <= 0) {
                $userdata[$i]['username'] = "";
                $userdata[$i]['email'] = "";
            } else {
                $userdata[$i]['username'] = $getUserData[0]['username'];
                $userdata[$i]['email'] = $getUserData[0]['email'];
            }

            // Merge product and user data
            $mergedData = [];
            foreach ($getresult as $index => $product) {
                if (isset($userdata[$i])) {
                    $mergedData[] = array_merge($product, $userdata[$i]);
                } else {
                    $mergedData[] = $product;
                }
            }

            // If mergedData is not empty, add the merged result to allResults
            if (!empty($mergedData)) {
                foreach ($mergedData as $productData) {
                    $allResults[] = [
                        'product_name' => $productData['product_name'],
                        'product_img' => $productData['product_img'],
                        'wishlist_count' => $count,
                        'username' => $productData['username'],
                        'email' => $productData['email'],
                        'user_id' => $userID
                    ];
                }
            }
        }

        

        echo json_encode($allResults);
    }



}