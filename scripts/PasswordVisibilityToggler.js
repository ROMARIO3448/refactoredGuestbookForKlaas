class PasswordVisibilityToggler {
    constructor(inputSelector, imgSelector) {
        this.input = $(inputSelector);
        this.img = $(imgSelector);

        this.setupEventListeners();
    }

    setupEventListeners() {
        this.img.on("click", () => this.togglePasswordVisibility());
    }

    togglePasswordVisibility() {
        const currentType = this.input.prop("type");
        const newType = currentType === "password" ? "text" : "password";

        this.input.prop("type", newType);
        this.img.attr(
            "src",
            `./assets/${newType === "password" ? "hide" : "show"}.png`
        );
    }
}

export default PasswordVisibilityToggler;
