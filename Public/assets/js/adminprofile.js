(function ($) {
  "use strict";
  var fullHeight = function () {
    $(".js-fullheight").css("height", $(window).height());
    $(window).resize(function () {
      $(".js-fullheight").css("height", $(window).height());
    });
  };
  fullHeight();
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");
  });
})(jQuery);

document.getElementById("sendMessageButton").addEventListener("click", function () {
  document.getElementById("sendMessageModal").style.display = "block";
});

document.getElementsByClassName("close")[0].addEventListener("click", function () {
  document.getElementById("sendMessageModal").style.display = "none";
});

window.addEventListener("click", function (event) {
  if (event.target == document.getElementById("sendMessageModal")) {
    document.getElementById("sendMessageModal").style.display = "none";
  }
});











