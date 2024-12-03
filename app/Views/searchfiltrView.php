<!DOCTYPE html>
<?php
require("components/head.php");
?>

<body id="products_page" class="dark-scheme">
    <?php
    require("components/header.php");
    ?>
    <!-- content begin -->

    <div class="no-bottom no-top zebra">

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <!-- <img src="<?php echo base_url() ?>public/assets/images/background/2.jpg" class="jarallax-img" alt=""> -->
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>
                                Search Results!!
                            </h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->
        <section id="section-cars" class="products_wrapper">
            <div class="container">
                <!-- <div class="row">
                    <div class="col-lg-3">
                        <div class="item_filter_group">
                            <h4>Vehicle Type</h4>
                            <div class="de_form">
                                <div class="de_checkbox">
                                    <input id="vehicle_type_1" name="vehicle_type_1" type="checkbox"
                                        value="vehicle_type_1">
                                    <label for="vehicle_type_1">Car</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="vehicle_type_2" name="vehicle_type_2" type="checkbox"
                                        value="vehicle_type_2">
                                    <label for="vehicle_type_2">Van</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="vehicle_type_3" name="vehicle_type_3" type="checkbox"
                                        value="vehicle_type_3">
                                    <label for="vehicle_type_3">Minibus</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="vehicle_type_4" name="vehicle_type_4" type="checkbox"
                                        value="vehicle_type_4">
                                    <label for="vehicle_type_4">Prestige</label>
                                </div>

                            </div>
                        </div>

                        <div class="item_filter_group">
                            <h4>Car Body Type</h4>
                            <div class="de_form">
                                <div class="de_checkbox">
                                    <input id="car_body_type_1" name="car_body_type_1" type="checkbox"
                                        value="car_body_type_1">
                                    <label for="car_body_type_1">Convertible</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_body_type_2" name="car_body_type_2" type="checkbox"
                                        value="car_body_type_2">
                                    <label for="car_body_type_2">Coupe</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_body_type_3" name="car_body_type_3" type="checkbox"
                                        value="car_body_type_3">
                                    <label for="car_body_type_3">Exotic Cars</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_body_type_4" name="car_body_type_4" type="checkbox"
                                        value="car_body_type_4">
                                    <label for="car_body_type_4">Hatchback</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_body_type_5" name="car_body_type_5" type="checkbox"
                                        value="car_body_type_5">
                                    <label for="car_body_type_5">Minivan</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_body_type_6" name="car_body_type_6" type="checkbox"
                                        value="car_body_type_6">
                                    <label for="car_body_type_6">Truck</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_body_type_7" name="car_body_type_7" type="checkbox"
                                        value="car_body_type_7">
                                    <label for="car_body_type_7">Sedan</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_body_type_8" name="car_body_type_8" type="checkbox"
                                        value="car_body_type_8">
                                    <label for="car_body_type_8">Sports Car</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_body_type_9" name="car_body_type_9" type="checkbox"
                                        value="car_body_type_9">
                                    <label for="car_body_type_9">Station Wagon</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_body_type_10" name="car_body_type_10" type="checkbox"
                                        value="car_body_type_10">
                                    <label for="car_body_type_10">SUV</label>
                                </div>

                            </div>
                        </div>

                        <div class="item_filter_group">
                            <h4>Car Seats</h4>
                            <div class="de_form">
                                <div class="de_checkbox">
                                    <input id="car_seat_1" name="car_seat_1" type="checkbox" value="car_seat_1">
                                    <label for="car_seat_1">2 seats</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_seat_2" name="car_seat_2" type="checkbox" value="car_seat_2">
                                    <label for="car_seat_2">4 seats</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_seat_3" name="car_seat_3" type="checkbox" value="car_seat_3">
                                    <label for="car_seat_3">6 seats</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_seat_4" name="car_seat_4" type="checkbox" value="car_seat_4">
                                    <label for="car_seat_4">6+ seats</label>
                                </div>

                            </div>
                        </div>

                        <div class="item_filter_group">
                            <h4>Car Engine Capacity (cc)</h4>
                            <div class="de_form">
                                <div class="de_checkbox">
                                    <input id="car_engine_1" name="car_engine_1" type="checkbox" value="car_engine_1">
                                    <label for="car_engine_1">1000 - 2000</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_engine_2" name="car_engine_2" type="checkbox" value="car_engine_2">
                                    <label for="car_engine_2">2000 - 4000</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_engine_3" name="car_engine_3" type="checkbox" value="car_engine_3">
                                    <label for="car_engine_3">4000 - 6000</label>
                                </div>

                                <div class="de_checkbox">
                                    <input id="car_engine_4" name="car_engine_4" type="checkbox" value="car_engine_4">
                                    <label for="car_engine_4">6000+</label>
                                </div>

                            </div>
                        </div>

                        <div class="item_filter_group">
                            <h4>Price ($)</h4>
                            <div class="price-input">
                                <div class="field">
                                    <span>Min</span>
                                    <input type="number" class="input-min" value="0">
                                </div>
                                <div class="field">
                                    <span>Max</span>
                                    <input type="number" class="input-max" value="2000">
                                </div>
                            </div>
                            <div class="slider">
                                <div class="progress"></div>
                            </div>
                            <div class="range-input">
                                <input type="range" class="range-min" min="0" max="2000" value="0" step="1">
                                <input type="range" class="range-max" min="0" max="2000" value="2000" step="1">
                            </div>
                        </div>
                    </div>

                    
                </div> -->



                <div class="col-lg-12">
                    <div class="row">
                        <?php for ($i = 0; $i < count($search_data); $i++) { ?>
                            <div class="col-6 col-lg-3 productCard mb-4">

                                <?php
                                $tbl_name = $search_data[$i]['tbl_name'];


                                if ($tbl_name == "tbl_products") {
                                    $url = base_url() . "detail/" . strtolower(str_replace(' ', '-', $search_data[$i]['redirect_url'])) . "/" . base64_encode($search_data[$i]['prod_id']);
                                } else if ($tbl_name == "tbl_accessories_list") {
                                    $url = base_url() . "accessories-detail/" . strtolower(str_replace(' ', '-', $search_data[$i]['redirect_url'])) . "/" . base64_encode($search_data[$i]['prod_id']);
                                } else if ($tbl_name == "tbl_rproduct_list") {
                                    $url = base_url() . "riding-details/" . strtolower(str_replace(' ', '-', $search_data[$i]['redirect_url'])) . "/" . base64_encode($search_data[$i]['prod_id']);
                                } else if ($tbl_name == "tbl_helmet_products") {
                                    $url = base_url() . "helmet-details/" . strtolower(str_replace(' ', '-', $search_data[$i]['redirect_url'])) . "/" . base64_encode($search_data[$i]['prod_id']);
                                } else if ($tbl_name == "tbl_luggagee_products") {
                                    $url = base_url() . "tour-detail/" . strtolower(str_replace(' ', '-', $search_data[$i]['redirect_url'])) . "/" . base64_encode($search_data[$i]['prod_id']);
                                } else if ($tbl_name == "tbl_camping_products") {
                                    $url = base_url() . "camp-details/" . strtolower(str_replace(' ', '-', $search_data[$i]['redirect_url'])) . "/" . base64_encode($search_data[$i]['prod_id']);
                                }
                                ?>
                                <a href="<?php echo $url ?>">
                                    <div class="de-item">
                                        <?php
                                        $offer = $search_data[$i]['offer_details'];
                                        if ($offer == 1 || $offer == 2 || $offer == "" || $offer == 0 || $offer == "-") {
                                            $offerClass = "d-none";
                                        } else {
                                            $offerClass = "";

                                        } ?>

                                        <span class="offer  <?= $offerClass ?>">
                                            <?= $search_data[$i]['offer_details'] ?>%
                                        </span>
                                        <div class="d-img">
                                            <img
                                                src="<?php echo base_url() ?>/<?php echo $search_data[$i]['product_img'] ?>" />
                                        </div>
                                        <div class="d-info">
                                            <div class="d-text">

                                                <?php
                                                $MRP = $search_data[$i]['product_price'];
                                                $RS = $search_data[$i]['offer_price'];

                                                if ($MRP == $RS) {
                                                    $Classname = "d-none";
                                                } else {
                                                    $Classname = "";
                                                }
                                                ?>
                                                <span class="d-price">
                                                    ₹<?php echo number_format($search_data[$i]['offer_price'], 2) ?>
                                                    &nbsp;<small class="<?= $Classname ?>"
                                                        style="text-decoration:line-through">₹<?php echo number_format($search_data[$i]['product_price'], 2) ?></small>
                                                </span>

                                                <h4>
                                                    <?php echo $search_data[$i]['product_name'] ?>
                                                </h4>





                                                <p class="d-flex wish-status">
                                                    <span class="d-flex align-items-center">
                                                        <?php
                                                        $stock = $search_data[$i]['quantity'];
                                                        if ($stock <= 0) { ?>
                                                            <span class="product_status outof_stock">
                                                                <label>Out of stock</label>
                                                            </span>
                                                        <?php } else {
                                                            ?>
                                                            <span class="product_status">
                                                                <label>Available</label>
                                                            </span>
                                                        <?php } ?>
                                                    </span>
                                                </p>
                                                <?php
                                                $stock = $search_data[$i]['quantity'];
                                                if ($stock <= 0) { ?>

                                                    <div>
                                                        <a class="btn-main buynow_btn"
                                                            href="https://wa.me/7358992528?text=<?php echo urlencode("Product Information!\nProduct Name: " . $product[$i]['product_name'] . "\nProduct Price: " . $product[$i]['product_price']); ?>">Contact
                                                            us to order</a>
                                                    </div>

                                                <?php } else { ?>

                                                    <div>

                                                        <?php
                                                        $tbl_name = $search_data[$i]['tbl_name'];

                                                        if ($tbl_name == "tbl_products") {
                                                            $url = base_url() . "detail/" . strtolower(str_replace(' ', '-', $search_data[$i]['redirect_url'])) . "/" . base64_encode($search_data[$i]['prod_id']);
                                                        } else if ($tbl_name == "tbl_accessories_list") {
                                                            $url = base_url() . "accessories-detail/" . strtolower(str_replace(' ', '-', $search_data[$i]['redirect_url'])) . "/" . base64_encode($search_data[$i]['prod_id']);
                                                        } else if ($tbl_name == "tbl_rproduct_list") {
                                                            $url = base_url() . "riding-details/" . strtolower(str_replace(' ', '-', $search_data[$i]['redirect_url'])) . "/" . base64_encode($search_data[$i]['prod_id']);
                                                        } else if ($tbl_name == "tbl_helmet_products") {
                                                            $url = base_url() . "helmet-details/" . strtolower(str_replace(' ', '-', $search_data[$i]['redirect_url'])) . "/" . base64_encode($search_data[$i]['prod_id']);
                                                        } else if ($tbl_name == "tbl_luggagee_products") {
                                                            $url = base_url() . "tour-detail/" . strtolower(str_replace(' ', '-', $search_data[$i]['redirect_url'])) . "/" . base64_encode($search_data[$i]['prod_id']);
                                                        } else if ($tbl_name == "tbl_camping_products") {
                                                            $url = base_url() . "camp-details/" . strtolower(str_replace(' ', '-', $search_data[$i]['redirect_url'])) . "/" . base64_encode($search_data[$i]['prod_id']);
                                                        }
                                                        ?>
                                                        <a class="btn-main buynow_btn" href="<?php echo $url ?>">Buy Now</a>
                                                    </div>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- content close -->
        <?php
        require("components/footer.php");
        ?>
</body>

</html>