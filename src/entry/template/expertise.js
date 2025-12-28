import $ from "jquery";
  $(document).ready(function() {
    function activateTabFromUrl() {
      var hash = window.location.hash; 
      if (hash) {
        $('.tab-button').removeClass('active');
        $('.tab-pane').removeClass('active');

        var targetTab = $('[data-tab-id="' + hash.substring(1) + '"]');
        if (targetTab.length) {
          targetTab.addClass('active');
          var tabIndex = targetTab.data('tab');
          $('#' + tabIndex).addClass('active'); 
        }
      }
    }

    $('.tab-button').on('click', function() {
      var tabId = $(this).data('tab'); 
      var targetTab = $(this).data('tab-id'); 
      // window.location.hash = targetTab;
      $('.tab-button').removeClass('active');
      $('.tab-pane').removeClass('active');

      $(this).addClass('active');
      $('#' + tabId).addClass('active');
    });

    activateTabFromUrl();

    // $(window).on('hashchange', function() {
    //   activateTabFromUrl();
    // });
  });

