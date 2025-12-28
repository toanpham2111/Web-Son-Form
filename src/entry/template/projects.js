import $ from "jquery";

$(document).ready(function () {
  $("#loading-spinner").hide();

  loadProjects("all");

  $("#category-menu li").on("click", function () {
    var category = $(this).data("category");

    $("#category-menu li").removeClass("active");
    $(this).addClass("active");

    loadProjects(category);
  });

  function loadProjects(category) {
    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      type: "POST",
      data: {
        action: "load_projects_by_category",
        category: category,
      },
      beforeSend: function () {
        $("#loading-spinner").show();
        $("#projects-grid").css({
          filter: "blur(5px)", 
          opacity: "0.8",       
        });
      },
      success: function (response) {
        $("#projects-grid").html(response);
      },
      complete: function () {
        $("#loading-spinner").hide();
        $("#projects-grid").css({
          filter: "none",       
          opacity: "1",         
        });
      },
      error: function () {
        $("#projects-grid").html(
          "<p>Something went wrong. Please try again.</p>"
        );
        $("#loading-spinner").hide();
        $("#projects-grid").css({
          filter: "none",
          opacity: "1",
        });
      },
    });
  }
});
const projectCategories = document.querySelector('.project-categories');
const placeholder = document.querySelector('.menu-placeholder');
if (projectCategories && placeholder) {
const stickyOffset = projectCategories.offsetTop;
const menuHeight = projectCategories.offsetHeight;

function handleScroll() {
    if (window.pageYOffset >= stickyOffset) {
        placeholder.style.height = `${menuHeight}px`; 
        projectCategories.classList.add('sticky-menu');
    } else {
        placeholder.style.height = '0';
        projectCategories.classList.remove('sticky-menu');
    }
}

window.addEventListener('scroll', handleScroll);
}