
import jQuery from "jquery";

jQuery(document).ready(function ($) {
  if ($(".footContact").length > 0) {
    $(".footContact").on("click", function (e) {
      e.preventDefault();
      $("#footContact").removeClass("d-none");
    });
    $(".btn-close, .modal_popup_overlay").on("click", function () {
      $("#footContact").addClass("d-none");
    });
  }
  if ($(".report_project").length > 0) {
    $(".report_project").on("click", function (e) {
      e.preventDefault();
      $("#report_project").removeClass("d-none");
    });
    $(".btn-close, .modal_popup_overlay").on("click", function () {
      $("#report_project").addClass("d-none");
    });
  }
  if ($(".loginContact").length > 0) {
    $(".loginContact").on("click", function (e) {
      e.preventDefault();
      $("#footContact").removeClass("d-none");
    });
    $(".btn-close, .modal_popup_overlay").on("click", function () {
      $("#footContact").addClass("d-none");
    });
  }
  // Or call it after the form has been submitted using Contact Form 7's on_submit callback

  if ($(window).width() < 992) {
    $(".btn_click").each(function () {
      $(this).click(function (e) {
        e.preventDefault();
        $(this).next("div").slideToggle(300);
      });
    });
    //--------------------------------------
    $("#top").click(function () {
      $("html, body").animate({ scrollTop: 0 }, 300);
      return false;
    });
    //scroll up down
    var position_up = $(window).scrollTop();
    $(window).scroll(function () {
      var scroll_up = $(window).scrollTop();
      if (scroll_up > position_up || scroll_up === 0) {
        $(".top_scroll").removeClass("show");
      } else {
        $(".top_scroll").addClass("show");
      }
      position_up = scroll_up;
    });
  }
});
