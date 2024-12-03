<!DOCTYPE html>
<?php
require ("components/head.php");
?>
<style>
    #products_page .de-item .d-img img {
        background-color: #fff;
        aspect-ratio: 4 / 2.7;
        width: 100%;
        object-fit: contain;
    }

    .productCard .d-img {
        padding: 10px;
    }
</style>

<body id="products_page" class="dark-scheme">
    <?php
    require ("components/header.php");
    ?>
    <!-- content begin -->

    <div class="no-bottom no-top zebra">
        <section id="section-cars" class="products_wrapper">
            <div class="container">
                <div class="row">
                    <h1>Helmets</h1>
                    <div class="col-lg-12">
                        <div class="row">
                            <?php for ($i = 0; $i < count($h_submenu_list); $i++) { ?>
                                <div class="col-6 col-lg-3 productCard my-3">
                                    <a
                                        href="<?php echo base_url() ?>helmet-accessories/<?php echo strtolower(str_replace(' ', '-', $h_submenu_list[$i]['h_submenu'])) ?>/<?php echo base64_encode($h_submenu_list[$i]['h_submenu_id']) ?>">
                                        <div class="de-item">
                                            <div class="d-img">
                                                <img
                                                    src="<?php echo base_url() ?><?php echo $h_submenu_list[$i]['hsubmenu_img'] ?>" />
                                            </div>
                                            <h3><?php echo $h_submenu_list[$i]['h_submenu'] ?></h3>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- content close -->
        <?php
        require ("components/footer.php");
        ?>
</body>

</html>