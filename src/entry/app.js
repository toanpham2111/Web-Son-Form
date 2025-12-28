import(/* webpackPrefetch: true */ "../utils/header.js");
import(/* webpackPrefetch: true */ "../utils/footer.js");
import(/* webpackPrefetch: true */ /* webpackChunkName: 'swiper' */ "../utils/swiper.js");
import JQuery from "jquery";
import { Collapse, Modal } from "bootstrap";
import { fontAwesomeLoad } from "root/utils/fontawesome";
import { faChevronDown } from "@fortawesome/free-solid-svg-icons/faChevronDown";
fontAwesomeLoad(".fa-chevron-down", faChevronDown);
import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox.css";
window.jQuery = JQuery;

jQuery(document).ready(function ($) {
  // Perform search function
  function performSearch(searchQuery) {
    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      type: "GET",
      data: {
        action: "search_posts",
        s: searchQuery,
      },
      success: function (response) {
        $("#search-results").html(response);

        var newUrl = "/search?search=" + encodeURIComponent(searchQuery);
        window.history.pushState({ path: newUrl }, "", newUrl);

        $("#search").val(searchQuery);
        $("#search").attr("placeholder", searchQuery);
      },
      error: function () {
        $("#search-results").html("<p>There was an error processing your request.</p>");
      },
    });
  }

  // On form submit, trigger the search
  if ($("#searchform").length) {
    $("#searchform").on("submit", function (e) {
      e.preventDefault();
      var searchQuery = $("#search").val();
      performSearch(searchQuery);
    });
  }

  // On page load, perform search if query in URL
  $(window).on("load", function () {
    var urlParams = new URLSearchParams(window.location.search);
    var searchQuery = urlParams.get("search");
    if (searchQuery) {
      performSearch(searchQuery);
      $("#search").attr("placeholder", searchQuery);
    }
  });

  // Handle back/forward navigation
  window.onpopstate = function (event) {
    if (event.state && event.state.path) {
      var urlParams = new URLSearchParams(event.state.path.split("?")[1]);
      var searchQuery = urlParams.get("search");
      if (searchQuery) {
        $("#search").val(searchQuery);
        $("#search").attr("placeholder", searchQuery);
        performSearch(searchQuery);
      }
    }
  };

  // Tab switching
  if ($(".tablink").length) {
    $(".tablink").click(function () {
      $(".tablink").removeClass("active");
      $(this).addClass("active");

      $(".tab-pane").removeClass("active");
      var tabIndex = $(this).index();
      $(".tab-pane").eq(tabIndex).addClass("active");
    });
  }
});

// Placeholder typing effect
const placeholders = ["Tìm kiếm bài viết...", "Nhập từ khóa bạn muốn...", "Tìm kiếm theo danh mục..."];
const searchInput = document.getElementById("searchInput");
const searchInput2 = document.getElementById("searchInput2");

function typePlaceholder(inputElement, index) {
  if (!inputElement) {
    console.error(`Không tìm thấy phần tử input tại index ${index}!`);
    return;
  }

  let currentIndex = 0;
  let typingIndex = 0;
  let typingSpeed = 50;
  let deletingSpeed = 50;

  function startTyping() {
    const placeholder = placeholders[currentIndex];
    inputElement.placeholder = "";

    function type() {
      if (typingIndex < placeholder.length) {
        inputElement.placeholder += placeholder[typingIndex];
        typingIndex++;
        setTimeout(type, typingSpeed);
      } else {
        setTimeout(startDeleting, 1500);
      }
    }

    type();
  }

  function startDeleting() {
    function deleteText() {
      if (inputElement.placeholder.length > 0) {
        inputElement.placeholder = inputElement.placeholder.slice(0, -1);
        setTimeout(deleteText, deletingSpeed);
      } else {
        currentIndex = (currentIndex + 1) % placeholders.length;
        typingIndex = 0;
        setTimeout(startTyping, 500);
      }
    }

    deleteText();
  }

  startTyping();
}

if (searchInput) {
  typePlaceholder(searchInput, 0);
}
if (searchInput2) {
  typePlaceholder(searchInput2, 1);
}

const currentUrl = window.location.href;
const links = document.querySelectorAll("a");

links.forEach((link) => {
  if (currentUrl.includes(link.href)) {
    link.classList.add("active");
  }
});


const phrases = [
  "Xin chào",
  "こんにちは", 
  "您好", 
  "Bonjour",  
];

const textElement = document.querySelector(".title-top-footer");

if (textElement) {
  const typingSpeed = 100;
  const delayBetweenPhrases = 2000;

  let currentIndex = 0;
  let charIndex = 0;

  function typePhrase() {
    if (charIndex < phrases[currentIndex].length) {
      textElement.textContent += phrases[currentIndex][charIndex];
      charIndex++;
      setTimeout(typePhrase, typingSpeed);
    } else {
      setTimeout(clearPhrase, delayBetweenPhrases);
    }
  }

  function clearPhrase() {
    if (charIndex > 0) {
      textElement.textContent = textElement.textContent.slice(0, -1);
      charIndex--;
      setTimeout(clearPhrase, typingSpeed);
    } else {
      currentIndex = (currentIndex + 1) % phrases.length;
      typePhrase();
    }
  }

  typePhrase();
}

Fancybox.bind('[data-fancybox="gallery"]', {
  Thumbs: {
    autoStart: true, 
  },
  infinite: true,
});


