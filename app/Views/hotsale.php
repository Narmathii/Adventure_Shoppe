<!DOCTYPE html>
<?php
require("components/head.php");
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

    .orderby,
    .discount,
    .orderby_web,
    .orderby_mob,
    .discount_mob {

        width: 100%;
        padding: 1.5%;
        color: #000;
        border-radius: 10px;
    }

    .orderby>option,
    .discount>option,
    .orderby_web>option,
    .orderby_mob>option,
    .discount_mob>option {
        color: #000 !important
    }
</style>

<body id="products_page" class="dark-scheme">
    <?php
    require("components/header.php");
    ?>
    <!-- content begin -->

    <div class="no-bottom no-top zebra">
        <section id="section-newArrivalView" class="products_wrapper">
            <div class="container access_list_grid">
                <h2 class="text-center mb-4">Hot Sale Products</h2>
                <div class="row">
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
                                    <div class="price-field">
                                        <input type="range" min="0" class="input-min common_selector" max="50000"
                                            value="0" id="mob_min_val">
                                        <input type="range" min="0" class="input-max common_selector" max="50000"
                                            value="50000" id="mob_max_val">
                                    </div>
                                    <div class="price-wrap">
                                        <div class="price-wrap-1">

                                            <input id="mob_one">
                                            <label for="one"></label>
                                        </div>
                                        <div class="price-wrap_line">-</div>

                                        <div class="price-wrap-2">

                                            <input id="mob_two">
                                            <label for="two"></label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="item_filter_group">
                                <h4>Sort By</h4>
                                <select class="common_selector orderby_mob" aria-label="Default select example">
                                    <option value="0">Select Option</option>
                                    <option value="ASC">Order by A-Z</option>
                                    <option value="DESC">Order by Z-A</option>
                                    <option value="LOW">Low to High</option>
                                    <option value="HIGH">High to Low</option>
                                </select>
                            </div>


                            <div class="item_filter_group">
                                <h4>Discount</h4>
                                <select class="common_selector discount_mob" aria-label="Default select example">
                                    <option value="0">Select Discount</option>
                                    <option value="10">10% or more</option>
                                    <option value="20">20% or more</option>
                                    <option value="30">30% or more</option>
                                    <option value="40">40% or more</option>
                                </select>
                            </div>


                            <div class="item_filter_group">
                                <h4>Availabilty</h4>
                                <div class="de_form">
                                    <div class="de_checkbox">
                                        <input class="common_selector available" id="available-mob" name="available-mob"
                                            type="checkbox" value="1">
                                        <label for="available-mob">Available</label>
                                    </div>

                                    <div class="de_checkbox">
                                        <input class="common_selector available" id="outofstock-mob"
                                            name="outofstock-mob" type="checkbox" value="0">
                                        <label for="outofstock-mob">Out Of Stock</label>
                                    </div>


                                </div>
                            </div>
                            <div class="item_filter_group">
                                <h4>Brands</h4>
                                <div class="de_form">
                                    <?php for ($i = 0; $i < count($search_brand); $i++) { ?>
                                        <div class="de_checkbox">

                                            <input class="common_selector table_name" id="table_name<?php echo $i ?>"
                                                name="table_name" type="checkbox"
                                                value="<?php echo $search_brand[$i]['tbl_name'] ?>">

                                            <input class="common_selector brand" id="mob_search_brand_<?php echo $i ?>"
                                                name="brands[]" type="checkbox"
                                                value="<?php echo $search_brand[$i]['search_brand'] ?>">
                                            <label
                                                for="mob_search_brand_<?php echo $i ?>"><?php echo $search_brand[$i]['brand_name'] ?></label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- web view filter -->
                    <div class="col-lg-3 filter_lg">
                        <div class="item_filter_group">
                            <h4>Price (₹)</h4>
                            <fieldset class="filter-price">
                                <div class="price-field">
                                    <input type="range" min="0" class="input-min common_selector" max="50000" value="0"
                                        id="web_min_val">
                                    <input type="range" min="0" class="input-max common_selector" max="50000"
                                        value="50000" id="web_max_val">
                                </div>
                                <div class="price-wrap">
                                    <div class="price-wrap-1">
                                        <input id="web_one">
                                        <label for="one"></label>
                                    </div>
                                    <div class="price-wrap_line">-</div>
                                    <div class="price-wrap-2">
                                        <input id="web_two">
                                        <label for="two"></label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="item_filter_group">
                            <h4>Sort By</h4>
                            <select class="common_selector orderby_web" aria-label="Default select example">
                                <option value="0">Select Option</option>
                                <option value="ASC">Order by A-Z</option>
                                <option value="DESC">Order by Z-A</option>
                                <option value="LOW">Low to High</option>
                                <option value="HIGH">High to Low</option>
                            </select>
                        </div>


                        <div class="item_filter_group">
                            <h4>Discount</h4>
                            <select class="common_selector discount" aria-label="Default select example">
                                <option value="0">Select Discount</option>
                                <option value="10">10% or more</option>
                                <option value="20">20% or more</option>
                                <option value="30">30% or more</option>
                                <option value="40">40% or more</option>
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
                    </div>
                    <div class="col-lg-9">
                        <div class="row seach_results">
                            <?php for ($i = 0; $i < count($hotsale); $i++) { ?>
                                <div class="col-12 col-lg-3 productCard mb-4">

                                    <div class="de-item">
                                        <!-- wishlist  start -->
                                        <a><span aria-hidden="true" class="icon_heart_alt wishlist-icon"
                                                data-id="<?php echo $hotsale[$i]['prod_id'] ?>"
                                                tbl-name="<?php echo $hotsale[$i]['tbl_name'] ?>"></span></a>
                                        <!-- wishlist end -->
                                        <div class="d-img">
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
                                                <img src="<?php echo base_url() ?>/<?php echo $hotsale[$i]['product_img'] ?>"
                                                    class="img-fluid" alt=""></a>
                                        </div>
                                        <div class="d-info">
                                            <div class="d-text">

                                                <h4>
                                                    <?php echo $hotsale[$i]['product_name'] ?>
                                                </h4>
                                                <span class="d-price">
                                                    ₹<?php echo number_format($hotsale[$i]['offer_price'], 2) ?>
                                                </span>
                                                <p class="d-flex wish-status">
                                                    <span class="d-flex align-items-center">
                                                        <?php
                                                        $stock = $hotsale[$i]['quantity'];
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
                                                $stock = $hotsale[$i]['quantity'];
                                                if ($stock <= 0) { ?>

                                                    <div>
                                                        <a class="btn-main buynow_btn"
                                                            href="https://wa.me/7358992528?text=<?php echo urlencode("Product Information!\nProduct Name: " . $hotsale[$i]['product_name'] . "\nProduct Price: " . $hotsale[$i]['product_price']); ?>">Contact
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
                                                        <a class="btn-main buynow_btn" href="<?php echo $url; ?>">Buy Now</a>
                                                    </div>
                                                <?php } ?>

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


        <!-- content close -->
        <?php
        require("components/footer.php");
        ?>

        <script>
            $(document).ready(function () {
                function filter_data() {
                    var minimum_price = $('#min-price').val();
                    var maximum_price = $('#max-price').val();
                    var available = get_filter('available');
                    var brand = get_filter('brand');

                    var orderby_web = $('.orderby_web').val();
                    var orderby_mob = $('.orderby_mob').val();

                    var discount = $('.discount').val();
                    var discount_mob = $('.discount_mob').val();

                    var tablename = $('.table_name').val();

                    $.ajax({
                        url: base_Url + "hotsale-filter",
                        type: "POST",
                        dataType: "json",
                        data: {
                            minimum_price: minimum_price,
                            maximum_price: maximum_price,
                            available: available,
                            brand: brand,
                            orderby_web: orderby_web,
                            tablename: tablename,

                            discount: discount,
                            orderby_mob: orderby_mob,
                            discount_mob: discount_mob

                        },
                        success: function (data) {
                            let searchResults = "";

                            let count = data.length;
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
                                for (let i = 0; i < count; i++) {
                                    const product = data[i];
                                    const redirectUrl = product.redirect_url.toLowerCase().replace(/ /g, '-');
                                    const prodId = btoa(product.prod_id);  // Base64 encode product ID
                                    const formattedPrice = parseFloat(product.oprice).toFixed(2);
                                    const stockStatus = product.quantity == 0 ? 'Out of stock' : 'Available';
                                    let stock = product.quantity;


                                    // console.log(formattedPrice);
                                    // for redirect url start
                                    let tblName = product.tbl_name;
                                    let url = '';
                                    if (tblName) {
                                        if (tblName === "tbl_products") {
                                            url = base_Url + "detail/" + product.redirect_url.toLowerCase().replace(/ /g, '-') + "/" + btoa(product.prod_id);
                                        } else if (tblName === "tbl_accessories_list") {
                                            url = base_Url + "accessories-detail/" + product.redirect_url.toLowerCase().replace(/ /g, '-') + "/" + btoa(product.prod_id);
                                        } else if (tblName === "tbl_rproduct_list") {
                                            url = base_Url + "riding-details/" + product.redirect_url.toLowerCase().replace(/ /g, '-') + "/" + btoa(product.prod_id);
                                        } else if (tblName === "tbl_helmet_products") {
                                            url = base_Url + "helmet-details/" + product.redirect_url.toLowerCase().replace(/ /g, '-') + "/" + btoa(product.prod_id);
                                        } else if (tblName === "tbl_luggagee_products") {
                                            url = base_Url + "tour-detail/" + product.redirect_url.toLowerCase().replace(/ /g, '-') + "/" + btoa(product.prod_id);
                                        } else if (tblName === "tbl_camping_products") {
                                            url = base_Url + "camp-details/" + product.redirect_url.toLowerCase().replace(/ /g, '-') + "/" + btoa(product.prod_id);
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
                    <div class="col-12 col-lg-3
                    
                    productCard mb-4">
                    <form>
                       
                            <div class="de-item">
                            
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
                                     <h4>${product.product_name}</h4>
                                        <span class="d-price">
                                            ₹ ${formattedPrice}
                                        </span>
                                       
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
                    </div>`;
                                }
                                $('.seach_results').html(searchResults);
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
            });
        </script>
</body>

</html>