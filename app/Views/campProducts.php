<!DOCTYPE html>
<?php
require("components/head.php");
?>

<style>
    .btn_view_all {
        display: flex;
        position: relative;
        justify-content: center;
        padding: 0px 33px;
        margin-left: 1%;
    }

    .view-more {
        width: 25%;
        border: solid 2px #a4c735 !important;
        border-radius: 5px;
        color: #000;
        justify-content: center;
    }

    @media only screen and (max-width: 768px) {
        .view-more {
            width: 35% !important;

        }
    }

    .orderby {

        width: 100%;
        padding: 3%;
        color: #000;
    }

    .orderby>option {
        color: #000 !important
    }
</style>

<body id='products_page' class="dark-scheme">
    <?php
    require("components/header.php");
    ?>
    <!-- content begin -->

    <div class="no-bottom no-top zebra">

        <!-- section begin -->
        <!-- <section id="subheader" class="jarallax text-light">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>
                                <?php echo $product[0]['c_submenu'] ?>
                            </h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- section close -->
        <section id="section-cars" class="products_wrapper">
            <div class="container">
                <div class="row">
                    <h2 class="text-center">
                        <?php echo $product[0]['c_submenu'] ?>
                    </h2>
                    <!-- mobile view filter -->
                    <span class="filter_sm d-lg-none">
                        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                            aria-controls="offcanvasRight"><i class="fa fa-filter"
                                aria-hidden="true"></i>Filter</button>
                    </span>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel" class="mb-0">Filter</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="item_filter_group">
                                <h4>Price (₹)</h4>
                                <fieldset class="filter-price">
                                    <div class="price-field mobile-view">
                                        <input type="range" min="0" class="input-min common_selector" max="50000"
                                            value="0" id="mob_min_val">
                                        <input type="range" min="0" class="input-max common_selector" max="50000"
                                            value="50000" id="mob_max_val">
                                    </div>
                                    <div class="price-wrap">
                                        <span class="min-max">Min</span>
                                        <div class="price-wrap-1">
                                            <input id="mob_one">
                                            <label for="one"></label>
                                        </div>
                                        <div class="price-wrap_line">-</div>
                                        <span class="min-max">Max</span>
                                        <div class="price-wrap-2">
                                            <input id="mob_two">
                                            <label for="two"></label>
                                        </div>
                                    </div>
                                </fieldset>

                            </div>

                            <div class="item_filter_group">
                                <h4>Sort By</h4>
                                <select class="common_selector orderby" aria-label="Default select example">
                                    <option value="0">Select Option</option>
                                    <option value="ASC">Order by A-Z</option>
                                    <option value="DESC">Order by Z-A</option>
                                </select>
                            </div>

                            <div class="item_filter_group">
                                <h4>Availabilty</h4>
                                <div class="de_form">
                                    <div class="de_checkbox">
                                        <input class="common_selector available" id="mobile_available"
                                            name="mobile_available" type="checkbox" value="1">
                                        <label for="mobile_available">Available</label>
                                    </div>

                                    <div class="de_checkbox">
                                        <input class="common_selector available" id="mobile_outofstock"
                                            name="mobile_outofstock" type="checkbox" value="0">
                                        <label for="mobile_outofstock">Out Of Stock</label>
                                    </div>


                                </div>
                            </div>
                            <div class="item_filter_group">
                                <h4>Brands</h4>
                                <div class="de_form">
                                    <?php for ($i = 0; $i < count($search_brand); $i++) { ?>
                                        <div class="de_checkbox">
                                            <input class="common_selector brand" id="mob_search_brand_<?php echo $i ?>"
                                                name="brands[]" type="checkbox"
                                                value="<?php echo $search_brand[$i]['search_brand'] ?>">
                                            <label
                                                for="mob_search_brand_<?php echo $i ?>"><?php echo $search_brand[$i]['brand_name'] ?></label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <input type="hidden" class="common_selector submenuid"
                                value="<?php echo $product[0]['c_submenu_id'] ?>" />

                        </div>
                    </div>


                    <!-- web view filter -->
                    <div class="col-lg-3 filter_lg">
                        <div class="item_filter_group">
                            <h4>Price (₹)</h4>
                            <fieldset class="filter-price">
                                <div class="price-field web-view">
                                    <input type="range" min="0" class="input-min common_selector" max="50000" value="0"
                                        id="web_min_val">
                                    <input type="range" min="0" class="input-max common_selector" max="50000"
                                        value="50000" id="web_max_val">
                                </div>
                                <div class="price-wrap">
                                    <span class="min-max">Min</span>
                                    <div class="price-wrap-1">
                                        <input id="web_one">
                                        <label for="one"></label>
                                    </div>
                                    <div class="price-wrap_line">-</div>
                                    <span class="min-max">Max</span>
                                    <div class="price-wrap-2">
                                        <input id="web_two">
                                        <label for="two"></label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>


                        <div class="item_filter_group">
                            <h4>Sort By</h4>
                            <select class="common_selector orderby" aria-label="Default select example">
                                <option value="0">Select Option</option>
                                <option value="ASC">Order by A-Z</option>
                                <option value="DESC">Order by Z-A</option>
                            </select>
                        </div>

                        <div class="item_filter_group">
                            <h4>Availabilty</h4>
                            <div class="de_form">
                                <div class="de_checkbox">
                                    <input class="common_selector available" id="web_available" name="web_available"
                                        type="checkbox" value="1">
                                    <label for="web_available">Available</label>
                                </div>

                                <div class="de_checkbox">
                                    <input class="common_selector available" id="web_outofstock" name="web_outofstock"
                                        type="checkbox" value="0">
                                    <label for="web_outofstock">Out Of Stock</label>
                                </div>


                            </div>
                        </div>
                        <div class="item_filter_group">
                            <h4>Brands</h4>
                            <div class="de_form">
                                <?php for ($i = 0; $i < count($search_brand); $i++) { ?>
                                    <div class="de_checkbox">
                                        <input class="common_selector brand" id="web_search_brand_<?php echo $i ?>"
                                            name="brands[]" type="checkbox"
                                            value="<?php echo $search_brand[$i]['search_brand'] ?>">
                                        <label
                                            for="web_search_brand_<?php echo $i ?>"><?php echo $search_brand[$i]['brand_name'] ?></label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" class="common_selector submenuid"
                            value="<?php echo $product[0]['c_submenu_id'] ?>" />
                    </div>

                    <div class="col-lg-9">
                        <div class="row seach_results">

                            <?php if (count($product) <= 0) { ?>

                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 text-center newarrival_header">
                                            <h3 class="no-product">Currently, there are no products available!!!.</h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <?php for ($i = 0; $i < count($product); $i++) { ?>
                                    <div class="col-12 col-lg-4 productCard">
                                        <form>

                                            <div class="de-item mb30">
                                                <?php
                                                $offer = $product[$i]['offer_details'];
                                                if ($offer == 1 || $offer == 2 || $offer == "" || $offer == 0 || $offer == "-") {
                                                    $offerClass = "d-none";
                                                } else {
                                                    $offerClass = "";
                                                } ?>

                                                <span class="offer  <?= $offerClass ?>">
                                                    <?= $product[$i]['offer_details'] ?>%
                                                </span>
                                                <!-- wishlist  start -->
                                                <a><span aria-hidden="true" class="icon_heart_alt wishlist-icon"
                                                        data-id="<?php echo $product[$i]['prod_id'] ?>"
                                                        tbl-name="<?php echo $product[$i]['tbl_name'] ?>"></span></a>
                                                <!-- wishlist end -->
                                                <div class="d-img">
                                                    <a
                                                        href="<?php echo base_url() ?>camp-details/<?php echo strtolower(str_replace(['/', ' '], '-', $product[$i]['redirect_url'])) ?>/<?php echo base64_encode($product[$i]['prod_id']) ?>">
                                                        <img
                                                            src="<?php echo base_url() ?>/<?php echo $product[$i]['product_img'] ?>" />
                                                    </a>
                                                </div>
                                                <div class="d-info">
                                                    <div class="d-text">
                                                        <?php
                                                        $MRP = $product[$i]['product_price'];
                                                        $RS = $product[$i]['offer_price'];

                                                        if ($MRP == $RS) {
                                                            $Classname = "d-none";
                                                        } else {
                                                            $Classname = "";
                                                        }
                                                        ?>
                                                        <span class="d-price">
                                                            ₹<?php echo number_format($product[$i]['offer_price']) ?>
                                                            &nbsp;<small class="<?= $Classname ?>"
                                                                style="text-decoration:line-through">₹<?php echo number_format($product[$i]['product_price']) ?></small>
                                                        </span>
                                                        <h4>
                                                            <?php echo $product[$i]['product_name'] ?>
                                                        </h4>



                                                        <p class="d-flex wish-status">
                                                            <span class="d-flex align-items-center">
                                                                <?php
                                                                $stock = $product[$i]['quantity'];
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
                                                        $stock = $product[$i]['quantity'];
                                                        if ($stock <= 0) { ?>

                                                            <div>
                                                                <a class="btn-main buynow_btn"
                                                                    href="https://wa.me/7358992528?text=<?php echo urlencode("Welcome to Adventure Shoppe!\nProduct Name: " . $product[$i]['product_name'] . "\nProduct Price: " . $product[$i]['product_price']); ?>">Contact
                                                                    us to order</a>
                                                            </div>

                                                        <?php } else { ?>

                                                            <div>
                                                                <a class="btn-main buynow_btn"
                                                                    href="<?php echo base_url() ?>camp-details/<?php echo strtolower(str_replace(['/', ' '], '-', $product[$i]['redirect_url'])) ?>/<?php echo base64_encode($product[$i]['prod_id']) ?>">Buy
                                                                    Now</a>
                                                            </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                <?php } ?>
                                <!-- View More Button -->
                                <?php if (count($product) >= 12) { ?>
                                    <div class="col-lg-12 col-md-12 col-12 button btn_view_all">
                                        <button class="btn view-more justify-content-center" data-offset='12'
                                            data-subid=" <?php echo $sub_id ?>">View More</button>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- content close -->
        <?php
        require("components/footer.php");
        ?>

        <script>
            $(document).ready(function () {
                function filter_data() {
                    var width = $(window).width();
                    if (width <= 768) {
                        var minimum_price = $('#mob_min_val').val();
                        var maximum_price = $('#mob_max_val').val();
                    }
                    else {
                        var minimum_price = $('#web_min_val').val();
                        var maximum_price = $('#web_max_val').val();

                    }
                    var available = get_filter('available');
                    var brand = get_filter('brand');
                    var orderby = $('.orderby').val();
                    var tablename = 'tbl_camping_products';
                    var submenu_id = $('.submenuid').val();

                    $.ajax({
                        url: base_Url + "prod-filter",
                        type: "POST",
                        dataType: "json",
                        data: {
                            minimum_price: minimum_price,
                            maximum_price: maximum_price,
                            available: available,
                            brand: brand,
                            orderby: orderby,
                            tablename: tablename,
                            submenu_id: submenu_id
                        },
                        success: function (data) {
                            let count = data.length;
                            let searchResults = "";
                            if (count <= 0) {
                                searchResults += ` <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 text-center newarrival_header">
                                            <h3 class="no-product">Currently, there are no products available!!!.</h3>
                                        </div>
                                    </div>
                                </div>`;
                                $('.seach_results').html(searchResults);
                            }
                            else {
                                // INR converter
                                const formatter = new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'INR',
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                });

                                for (let i = 0; i < count; i++) {
                                    const product = data[i];
                                    const redirectUrl = product.redirect_url.toLowerCase().replace(/[/ ]/g, '-');
                                    const prodId = btoa(product.prod_id);  // Base64 encode product ID
                                    const formattedPrice = formatter.format(product.offer_price);
                                    const stockStatus = product.quantity == 0 ? 'Out of stock' : 'Available';
                                    let stock = product.quantity;

                                    const MRPPrice = product.product_price;
                                    const formatMRP = formatter.format(MRPPrice);
                                    const offerPrice = product.offer_price;
                                    const formatOffer = formatter.format(offerPrice);
                                    // const formattedMRP = formatter.format(product.product_price);

                                    let piceClassname;
                                    if (MRPPrice == offerPrice) {

                                        piceClassname = 'd-none';
                                    }
                                    else {
                                        piceClassname = '';
                                    }


                                    let offerDetails = product.offer_details;
                                    let offerClass;
                                    if (offerDetails == 1 || offerDetails == 2 || offerDetails == "" || offerDetails == 0 || offerDetails == "-") {
                                        offerClass = "d-none";
                                    }
                                    else {
                                        offerClass = "";

                                    }
                                    let buyNow = "";
                                    if (stock <= 0) {
                                        buyNow += `
                                                    <div>
                                                        <a class="btn-main buynow_btn"
                                                            href="https://wa.me/7358992528?text=${encodeURIComponent("Welcome to Adventure Shoppe!\nProduct Name: " + product.product_name + "\nProduct Price: " + product.product_price)}">
                                                            Contact us to order
                                                        </a>
                                                    </div>
                                                `;
                                    }
                                    else {
                                        buyNow += `
                                                    <div>
                                                        <a class="btn-main buynow_btn"
                                                            href="${base_Url}camp-details/${product.redirect_url.toLowerCase().replace(/[/ ]/g, '-')}/${btoa(product.prod_id)}">
                                                            Buy Now
                                                        </a>
                                                    </div>
                                                `;
                                    }
                                    searchResults += `
                    <div class="col-12 col-lg-4 productCard mb-4">
                    <form>
                        
                            <div class="de-item">
                              <span
                             class="offer ${offerClass}">${offerDetails}%
                                                </span>
                              <a><span aria-hidden="true" class="icon_heart_alt wishlist-icon"
                                                            data-id="${product.prod_id}"
                                                            tbl-name="${product.tbl_name}"></span></a>
                                <div class="d-img">
                                <a href="${base_Url}camp-details/${redirectUrl}/${prodId}">
                                    <img src="${base_Url}${product.product_img}" />
                                </a>
                                </div>
                                <div class="d-info">
                                    <div class="d-text">
                                   <span class="d-price">
                                           ${formatOffer}
                                            &nbsp;<small class="${piceClassname}"
                                                                style="text-decoration:line-through">${formatMRP}</small>
                                        </span>
                                      <h4>${product.product_name}</h4>
                                      
                                       
                                      
                                        <p class="d-flex wish-status">
                                            <span class="d-flex align-items-center">
                                                <span class="product_status ${stockStatus == 'Out of stock' ? 'outof_stock' : ''}">
                                                    <label>${stockStatus}</label>
                                                </span>
                                            </span>
                                        </p>
                                ${buyNow}
                                    </div>
                                </div>
                            </div>
                        
                        </form>
                    </div>`;
                                }
                                $('.seach_results').html(searchResults);
                                $(".wishlist-icon").on('click', function () {
                                    let prod_id = $(this).data("id");
                                    let tbl_name = $(this).attr('tbl-name');

                                    console.log(prod_id);
                                    console.log(tbl_name)

                                    $.ajax({
                                        type: "POST",
                                        url: base_Url + "add-wishlist",
                                        data: { prod_id: prod_id, tbl_name: tbl_name },

                                        success: function (data) {
                                            let res = $.parseJSON(data);
                                            if (res.code == 200) {
                                                $.toast({
                                                    icon: "success",
                                                    heading: "Suucess",
                                                    text: res.msg,
                                                    position: "top-right",
                                                    bgColor: "#28292d",
                                                    loader: true,
                                                    hideAfter: 2000,
                                                    stack: false,
                                                    showHideTransition: "fade",
                                                });
                                                setTimeout(function () {
                                                    location.reload();
                                                }, 1000);
                                            } else {
                                                $.toast({
                                                    icon: "error",
                                                    heading: "Warning",
                                                    text: res.msg,
                                                    position: "top-right",
                                                    bgColor: "#res",
                                                    loader: true,
                                                    hideAfter: 2000,
                                                    stack: false,
                                                    showHideTransition: "fade",
                                                });
                                            }
                                        },
                                    });
                                });
                            }

                        }
                    });
                }

                function get_filter(class_name) {
                    var filter = [];
                    $('.' + class_name + ':checked').each(function () {
                        filter.push($(this).val());
                    });
                    return filter;
                }
                $('.common_selector').click(function () {
                    filter_data();
                });
                $('.common_selector').change(function () {
                    filter_data();
                });
            });

        </script>
        <script>
            $(document).on('click', '.view-more', function () {
                var offset = $(this).data('offset');
                var subID = $(this).data('subid');

                var button = $(this);

                // Disable Buttons
                button.prop('disabled', true).text('Loading...');

                $.ajax({
                    method: 'POST',
                    url: base_Url + 'loadmore-campdetails',
                    data: { offset: offset, subID: subID },
                    dataType: 'json',
                    contentType: 'application/x-www-form-urlencoded',
                    success: function (data) {
                        let searchResults = "";
                        let loadmorebtn = "";

                        let count = data.length;
                        if (count <= 0) {
                            button.prop('disabled', true).text('No More Products');

                            $('.seach_results').append(searchResults);
                        }
                        else {

                            // INR converter
                            const formatter = new Intl.NumberFormat('en-US', {
                                style: 'currency',
                                currency: 'INR',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            });

                            for (let i = 0; i < count; i++) {
                                const product = data[i];

                                const redirectUrl = product.redirect_url.toLowerCase().replace(/[/ ]/g, '-');
                                const prodId = btoa(product.prod_id);  // Base64 encode product ID
                                const formattedPrice = product.offer_price;
                                const stockStatus = product.quantity == 0 ? 'Out of stock' : 'Available';
                                let stock = product.quantity;

                                const MRPPrice = product.product_price;
                                const formatMRP = formatter.format(MRPPrice);
                                const offerPrice = product.offer_price;
                                const formatOffer = formatter.format(offerPrice);



                                let offerDetails = product.offer_details;
                                let offerClass;
                                if (offerDetails == 1 || offerDetails == 2 || offerDetails == "" || offerDetails == 0 || offerDetails == "-") {
                                    offerClass = "d-none";
                                }
                                else {
                                    offerClass = "";

                                }

                                // const formattedMRP = formatter.format(product.product_price);
                                // const formatPrice = formatter.format(formattedPrice);


                                let piceClassname;

                                if (parseInt(MRPPrice) == parseInt(offerPrice)) {

                                    piceClassname = 'd-none';
                                }
                                else {
                                    piceClassname = '';
                                }


                                // console.log(formattedPrice);
                                // for redirect url start
                                let tblName = product.tbl_name;
                                let url = '';
                                if (tblName) {
                                    if (tblName === "tbl_products") {
                                        url = base_Url + "detail/" + product.redirect_url.toLowerCase().replace(/[/ ]/g, '-') + "/" + btoa(product.prod_id);
                                    } else if (tblName === "tbl_accessories_list") {
                                        url = base_Url + "accessories-detail/" + product.redirect_url.toLowerCase().replace(/[/ ]/g, '-') + "/" + btoa(product.prod_id);
                                    } else if (tblName === "tbl_rproduct_list") {
                                        url = base_Url + "riding-details/" + product.redirect_url.toLowerCase().replace(/[/ ]/g, '-') + "/" + btoa(product.prod_id);
                                    } else if (tblName === "tbl_helmet_products") {
                                        url = base_Url + "helmet-details/" + product.redirect_url.toLowerCase().replace(/[/ ]/g, '-') + "/" + btoa(product.prod_id);
                                    } else if (tblName === "tbl_luggagee_products") {
                                        url = base_Url + "tour-detail/" + product.redirect_url.toLowerCase().replace(/[/ ]/g, '-') + "/" + btoa(product.prod_id);
                                    } else if (tblName === "tbl_camping_products") {
                                        url = base_Url + "camp-details/" + product.redirect_url.toLowerCase().replace(/[/ ]/g, '-') + "/" + btoa(product.prod_id);
                                    }
                                }
                                //redirect url end
                                let buyNow = "";
                                if (stock <= 0) {
                                    buyNow += `
                                                <div>
                                                    <a class="btn-main buynow_btn"
                                                        href="https://wa.me/7358992528?text=${encodeURIComponent("Welcome to Adventure Shoppe!\nProduct Name: " + product.product_name + "\nProduct Price: " + product.offer_price)}">
                                                        Contact us to order
                                                    </a>
                                                </div>
                                            `;
                                }
                                else {
                                    buyNow += `
                                                <div>
                                                    <a class="btn-main buynow_btn"
                                                        href="${url}">
                                                        Buy Now
                                                    </a>
                                                </div>
                                            `;
                                }




                                searchResults += `
                    <div class="col-12 col-lg-4 productCard mb-4">
                    <form>
                        
                            <div class="de-item">
                             <span
                             class="offer ${offerClass}">${offerDetails}%
                                                </span>
                              <a><span aria-hidden="true" class="icon_heart_alt wishlist-icon"
                                                            data-id="${product.prod_id}"
                                                            tbl-name="${product.tbl_name}"></span></a>
                                <div class="d-img">
                                <a href="${url}">
                                    <img src="${base_Url}${product.product_img}" />
                                </a>
                                </div>
                                <div class="d-info">
                                    <div class="d-text">
                                      <span class="d-price">
                                           ${formatOffer}
                                            &nbsp;<small class="${piceClassname}"
                                                                style="text-decoration:line-through">${formatMRP}</small>
                                        </span>
                                        
                                    <h4>${product.product_name}</h4>
                                      
                                        
                                        <p class="d-flex wish-status">
                                            <span class="d-flex align-items-center">
                                                <span class="product_status ${stockStatus == 'Out of stock' ? 'outof_stock' : ''}">
                                                    <label>${stockStatus}</label>
                                                </span>
                                            </span>
                                        </p>
                                        <div>
                                          ${buyNow}
                                        </div>
                                    </div>
                                </div>
                            </div>
                     
                        </form>
                    </div>`
                                    ;
                            }
                            button.prop('disabled', true)
                                .text('Loading...')
                                .hide()
                                ;

                            $('.seach_results').append(searchResults);

                            $('.btn_view_all').addClass('d-none');

                            let offsetValue = offset + 12;
                            loadmorebtn += `
                                <div class="col-lg-12 col-md-12 col-12 button btn_view_all">
                                    <button class="btn view-more justify-content-center" data-offset="${offsetValue}"  data-subid=${subID}>View More</button>
                                </div>
                                `;

                            $('.seach_results').append(loadmorebtn);

                            $(".wishlist-icon").on('click', function () {
                                let prod_id = $(this).data("id");
                                let tbl_name = $(this).attr('tbl-name');



                                $.ajax({
                                    type: "POST",
                                    url: base_Url + "add-wishlist",
                                    data: { prod_id: prod_id, tbl_name: tbl_name },

                                    success: function (data) {
                                        let res = $.parseJSON(data);
                                        if (res.code == 200) {
                                            $.toast({
                                                icon: "success",
                                                heading: "Suucess",
                                                text: res.msg,
                                                position: "top-right",
                                                bgColor: "#28292d",
                                                loader: true,
                                                hideAfter: 2000,
                                                stack: false,
                                                showHideTransition: "fade",
                                            });
                                            setTimeout(function () {
                                                location.reload();
                                            }, 1000);
                                        } else {
                                            $.toast({
                                                icon: "error",
                                                heading: "Warning",
                                                text: res.msg,
                                                position: "top-right",
                                                bgColor: "#res",
                                                loader: true,
                                                hideAfter: 2000,
                                                stack: false,
                                                showHideTransition: "fade",
                                            });
                                        }
                                    },
                                });
                            });
                        }
                    }

                });
            });




        </script>
</body>

</html>