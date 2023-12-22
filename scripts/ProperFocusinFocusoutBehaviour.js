class ProperFocusinFocusoutBehaviour {
    constructor(inputSelector, inputSelectorModifier) {
        this.input = $(inputSelector);
        this.isMousedownOnParent = false;
        this.inputSelectorModifier = inputSelectorModifier;
        this.inputField = this.input.find("input");

        this.setupEventListeners();
    }

    setupEventListeners() {
        this.input.on("click", () => this.handleInputClick());
        this.inputField.on("focusout", () => this.handleInputFocusout());
        this.input.on("mousedown", () => this.handleInputMousedown());
    }

    handleInputClick() {
        this.input.addClass(this.inputSelectorModifier);
        this.inputField.focus();
    }

    handleInputFocusout() {
        if (!this.isMousedownOnParent) {
            this.input.removeClass(this.inputSelectorModifier);
        }
    }

    handleInputMousedown() {
        this.isMousedownOnParent = true;
        setTimeout(() => {
            this.isMousedownOnParent = false;
        });
    }
}

export default ProperFocusinFocusoutBehaviour;
