<?php
namespace App\Controllers;

use App\Models\WishlistModel;

class WishlistController extends BaseController
{

    public function addwishlist()
    {
        $wishModel = new WishlistModel();
        $this->session = \Config\Services::session();
        $db = \Config\Database::connect();
        $userID = session()->get('user_id');

        $prodID = $this->request->getPost('prod_id');
        $tblName = $this->request->getPost('tbl_name');
        $quantity = $this->request->getPost('quantity');

        $data = [
            'prod_id' => $prodID,
            'tbl_name' => $tblName,
            'user_id' => $userID,

        ];

       
        $query = "SELECT * FROM `tbl_wishlist` WHERE `prod_id` = ? AND `tbl_name` = ? AND  `user_id` = ? AND `flag` = 1";
        $getData = $db->query($query, [$prodID, $tblName, $userID])->getResultArray();

        if (count($getData) > 0) {
            $res["code"] = "400";
            $res["msg"] = "Product Already in wishlist";

        } else {

            $insertData = $wishModel->insert($data);
            $affectedRow = $db->affectedRows();
            if ($insertData && $affectedRow > 0) {
                $res["code"] = "200";
                $res["msg"] = "Product added to your wishlist";

            }
        }

        echo json_encode($res);

    }

    public function deletewishlist()
    {
        $db = \Config\Database::connect();

        $prodID = $this->request->getPost('prod_id');
        // $csrf = $this->request->getHeader('X-CSRF-TOKEN')->getValue();

        $query = "UPDATE tbl_wishlist SET `flag` = 0 WHERE `prod_id` = ?";
        $dltData = $db->query($query, $prodID);

        $affectedRows = $db->affectedRows();

        if ($dltData && $affectedRows) {
            $result['code'] = 200;
            $result['msg'] = 'Product Deleted!!';
            $result['status'] = 'success';
            $result['csrf'] = csrf_hash();

            echo json_encode($result);
        } else {
            $result['code'] = 400;
            $result['msg'] = 'Something Wrong';
            $result['status'] = 'failure';
            $result['csrf'] = csrf_hash();
            echo json_encode($result);
        }
    }

}