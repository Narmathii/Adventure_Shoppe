$(document).ready(function () {
  $("#cancel-btn").click(function () {
    if ($("#message-text").val() == "") {
      $("#error-message")
        .text("Please Enter reason!")
        .css("color", "#ff0000")
        .show();
    } else {
      let message = $("#message-text").val();
      let orderid = $("#cancel-id").val();
      console.log(orderid);
      $.ajax({
        type: "POST",
        url: base_Url + "cancel-orders",
        data: { cancel_reason: message, orderid: orderid },
        dataType: "json",

        success: function (resultData) {
          if (resultData.code == 200) {
            $(".cancelorder").addClass("d-none");

            $.toast({
              icon: "success",
              heading: "Success",
              text: resultData.message,
              position: "top-right",
              bgColor: "#28292d",
              loader: true,
              hideAfter: 2000,
              stack: false,
              showHideTransition: "fade",
            });
            $("#modal2").modal("hide");
            setTimeout(function () {
              location.reload();
            }, 1000);
          } else {
            // changeCSRF(resultData.csrf);
            $.toast({
              icon: "warning",
              heading: "warning",
              text: resultData.message,
              position: "top-right",
              bgColor: "#28292d",
              loader: true,
              hideAfter: 2000,
              stack: false,
              showHideTransition: "fade",
            });
            $("#modal2").modal("hide");
          }
        },
      });
    }
  });
});
