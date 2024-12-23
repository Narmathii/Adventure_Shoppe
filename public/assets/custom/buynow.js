// // ********************************************************** ADDRESS INSERTION  *************************************************************

$(document).ready(function () {
  var mode;
  mode = "new";
  $("#state_id").change(function () {
    let state_id = $(this).val();
    $.ajax({
      type: "POST",
      url: base_Url + "getdist-data",
      data: { state_id: state_id },
      // headers: {
      //   "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      // },
      dataType: "json",

      success: function (res) {
        console.log(res["response"].length);
        // changeCSRF(res["csrf"]);
        var distDta = "";
        for ($i = 0; $i < res["response"].length; $i++) {
          distDta += `<option value="${res["response"][$i]["dist_id"]}">${res["response"][$i]["dist_name"]}</option>`;
        }
        $("#dist_id").html(
          `<option value=''> Select District </option>` + distDta
        );
      },
    });
  });
  //  ************************************** INSERT ADDRESS **********

  $("#save_address").click(function () {
    if ($("#state_id").val() === "") {
      validation("Please Select State!");
    } else if ($("#dist_id").val() === "") {
      validation("Please Select District!");
    } else if ($("#landmark").val() === "") {
      validation("Please Enter Landmark");
    } else if ($("#city").val() === "") {
      validation("Please Enter City");
    } else if ($("#address").val() === "") {
      validation("Please Enter Address");
    } else if ($("#pincode").val() === "") {
      validation("Please Enter Pincode");
    } else if (!$("#default_addr").prop("checked")) {
      validation("Please Select as default address");
    } else {
      insertData();
    }
  });

  function validation(data) {
    $.toast({
      icon: "error",
      heading: "Warning",
      text: data,
      position: "bottom-left",
      bgColor: "#red",
      loader: true,
      hideAfter: 2000,
      stack: false,
      showHideTransition: "fade",
    });
  }

  function insertData() {
    var state_id = $("#state_id").val();
    var dist_id = $("#dist_id").val();
    var landmark = $("#landmark").val();
    var city = $("#city").val();
    var address = $("#address").val();
    var pincode = $("#pincode").val();
    var isChecked = $("#default_addr").prop("checked");

    $.ajax({
      type: "POST",
      url: base_Url + "insert-address",
      data: {
        state_id: state_id,
        dist_id: dist_id,
        landmark: landmark,
        city: city,
        address: address,
        pincode: pincode,
        default_addr: isChecked,
      },
      dataType: "json",
      cache: false,
      // headers: {
      //   "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      // },
      success: function (resultData) {
        // var resultData = $.parseJSON(data);

        if (resultData.code == 200) {
          // changeCSRF(resultData.csrf);
          // update_csrf_fields(resultData.csrf_test_name);
          $.toast({
            icon: "success",
            heading: "Success",
            text: resultData.msg,
            position: "top-right",
            bgColor: "#28292d",
            loader: true,
            hideAfter: 1000,
            stack: false,
            showHideTransition: "fade",
          });

          window.location.reload();
        } else {
          // changeCSRF(resultData.csrf);
          $.toast({
            icon: "warning",
            heading: "warning",
            text: resultData.msg,
            position: "top-right",
            bgColor: "#28292d",
            loader: true,
            hideAfter: 1000,
            stack: false,
            showHideTransition: "fade",
          });
          window.location.reload();
        }
      },
      error: function (xhr, status, error) {
        console.log("test3");
        console.error(xhr, status, error);
      },
    });
  }

  // **********************************************************PROGRESS BAR *************************************************************
  var currentStep = 1;
  var updateProgressBar;

  function displayStep(stepNumber) {
    if (stepNumber >= 1 && stepNumber <= 3) {
      $(".step-" + currentStep).hide();
      $(".step-" + stepNumber).show();
      currentStep = stepNumber;
      updateProgressBar();
    }
  }

  $("#multi-step-form").find(".step").slice(1).hide();

  $(".next-step").click(function () {
    if (currentStep <= 2) {
      if (currentStep == 1) {
        if (!$(".courier-type").is(":checked")) {
          $.toast({
            icon: "error",
            heading: "Warning",
            text: "Please Select Courier Option!",
            position: "top-right",
            bgColor: "#red",
            loader: true,
            hideAfter: 2000,
            stack: false,
            showHideTransition: "fade",
          });
        } else {
          let stateID = $("#buynow-state-id").val();
          let price = $("#prod_price").val();

          let courierType = $('input[name="courier_option"]:checked').val();
          let charge = "";

          if (courierType == 0) {
            charge = 100;

            $("#courier-charge").html("₹" + charge);
            let priceInt = parseInt(price);
            let chargeInt = parseInt(charge);

            let totalAmt = priceInt + chargeInt;
            // INR converter
            const formatter = new Intl.NumberFormat("en-IN", {
              style: "currency",
              currency: "INR",
              minimumFractionDigits: 0,
              maximumFractionDigits: 2,
            });

            let Total = formatter.format(totalAmt);

            $(".overAllTotalValue").text(Total);

            // Add animation class and hide current step
            $(".step-" + currentStep).addClass(
              "animate__animated animate__fadeOutLeft"
            );
            currentStep++;

            // Transition to next step after a delay
            setTimeout(function () {
              $(".step")
                .removeClass("animate__animated animate__fadeOutLeft")
                .hide();
              $(".step-" + currentStep)
                .show()
                .addClass("animate__animated animate__fadeInRight");
              updateProgressBar();
            }, 500);
          } else {
            $.ajax({
              type: "POST",
              url: base_Url + "couriercharge-buynow",
              data: { state_id: stateID, courierType: courierType },
              dataType: "json",
              success: function (data) {
                var charge = data;

                $("#courier-charge").html("₹" + charge);
                let priceInt = parseInt(price);
                let chargeInt = parseInt(charge);

                let totalAmt = priceInt + chargeInt;
                // INR converter
                const formatter = new Intl.NumberFormat("en-IN", {
                  style: "currency",
                  currency: "INR",
                  minimumFractionDigits: 0,
                  maximumFractionDigits: 2,
                });

                let Total = formatter.format(totalAmt);

                $(".overAllTotalValue").text(Total);

                $(".step-" + currentStep).addClass(
                  "animate__animated animate__fadeOutLeft"
                );
                currentStep++;
                setTimeout(function () {
                  $(".step")
                    .removeClass("animate__animated animate__fadeOutLeft")
                    .hide();
                  $(".step-" + currentStep)
                    .show()
                    .addClass("animate__animated animate__fadeInRight");
                  updateProgressBar();
                }, 500);
              },
            });
          }
        }
      }
    }
  });

  $(".prev-step").click(function () {
    if (currentStep > 1) {
      $(".step-" + currentStep).addClass(
        "animate__animated animate__fadeOutRight"
      );
      currentStep--;
      setTimeout(function () {
        $(".step")
          .removeClass("animate__animated animate__fadeOutRight")
          .hide();
        $(".step-" + currentStep)
          .show()
          .addClass("animate__animated animate__fadeInLeft");
        updateProgressBar();
      }, 500);
    }
  });

  var updateProgressBar = function () {
    var progressPercentage = (currentStep - 1) * 50;
    $(".progress-bar").css("width", progressPercentage + "%");
  };

  // ************************************************** Buy Now   *************************************************************************

  $("#buy-now").click(function () {
    let totalAmt = $(".overAllTotalValue").text().trim();
    let amt = totalAmt.replace("₹", "");
    let Amtt = parseInt(amt.replace(",", ""));

    let courier = $("#courier-charge").text();
    let courierCharge = courier.replace("₹", "");

    let State = $("#buynow-state-id").val();
    let CourierType = $('input[name="courier_option"]:checked').val();

    $.ajax({
      type: "POST",
      url: base_Url + "buynow-checkout",
      data: {
        totalamt: Amtt,
        courierCharge: courierCharge,
        stateid: State,
        courier_type: CourierType,
      },
      dataType: "json",
      success: function (data) {
        if (data.code == 200) {
          window.location.href = base_Url + "payment";
        } else {
          $.toast({
            icon: "error",
            heading: "Warning",
            text: data.message,
            position: "bottom-left",
            bgColor: "#red",
            loader: true,
            hideAfter: 2000,
            stack: false,
            showHideTransition: "fade",
          });
        }
      },
    });
  });
});
