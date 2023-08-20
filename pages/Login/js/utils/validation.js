import { emailRegex, showErrorMessage } from "/shared/js/utils/validation.js"
import { removeButtonsDefaultBehavior } from "/shared/js/utils/lang.js"

function inputValidation(emailElementSelector = ".wrapper input[name='Email']", passwordElementSelector = ".wrapper input[name='Password']") {
    let emailElement = document.querySelector(emailElementSelector);
    let passwordElement = document.querySelector(passwordElementSelector);

    if (!emailRegex.test(emailElement.value)) {
        showErrorMessage("Enter Valid Email", emailElement);
        return false;
    }
    else if (passwordElement.value == "") {
        showErrorMessage("Enter Password", passwordElement);
        return false;
    }
    return true;
}

export function validationInit() {
    let buttonElement = document.querySelector(".wrapper button");
    let formElement = document.querySelector(".wrapper form");
    removeButtonsDefaultBehavior(buttonElement);

    buttonElement.addEventListener("click", () => {
        if (inputValidation()) {
            formElement.submit();
        }
    });
}