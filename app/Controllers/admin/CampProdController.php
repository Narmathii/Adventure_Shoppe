<?php
namespace App\Controllers\admin;

use App\Models\admin\CampProdModel;
use App\Models\admin\ProdConfigModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class CampProdController extends BaseController
{

    public function campProducts()
    {
        $db = \Config\Database::connect();

        $res['menu'] = $db->query('SELECT `camp_menu_id`,`camp_menu` FROM `tbl_camping_menu` WHERE  `flag` =1')->getResultArray();
        $res['colour'] = $db->query('SELECT * FROM `tbl_color` WHERE `flag` = 1')->getResultArray();
        $res['searchbrand'] = $db->query('SELECT `brand_master_id`,`brand_name` FROM `brand_master` WHERE `flag`=1 ORDER BY brand_name ASC')->getResultArray();
        $session = \Config\Services::session();
        if ($session->get('login_sts') == "") {
            return redirect()->to('admin');
        } else {
            return view('admin/campProducts', $res);
        }

    }

    // *************************** [Insert] *************************************************************************

    public function insertCampProducts()
    {

        $validation = \Config\Services::validation();
        $modal = new CampProdModel;
        $configg = new ProdConfigModel;

        $db = \Config\Database::connect();
        $data = $this->request->getPost();

        $data['tbl_name'] = "tbl_camping_products";

        $validation->setRules([
            'product_img' => 'uploaded[product_img]|is_image[product_img]|mime_in[product_img,image/jpg,image/jpeg,image/png]',

        ]);


        $productImg = $this->request->getFile('product_img');


        if (!$validation->withRequest($this->request)->run()) {
            $res = $validation->getErrors();
            $result['code'] = 400;
            $result['status'] = 'Failure';
            $result['msg'] = 'Allowed Files : jpeg,jpg and png !!!';
            echo json_encode($result);

        } else {
            $Img1 = $this->request->getFile('img_1');
            $Img2 = $this->request->getFile('img_2');
            $Img3 = $this->request->getFile('img_3');
            $Img4 = $this->request->getFile('img_4');
            $Img5 = $this->request->getFile('img_5');
            $Img6 = $this->request->getFile('img_6');
            $Img7 = $this->request->getFile('img_7');
            $Img8 = $this->request->getFile('img_8');
            $Img9 = $this->request->getFile('img_9');
            $Img10 = $this->request->getFile('img_10');


            $productImg->move('./uploads/ProductImg/');
            if ($Img1 && $Img1->isValid() && !$Img1->hasMoved()) {
                $Img1->move('./uploads/Img1/');
            }
            if ($Img2 && $Img2->isValid() && !$Img2->hasMoved()) {
                $Img2->move('./uploads/Img2/');
            }
            if ($Img3 && $Img3->isValid() && !$Img3->hasMoved()) {
                $Img3->move('./uploads/Img3/');
            }
            if ($Img4 && $Img4->isValid() && !$Img4->hasMoved()) {
                $Img4->move('./uploads/Img4/');
            }
            if ($Img5 && $Img5->isValid() && !$Img5->hasMoved()) {
                $Img5->move('./uploads/');
            }
            if ($Img6 && $Img6->isValid() && !$Img6->hasMoved()) {
                $Img6->move('./uploads');
            }
            if ($Img7 && $Img7->isValid() && !$Img7->hasMoved()) {
                $Img7->move('./uploads');
            }
            if ($Img8 && $Img8->isValid() && !$Img8->hasMoved()) {
                $Img8->move('./uploads');
            }
            if ($Img9 && $Img9->isValid() && !$Img9->hasMoved()) {
                $Img9->move('./uploads');
            }
            if ($Img10 && $Img10->isValid() && !$Img10->hasMoved()) {
                $Img10->move('./uploads');
            }


            $file_path1 = '/uploads/ProductImg/';
            $file_path2 = '/uploads/Img1/';
            $file_path3 = '/uploads/Img2/';
            $file_path4 = '/uploads/Img3/';
            $file_path5 = '/uploads/Img4/';
            $file_path = '/uploads';

            $Prodname = $productImg->getName();
            $img_1 = $Img1->getName();
            $img_2 = $Img2->getName();
            $img_3 = $Img3->getName();
            $img_4 = $Img4->getName();
            $img_5 = $Img5 ? $Img5->getName() : " ";
            $img_6 = $Img6 ? $Img6->getName() : " ";
            $img_7 = $Img7 ? $Img7->getName() : " ";
            $img_8 = $Img8 ? $Img8->getName() : " ";
            $img_9 = $Img9 ? $Img9->getName() : " ";
            $img_10 = $Img10 ? $Img10->getName() : " ";

            $data['product_img'] = $file_path1 . $Prodname;
            $data['img_1'] = $file_path2 . $img_1;
            $data['img_2'] = $file_path3 . $img_2;
            $data['img_3'] = $file_path4 . $img_3;
            $data['img_4'] = $file_path5 . $img_4;
            $data['img_5'] = $img_5 ? $file_path . $img_5 : " ";
            $data['img_6'] = $img_6 ? $file_path . $img_6 : " ";
            $data['img_7'] = $img_7 ? $file_path . $img_7 : " ";
            $data['img_8'] = $img_8 ? $file_path . $img_8 : " ";
            $data['img_9'] = $img_9 ? $file_path . $img_9 : " ";
            $data['img_10'] = $img_10 ? $file_path . $img_10 : " ";

            $insertData = $modal->insert($data);

            $affectedRows1 = $db->affectedRows();

            $stockSts = $this->request->getPost('soldout_status');
            $size = $this->request->getPost('size');
            $prodID = $modal->insertID();
            $tblName = "tbl_camping_products";

            if ($affectedRows1) {
                $data2 = [
                    'prod_id' => $prodID,
                    'tbl_name' => $tblName,
                    'size' => json_encode($size),
                    'soldout_status' => json_encode($stockSts),
                ];


                $query = "SELECT * FROM `tbl_configuration` WHERE `flag` = 1 AND `prod_id` = ?";
                $oldData = $db->query($query, [$prodID])->getResultArray();

                if (count($oldData) > 0) {

                    $updateQuery = "UPDATE tbl_configuration SET tbl_name = ?, colour = ?, size = ?, soldout_status = ?, config_img1 = ?, config_img2 = ?, config_img3 = ?, config_img4 = ? WHERE prod_id = ?";
                    $updateData = $db->query($updateQuery, [$tblName, $data2['colour'], $data2['size'], $data2['soldout_status'], $data2['config_img1'], $data2['config_img2'], $data2['config_img3'], $data2['config_img4'], $prodID]);
                    $affectedRows = $db->affectedRows();
                } else {

                    $insertConfig = $configg->insert($data2);
                }

                $affectedRows = $db->affectedRows();
                if ($affectedRows === 1) {
                    $result['code'] = 200;
                    $result['msg'] = 'Data Inserted Successfully';
                    $result['status'] = 'success';
                    echo json_encode($result);
                } else {
                    $result['code'] = 400;
                    $result['status'] = 'Failed';
                    $result['msg'] = 'Something went wrong';
                    echo json_encode($result);
                }
            }
        }
    }


    public function getCampProducts()
    {

        $db = \Config\Database::connect();

        $query =
            'SELECT
            a.camp_menu,
            d.prod_id AS configid,
            b.*,
            c.c_submenu,
            d.`config_id`,
            d.`tbl_name`,
            d.`colour`,
            d.`size`,
            d.`soldout_status`,
            d.`config_img1`,
            d.`config_img2`,
            d.`config_img3`,
            d.`config_img4`
        FROM
            tbl_camping_menu AS a
        INNER JOIN tbl_camping_products AS b
        ON
            a.camp_menu_id = b.camp_menu_id
        INNER JOIN tbl_camping_submenu AS c
        ON
            c.c_submenu_id = b.c_submenu_id
        LEFT JOIN tbl_configuration AS d
        ON
            d.prod_id = b.prod_id OR d.prod_id IS NULL
        WHERE
            b.flag = 1
            ORDER BY `camp_menu` ASC ';
        $res = $db->query($query)->getResultArray();



        echo json_encode($res);
    }

    // *************************** [update] *************************************************************************

    public function updateCampProducts()
    {
        $db = \Config\Database::connect();
        $configg = new ProdConfigModel;

        $prodId = $this->request->getPost('prod_id');
        $configId = $this->request->getPost('config_id');

        $data = $this->request->getPost();

        $tblName = "tbl_camping_products";


        ini_set('memory_limit', '1024M');

        // product Images and image1 - image 10
        $query = "SELECT product_img,img_1,img_2,img_3,img_4,img_5,img_6,img_7,img_8,img_9,img_10 FROM `tbl_camping_products` WHERE `flag` = 1 AND `prod_id` = ? ";
        $oldproductImages = $db->query($query, [$prodId])->getResultArray();

        $old_productImg = $oldproductImages[0]['product_img'];
        $old_img_1 = $oldproductImages[0]['img_1'];
        $old_img_2 = $oldproductImages[0]['img_2'];
        $old_img_3 = $oldproductImages[0]['img_3'];
        $old_img_4 = $oldproductImages[0]['img_4'];
        $old_img_5 = $oldproductImages[0]['img_5'];
        $old_img_6 = $oldproductImages[0]['img_6'];
        $old_img_7 = $oldproductImages[0]['img_7'];
        $old_img_8 = $oldproductImages[0]['img_8'];
        $old_img_9 = $oldproductImages[0]['img_9'];
        $old_img_10 = $oldproductImages[0]['img_10'];


        $productImage = "";
        $newProdImage = $this->request->getFile('product_img');
        if ($newProdImage->getName() == '') {
            $productImage = $old_productImg;
        } else {
            if ($newProdImage->isValid() && !$newProdImage->hasMoved()) {
                $prodnamee = $newProdImage->getName();
                $prodname = str_replace(" ", "_", $prodnamee);
                $filePath = "uploads/ProductImg/";
                $newProdImage->move($filePath, $prodname);
                $productImage = $filePath . $prodname;
            } else {
                $productImage = $old_productImg;
            }
        }

        $Image1 = "";
        $new_img_1 = $this->request->getFile('img_1');
        if ($new_img_1->getName() == '') {
            $Image1 = $old_img_1;
        } else {
            if ($new_img_1->isValid() && !$new_img_1->hasMoved()) {
                $image1_name = $new_img_1->getName();
                $image1 = str_replace(" ", "_", $image1_name);
                $filePath = "uploads/Img1/";
                $new_img_1->move($filePath, $image1);
                $Image1 = $filePath . $image1;
            } else {
                $Image1 = $old_img_1;
            }
        }

        $Image2 = "";
        $new_img_2 = $this->request->getFile('img_2');
        if ($new_img_2->getName() == '') {
            $Image2 = $old_img_2;
        } else {
            if ($new_img_2->isValid() && !$new_img_2->hasMoved()) {
                $image2_name = $new_img_2->getName();
                $image2 = str_replace(" ", "_", $image2_name);
                $filePath = "uploads/Img2/";
                $new_img_2->move($filePath, $image2);
                $Image2 = $filePath . $image2;
            } else {
                $Image2 = $old_img_2;
            }
        }


        $Image3 = "";
        $new_img_3 = $this->request->getFile('img_3');
        if ($new_img_3->getName() == '') {
            $Image3 = $old_img_3;
        } else {
            if ($new_img_3->isValid() && !$new_img_3->hasMoved()) {
                $image3_name = $new_img_3->getName();
                $image3 = str_replace(" ", "_", $image3_name);
                $filePath = "uploads/Img3/";
                $new_img_3->move($filePath, $image3);
                $Image3 = $filePath . $image3;
            } else {
                $Image3 = $old_img_3;
            }
        }

        $Image4 = "";
        $new_img_4 = $this->request->getFile('img_4');
        if ($new_img_4->getName() == '') {
            $Image4 = $old_img_4;
        } else {
            if ($new_img_4->isValid() && !$new_img_4->hasMoved()) {
                $image4_name = $new_img_4->getName();
                $image4 = str_replace(" ", "_", $image4_name);
                $filePath = "uploads/Img4/";
                $new_img_4->move($filePath, $image4);
                $Image4 = $filePath . $image4;
            } else {
                $Image4 = $old_img_4;
            }
        }


        $Image5 = "";
        $new_img_5 = $this->request->getFile('img_5');
        if ($new_img_5->getName() == '') {
            $Image5 = $old_img_5;
        } else {
            if ($new_img_5->isValid() && !$new_img_5->hasMoved()) {
                $image5_name = $new_img_5->getName();
                $image5 = str_replace(" ", "_", $image5_name);
                $filePath = "uploads/";
                $new_img_5->move($filePath, $image5);
                $Image5 = $filePath . $image5;
            } else {
                $Image5 = $old_img_5;
            }
        }

        $Image6 = "";
        $new_img_6 = $this->request->getFile('img_6');
        if ($new_img_6->getName() == '') {
            $Image6 = $old_img_6;
        } else {
            if ($new_img_6->isValid() && !$new_img_6->hasMoved()) {
                $image6_name = $new_img_6->getName();
                $image6 = str_replace(" ", "_", $image6_name);
                $filePath = "uploads/";
                $new_img_6->move($filePath, $image6);
                $Image6 = $filePath . $image6;
            } else {
                $Image6 = $old_img_6;
            }
        }



        $Image7 = "";
        $new_img_7 = $this->request->getFile('img_7');
        if ($new_img_7->getName() == '') {
            $Image7 = $old_img_7;
        } else {
            if ($new_img_7->isValid() && !$new_img_7->hasMoved()) {
                $image7_name = $new_img_7->getName();
                $image7 = str_replace(" ", "_", $image7_name);
                $filePath = "uploads/";
                $new_img_7->move($filePath, $image7);
                $Image7 = $filePath . $image7;
            } else {
                $Image7 = $old_img_7;
            }
        }

        $Image8 = "";
        $new_img_8 = $this->request->getFile('img_8');
        if ($new_img_8->getName() == '') {
            $Image8 = $old_img_8;
        } else {
            if ($new_img_8->isValid() && !$new_img_8->hasMoved()) {
                $image8_name = $new_img_8->getName();
                $image8 = str_replace(" ", "_", $image8_name);
                $filePath = "uploads/";
                $new_img_8->move($filePath, $image8);
                $Image8 = $filePath . $image8;
            } else {
                $Image8 = $old_img_8;
            }
        }


        $Image9 = "";
        $new_img_9 = $this->request->getFile('img_9');
        if ($new_img_9->getName() == '') {
            $Image9 = $old_img_9;
        } else {
            if ($new_img_9->isValid() && !$new_img_9->hasMoved()) {
                $image9_name = $new_img_9->getName();
                $image9 = str_replace(" ", "_", $image9_name);
                $filePath = "uploads/";
                $new_img_9->move($filePath, $image9);
                $Image9 = $filePath . $image9;
            } else {
                $Image9 = $old_img_9;
            }
        }

        $Image10 = " ";
        $new_img_10 = $this->request->getFile('img_10');
        if ($new_img_10->getName() == '') {
            $Image10 = $old_img_10;
        } else {
            if ($new_img_10->isValid() && !$new_img_10->hasMoved()) {
                $image10_name = $new_img_10->getName();
                $image10 = str_replace(" ", "_", $image10_name);
                $filePath = "uploads/";
                $new_img_10->move($filePath, $image10);
                $Image10 = $filePath . $image10;
            } else {
                $Image10 = $old_img_10;
            }
        }

        $data = [
            'r_menu_id' => $this->request->getPost('r_menu_id'),
            'r_sub_id' => $this->request->getPost('r_sub_id'),
            'billing_name' => $this->request->getPost('billing_name'),
            'product_name' => $this->request->getPost('product_name'),
            'product_price' => $this->request->getPost('product_price'),
            'offer_price' => $this->request->getPost('offer_price'),
            'offer_details' => $this->request->getPost('offer_details'),
            'arrival_status' => $this->request->getPost('arrival_status'),
            'stock_status' => $this->request->getPost('stock_status'),
            'redirect_url' => $this->request->getPost('redirect_url'),
            'offer_type' => $this->request->getPost('offer_type'),
            'product_img' => $productImage,
            'img_1' => $Image1,
            'img_2' => $Image2,
            'img_3' => $Image3,
            'img_4' => $Image4,
            'img_5' => $Image5,
            'img_6' => $Image6,
            'img_7' => $Image7,
            'img_8' => $Image8,
            'img_9' => $Image9,
            'img_10' => $Image10,
            'prod_desc' => $this->request->getPost('prod_desc'),
            'hot_sale' => $this->request->getPost('hot_sale'),
            'tbl_name' => 'tbl_camping_products',
            'search_brand' => $this->request->getPost('search_brand'),
            'weight' => $this->request->getPost('weight'),
            'weight_units' => $this->request->getPost('offer_type'),
            'quantity' => $this->request->getPost('quantity'),
            'specifications' => $this->request->getPost('specifications'),
        ];

        $modal = new CampProdModel;
        $updateRes = $modal->update($prodId, $data);
        $affectedRows1 = $db->affectedRows();




        // CONFIGURATION  IMAGES
        // data 2
        $stockSts = $this->request->getPost('soldout_status');

        $size = $this->request->getPost('size');
        $prodID = $prodId;
        $tblName = "tbl_camping_products";


        $data2 = [
            'prod_id' => $prodID,
            'tbl_name' => $tblName,
            'size' => json_encode($size),
            'soldout_status' => json_encode($stockSts),
        ];


        $query = "SELECT * FROM `tbl_configuration` WHERE `flag` = 1 AND `prod_id` = ?";
        $oldData = $db->query($query, [$prodID])->getResultArray();


        if (count($oldData) > 0) {

            $updateQuery = "UPDATE tbl_configuration SET tbl_name = ?, size = ?, soldout_status = ? WHERE prod_id = ?";
            $updateData = $db->query($updateQuery, [$tblName, $data2['size'], $data2['soldout_status'], $prodID]);
            $affectedRows2 = $db->affectedRows();

        } else {

            $insertConfig = $configg->insert($data2);
            $affectedRows2 = $db->affectedRows();
        }

        if ($affectedRows1 || $affectedRows2) {
            $result['code'] = 200;
            $result['msg'] = 'Data updates Successfully';
            $result['status'] = 'success';
            echo json_encode($result);
        } else {
            $result['code'] = 400;
            $result['msg'] = 'Something Wrong';
            $result['status'] = 'failure';
            echo json_encode($result);
        }

    }
    // *************************** [Delete] *************************************************************************


    public function deleteCampProducts()
    {

        $db = \Config\Database::connect();

        $prodId = $this->request->getPost('prod_id');


        $query = 'update`tbl_camping_products` SET `flag` = 0 WHERE `prod_id` = ?';
        $res = $db->query($query, $prodId);

        $affected_rows = $db->affectedRows();

        if ($affected_rows && $res) {
            $result['code'] = 200;
            $result['status'] = 'success';
            $result['message'] = 'Deleted Successfully';
            echo json_encode($result);
        } else {
            $result['code'] = 400;
            $result['status'] = 'Failure';
            $result['message'] = 'Something wrong';
            echo json_encode($result);
        }

    }

    public function getCampSubmenu()
    {
        $db = \Config\Database::connect();
        $c_menu_id = $this->request->getPost('camp_menu_id');


        $query = 'SELECT `c_submenu_id`,`c_submenu` FROM tbl_camping_submenu 
        WHERE `camp_menuid` = ? AND flag = 1';
        $res = $db->query($query, [$c_menu_id])->getResultArray();
        echo json_encode($res);
    }

    public function exportCampProducts()
    {
        ini_set('memory_limit', '1024M');

        $db = \Config\Database::connect();
        $query = "SELECT
                    `product_name`,
                    `offer_price`,
                    CASE WHEN `offer_type` = 0 THEN 'Percentage' WHEN `offer_type` = 1 THEN 'Flat discount' WHEN `offer_type` = 2 THEN 'None' ELSE 'Other'
                END AS `offer_type_label`,
                `offer_details`,
                `quantity`,
                `weight`
                FROM
                    tbl_camping_products
                WHERE
                    `flag` = 1 AND `quantity` <= 0";

        // Query the stock details
        $stockDetails = $db->query($query)->getResultArray();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $filename = 'Camping_stocks.xlsx';

        // Set headers for the columns
        $sheet->setCellValue('A1', 'Product Name');
        $sheet->setCellValue('B1', 'Product Price');
        $sheet->setCellValue('C1', 'Offer Type');
        $sheet->setCellValue('D1', 'Offer Details');
        $sheet->setCellValue('E1', 'Weight');
        $sheet->setCellValue('F1', 'Quantity');

        /* set background */
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],

            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '829B2F',
                ],
            ],
        ];

        /* Style headers */
        $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

        /*Column width */
        $sheet->getColumnDimension('A')->setWidth(60);
        $sheet->getColumnDimension('C')->setWidth(50);

        // Populate the rows
        $row = 2;
        foreach ($stockDetails as $stock) {
            $sheet->setCellValue('A' . $row, $stock['product_name']);
            $sheet->setCellValue('B' . $row, $stock['offer_price']);
            $sheet->setCellValue('C' . $row, $stock['offer_type_label']);
            $sheet->setCellValue('D' . $row, $stock['offer_details']);
            $sheet->setCellValue('E' . $row, $stock['weight']);
            $sheet->setCellValue('F' . $row, $stock['quantity']);
            $row++;
        }

        // Write the file directly to the output stream
        $writer = new Xlsx($spreadsheet);

        // Set headers to force download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Save to PHP output
        $writer->save('php://output');
        exit();
    }

}


