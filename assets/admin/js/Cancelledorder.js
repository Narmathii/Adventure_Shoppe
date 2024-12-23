$(document).ready(function () {
  var mode, JSON, res_DATA, order_id, dispStatus, PrintID;
  var orderID = "";
  var CancelOrderID, CancelStatusID;

  $.when(getOrderList()).done(function () {
    dispOrderDetails(JSON);
  });

  function refreshDetails() {
    $.when(getOrderList()).done(function (brandDetails) {
      var table = $("#datatable").DataTable();
      table.clear();
      table.rows.add(brandDetails);
      table.draw();
      window.location.reload();
    });
  }

  // *************************** [get Data] *************************************************************************
  function getOrderList() {
    $.ajax({
      type: "POST",
      url: base_Url + "get-cancelled-order",
      dataType: "json",
      success: function (data) {
        res_DATA = data;
        dispOrderDetails(res_DATA);
      },
      error: function () {
        console.log("Error");
      },
    });
  }
  // *************************** [Display Data] *************************************************************************

  function dispOrderDetails(JSON) {
    var i = 1;
    $("#datatable").DataTable({
      destroy: true,
      aaSorting: [],
      aaData: JSON,
      aoColumns: [
        {
          mDataProp: null,
          render: function (data, type, row, meta) {
            return i++;
          },
        },
        {
          mDataProp: "order_no",
        },
        {
          mDataProp: "username",
        },
        {
          mDataProp: "order_date",
        },
        {
          mDataProp: function (data, type, full, meta) {
            return (
              '<a  order-id = "' +
              data.order_id +
              '" id="' +
              meta.row +
              '" class="btn orderDetails text-info fs-14 lh-1"> <i class="fe fe-eye" data-bs-effect="effect-scale" data-bs-toggle="modal"></i> View</a>'
            );
          },
        },
        // {
        //   mDataProp: "delivery_date",
        // },
        {
          mDataProp: function (data, type, full, meta) {
            var status = data.delivery_status;

            var backgroundclr;
            if (status == "New") {
              backgroundclr = "badge bg-info";
            } else if (status == "Pending") {
              backgroundclr = "badge bg-warning";
            } else if (status == "Shipped") {
              backgroundclr = "badge bg-secondary-gradient";
            } else if (status == "Delivered") {
              backgroundclr = "badge bg-success";
            } else if (status == "Cancelled") {
              backgroundclr = "badge bg-danger";
            } else if (status == "Refund Created") {
              backgroundclr = "badge bg-warning";
            } else if (status == "Refund Processed") {
              backgroundclr = "badge bg-success";
            } else if (status == "Refund Failed") {
              backgroundclr = "badge bg-danger";
            }
            return (
              '<a id="' +
              meta.row +
              '" class="btn BtnOrdersts" merchant-id="' +
              data.transaction_id +
              '" tnx-id="' +
              data.txnid +
              '" salt="' +
              data.salt +
              '"><span class="badge ' +
              backgroundclr +
              '">' +
              status +
              "</span></a>"
            );
          },
        },
        // {
        //   mDataProp: "delivery_date",
        // },
        {
          mDataProp: function (data, type, full, meta) {
            return (
              '<a id="' +
              meta.row +
              '" class="btn BtnEdit text-danger fs-14 lh-1"><i class="ri-edit-line"></i></a>' +
              '<a order-id="' +
              data.order_id +
              '" id="' +
              meta.row +
              '" class="btn BtnTrackView text-danger fs-14 lh-1"><i class="fe fe-eye" data-bs-effect="effect-scale"></i></a>' +
              '<a id="' +
              meta.row +
              '" class="btn BtnDelete text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i></a>'
            );
          },
        },
      ],
    });
  }
  // *************************** [Change delivery status] *************************************************************************

  $(document).on("click", ".BtnOrdersts", function () {
    $("#delivery-status").modal("show");

    var index = $(this).attr("id");
    orderID = res_DATA[index].order_id;
  });

  $("#submit-status").click(function () {
    var delivery_status = $("#delivery_status").val();

    $.ajax({
      type: "post",
      url: base_Url + "update-delivery-status",
      data: { order_id: orderID, delivery_status: delivery_status },
      dataType: "json",

      success: function (data) {
        if (data.code == 200) {
          location.reload();
        } else {
          Swal.fire({
            title: "Failure",
            text: data.msg,
            icon: "error",
          });
          $("#delivery-status").modal("hide");
        }
      },
    });
  });

  // *************************** [Check order status] *************************************************************************

  $(document).on("click", ".BtnOrdersts", function () {
    $tnxID = $(this).attr("tnx-id");
    $merchantID = $(this).attr("merchant-id");
    $salt = $(this).attr("salt");
  });

  // *************************** [Edit Data] *************************************************************************
  $(document).on("click", ".BtnEdit", function () {
    $("#tracking-order").modal("show");

    var index = $(this).attr("id");
    orderID = res_DATA[index].order_id;

    $.ajax({
      type: "post",
      url: base_Url + "get-trackingdetails",
      data: { order_id: orderID },

      success: function (data) {
        let result = $.parseJSON(data);
        if (result.code == 200) {
          $("#courier_partner").val(result.track_detail[0]["courier_partner"]);
          $("#tracking_id").val(result.track_detail[0]["tracking_id"]);
          // $("#coupon_code").val(result.track_detail[0]["coupon_code"]);

          $deliveryDate = result.track_detail[0]["delivery_date"];

          if ($deliveryDate == "0000-00-00") {
            $("#date").val("");
          } else {
            $("#date").val($deliveryDate);
          }
        }
      },
    });
  });

  // *************************** [Delete Data] *************************************************************************
  $(document).on("click", ".BtnDelete", function () {
    mode = "delete";
    var index = $(this).attr("id");
    order_id = res_DATA[index].order_id;

    Swal.fire({
      title: "Are you sure?",
      text: "You want to delete it?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: base_Url + "delete-orderlist",
          data: { order_id: order_id },

          success: function (data) {
            var resData = $.parseJSON(data);

            if (resData.code == 200) {
              Swal.fire({
                title: "Congratulations!",
                text: resData["message"],
                icon: "success",
              });
              $("#model-data").modal("hide");
              refreshDetails();
            } else {
              Swal.fire({
                title: "Failure",
                text: resData["message"],
                icon: "danger",
              });
              $("#model-data").modal("hide");
              refreshDetails();
            }
          },
        });
      }
    });
  });
  // *************************** [Order Details] *************************************************************************
  $(document).on("click", ".orderDetails", function () {
    $("#order_form").modal("show");
    var orderid = $(this).attr("order-id");
    PrintID = orderid;

    var index = $(this).attr("id");
    $("#refund-status").html("");
    $("#refund-button").html("");

    CancelOrderID = orderid;
    $.ajax({
      type: "POST",
      data: { order_id: orderid },
      url: base_Url + "get-order-details",
      success: function (data) {
        let viewOrder = $.parseJSON(data);
        let sizee = viewOrder.length;
        CancelStatusID = viewOrder[0]["order_id"];

        let DisplayBtn = "";
        DisplayBtn += `<a type="button" id="refund-btn"
                        class="btn btn-warning my-1- me-2">
                        Click to Refund </a>`;

        if (viewOrder[0]["payment_status"] == "COMPLETED") {
          $(".refund_menu").removeClass("d-none");
          $("#refund-button").removeClass("d-none");
          $("#refund-button").html(DisplayBtn);
        }

        let RefundStatus = "";
        RefundStatus += `<a type="button" id="refund-status"
                        class="btn btn-info my-1 me-2">
                        Check Refund Status </a>`;

        if (viewOrder[0]["delivery_status"] == "Refund Processing") {
          $(".refund_menu").removeClass("d-none");
          $("#refund-status").removeClass("d-none");

          $("#refund-status").html(RefundStatus);
        }

        $("#cancel-payid").val(viewOrder[0]["razerpay_payment_id"]);
        $("#cancel-orderid").val(viewOrder[0]["order_id"]);
        // Address
        $("#user-name").html(viewOrder[0]["username"]);
        $("#email-data").html(viewOrder[0]["email"]);

        $("#address").html(
          viewOrder[0]["address"] + " ," + viewOrder[0]["landmark"]
        );
        $("#city").html(viewOrder[0]["city"] + "," + viewOrder[0]["dist_name"]);
        $("#number").html(viewOrder[0]["number"]);
        $("#state_title").html(
          viewOrder[0]["state_title"] + "-" + viewOrder[0]["pincode"]
        );

        //Payment status
        $("#total-amt").html(
          "Total Amount - &#8377;" + viewOrder[0]["sub_total"]
        );
        $("#trans-id").html("Order ID -" + viewOrder[0]["order_no"]);
        $("#payment-id").html(
          "Payment ID -" + viewOrder[0]["razerpay_payment_id"]
        );

        $("#payment-sts").html("" + viewOrder[0]["payment_status"]);

        let cancelReason = viewOrder[0]["cancel_reason"];
        let cancelView = "";
        cancelView += ` 
                          <h6>Cancel Reason</h6>
                        
                        <p>${cancelReason}</p>`;
        $(".cancel-reason").html(cancelView);

        let tblData = "";
        for (i = 0; i < sizee; i++) {
          tblData += `
            <tr>
  
             <td> 
  
            <div class="mb-1 fs-14 fw-semibold">
                <a href="javascript:void(0);">${i + 1}.</a>
            </div>
  
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="avatar avatar-xxl bg-light">
                            <img src="${base_Url}${
            viewOrder[i]["config_image1"]
          }" alt="">
                        </span>
                    </div>
                   
                </div>
            </td>
            <td> 
  
            <div class="mb-1 fs-14 fw-semibold">
                <a href="javascript:void(0);">${
                  viewOrder[i]["product_name"]
                }</a>
            </div>
  
            </td>
            <td>
                <span class="fs-15 fw-semibold">${
                  viewOrder[i]["prod_price"]
                }</span>
            </td>
            <td>${viewOrder[i]["quantity"]}</td>
            <td style="text-align:right">₹${viewOrder[i]["product_price"]}</td>
        </tr>
       
        
    </tr>`;
          $("#order-details tbody").html(tblData);
        }

        const totalAmt = `
          <tr>
            <td colspan="2"></td>
            <td colspan="2">
                <div class="fw-semibold" style="text-align: right;">Delivery Charge :</div>
            </td>
            <td colspan="2" style="text-align: right;">
                <span class="fs-16 fw-semibold"> ₹${viewOrder[0]["courier_charge"]}</span>
            </td>
          </tr>
  
          <tr>
            <td colspan="2"></td>
            <td colspan="2">
                <div class="fw-semibold" style="text-align: right;">Total Price :</div>
            </td>
            <td colspan="2" style="text-align: right;">
                <span class="fs-16 fw-semibold"> ₹${viewOrder[0]["sub_total"]}</span>
            </td>
          </tr>
         `;

        $("#order-details tbody").append(totalAmt);
      },
      error: function () {
        console.log("Error");
      },
    });
  });

  // *************************** [Submit Tracking Detail] *************************************************************************
  $("#submit-track").click(function () {
    if ($("#courier_partner").val() == "") {
      $(".courier_partner").html("Please Enter the Courier Partner");
    } else if ($("#tracking_id").val() == "") {
      $(".tracking_id").html("Please Enter the Tracking ID");
    } else {
      insertTrackingDetails();
    }
  });

  function insertTrackingDetails() {
    var form = $("#tracking-form")[0];
    data = new FormData(form);
    data.append("order_id", orderID);

    $.ajax({
      type: "POST",
      data: data,
      url: base_Url + "update-trackingdetail",
      dataType: "json",
      processData: false,
      contentType: false,

      success: function (data) {
        if (data.code == 200) {
          Swal.fire({
            title: "Congratulations!",
            text: data.msg,
            icon: "success",
          });
          $("#tracking-order").modal("hide");
          location.reload();
        } else {
          Swal.fire({
            title: "Failure!",
            text: data.msg,
            icon: "danger",
          });
          $("#tracking-order").modal("hide");
        }
      },
    });
  }

  // *************************** [View Tracking Detail] *************************************************************************

  $(document).on("click", ".BtnTrackView", function () {
    $("#tracking-view").modal("show");

    var orderid = $(this).attr("order-id");

    $.ajax({
      type: "POST",
      data: { order_id: orderid },
      url: base_Url + "view-trackingdetail",
      dataType: "json",

      success: function (data) {
        $("#tracking-details tbody").empty();
        let tblData = "";
        tblData += `
         <tr>
         <td>${data[0]["courier_partner"]}</td>
         <td>${data[0]["tracking_id"]}</td>
      
           <td>${data[0]["delivery_date"]}</td>
            <td>${data[0]["delivery_message"]}</td>
         </tr>`;

        $("#tracking-details tbody").append(tblData);
      },
    });
  });

  // *************************** [Refund] *************************************************************************
  $(document).on("click", "#refund-btn", function () {
    if ($("#amount_type").val() == "") {
      alert("Pleae Select Amount type");
    } else {
      getCancelorder();
    }

    function getCancelorder() {
      let CancelPaymentID = $("#cancel-payid").val();
      let CancelOrderID = $("#cancel-orderid").val();
      let amount_type = $("#amount_type").val();

      $.ajax({
        url: base_Url + "process-refund",
        type: "POST",
        dataType: "json",
        data: {
          payment_id: CancelPaymentID,
          order_id: CancelOrderID,
          amount_type: amount_type,
        },
        success: function (response) {
          if (response.code == 200) {
            $("#refund-btn").addClass("d-none");

            Swal.fire({
              title: "Congratulations!",
              text: response.message,
              icon: "success",
            });
            setTimeout(function () {
              location.reload();
            }, 1500);
          } else {
            Swal.fire({
              title: "Failure!",
              text: response.message,
              icon: "danger",
            });
            setTimeout(function () {
              location.reload();
            }, 1500);
          }
        },
        error: function () {
          console.log(response);
        },
      });
    }
  });

  // *************************** [Check refund status ] *************************************************************************

  $(document).on("click", "#refund-status", function () {
    let order_id = CancelStatusID;

    $.ajax({
      type: "POST",
      url: base_Url + "check-refundstatus",
      data: { order_id: order_id },
      dataType: "json",
      success: function (data) {
        console.log(data);
      },
    });
  });
  // *************************** [Print Details] *************************************************************************
  $("#btn-print").click(function () {
    let print_id = PrintID;
    var encodedPrintID = btoa(print_id);
    var pdfURL = base_Url + "pdf-viewpage/" + encodedPrintID;

    var printWindow = window.open(pdfURL, "_blank");

    if (printWindow) {
      printWindow.print();
      printWindow.onafterprint = function () {
        printWindow.close();
      };
    } else {
      alert("Popup blocked! Please allow popups for this site.");
    }
  });
});
