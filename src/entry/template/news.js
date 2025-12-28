import $ from "jquery";
import slick from "slick-carousel";
$(document).ready(function ($) {
  if ($(".news-featured-slider").length) {
  $(".news-featured-slider").slick({
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    arrows: true,
    fade: true,
    prevArrow: ".slick-prev",
    nextArrow: ".slick-next",
  });
  }
  $("#loading-spinner").hide();

  // Initial load
  loadBlog("all");

  // Category click event
  $("#category-menu li").on("click", function() {
      var category = $(this).data("category");

      $("#category-menu li").removeClass("active");
      $(this).addClass("active");

      loadBlog(category);
  });

  // Function to load blog posts by category
  function loadBlog(category) {
      $.ajax({
          url: "/wp-admin/admin-ajax.php",
          type: "POST",
          data: {
              action: "load_blog_by_category",
              category: category,
          },
          beforeSend: function() {
              $("#loading-spinner").show();
              $("#blog-grid").css({
                  filter: "blur(5px)",
                  opacity: "0.8",
              });
          },
          success: function(response) {
              $("#blog-grid").html(response);
          },
          complete: function() {
              $("#loading-spinner").hide();
              $("#blog-grid").css({
                  filter: "none",
                  opacity: "1",
              });
          },
          error: function() {
              $("#blog-grid").html("<p>Something went wrong. Please try again.</p>");
              $("#loading-spinner").hide();
              $("#blog-grid").css({
                  filter: "none",
                  opacity: "1",
              });
          },
      });
  }
});
 // Sticky menu for blog categories
 const projectCategories = document.querySelector(".blog-categories");
 const placeholder = document.querySelector(".menu-placeholder");

 if (projectCategories && placeholder) {
   const stickyOffset = projectCategories.offsetTop;
   const menuHeight = projectCategories.offsetHeight;

   function handleScroll() {
     if (window.pageYOffset >= stickyOffset) {
       placeholder.style.height = `${menuHeight}px`;
       projectCategories.classList.add("sticky-menu");
     } else {
       placeholder.style.height = "0";
       projectCategories.classList.remove("sticky-menu");
     }
   }

   window.addEventListener("scroll", handleScroll);
 }