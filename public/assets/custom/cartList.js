// // ********************************************************** ADDRESS INSERTION  *************************************************************

$(document).ready(function () {
  var mode;

  var states = "";

  $("#state_id_val").change(function () {
    let state_id = $(this).val();

    if (mode == "new") {
      $.ajax({
        type: "POST",
        url: base_Url + "getdist-data",
        data: { state_id: state_id },
        dataType: "json",

        success: function (res) {
          var distDta = "";
          for ($i = 0; $i < res["response"].length; $i++) {
            distDta += `<option value="${res["response"][$i]["dist_id"]}">${res["response"][$i]["dist_name"]}</option>`;
          }

          $("#dist_id_val").html(
            `<option value=''> Select District </option>` + distDta
          );
        },
      });
    } else if (mode == "edit") {
      $.ajax({
        type: "POST",
        url: base_Url + "getdist-data",
        data: { state_id: state_id },
        dataType: "json",

        success: function (data) {
          states += `<option value="${stateID}" selected>${state_name}</option>`;
          $("#state_id_val").val(states);

          var distDta = "";
          distDta += `<option value="${distID}" selected>${distName}</option>`;

          for (let i = 0; i < data.length; i++) {
            if (data[i]["dist_id"] !== distID) {
              distDta += `<option value="${data[i]["dist_id"]}">${data[i]["dist_name"]}</option>`;
            }
          }

          $("#state_id_val").val(stateID);

          $("#dist_id_val").html(distDta);
        },
      });
    }
  });
  //  ************************************** INSERT ADDRESS **********
  mode = "new";

  function validateError(data) {
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

  $("#btn_save").click(function () {
    if ($("#state_id").val() === "") {
      validateError("Please Select State!");
    } else if ($("#dist_id").val() === "") {
      validateError("Please Select District!");
    } else if ($("#landmark").val() === "") {
      validateError("Please Enter Landmark");
    } else if ($("#city").val() === "") {
      validateError("Please Enter City");
    } else if ($("#address").val() === "") {
      validateError("Please Enter Address");
    } else if ($("#pincode").val() === "") {
      validateError("Please Enter Pincode");
    } else if (!$("#default_addr").prop("checked")) {
      validateError("Please Select as default address");
    } else {
      insertData();
    }
  });

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
          location.reload();
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
          $("#add_form").modal("hide");
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

  $(document).ready(function () {
    $("#multi-step-form").find(".step").slice(1).hide();

    $(".next-step").click(function () {
      if (currentStep < 3) {
        if (currentStep == 2) {
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
            let stateID = $("#cart-state-id").val();
            let courierType = $('input[name="courier_option"]:checked').val();
            let charge = "";

            if (courierType == 0) {
              charge = 100;

              $(".goto-buy")
                .addClass("next-step")
                .trigger("click")
                .off("click");

              $("#courier-charge").html("₹" + charge);

              let subTotal = $("#final_total").val();
              let overAlltotal = parseFloat(
                parseFloat(subTotal) + parseFloat(charge)
              ).toFixed(2);

              // INR converter
              const formatter = new Intl.NumberFormat("en-IN", {
                style: "currency",
                currency: "INR",
                minimumFractionDigits: 0,
                maximumFractionDigits: 2,
              });

              let Total = formatter.format(overAlltotal);
              $(".overAllTotalValue").text(Total);

              $(".step-" + currentStep).addClass(
                "animate__animated animate__fadeOutLeft"
              );

              currentStep = 3;
              $(".step")
                .removeClass("animate__animated animate__fadeOutLeft")
                .hide();
              $(".step-3")
                .show()
                .addClass("animate__animated animate__fadeInRight");

              updateProgressBar();
            } else {
              $.ajax({
                type: "POST",
                url: base_Url + "assign-couriercharge",
                data: { state_id: stateID, courierType: courierType },
                dataType: "json",
                success: function (data) {
                  charge = data;

                  if (charge !== "") {
                    $(".goto-buy")
                      .addClass("next-step")
                      .trigger("click")
                      .off("click");
                  }

                  $("#courier-charge").html("₹" + charge);

                  let subTotal = $("#final_total").val();
                  let overAlltotal = parseFloat(
                    parseFloat(subTotal) + parseFloat(charge)
                  ).toFixed(2);

                  // INR converter
                  const formatter = new Intl.NumberFormat("en-IN", {
                    style: "currency",
                    currency: "INR",
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2,
                  });

                  let Total = formatter.format(overAlltotal);
                  $(".overAllTotalValue").text(Total);

                  $(".step-" + currentStep).addClass(
                    "animate__animated animate__fadeOutLeft"
                  );

                  currentStep = 3;
                  $(".step")
                    .removeClass("animate__animated animate__fadeOutLeft")
                    .hide();
                  $(".step-3")
                    .show()
                    .addClass("animate__animated animate__fadeInRight");

                  updateProgressBar();
                },
                error: function (xhr, status, error) {},
              });
            }
          }
        } else {
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

    updateProgressBar = function () {
      var progressPercentage = ((currentStep - 1) / 2) * 100;
      $(".progress-bar").css("width", progressPercentage + "%");
    };

    // ************************************************** COLOR *************************************************************************
    // color Option
    $(".color_wrap ul li").each(function (item) {
      var color = $(this).attr("data-color");
      $(this).css("backgroundColor", color);
    });

    $(".color_wrap ul li").each(function (item) {
      $(this).click(function () {
        $(this)
          .parents(".product_item")
          .find(".color_wrap ul li")
          .removeClass("active");
        $(this).addClass("active");
        var img_src = $(this).attr("data-src");
        $(this).parents(".product_item").find("img").attr("src", img_src);
      });

      // ************************************************** QUANTITY *************************************************************************
    });

    totalAmount();
    $(".btn-increment").click(function () {
      var cartID = $(this).attr("cart_id_data");
      var totalStock = parseInt($(this).attr("data-stock"));

      var inputField = this.parentNode.querySelector("input[type=number]");
      var currentQty = parseInt($(inputField).val());

      if (currentQty < totalStock) {
        inputField.stepUp();
        var incQty = parseInt($(`.quantity_${cartID}`).val());

        subTotal(incQty, cartID);
      }
    });

    $(".btn-decrement").click(function () {
      var cartID = $(this).attr("cart_id_data");
      this.parentNode.querySelector("input[type=number]").stepDown();
      var decQty = $(`.quantity_${cartID}`).val();

      subTotal(decQty, cartID);
    });

    function subTotal(qty, cartID) {
      let original = `.offer_${cartID}`;
      let prodPrice = $(original).val();

      let p1 = prodPrice.replace(",", "");
      let price = parseInt(p1);

      let displayPrice = `.disp_${cartID}`;

      let subtotalAmt = qty * price;

      $(displayPrice).text("₹" + subtotalAmt.toLocaleString());

      // update the quantity and subtotal into cart tbl
      $.ajax({
        type: "POST",
        url: base_Url + "update-cart",
        data: {
          quantity: qty,
          sub_total: subtotalAmt,
          cart_id: cartID,
        },
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },

        dataType: "json",
        success: function (data) {
          // console.log(data.csrf_token);

          if (data.code == 200) {
            updateCSRF(data.csrf_token);
            $(".total_amt_cal").text(number_formate(subtotalAmt));
          }
        },
        error: function () {
          console.log("Error");
        },
      });
      totalAmount(subtotalAmt);
    }

    function totalAmount() {
      var totalAmt = 0;
      $(".display-price").each(function () {
        let price = $(this).text();
        let remov_space = price.replace(",", "");
        let amt = parseFloat(remov_space.replace("₹", "").trim());

        totalAmt += amt;
      });
      $("#final_total").val(parseFloat(totalAmt));
      $(".total_amt_cal").text("₹" + totalAmt.toLocaleString());
    }

    //  ************************************************** CSRF update Token  *****************************************************************
    function updateCSRF(newToken) {
      $('meta[name="csrf-token"]').attr("content", newToken);
    }

    // ************************************************** DELETE  *************************************************************************

    $(document).on("click", ".btnDlt", function () {
      var cart_id = $(this).attr("dlt_id");
      console.log(cart_id);

      $("#myModal").modal("show");

      if (
        $(".btndelete").on("click", function () {
          $.ajax({
            type: "POST",
            url: base_Url + "delete-cart",
            data: { cart_id: cart_id },
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            success: function (data) {
              $("#myModal").modal("hide");
              var resData = $.parseJSON(data);
              console.log(resData);

              if (resData.code == 200) {
                updateCSRF(resData.csrf);
                refreshDetail();
              } else {
                updateCSRF(resData.csrf);
                $.toast({
                  text: resData.msg,
                  hideAfter: 2000,
                  position: "top-center",
                });
              }
            },
          });
        })
      );
      if (
        $(".btnclose").on("click", function () {
          $("#myModal").modal("hide");
        })
      );
    });

    // ************************************************** REFRESH   *************************************************************************

    function refreshDetail() {
      window.location.reload();
    }
    // ************************************************** Checkout  cart   *************************************************************************

    $("#place-order").click(function () {
      $.ajax({
        type: "GET",
        url: base_Url + "check-userlogin",
        success: function (data) {
          var d = $.parseJSON(data);
          if (d.code == 400) {
            window.location.href = "login";
          } else if (d.code == 200) {
          }
        },
      });
    });
  });

  // ************************************************** Buy Now   *************************************************************************

  $("#buy-now").click(function () {
    let totalAmt = $(".overAllTotalValue").text().trim();
    let amt = totalAmt.replace("₹", "");
    let Amtt = parseInt(amt.replace(",", ""));

    let State = $("#cart-state-id").val();
    let CourierType = $('input[name="courier_option"]:checked').val();

    let courier = $("#courier-charge").text();
    let courierCharge = courier.replace("₹", "");

    $.ajax({
      type: "POST",
      url: base_Url + "cart-checkout",
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
  // ************************************************** Add courier charges  *************************************************************************

  $("#step-next").click(function () {
    // let distID = $(this).attr("user_iid");
    let userID = $(this).attr("user_iid");
    var distID;
    $.ajax({
      type: "POST",
      url: base_Url + "get-dist",
      data: { user_id: userID },
      dataType: "json",
      success: function (data) {
        if (data != "") {
          distID = data[0]["dist_id"];
          proceedWithNextStep(distID);
        } else if (data == "") {
          $.toast({
            icon: "warning",
            heading: "Warning",
            text: "Please Fill Address",
            position: "top-left",
            bgColor: "#red",
            loader: true,
            hideAfter: 2000,
            stack: false,
            showHideTransition: "fade",
          });
        }
      },
    });

    function proceedWithNextStep(distID) {
      let currentStep = 3;

      $(".step-" + currentStep).addClass(
        "animate__animated animate__fadeOutLeft"
      );
      // currentStep++;
      setTimeout(function () {
        $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
        $(".step-" + currentStep)
          .show()
          .addClass("animate__animated animate__fadeInRight");
        updateProgressBar();
      }, 500);

      function number_formate(number) {
        return number.toLocaleString();
      }
    }
  });

  // ************************************************** Change Address *************************************************************************

  $("#address-close").click(function () {
    $("#edit_address").modal("hide");
  });
  $("#btn-cancel").click(function () {
    $("#edit_address").modal("hide");
  });

  var distID;
  var distName;
  var stateID;
  var state_name;

  $(".change-address").click(function () {
    $("#state_id_val").val("").trigger("change");
    $("#dist_id_val").html('<option value="">Select District</option>');
    $("#landmark_val").val("");
    $("#city_val").val("");
    $("#address_val").val("");
    $("#pincode_val").val("");
    $("#default_addr_val").prop("checked", false);

    let addID = $(this).data("id");

    $("#save_address").attr("data-addid", addID);

    let index = 0;

    mode = "edit";

    $.ajax({
      type: "POST",
      url: base_Url + "change-address",
      data: { add_id: addID },
      cache: false,
      success: function (data) {
        var res_DATA = JSON.parse(data);

        stateID = res_DATA[index]["state_id"];

        state_name = res_DATA[index]["state_title"];
        distID = res_DATA[index]["dist_id"];
        distName = res_DATA[index]["dist_name"];
        $("#state_id_val").val(stateID).trigger("change");

        $("#landmark_val").val(res_DATA[index]["landmark"]);
        $("#city_val").val(res_DATA[index]["city"]);
        $("#address_val").val(res_DATA[index]["address"]);
        $("#pincode_val").val(res_DATA[index]["pincode"]);

        let defaultAddr = res_DATA[index]["default_addr"];
        if (defaultAddr == 1) {
          $("#default_addr_val").prop("checked", true);
        } else {
          $("#default_addr_val").prop("checked", false);
        }
      },
    });

    $("#edit_address").modal("show");
  });

  // ************************************************** Save  Address *************************************************************************

  function validateError(data) {
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

  $("#save_address").click(function () {

    $addID  = $(this).data("addid");

    if ($("#state_id_val").val() === "") {
      validateError("Please Select State!");
    } else if ($("#dist_id_val").val() === "") {
      validateError("Please Select District!");
    } else if ($("#landmark_val").val() === "") {
      validateError("Please Enter Landmark");
    } else if ($("#city_val").val() === "") {
      validateError("Please Enter City");
    } else if ($("#address_val").val() === "") {
      validateError("Please Enter Address");
    } else if ($("#pincode_val").val() === "") {
      validateError("Please Enter Pincode");
    } else {
      updateAddress($addID);
    }

  });

  function updateAddress($addID) {
    var state_id = $("#state_id_val").val();
    var dist_id = $("#dist_id_val").val();
    var landmark = $("#landmark_val").val();
    var city = $("#city_val").val();
    var address = $("#address_val").val();
    var pincode = $("#pincode_val").val();
    var isChecked = $("#default_addr_val").prop("checked");
    var add_id = $addID;
    

    $.ajax({
      type: "POST",
      url: base_Url + "update-cart-address",
      data: {
        state_id: state_id,
        dist_id: dist_id,
        landmark: landmark,
        city: city,
        address: address,
        pincode: pincode,
        default_addr: isChecked,
        add_id:add_id
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
          location.reload();
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
          $("#add_form").modal("hide");
        }
      },
      error: function (xhr, status, error) {
        console.log("test3");
        console.error(xhr, status, error);
      },
    });
  }
});
