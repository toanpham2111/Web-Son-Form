/**
 * @package     Wordpress.Site
 * @subpackage  Templates.NoName
 *
 * @copyright   Copyright (C) 2020 NoName. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
import jQuery from "jquery";
import $ from "jquery";
window.jQuery = $;

//menu button
if (document.body.contains(document.getElementById("menu-btn"))) {
  document.getElementById("menu-btn").addEventListener("click", (event) => {
    document.querySelector("body").classList.toggle("menu-open");
  });
}

window.addEventListener("scroll", () => {
  // console.log(window.scrollY);
  if (window.scrollY > 10) {
    document.querySelector("header").classList.add("fixed");
  } else {
    document.querySelector("header").classList.remove("fixed");
  }
});


  var header = document.querySelector('header');
  var bodyOffsetTop = document.body.offsetTop + window.pageYOffset;
  
  if ( bodyOffsetTop > 0) {
    header.classList.add('fixed');
    header.classList.remove('bg-transparent');
  } else {
    header.classList.remove('fixed');
    header.classList.add('bg-transparent');
  }

jQuery(document).ready(function ($) {
  var widthW = $(window).width();
  if (widthW < 992) {
    $("#menu-main-menu > .menu-item-has-children > a").each(function () {
      $(this).click(function (e) {
        e.preventDefault();
        $(this).toggleClass("active");
        $(this).next("ul").toggleClass("d-block");
      });
    });
  }
  // click scrollLeft about
  if ($(".menu_tab").length > 0) {
    var totalWidth = 20;
    $(".menu_tab ul li").each(function (index) {
      totalWidth += parseInt($(this).width(), 10) + 30;
    });
    if ($(".global_menu").length > 0) {
      totalWidth = totalWidth + 150;
    }
    if (totalWidth > widthW) {
      $(".menu_tab").addClass("show_icon");
    } else {
      $(".menu_tab").removeClass("show_icon");
    }
    $(".click_scroll").click(function () {
      var _leftOffset = $(".menu_tab .container").scrollLeft() + 30;
      $(".menu_tab .container").animate(
        {
          scrollLeft: _leftOffset,
        },
        300
      );
    });
    //--------------------------------------------------------
    if (widthW < 992) {
      var _offset = $(".menu_tab").offset();
      $(window).scroll(function () {
        var _scrollTop = $(window).scrollTop();
        if (_scrollTop >= _offset.top - 110) {
          $(".menu_tab").addClass("fixed");
          $(".menu_title").addClass("d-none");
        } else {
          $(".menu_tab").removeClass("fixed");
          $(".menu_title").removeClass("d-none");
        }
      });
    }
  }
  ///---------------------------
});
