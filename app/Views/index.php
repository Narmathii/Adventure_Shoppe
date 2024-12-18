<!DOCTYPE html>
<html lang="zxx">

<?php
for ($i = 0; $i < count($banner); $i++) {
    $mobileImage = base_url() . $banner[$i]['mobile_img'];
    $desktopImage = base_url() . $banner[$i]['desktop_img'];
}
?>

<?php require("components/head.php"); ?>
<style>
    .shop_now {
        background-color: #ffffff !important;
        color: #000 !important
    }

    .banner_container {
        width: 30%;
        display: flex;
        justify-content: center;
    }

    .dark-scheme .card {
        background-color: rgb(255 255 255) !important;
    }

    .cart_head {
        color: #000 !important;
    }

    .cart_action .cart_wrapper,
    .cart_action .icon_cart_alt {
        color: #fff !important;
    }


    #banner_img {
        background-image: url('<?php echo $desktopImage; ?>');
        padding: 20px 0;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        height: 75vh;
    }

    @media only screen and (max-width: 500px) {
        #banner_img {
            background-image: url('<?php echo $mobileImage; ?>') !important;
        }
    }



    .hide-hotsale {
        display: none
    }

    .wish_view {
        margin-bottom: 15px !important;
        top: 20px !important
    }

    #section-offers .fa-quote-right:before {
        content: "50%";
        background-color: #a4c735;
        color: #fff;
        top: -2px;
        position: absolute;
        right: -2px;
        padding: 10px;
        border-radius: 4px 11px 4px 4px;
        font-size: 25px;
        width: 87px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Avenir Next", sans-serif;
        font-weight: 400;
        letter-spacing: 0px;
    }


    /* .offerratee {
        position: absolute;
        top: 1px;
        z-index: 99;
        left: 10px;
        background: #85a229;
        padding: 2px 6px;
        color: #fff !important;
        border-radius: 0 0 20px 0;
        font-size: 20px;
        font-weight: 600;
    } */

    .social-icons {
        padding: 30px;
        background-color: #000000;
        text-align: center;
        width: 100%;
    }

    .social-icons a {
        color: #fff;
        line-height: 30px;
        font-size: 30px;
        margin: 0 5px;
        text-decoration: none;

    }


    .social-icons a i {
        color: #fff;
        font-size: 70px;
        display: contents;
    }

    .follow_us h2 {
        color: #fff !important;
    }

    .social-icons i:hover {
        background: transparent !important;
        color: #fff;
        font-size: 70px;
    }

    @media only screen and (max-width: 600px) {
        #de-carousel {
            display: none !important;
        }

        .social-icons a {
            font-size: 20px !important;
        }
    }

    @media only screen and (max-width: 600px) {
        #banner_img {
            display: block;
            background-image: url('./public/assets/images/banner/mobile.jpg') !important;

        }

        .offerratee {
            font-size: 15px !important;

        }
    }

    @media only screen and (min-width: 768px) {
        #banner_img {
            display: none;
        }
    }


    #de-carousel {
        display: block;
    }
</style>

<body onload="initialize()" class="dark-scheme home_page-">

    <div id="wrapper">
        <?php require("components/header.php"); ?>
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            <section id="de-carousel" class="no-top no-bottom carousel slide carousel-fade" data-mdb-ride="carousel">

                <!-- Inner -->
                <div class="carousel-inner position-relative">
                    <!-- Single item -->
                    <div class="carousel-item active jarallax">
                        <img src="<?php echo base_url() ?><?php echo $banner[0]['desktop_img'] ?>"
                            class="jarallax-img img-fluid" alt="">
                        <div class="mask">
                            <div class="no-top no-bottom">
                                <div class="h-100 v-center">
                                    <div class="container">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 text-center p-3 mb-sm-30">
                                                <div class="container">
                                                    <div class="h-100 v-center">
                                                        <div class="container banner_container">
                                                            <div class="banner_content">
                                                                <a href="<?php echo base_url() ?>shopby-brand/yamaha"
                                                                    type='button' id='buynowBtn'
                                                                    class="btn-main btn-fullwidth shop_now">Shop Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single item -->
                    <div class="carousel-item  jarallax">
                        <img src="<?php echo base_url() ?><?php echo $banner[1]['desktop_img'] ?>"
                            class="jarallax-img img-fluid" alt="">
                        <div class="mask">
                            <div class="no-top no-bottom">
                                <div class="h-100 v-center">
                                    <div class="container">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 text-center p-3 mb-sm-30">
                                                <div class="container">
                                                    <div class="h-100 v-center">
                                                        <div class="container banner_container">
                                                            <div class="banner_content">
                                                                <a href="<?php echo base_url() ?>/helmet-view"
                                                                    type='button' id='buynowBtn'
                                                                    class="btn-main btn-fullwidth shop_now">Shop Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item  jarallax">
                        <img src="<?php echo base_url() ?><?php echo $banner[2]['desktop_img'] ?>"
                            class="jarallax-img img-fluid" alt="">
                        <div class="mask">
                            <div class="no-top no-bottom">
                                <div class="h-100 v-center">
                                    <div class="container">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 text-center p-3 mb-sm-30">
                                                <div class="container">
                                                    <div class="h-100 v-center">
                                                        <div class="container banner_container">
                                                            <div class="banner_content">
                                                                <a href="<?php echo base_url() ?>brands-viewall"
                                                                    type='button' id='buynowBtn'
                                                                    class="btn-main btn-fullwidth shop_now">Shop Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single item -->
                </div>
                <!-- Inner -->

                <!-- Controls -->
                <a class="carousel-control-prev" href="#de-carousel" role="button" data-mdb-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#de-carousel" role="button" data-mdb-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <div class="de-gradient-edge-bottom"></div>
            </section>
            <section id="banner_img" class="no-top no-bottom carousel slide carousel-fade" data-mdb-ride="carousel">
                <div class="position-relative">
                    <div class="">
                        <div class="mask">
                            <div class="no-top no-bottom">
                                <div class="h-100 v-center">
                                    <div class="container banner_container">
                                        <div class="banner_content">
                                            <h1>Two wheels,endless adventures.</h1>
                                            <h1></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <section class="p-0 follow_us">
        <div class="social-icons">
            <!-- <h2>Follow Us On : </h2> -->
            <div class="d-flex justify-content-evenly">
                <a href="#" title="facebook">
                    <p>Facebook</p>
                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                </a>
                <a href="https://www.instagram.com/adventureshoppe/?igsh=YjIzbHV3ZnRjaHBi" title="instagram">
                    <p>Instagram</p>
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
                <a href="https://www.youtube.com/@adventureshoppe3772/videos" title="youtube">
                    <p>Youtube</p>
                    <i class="fa fa-youtube-square" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>


    <!-- offers  start  -->
    <?php
    $className = $offers <= 0 ? "d-none" : "";
    ?>
     <section id="section-newArrival" class="p-0 <?=$className  ?>">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center newarrival_header">
                    <h3>OFFERS</h3>
                    <a href="<?php echo base_url() ?>offers"><span class="view_all">View all<i
                                class="fa fa-angle-right d-none"></i></span></a>
                    <!-- <span class="view_all">View all<i class="fa fa-angle-right d-none"></i></span>  -->
                </div>
                <div class="col-12 col-carousel">
                    <div class="owl-carousel carousel-main">
                        <?php for ($i = 0; $i < 8; $i++) { ?>
                            <div class="">
                                <div class="item">
                                    <div class="">
                                        <?php
                                        $tbl_name = $offers[$i]['tbl_name'];

                                        if ($tbl_name == "tbl_products") {
                                            $url = base_url() . "detail/" . strtolower(str_replace(['/', ' '], '-', $offers[$i]['redirect_url'])) . "/" . base64_encode($offers[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_accessories_list") {
                                            $url = base_url() . "accessories-detail/" . strtolower(str_replace(['/', ' '], '-', $offers[$i]['redirect_url'])) . "/" . base64_encode($offers[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_rproduct_list") {
                                            $url = base_url() . "riding-details/" . strtolower(str_replace(['/', ' '], '-', $offers[$i]['redirect_url'])) . "/" . base64_encode($offers[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_helmet_products") {
                                            $url = base_url() . "helmet-details/" . strtolower(str_replace(['/', ' '], '-', $offers[$i]['redirect_url'])) . "/" . base64_encode($offers[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_luggagee_products") {
                                            $url = base_url() . "tour-detail/" . strtolower(str_replace(['/', ' '], '-', $offers[$i]['redirect_url'])) . "/" . base64_encode($offers[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_camping_products") {
                                            $url = base_url() . "camp-details/" . strtolower(str_replace(['/', ' '], '-', $offers[$i]['redirect_url'])) . "/" . base64_encode($offers[$i]['prod_id']);
                                        }
                                        ?>
                                        <a href="<?php echo $url; ?>">
                                            <div class="de-item">
                                            <?php
                                                $offerrr =$offers[$i]['offer_details'];
                                                if ($offerrr == 1 || $offerrr == 2 || $offerrr == "" || $offerrr == 0 || $offerrr == "-") {
                                                    $offerClass = "d-none";
                                                } else {
                                                    $offerClass = "";

                                                } ?>

                                                <span class="offer  <?= $offerClass ?>">
                                                    <?=$offers[$i]['offer_details'] ?>%
                                                </span>


                                                <div class="d-img">
                                                    <img src="<?php echo base_url() ?><?php echo $offers[$i]['product_img'] ?>"
                                                        class="img-fluid" alt="">
                                                </div>
                                                <div class="d-info" id="offer-viewpage">
                                                    <div class="d-text">
                                                        <span
                                                            class="d-price">₹<?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $offers[$i]['offer_price']) ?>  &nbsp;<small class="<?= $Classname ?>"
                                                            >₹<?php echo number_format($offers[$i]['product_price']) ?></small></span>
                                                        <h4><?php echo $offers[$i]['product_name'] ?></h4>
                                                        <div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- offers  End  -->



    <!-- New Arrivals Start  -->
    <section id="section-newArrival" class="p-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center newarrival_header">
                    <h3>NEW ARRIVALS</h3>
                    <a href="<?php echo base_url() ?>newrrival-view"><span class="view_all">View all<i
                                class="fa fa-angle-right d-none"></i></span></a>
                    <!-- <span class="view_all">View all<i class="fa fa-angle-right d-none"></i></span>  -->
                </div>
                <div class="col-12 col-carousel">
                    <div class="owl-carousel carousel-main">
                        <?php for ($i = 0; $i < 8; $i++) { ?>
                            <div class="">
                                <div class="item">
                                    <div class="">
                                        <?php
                                        $tbl_name = $new_arrivals[$i]['tbl_name'];

                                        if ($tbl_name == "tbl_products") {
                                            $url = base_url() . "detail/" . strtolower(str_replace(['/', ' '], '-', $new_arrivals[$i]['redirect_url'])). "/" . base64_encode($new_arrivals[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_accessories_list") {
                                            $url = base_url() . "accessories-detail/" . strtolower(str_replace(['/', ' '], '-', $new_arrivals[$i]['redirect_url'])). "/" . base64_encode($new_arrivals[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_rproduct_list") {
                                            $url = base_url() . "riding-details/" . strtolower(str_replace(['/', ' '], '-', $new_arrivals[$i]['redirect_url'])). "/" . base64_encode($new_arrivals[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_helmet_products") {
                                            $url = base_url() . "helmet-details/" . strtolower(str_replace(['/', ' '], '-', $new_arrivals[$i]['redirect_url'])). "/" . base64_encode($new_arrivals[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_luggagee_products") {
                                            $url = base_url() . "tour-detail/" . strtolower(str_replace(['/', ' '], '-', $new_arrivals[$i]['redirect_url'])). "/" . base64_encode($new_arrivals[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_camping_products") {
                                            $url = base_url() . "camp-details/" . strtolower(str_replace(['/', ' '], '-', $new_arrivals[$i]['redirect_url'])). "/" . base64_encode($new_arrivals[$i]['prod_id']);
                                        }
                                        ?>
                                        <a href="<?php echo $url; ?>">
                                            <div class="de-item">
                                                <div class="d-img">
                                                    <img src="<?php echo base_url() ?><?php echo $new_arrivals[$i]['product_img'] ?>"
                                                        class="img-fluid" alt="">
                                                </div>
                                                <div class="d-info" id="index-offer">
                                                    <div class="d-text">
                                                        <span
                                                            class="d-price">₹<?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $new_arrivals[$i]['offer_price']) ?>  &nbsp;<small class="<?= $Classname ?>"
                                                            >₹<?php echo number_format($new_arrivals[$i]['product_price']) ?></small></span>
                                                        <h4><?php echo $new_arrivals[$i]['product_name'] ?></h4>
                                                        <div>
                                                            
                                                            <?php
                                                            $tbl_name = $new_arrivals[$i]['tbl_name'];

                                                            if ($tbl_name == "tbl_products") {
                                                                $url = base_url() . "detail/" . strtolower(str_replace(['/', ' '], '-', $new_arrivals[$i]['redirect_url'])). "/" . base64_encode($new_arrivals[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_accessories_list") {
                                                                $url = base_url() . "accessories-detail/" . strtolower(str_replace(['/', ' '], '-', $new_arrivals[$i]['redirect_url'])). "/" . base64_encode($new_arrivals[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_rproduct_list") {
                                                                $url = base_url() . "riding-details/" . strtolower(str_replace(['/', ' '], '-', $new_arrivals[$i]['redirect_url'])). "/" . base64_encode($new_arrivals[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_helmet_products") {
                                                                $url = base_url() . "helmet-details/" . strtolower(str_replace(['/', ' '], '-', $new_arrivals[$i]['redirect_url'])). "/" . base64_encode($new_arrivals[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_luggagee_products") {
                                                                $url = base_url() . "tour-detail/" . strtolower(str_replace(['/', ' '], '-', $new_arrivals[$i]['redirect_url'])). "/" . base64_encode($new_arrivals[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_camping_products") {
                                                                $url = base_url() . "camp-details/" . strtolower(str_replace(['/', ' '], '-', $new_arrivals[$i]['redirect_url'])). "/" . base64_encode($new_arrivals[$i]['prod_id']);
                                                            }
                                                            ?>



                                                            <a class="btn-main buynow_btn" href="<?php echo $url; ?>">Buy
                                                                Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- New Arrivals Enddd  -->

    <!-- Hot Sale  Start  -->
    <?php
    if (count($hotsale) <= 0) {
        $class = "hide-hotsale";
    } else {
        $class = "";
    }

    ?>
    <section id="section-hotsale" class="p-0 <?php echo $class ?>">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center newarrival_header" class="view_all">
                    <h3>Hot Sale</h3>
                    <a href="<?php echo base_url() ?>hotsale"><span class="view_all">View all<i
                                class="fa fa-angle-right d-none"></i></span></a>
                </div>
                <div class="col-12 col-carousel">
                    <div class="owl-carousel carousel-main">
                        <?php
                        for ($i = 0; $i < 4; $i++) { ?>
                            <div class="">
                                <div class="item">
                                    <div class="">
                                        <?php
                                        $tbl_name = $hotsale[$i]['tbl_name'];

                                        if ($tbl_name == "tbl_products") {
                                            $url = base_url() . "detail/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_accessories_list") {
                                            $url = base_url() . "accessories-detail/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_rproduct_list") {
                                            $url = base_url() . "riding-details/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_helmet_products") {
                                            $url = base_url() . "helmet-details/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_luggagee_products") {
                                            $url = base_url() . "tour-detail/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                        } else if ($tbl_name == "tbl_camping_products") {
                                            $url = base_url() . "camp-details/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                        }
                                        ?>
                                        <a href="<?php echo $url; ?>">
                                            <div class="de-item">
                                                <div class="d-img">
                                                    <img src="<?php echo base_url() ?>/<?php echo $hotsale[$i]['product_img'] ?>"
                                                        class="img-fluid" alt="">
                                                </div>
                                                <div class="d-info">
                                                    <div class="d-text">
                                                        <h4><?php echo $hotsale[$i]['product_name'] ?></h4>
                                                        <div>
                                                            <?php
                                                            $tbl_name = $hotsale[$i]['tbl_name'];

                                                            if ($tbl_name == "tbl_products") {
                                                                $url = base_url() . "detail/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_accessories_list") {
                                                                $url = base_url() . "accessories-detail/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_rproduct_list") {
                                                                $url = base_url() . "riding-details/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_helmet_products") {
                                                                $url = base_url() . "helmet-details/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_luggagee_products") {
                                                                $url = base_url() . "tour-detail/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_camping_products") {
                                                                $url = base_url() . "camp-details/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                                            }
                                                            ?>
                                                            <span
                                                                class="d-price">₹<?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $hotsale[$i]['offer_price']) ?></span>
                                                            <a class="btn-main buynow_btn" href="<?php echo $url; ?>">Buy
                                                                Now</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Brands We deal  Start  -->
    <section id="section-brands" class="p-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center newarrival_header brands_we_deal">
                    <h3>BRANDS WE DEAL</h3>
                    <a href="<?php echo base_url() ?>brands-viewall"><span class="view_all">View all<i
                                class="fa fa-angle-right d-none"></i></span></a>
                </div>
                <div class="col-12 col-carousel">
                    <div class="owl-carousel carousel-main">
                        <?php for ($i = 0; $i < 4; $i++) {
                            ?>
                            <div class="">
                                <div class="item">
                                    <div class="">
                                        <a href="#">
                                            <div class="de-item" id="brands-deals">
                                                <div class="d-img" id="brands-deals-img">
                                                    <a
                                                        href="<?php echo base_url() ?>brands/<?php echo strtolower(str_replace(' ', '-', $brand_master[$i]['brand_name'])) ?>/<?php echo base64_encode($brand_master[$i]['brand_master_id']) ?>"><img
                                                            src="<?php echo base_url() ?><?php echo $brand_master[$i]['brand_img'] ?>"
                                                            class="img-fluid" alt=""></a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Brands We deal  End  -->


    <!-- Helmets  start  -->
    <section id="section-helmets" class="py-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center newarrival_header">
                    <h3>HELMETS</h3>
                    <a href="<?php echo base_url() ?>helmet-view"><span class="view_all">View all<i
                                class="fa fa-angle-right d-none"></i></span></a>
                </div>
                <div class="col-12 col-carousel">
                    <div class="owl-carousel carousel-main">
                        <?php for ($i = 0; $i < count($h_submenu_list); $i++) { ?>
                            <div class="">
                                <div class="item">
                                    <div class="">
                                        <a
                                            href="<?php echo base_url() ?>helmet-accessories/<?php echo strtolower(str_replace(' ', '-', $h_submenu[$i]['h_submenu'])) ?>/<?php echo base64_encode($h_submenu[$i]['h_submenu_id']) ?>">
                                            <div class="de-item">
                                                <div class="d-img">
                                                    <img src="<?php echo base_url() ?><?php echo $h_submenu_list[$i]['hsubmenu_img'] ?>"
                                                        class="img-fluid" alt="">
                                                </div>
                                                <div class="d-info">
                                                    <div class="d-text">
                                                        <h5 class="text-center">
                                                            <?php echo $h_submenu_list[$i]['h_submenu'] ?>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Helmets  End  -->

    <!-- SOCIAL MEDIA start -->
    <section id="social_media" class="pt-0">
        <div class="container p-0">
            <div class="row">
                <div class="col-lg-12 text-center newarrival_header">
                    <h3>YOUTUBE</h3>
                </div>

                <div class="col-4 left_container">
                    <a href="<?php echo $youtube[0]['ytube_link'] ?>">
                        <img src="<?php echo base_url() ?>/<?php echo $youtube[0]['ytube_img'] ?>"
                            class="img-fluid img-left" alt="">
                        <i><img src="<?php echo base_url() ?>public/assets/images/icons/bi_youtube.png" alt=""></i>
                    </a>
                </div>


                <div class="col-4 center_container">
                    <a href="<?php echo $youtube[1]['ytube_link'] ?>">
                        <img src="<?php echo base_url() ?>/<?php echo $youtube[1]['ytube_img'] ?>"
                            class="img-fluid img-center" alt="">
                        <i><img src="<?php echo base_url() ?>public/assets/images/icons/bi_youtube.png" alt=""></i>
                    </a>
                </div>


                <div class="col-4 right_container">
                    <a href="<?php echo $youtube[2]['ytube_link'] ?>">
                        <img src="<?php echo base_url() ?>/<?php echo $youtube[2]['ytube_img'] ?>"
                            class="img-fluid img-right" alt="">
                        <i><img src="<?php echo base_url() ?>public/assets/images/icons/bi_youtube.png" alt=""></i>
                    </a>
                </div>

            </div>

        </div>
    </section>
    <!-- SOCIAL MEDIA end -->
    <!-- Recently viewed products -->

    
    <section id="section-newArrival" class="py-0  <?php echo $className ?>">
        <?php
        $recentCount = count($recent_products);
        $class = $recentCount <= 0 ? "display-none" : ""; ?>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center newarrival_header  <?= $class ?>">
                    <h3>RECENTLY VIEWED PRODUCTS</h3>
                    <!-- <span class="view_all">View all<i class="fa fa-angle-right d-none"></i></span> -->
                </div>
                <div class="col-12 col-carousel">
                    <div class="owl-carousel carousel-main">
                        <?php for ($i = 0; $i < count($recent_products); $i++) { ?>
                            <div class="item">
                                <div class="">

                                    <?php
                                    $tbl_name = $recent_products[$i]['tbl_name'];

                                    if ($tbl_name == "tbl_products") {
                                        $url = base_url() . "detail/" . strtolower(str_replace(['/', ' '], '-', $recent_products[$i]['redirect_url'])) . "/" . base64_encode($recent_products[$i]['prod_id']);
                                    } else if ($tbl_name == "tbl_accessories_list") {
                                        $url = base_url() . "accessories-detail/" . strtolower(str_replace(['/', ' '], '-', $recent_products[$i]['redirect_url'])) . "/" . base64_encode($recent_products[$i]['prod_id']);
                                    } else if ($tbl_name == "tbl_rproduct_list") {
                                        $url = base_url() . "riding-details/" . strtolower(str_replace(['/', ' '], '-', $recent_products[$i]['redirect_url'])) . "/" . base64_encode($recent_products[$i]['prod_id']);
                                    } else if ($tbl_name == "tbl_helmet_products") {
                                        $url = base_url() . "helmet-details/" . strtolower(str_replace(['/', ' '], '-', $recent_products[$i]['redirect_url'])) . "/" . base64_encode($recent_products[$i]['prod_id']);
                                    } else if ($tbl_name == "tbl_luggagee_products") {
                                        $url = base_url() . "tour-detail/" . strtolower(str_replace(['/', ' '], '-', $recent_products[$i]['redirect_url'])) . "/" . base64_encode($recent_products[$i]['prod_id']);
                                    } else if ($tbl_name == "tbl_camping_products") {
                                        $url = base_url() . "camp-details/" . strtolower(str_replace(['/', ' '], '-', $recent_products[$i]['redirect_url'])) . "/" . base64_encode($recent_products[$i]['prod_id']);
                                    }
                                    ?>
                                    <a href="<?php echo $url; ?>">
                                        <div class="de-item">
                                            <div class="d-img">

                                                <img src="<?php echo base_url() ?><?php echo $recent_products[$i]['product_img'] ?>"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <div class="d-info">
                                                <div class="d-text">
                                                    <span
                                                        class="d-price">₹<?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $recent_products[$i]['offer_price']) ?>
                                                        &nbsp;<small class="<?= $Classname ?>"
                                                           >₹<?php echo number_format($recent_products[$i]['product_price']) ?></small></span>
                                                    <h4><?php echo $recent_products[$i]['product_name'] ?></h4>



                                                    <p class="d-flex wish-status">
                                                        <span class="d-flex align-items-center similar-products">
                                                            <?php
                                                            $stock = $recent_products[$i]['quantity'];
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
                                                    $stock = $recent_products[$i]['quantity'];
                                                    if ($stock <= 0) { ?>
                                                        <div>
                                                            <a class="btn-main recently_view buynow_btn"
                                                                href="https://wa.me/7358992528?text=<?php echo urlencode("Product Information!\nProduct Name: " . $recent_products[$i]['product_name'] . "\nProduct Price: " . $recent_products[$i]['product_price']); ?>">Contact
                                                                us to order</a>
                                                        </div>

                                                    <?php } else { ?>

                                                        <div>
                                                            <?php
                                                            $tbl_name = $hotsale[$i]['tbl_name'];

                                                            if ($tbl_name == "tbl_products") {
                                                                $url = base_url() . "detail/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_accessories_list") {
                                                                $url = base_url() . "accessories-detail/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_rproduct_list") {
                                                                $url = base_url() . "riding-details/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_helmet_products") {
                                                                $url = base_url() . "helmet-details/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_luggagee_products") {
                                                                $url = base_url() . "tour-detail/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                                            } else if ($tbl_name == "tbl_camping_products") {
                                                                $url = base_url() . "camp-details/" . strtolower(str_replace(' ', '-', $hotsale[$i]['redirect_url'])) . "/" . base64_encode($hotsale[$i]['prod_id']);
                                                            }
                                                            ?>


                                                            <a class="btn-main recently_view buynow_btn " href="<?php echo $url; ?>">Buy
                                                                Now</a>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- <section id="section_testimonial" class="pt-0">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="text-center">
                    <h3>Testimonial</h3>
                </div>
                <div class="gtco-testimonials" id="section-testimonials">
                    <div class="owl-carousel owl-carousel1 owl-theme">
                        <div>
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5>Very satisfied<br /></h5>
                                    <p class="card-text">“ This brake cleaner is a very useful product which I have
                                        purchased from Adventure Shoppe. I' m very satisfied with the product and the
                                                    results. Thank you for suggesting this product.” </p>
                                                    <span>-Eric Churchill</span>
                                            </div>

                                        </div>
                                </div>
                                <div>
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h5>Desires color for Helmets<br />
                                            </h5>
                                            <p class="card-text">“Excellent choice for riding gear purchase, it's our
                                                3rd
                                                purchase, overall too good lot of verity, they will arrange for desires
                                                color
                                                for helmets.”
                                            </p>
                                            <span>-Aishwarya</span>
                                        </div>

                                    </div>
                                </div>
                                <div>
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h5>Responsive and Helpful<br />
                                            </h5>
                                            <p class="card-text">“I have been using Rentaly for my Car Rental needs for
                                                over 5
                                                years now. I have never had any problems with their service. Their
                                                customer
                                                support is always responsive and helpful” </p>
                                            <span>-RanjithKumar</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section> -->


    <!-- content close -->
    <a href="#" id="back-to-top"></a>
    <?php require("components/footer.php"); ?>
    <script>
        // (function() {
        //     "use strict";

        //     var carousels = function() {
        //         $(".owl-carousel1").owlCarousel({
        //             loop: true,
        //             center: true,
        //             margin: 10,
        //             responsiveClass: true,
        //             nav: false,
        //             responsive: {
        //                 0: {
        //                     items: 1,
        //                     nav: false
        //                 },
        //                 680: {
        //                     items: 2,
        //                     nav: false,
        //                     loop: false
        //                 },
        //                 1000: {
        //                     items: 3,
        //                     nav: true
        //                 }
        //             }
        //         });
        //     };

        //     (function($) {
        //         carousels();
        //     })(jQuery);
        // })();


        // $(document).ready(function() {
        //     $(".owl-carousel").owlCarousel({
        //         loop: true,
        //         margin: 10,
        //         nav: true,
        //         responsive: {
        //             0: {
        //                 items: 1
        //             },
        //             600: {
        //                 items: 3
        //             },
        //             1000: {
        //                 items: 4
        //             }
        //         }
        //     });
        // });
        // $(document).ready(function() {
        //     var itemsMainDiv = $('.MultiCarousel');
        //     var itemsDiv = $('.MultiCarousel-inner');
        //     var itemWidth = "";

        //     $('.leftLst, .rightLst').click(function() {
        //         var condition = $(this).hasClass("leftLst");
        //         if (condition)
        //             moveSlide(0, this);
        //         else
        //             moveSlide(1, this);
        //     });

        //     resizeCarousel();

        //     $(window).resize(function() {
        //         resizeCarousel();
        //     });

        //     function resizeCarousel() {
        //         var incno = 0;
        //         var itemClass = '.item';
        //         var id = 0;
        //         var btnParentSb = '';
        //         var itemsSplit = '';
        //         var sampwidth = itemsMainDiv.width();
        //         var bodyWidth = $('body').width();
        //         itemsDiv.each(function() {
        //             id = id + 1;
        //             var itemNumbers = $(this).find(itemClass).length;
        //             btnParentSb = $(this).parent().data("items");
        //             itemsSplit = btnParentSb.split(',');
        //             $(this).parent().attr("id", "MultiCarousel" + id);

        //             if (bodyWidth >= 1200) {
        //                 incno = itemsSplit[3];
        //                 itemWidth = sampwidth / incno;
        //             } else if (bodyWidth >= 992) {
        //                 incno = itemsSplit[2];
        //                 itemWidth = sampwidth / incno;
        //             } else if (bodyWidth >= 768) {
        //                 incno = itemsSplit[1];
        //                 itemWidth = sampwidth / incno;
        //             } else {
        //                 incno = itemsSplit[0];
        //                 itemWidth = sampwidth / incno;
        //             }
        //             $(this).css({
        //                 'transform': 'translateX(0px)',
        //                 'width': itemWidth * itemNumbers
        //             });
        //             $(this).find(itemClass).each(function() {
        //                 $(this).outerWidth(itemWidth);
        //             });

        //             $(".leftLst").addClass("over");
        //             $(".rightLst").removeClass("over");
        //         });
        //     }

        //     function moveSlide(direction, element) {
        //         var leftBtn = $('.leftLst');
        //         var rightBtn = $('.rightLst');
        //         var translateXval = '';
        //         var divStyle = $(element).parent().find(itemsDiv).css('transform');
        //         var values = divStyle.match(/-?[\d\.]+/g);
        //         var xds = values ? Math.abs(values[4]) : 0;
        //         var slideWidth = itemWidth * $(element).parent().data("slide");

        //         if (direction === 0) {
        //             translateXval = parseInt(xds) - parseInt(slideWidth);
        //             $(element).parent().find(rightBtn).removeClass("over");

        //             if (translateXval <= itemWidth / 2) {
        //                 translateXval = 0;
        //                 $(element).parent().find(leftBtn).addClass("over");
        //             }
        //         } else if (direction === 1) {
        //             var itemsCondition = $(element).parent().find(itemsDiv).width() - $(element).parent().width();
        //             translateXval = parseInt(xds) + parseInt(slideWidth);
        //             $(element).parent().find(leftBtn).removeClass("over");

        //             if (translateXval >= itemsCondition - itemWidth / 2) {
        //                 translateXval = itemsCondition;
        //                 $(element).parent().find(rightBtn).addClass("over");
        //             }
        //         }
        //         $(element).parent().find(itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
        //     }
        // });

        // Owl Carousel

        $('.carousel-main').owlCarousel({
            items: 4,
            loop: true,
            autoplay: true,
            autoplayTimeout: 7000,
            margin: 1,
            nav: true,
            dots: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: true
                }
            }
        })
    </script>
</body>

<script src="<?php echo base_url() ?>public/assets/custom/wishlist.js"></script>
<script>
    $(document).ready(function () {
        var width = $(window).width();
        // console.log(width);
    })
</script>

</html>