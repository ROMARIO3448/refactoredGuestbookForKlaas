import ProperFocusinFocusoutBehaviour from "./ProperFocusinFocusoutBehaviour.js";
import PasswordVisibilityToggler from "./PasswordVisibilityToggler.js";
import ProblemSuccessDisplayManager from "./ProblemSuccessDisplayManager.js";

jQuery(function () {
    const problemSuccessDisplayManager = new ProblemSuccessDisplayManager(
        ".problem__description",
        ".create-account__problem",
        ".success__description",
        ".create-account__success"
    );

    const properFocusinFocusoutBehaviour = new ProperFocusinFocusoutBehaviour(
        ".input-form__password-input",
        "input-form__password-input_focused"
    );

    const passwordVisibilityToggler = new PasswordVisibilityToggler(
        ".input-form__password-input input",
        ".input-form__password-input img"
    );
});
