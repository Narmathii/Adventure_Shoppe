<!DOCTYPE html>
<html lang="en">

<?php
require("components/head.php");
?>

<body class="dark-scheme h-100">
    <section class="h-100" id="successpage_wrapper">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="message-box _success">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <h1 class="mt-3">₹10,000</h1>


                    <h3> Your payment was successful </h3>
                    <p>Transaction id:454545454545454</p>

                    <div class="confirm_order">
                        <a href="<?php echo base_url() ?>ordersummary" type="button"
                            class="continue_shoppingBtn pay_btn prev-step me-4">
                            <i class="arrow_left me-2"></i>Click Here
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>