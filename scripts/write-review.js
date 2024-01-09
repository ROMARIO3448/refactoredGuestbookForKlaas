import ProblemSuccessDisplayManager from "./ProblemSuccessDisplayManager.js";

jQuery(function () {
    const problemSuccessDisplayManager = new ProblemSuccessDisplayManager(
        ".problem__description",
        ".write-review__problem",
        ".success__description",
        ".write-review__success"
    );

    function handleReview(event) {
        event.preventDefault();

        const $textInput = $(".input-form__text-input");
        const reviewValue = $textInput.val();
        $textInput.val("");

        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify({ review: reviewValue }),
            success: function ({ successDescription, problemDescription }) {
                $(".success__description").text(successDescription || "");
                $(".problem__description").text(problemDescription || "");
                problemSuccessDisplayManager.displayElementsBasedOnContent();
            },
            error: function (error) {
                console.log("Error:", error);
            },
        });
    }

    $(".write-review__input-form").submit(handleReview);
});
