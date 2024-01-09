import ProperFocusinFocusoutBehaviour from "./ProperFocusinFocusoutBehaviour.js";

function fetchAndDisplayReviews() {
    $.ajax({
        url: "guestbook/echo_reviews",
        method: "post",
        dataType: "html",
        success: function (data) {
            $(".reviews__list").html(data);
        },
        error: function (error) {
            console.log("Error:", error);
        },
    });
}

jQuery(function () {
    const properFocusinFocusoutBehaviour = new ProperFocusinFocusoutBehaviour(
        ".search__input",
        "search__input_focused"
    );

    const guestbookWriteReview = $(".guestbook__write-review");
    const logInStatus = $("._log-in-status");
    guestbookWriteReview.on("click", function () {
        if (logInStatus.text().trim()) {
            window.location.href =
                "http://localhost/refactoredGuestbookForKlaas/write_review";
        } else {
            window.location.href =
                "http://localhost/refactoredGuestbookForKlaas/sign_in";
        }
    });

    fetchAndDisplayReviews();
});
