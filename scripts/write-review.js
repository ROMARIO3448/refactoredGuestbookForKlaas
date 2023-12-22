import ProblemSuccessDisplayManager from "./ProblemSuccessDisplayManager.js";

jQuery(function () {
    const problemSuccessDisplayManager = new ProblemSuccessDisplayManager(
        ".problem__description",
        ".write-review__problem",
        ".success__description",
        ".write-review__success"
    );
});
