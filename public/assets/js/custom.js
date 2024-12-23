$(document).ready(function () {
  $(".minus").click(function () {
    var $input = $(this).parent().find("input");
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;

    $input.val(count);

    return false;
  });

  $(".plus").click(function () {
    // Use console.log for debugging
    var $input = $(this).parent().find("input");
    var availStock = $input.attr("stock-qty");
    var currentval = parseInt($input.val());

    if (!(currentval >= availStock)) {
      $input.val(parseInt($input.val()) + 1);
      $input.change();
      return false;
    } else {
      return true;
    }
  });
  //  showing the clicked tab
  $(".tabs-control a").click(function () {
    $(".tabs-control a").removeClass("active");
    $(this).addClass("active");

    let currentTab = $(this).attr("href");
    $(".box").hide();
    $(currentTab).fadeIn();

    // saving current tab to local storage
    let index = $(this).index();
    localStorage.setItem("currentTab", index);
  });

  //  getting last current tab from storage
  let getTab = localStorage.getItem("currentTab");
  $(".tabs-control a").eq(getTab).addClass("active");
  $(".box").eq(getTab).show();
});

$(document).ready(function () {
  $(".owl-carousel").owlCarousel({
    items: 4, // Set the number of items to display
    loop: true, // Enable loop mode
    margin: 1, // Set the margin between items
    autoplay: true, // Enable autoplay
    autoplayTimeout: 3000, // Set autoplay timeout in milliseconds
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 4,
      },
    },
  });
});
function countWordsAndAddEllipse() {
  var paragraph = document.getElementById("output");
  var text = paragraph.innerText.trim();
  var wordCount = text.split(/\s+/).length;
  if (wordCount > 30) {
    paragraph.innerText = text.split(/\s+/).slice(0, 40).join(" ") + "...";
  }
}
countWordsAndAddEllipse();
