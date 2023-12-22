class ProblemSuccessDisplayManager {
    constructor(
        problemDescriptionSelector,
        problemBlockSelector,
        successDescriptionSelector = "",
        successBlockSelector = ""
    ) {
        this.problemDescription = $(problemDescriptionSelector);
        this.problemBlock = $(problemBlockSelector);
        if (successDescriptionSelector) {
            this.flag = true;
            this.successDescription = $(successDescriptionSelector);
            this.successBlock = $(successBlockSelector);
        } else {
            this.flag = false;
        }
        this.displayElementsBasedOnContent();
    }

    displayIfContentExists(element, content) {
        if (content.text()) {
            element.css("display", "block");
        }
    }

    displayElementsBasedOnContent() {
        this.displayIfContentExists(this.problemBlock, this.problemDescription);
        if (this.flag) {
            this.displayIfContentExists(
                this.successBlock,
                this.successDescription
            );
        }
    }
}

export default ProblemSuccessDisplayManager;
