<!DOCTYPE html>
<!-- TITLE -->
<title>Accessories List</title>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<?php require('components/head.php') ?>

<style>
    #prod_desc {
        height: 300px !important;
    }

    #product-feature,
    #description {
        display: block;
        white-space: pre-wrap;
        text-align: justify
    }

    .delete-size {
        margin-top: 25px !important;
    }

    .field-set2 .col-lg-3 {
        margin-right: 1rem;
    }

    .field-set2 .col-lg-3:last-child {
        margin-right: 0;

    }
</style>

<body>

    <!-- LOADER -->
    <div id="loader">
        <img src="<?php echo base_url() ?>assets/admin/build/assets/images/media/loader.svg" alt="">
    </div>
    <!-- END LOADER -->

    <!-- PAGE -->
    <div class="page">
        <?php require('components/topnav.php') ?>

        <?php require('components/sidenavbar.php') ?>

        <!-- MAIN-CONTENT -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <h1 class="page-title fw-semibold fs-18 mb-0">Accessories List</h1>
                    <div class="ms-md-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#">Masters</a></li>
                                <li class="breadcrumb-item"><a href="#">Accessories</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Accessories List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- Page Header Close -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header">
                                <a id="addData"
                                    class="btn btn-end btn-outline-primary btn-wave d-sm-flex align-items-center justify-content-between">Add
                                    Products</a>

                                <a href="<?= base_url() ?>export-accessory-stock"
                                    class="btn btn-end btn-outline-success btn-wave d-sm-flex align-items-center justify-content-between">
                                    Export Available Stock &nbsp; &nbsp;<i class="bi bi-download"></i></a>

                                <a href="<?= base_url() ?>export-outof-stock"
                                    class="btn btn-end btn-outline-danger btn-wave d-sm-flex align-items-center justify-content-between">
                                    Export Outof Stock &nbsp; &nbsp;<i class="bi bi-download"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered text-nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Menu</th>
                                                <th>Submenu</th>
                                                <th width="14%">Short Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- data -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="model-data" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg  modal-dialog-">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Add Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="Sub-product">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="access_id" class="form-label">Accessories Menu
                                    </label><br>
                                    <select class="form-control" name="access_id" id="access_id">
                                        <option value="">Select Menu</option>
                                        <?php foreach ($access_name as $data) { ?>
                                            <option value="<?php echo $data['access_id'] ?>">
                                                <?php echo $data['access_title'] ?>
                                            </option>

                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="sub_access_id" class="form-label">Sub Menu
                                    </label><br>
                                    <select class="form-control" name="sub_access_id" id="sub_access_id">
                                        <!-- code -->
                                    </select>
                                </div>

                                <div class="col-lg-6 mt-3">
                                    <div class="form-floating mb-4 floating">
                                        <input type="text" class="form-control product_name" id="billing_name"
                                            placeholder="Billing Name" name="billing_name" name="billing_name" value="">
                                        <label for="floatingInputprimary">Billing Name</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 mt-3">
                                    <div class="form-floating mb-4 floating">
                                        <input type="text" class="form-control product_name" id="product_name"
                                            placeholder="Short Name" name="product_name" name="product_name" value="">
                                        <label for="floatingInputprimary">Short Name</label>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label for="brand_id" class="form-label">Brand Name</label><br>
                                    <div id="brand-container" class="d-flex flex-wrap">
                                        <!-- "No Brands" Checkbox:: -->
                                        <div class="form-check me-3" style="width: auto;">
                                            <input class="form-check-input brand-checkbox" name="brand_name[]"
                                                type="checkbox" id="brand_id_-1" value="-1">
                                            <label class="form-check-label" for="brand_id_-1">
                                                No Selected Brands
                                            </label>
                                        </div>
                                        <!-- "All Brands" Checkbox:: -->
                                        <div class="form-check me-3" style="width: auto;">
                                            <input class="form-check-input brand-checkbox" name="brand_name[]"
                                                type="checkbox" id="brand_id_0" value="0">
                                            <label class="form-check-label" for="brand_id_0">
                                                All Brands
                                            </label>
                                        </div>

                                        <!-- Loop through $brand_name to display each brand -->
                                        <?php foreach ($brand_name as $brand) { ?>
                                            <div class="form-check me-3" style="width: auto;">
                                                <input class="form-check-input brand-checkbox" name="brand_name[]"
                                                    type="checkbox" id="brand_id_<?php echo $brand['brand_id'] ?>"
                                                    value="<?php echo $brand['brand_id'] ?>">
                                                <label class="form-check-label"
                                                    for="brand_id_<?php echo $brand['brand_id'] ?>">
                                                    <?php echo $brand['brand_name'] ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <span class="error text-danger brand_id mt-5"></span>
                                </div>

                                <div class="col-lg-12">
                                    <label for="modal_id" class="form-label">Modal Name
                                    </label><br>
                                    <div id="modal-container" class="d-flex flex-wrap"></div>
                                    <span class="error text-danger modal_id mt-5"></span>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <div class="form-floating mb-4 floating">
                                        <input type="text" class="form-control" name="product_price" id="product_price"
                                            placeholder="Product Price" value="">
                                        <label for="product_price">Product Price</label>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label for="access_id" class="form-label">Offer Type
                                    </label><br>
                                    <select class="form-select" name="offer_type" id="offer_type">
                                        <option value="">Select Offer Type</option>
                                        <option value="0">
                                            Percentage(%)
                                        </option>
                                        <option value="1">
                                            Flate discount
                                        </option>
                                        <option value="2">
                                            None
                                        </option>
                                    </select>
                                </div>

                                <div class="col-lg-4 mt-4">
                                    <div class="form-floating mb-4 floating">
                                        <input type="text" class="form-control offer_details" id="offer_details"
                                            placeholder="Offer Details" name="offer_details" value="">
                                        <label for="offer_details">Offer Details</label>
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-4">
                                    <div class="form-floating mb-4 floating">
                                        <input type="text" class="form-control" name="offer_price" id="offer_price"
                                            placeholder="Product Price" value="">
                                        <label for="offer_price">Offer Price</label>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label for="arrival_status" class="form-label">Inventory Status
                                    </label><br>
                                    <select class="form-control" name="arrival_status" id="arrival_status">
                                        <option value="">Select status</option>
                                        <option value="1">
                                            New arrivals
                                        </option>
                                        <option value="0">
                                            Current
                                        </option>
                                        <option value="2">
                                            Upcoming
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-4 ">
                                    <label for="stock_status" class="form-label">Stock status
                                    </label><br>
                                    <select class="form-select" name="stock_status" id="stock_status">
                                        <option value="">Select status</option>

                                        <option value="1">
                                            Available
                                        </option>
                                        <option value="0">
                                            Out of Stock
                                        </option>
                                        <option value="2">
                                            Contactus to order
                                        </option>

                                    </select>
                                    <span class="error text-danger stock_status mt-10"></span>
                                </div>


                                <div class="col-lg-4">
                                    <label for="redirect_url" class="form-label">Redirect Url
                                    </label><br>
                                    <input type="text" class="form-control redirect_url" id="redirect_url"
                                        placeholder="Redirect Url" name="redirect_url" value="">
                                    <span class="error text-danger redirect_url mt-10"></span>
                                </div>

                                <!-- quantity -->
                                <div class="col-lg-4 mt-3">
                                    <label for="quantity" class="form-label">Quantity
                                    </label><br>
                                    <input type="text" class="form-control quantity" id="quantity"
                                        placeholder="Quantity" name="quantity" value="">
                                    <span class="error text-danger quantity mt-10"></span>
                                </div>


                                <div class="col-lg-4 mt-3">
                                    <label for="weight" class="form-label">Product Weight
                                    </label><br>
                                    <input type="text" class="form-control weight" id="weight" placeholder="Weight"
                                        name="weight" value="">
                                    <span class="error text-danger weight mt-10"></span>
                                </div>

                                <div class="col-lg-4 mt-3">
                                    <label for="weight_units" class="form-label">Weight Units
                                    </label><br>
                                    <select class="form-select" name="weight_units" id="weight_units">
                                        <option value="">Select units</option>
                                        <option value="1">
                                            g
                                        </option>
                                    </select>
                                    <span class="error text-danger weight_units mt-10"></span>
                                </div>


                                <!-- images start -->
                                <div class="col-lg-12 mt-3">
                                    <label for="product_img" class="form-label">Product Image &nbsp;<span
                                            class="text text-success">AllowedFiles :png,jpeg,jpg </span>
                                    </label><br>
                                    &nbsp;<span class="text text-success">
                                        (1080 x 1440px)</span>
                                    <input class="form-control" type="file" id="product_img" name="product_img">

                                    <img src="" id="product_image_url" alt="image" width="130px"
                                        style="padding-top: 15px; display:none;">

                                    <span class="error text-danger product_img mt-5"></span>
                                </div>


                                <div class="col-lg-3 mt-3">
                                    <label for="img_1" class="form-label">Image 1 &nbsp;<span class="text text-success">
                                            (1080 x 1440px)</span>
                                    </label><br>
                                    <input class="form-control" type="file" id="img_1" name="img_1">

                                    <img src="" id="img1_url" alt="image" width="70px"
                                        style="padding-top: 15px; display:none;">

                                    <span class="error text-danger img_1 mt-5"></span>
                                </div>

                                <div class="col-lg-3 mt-3">
                                    <label for="img_2" class="form-label">Image 2 &nbsp;<span class="text text-success">
                                            (1080 x 1440px)</span>
                                    </label><br>
                                    <input class="form-control" type="file" id="img_2" name="img_2">

                                    <img src="" id="img2_url" alt="image" width="70px"
                                        style="padding-top: 15px; display:none;">

                                    <span class="error text-danger img_2 mt-5"></span>
                                </div>


                                <div class="col-lg-3 mt-3">
                                    <label for="img_3" class="form-label">Image 3 &nbsp;<span class="text text-success">
                                            (1080 x 1440px)</span>
                                    </label><br>
                                    <input class="form-control" type="file" id="img_3" name="img_3">

                                    <img src="" id="img3_url" alt="image" width="70px"
                                        style="padding-top: 15px; display:none;">

                                    <span class="error text-danger img_3 mt-5"></span>
                                </div>
                                <div class="col-lg-3 mt-3">
                                    <label for="img_4" class="form-label">Image 4 &nbsp;<span class="text text-success">
                                            (1080 x 1440px)</span>
                                    </label><br>
                                    <input class="form-control" type="file" id="img_4" name="img_4">

                                    <img src="" id="img4_url" alt="image" width="70px"
                                        style="padding-top: 15px; display:none;">

                                    <span class="error text-danger img_4 mt-5"></span>
                                </div>

                                <div class="col-lg-3 mt-3">
                                    <label for="img_5" class="form-label">Image 5 &nbsp;<span
                                            class="text text-success">(1080 x 1440px)</span>
                                    </label><br>
                                    <input class="form-control" type="file" id="img_5" name="img_5">

                                    <img src="" id="img5_url" alt="image" width="70px"
                                        style="padding-top: 15px; display:none;">

                                    <span class="error text-danger img_5 mt-5"></span>
                                </div>
                                <div class="col-lg-3 mt-3">
                                    <label for="img_6" class="form-label">Image 6 &nbsp;<span
                                            class="text text-success">(1080 x 1440px)</span>
                                    </label><br>
                                    <input class="form-control" type="file" id="img_6" name="img_6">

                                    <img src="" id="img6_url" alt="image" width="70px"
                                        style="padding-top: 15px; display:none;">

                                    <span class="error text-danger img_6 mt-5"></span>
                                </div>
                                <div class="col-lg-3 mt-3">
                                    <label for="img_7" class="form-label">Image 7 &nbsp;<span
                                            class="text text-success">(1080 x 1440px)</span>
                                    </label><br>
                                    <input class="form-control" type="file" id="img_7" name="img_7">

                                    <img src="" id="img7_url" alt="image" width="70px"
                                        style="padding-top: 15px; display:none;">

                                    <span class="error text-danger img_7 mt-5"></span>
                                </div>
                                <div class="col-lg-3 mt-3">
                                    <label for="img_8" class="form-label">Image 8 &nbsp;<span
                                            class="text text-success">(1080 x 1440px)</span>
                                    </label><br>
                                    <input class="form-control" type="file" id="img_8" name="img_8">

                                    <img src="" id="img8_url" alt="image" width="70px"
                                        style="padding-top: 15px; display:none;">

                                    <span class="error text-danger img_8 mt-5"></span>
                                </div>
                                <div class="col-lg-3 mt-3">
                                    <label for="img_9" class="form-label">Image 9 &nbsp;<span
                                            class="text text-success">(1080 x 1440px)</span>
                                    </label><br>
                                    <input class="form-control" type="file" id="img_9" name="img_9">

                                    <img src="" id="img9_url" alt="image" width="70px"
                                        style="padding-top: 15px; display:none;">

                                    <span class="error text-danger img_9 mt-5"></span>
                                </div>
                                <div class="col-lg-3 mt-3">
                                    <label for="img_10" class="form-label">Image 10 &nbsp;<span
                                            class="text text-success">(1080 x 1440px)</span>
                                    </label><br>
                                    <input class="form-control" type="file" id="img_10" name="img_10">

                                    <img src="" id="img10_url" alt="image" width="70px"
                                        style="padding-top: 15px; display:none;">

                                    <span class="error text-danger img_10 mt-5"></span>
                                </div>


                                <div class="modal-header mt-3">
                                    <h5 class="modal-title"><i class="bi bi-bag"></i> Product Details</h5>

                                </div>
                                <!-- Product Details Start -->
                                <div class="col-lg-12 mt-3">
                                    <label for="prod_desc" class="form-label">Product
                                        Description</label>
                                    <input class="form-control" type="text" id="prod_desc" name="prod_desc"
                                        placeholder="Enter services">
                                    <span class="error text-danger prod_desc mt-5"></span>
                                </div>


                                <!-- Product Configuration Start -->
                                <!-- <div class="modal-header mt-3">
                                    <h5 class="modal-title"><i class="bi bi-bag"></i>Product Configuration</h5>
                                </div>
                                <div class="container">
                                    <div class="mb-3 mt-3 d-flex justify-content-end">
                                        <a class="btn btn-info" id="btn-addConfig">Add Product</a>
                                    </div>
                                    <div class="row mt-3" id="parent-config">
                                        <div class="mb-3 field-set d-flex justify-content-between">
                                            <div class="col-lg-3">
                                                <label for="soldout_status" class="form-label">Stock status
                                                </label><br>
                                                <select class="form-select" name="soldout_status[]"
                                                    id="soldout_statuss">
                                                    <option value="">Select status</option>
                                                    <option value="1">
                                                        Available
                                                    </option>
                                                    <option value="0">
                                                        Out of Stock
                                                    </option>

                                                </select>

                                            </div>

                                            <div class="col-xl-3">
                                                <label for="colour" class="form-label">Color</label>
                                                <select class="form-control floating" name="colour[]" id="colourr">
                                                    <option value="">Select Color</option>
                                                    <?php foreach ($colour as $data) { ?>

                                                        <option value="<?php echo $data['color_id'] ?>">
                                                            <?php echo $data['color_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-lg-3">
                                                <label for="size" class="form-label">Size
                                                </label><br>
                                                <input type="text" class="form-control size" id="sizee"
                                                    placeholder="Size" name="size[]">
                                                <span class="error text-danger size mt-10"></span>
                                            </div>
                                            <div class="col-lg-2">
                                                <a class="btn btn-danger delete-size" id="config-delete">Delete</a>
                                            </div>
                                        </div>

                                        <div class="mb-3 field-set2 d-flex ">
                                            <div class="col-lg-3 me-3" style="width: 22%;">
                                                <label for="config_img1" class="form-label">Image1
                                                    &nbsp;<span class="text text-success">AllowedFiles:png,jpeg,jpg
                                                    </span>
                                                </label>
                                                <input class="form-control" type="file" id="config_img1"
                                                    name="config_img1[]">

                                                <img src="" id="config_img1_url" alt="image" width="80px"
                                                    style="padding-top: 15px; display:none;">
                                            </div>

                                            <div class="col-lg-3 me-3" style="width: 22%;">
                                                <label for="config_img2" class="form-label">Image2
                                                    &nbsp;<span class="text text-success">AllowedFiles:png,jpeg,jpg
                                                    </span>
                                                </label>
                                                <input class="form-control" type="file" id="config_img2"
                                                    name="config_img2[]">

                                                <img src="" id="config_img2_url" alt="image" width="80px"
                                                    style="padding-top: 15px; display:none;">
                                            </div>

                                            <div class="col-lg-3 me-3" style="width: 22%;">
                                                <label for="config_img3" class="form-label">Image3
                                                    &nbsp;<span class="text text-success">AllowedFiles:png,jpeg,jpg
                                                    </span>
                                                </label>
                                                <input class="form-control" type="file" id="config_img3"
                                                    name="config_img3[]">

                                                <img src="" id="config_img3_url" alt="image" width="80px"
                                                    style="padding-top: 15px; display:none;">
                                            </div>

                                            <div class="col-lg-3 me-3" style="width: 22%;">
                                                <label for="config_img4" class="form-label">Image4
                                                    &nbsp;<span class="text text-success">AllowedFiles:png,jpeg,jpg
                                                    </span>
                                                </label>
                                                <input class="form-control" type="file" id="config_img4"
                                                    name="config_img4[]">

                                                <img src="" id="config_img4_url" alt="image" width="80px"
                                                    style="padding-top: 15px; display:none;">
                                                <span class="error text-danger config_img4 mt-5"></span>
                                            </div>
                                        </div>
                                        <br><br>
                                        </hr>
                                    </div>
                                </div> -->
                                <!-- Product Configuration End -->

                                <!-- Specification -->
                                <div class="modal-header mt-3">
                                    <h5 class="modal-title"> <i class="ri-briefcase-line"></i> Specifications</h5>

                                </div>
                                <div class="col-lg-12 mt-3">
                                    <label for="specifications" class="form-label">Product
                                        Specifications</label>
                                    <input class="form-control" type="text" id="specifications" name="specifications">
                                    <span class="error text-danger specifications mt-5"></span>
                                </div>

                                <!-- Search Filter -->
                                <h5 class="modal-title mt-5" id="myLargeModalLabel">Seach Filter</h5>
                                <div class="col-lg-12 mt-3">
                                    <label for="search_brand" class="form-label">Product
                                        Brand</label>

                                    <select class="form-select" name="search_brand" id="search_brand">
                                        <option value="">Select Brand</option>
                                        <?php foreach ($searchbrand as $brand) {
                                            ?>
                                            <option value="<?php echo $brand['brand_master_id'] ?>">
                                                <?php echo $brand['brand_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>

                                    <span class="error text-danger search_brand mt-5"></span>
                                </div>
                                <!-- <div class="modal-header mt-3">
                                    <h5 class="modal-title"><i class="bi bi-bar-chart-line"></i> Features</h5>

                                </div>

                                <div class="col-lg-12 mt-3">
                                    <label for="features" class="form-label">Product
                                        Features</label>
                                    <input class="form-control" type="text" id="features" name="features"
                                        placeholder="Enter services">
                                    <span class="error text-danger features mt-5"></span>
                                </div> -->


                                <h5 class="modal-title mt-5" id="myLargeModalLabel">Hot Sale</h5>
                                <div class="col-lg-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="hot_sale"
                                            id="hot_sale">
                                        <label class="form-check-label" for="hot_sale">
                                            Set as Hotsale
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div> <br><br>
                        <div class="mb-3 d-flex justify-content-end">
                            <a class="btn btn-success" id="btn-submit">Submit</a>
                        </div>

                        </hr>
                    </form>

                </div>

            </div>
        </div>
    </div>



    <!-- View Details Modal -->

    <div class="modal fade bs-example-modal-lg" id="model-view" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg  modal-dialog-">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">View Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="col-xl-12 ">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-bordered border-success">
                                <thead>
                                    <tr>
                                        <th scope="col">Billing Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><span id="billing-name"> </span></td>
                                </tbody>
                            </table>
                        </div>

                    </div>


                    <div class="col-xl-12 ">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-bordered border-success">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><span style="display: inline-block;" id="description"> </span></td>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table text-nowrap table-bordered border-success">
                            <thead>
                                <tr>

                                    <th scope="col">Offer Type</th>
                                    <th scope="col">Offer Details</th>
                                    <th scope="col">Offer Price</th>
                                    <th>New Arrivals Status</th>
                                    <th scope="col">Stock Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span id="offer-typee"> <span></td>
                                    <td><span id="offer"> <span></td>
                                    <td><span id="offer-price"> <span></td>
                                    <td><span id="arrival-status"> <span></td>
                                    <td><span id="soldout-status"> <span></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-5">
                        <table class="table text-nowrap table-bordered border-success " id="tbl-img">

                            <tbody>

                                <!--img Code  -->
                            </tbody>
                        </table>
                    </div>

                    <h5 class="modal-title mt-5" id="myLargeModalLabel">Specifications</h5>
                    <div class="table-responsive mt-3">
                        <table class="table text-nowrap table-bordered border-success">
                            <thead>
                                <tr>
                                    <th scope="col">Specifications</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td><span id="specificaionn"> </span></td>
                            </tbody>
                        </table>
                    </div>


                    <h5 class="modal-title mt-5" id="myLargeModalLabel">Seach Filter</h5>
                    <div class="table-responsive mt-3">
                        <table class="table text-nowrap table-bordered border-success">
                            <thead>
                                <tr>

                                    <th scope="col">Brand Name</th>

                                </tr>
                            </thead>
                            <tbody>
                                <td>
                                    <span id="search-brand"></span>
                                </td>
                            </tbody>
                        </table>
                    </div>
                    <!-- <h5 class="modal-title mt-5" id="myLargeModalLabel">Features</h5>
                    <div class="table-responsive mt-3">
                        <table class="table text-nowrap table-bordered border-success">
                            <thead>
                                <tr>

                                    <th scope="col">Features</th>

                                </tr>
                            </thead>
                            <tbody>
                                <td>
                                    <p style="text-align:justify;vertical-align: top;" id="product-feature"></p>
                                </td>
                            </tbody>
                        </table>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER-->
    <?php require('components/footer.php') ?>

    <!-- FOOTER -->

    <footer class="footer mt-auto py-3 bg-white text-center">
        <div class="container">
            <span class="text-muted"> Copyright © <span id="year"></span> <a href="javascript:void(0);"
                    class="text-dark fw-semibold">Adventure shoppe</a>.
                Designed </span> by <a href="javascript:void(0);">
                <span class="fw-semibold text-primary text-decoration-underline">Appteq</span>
            </a> All
            rights
            reserved
            </span>
        </div>
    </footer>
    <!-- END FOOTER -->

    </div>



    <!-- CK editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', (event) => {

            ClassicEditor
                .create(document.querySelector('#prod_desc')).then(e => {
                    prodDesc = e;
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            ClassicEditor
                .create(document.querySelector('#specifications')).then(e => {
                    specificationss = e;

                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>



    <script src="<?php echo base_url() ?>assets/admin/js/accessList.js"></script>
</body>

</html>