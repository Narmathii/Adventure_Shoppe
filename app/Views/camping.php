<!DOCTYPE html>
<html lang="zxx">

<?php require ("components/head.php"); ?>
<style>
    .orderby {
        width: 100%;
        padding: 3%;
        color: #000;
    }

    .orderby>option {
        color: #000 !important
    }
    



    .de-item .d-img img {
        object-fit: contain !important;
        aspect-ratio: 4 / 2.7;
    }
</style>

<body class="dark-scheme">
    <div id="wrapper">

        <!-- page preloader begin -->
        <!-- <div id="de-preloader"></div> -->
        <!-- page preloader close -->

        <!-- header begin -->
        <?php require ("components/header.php"); ?>
        <!-- header close -->


        <!-- content begin -->
        <div class="no-bottom no-top zebra shopbybrand" id="content">
            <div id="top"></div>

            <!-- section begin -->
            <section id="subheader" class="jarallax text-light">
                <video autoplay muted loop id="myVideo" class="jarallax-img">
                    <source src="<?php echo base_url() ?>public/assets/images/background/BIke_sliding.mp4"
                        type="video/mp4">
                </video>
                <!-- <img src="<?php echo base_url() ?>public/assets/images/background/2.jpg" class="jarallax-img" alt=""> -->
                <div class="center-y relative text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>
                                    <?php echo $camping_list[0]['camp_menu'] ?>
                                </h1>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- section close -->
            <section id="section-shopByBrands">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <?php for ($i = 0; $i < count($camping_list); $i++) { ?>

                                    <div class="col-xl-3 col-lg-6">
                                        <a
                                            href="<?= base_url() ?>camping-products/<?php echo strtolower(str_replace(' ', '-', $camping_list[$i]['c_submenu'])) ?>/<?php echo base64_encode($camping_list[$i]['c_submenu_id']) ?>">
                                            <div class="de-item mb30">
                                                <div class="d-img">
                                                    <img src="<?= base_url() . $camping_list[$i]['csubmenu_img'] ?>"
                                                        class="img-fluid" alt="">
                                                </div>
                                                <div class="d-info">
                                                    <div class="d-text">
                                                        <h3>
                                                            <?php echo $camping_list[$i]['c_submenu'] ?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                    </div>

                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


        </div>
        <!-- content close -->

        <a href="#" id="back-to-top"></a>

        <!-- footer begin -->
        <?php require ("components/footer.php"); ?>
        <!-- footer close -->

    </div>
    <!-- Javascript Files
    ================================================== -->
    <script src="<?php echo base_url() ?>public/assets/js/plugins.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/desigcustomnesia.js"></script>

</body>

</html>