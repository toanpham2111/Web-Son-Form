import { arrow } from "@popperjs/core";
import $ from "jquery";
import slick from "slick-carousel";

$(document).ready(function () {
  if ($(".slick-banner").length) {
    $(".slick-banner").slick({
      dots: true,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 5000,
      speed: 800,
      fade: true,
      customPaging: function (slider, i) {
        return "<span>" + ("0" + (i + 1)).slice(-2) + "</span>";
      },
      dotsClass: "slick-dots",
    });
  }

  if ($(".project-slider").length) {
    $(".project-slider").slick({
      dots: false,
      infinite: true,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      arrows: true,
      fade: true,
      prevArrow: ".slick-prev",
      nextArrow: ".slick-next",
    });
  }

  if ($(".blog-slider").length) {
    $(".blog-slider").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      centerMode: false,
      autoplaySpeed: 3000,
      prevArrow:
        '<button type="button" class="slick-prev"><img width="30" height="20" src="/wp-content/uploads/2024/10/Prev.webp"></button>',
      nextArrow:
        '<button type="button" class="slick-next"><img width="30" height="20" src="/wp-content/uploads/2024/10/Next.webp"></button>',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            centerMode: false,
            arrows: false,
            dots: true,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            centerMode: false,
            arrows: false,
            dots: true,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            centerMode: false,
            arrows: false,
            dots: true,
          },
        },
      ],
    });
  }

  if ($(".list-partners").length) {
    $(".list-partners").slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      autoplay: true,
      arrows: true,
      autoplaySpeed: 3000,
      prevArrow:
        '<button type="button" class="slick-prev"><img width="30" height="20" src="/wp-content/uploads/2024/10/Prev.webp"></button>',
      nextArrow:
        '<button type="button" class="slick-next"><img width="30" height="20" src="/wp-content/uploads/2024/10/Next.webp"></button>',
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 2,
            centerMode: false,
            arrows: false,
            autoplaySpeed: 3000,
            autoplay: true,
            dots: true,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            centerMode: false,
            arrows: false,
            autoplaySpeed: 3000,
            autoplay: true,
            dots: true,
          },
        },
      ],
    });
  }
});
