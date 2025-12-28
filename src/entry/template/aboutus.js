import $ from "jquery";
$(document).ready(function ($) {
  $("#load-more").on("click", function () {
    $("#loading-spinner").show();
    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      type: "POST",
      data: {
        action: "load_more_members",
        page_id: "173",
      },
      success: function (response) {
        if (response.success) {
          $("#member-list").append(response.data.html);
          // $("#load-more").prop("disabled", true).text("All members loaded").addClass("disabled");
          $("#load-more").hide();
        } else {
          console.log("No members found or another issue occurred.");
        }
      },
      error: function (error) {
        console.log("Error occurred", error);
      },
      complete: function () {
        $("#loading-spinner").hide();
      },
    });
  });
});
