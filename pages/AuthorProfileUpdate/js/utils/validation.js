import {passwordValidator,showErrorMessage,emailRegex} from "/shared/js/utils/validation.js";
import {removeButtonsDefaultBehavior} from "/shared/js/utils/lang.js";

function isPasswordValid(passwordInputSelector=".Password input[name='Password']",retypePasswordInputSelector=".Password #retypePassword"){
    let passwordElement = document.querySelector(passwordInputSelector);
    let retypePasswordElement = document.querySelector(retypePasswordInputSelector);
    if(!passwordValidator(passwordElement,retypePasswordElement)){
        showErrorMessage("passwords are not equal",retypePasswordElement);
        return false;
    }
    return true;
}

function isInputFieldsValid(userNameInputSelector=".Rating input[name='UserName']",firstNameInputSelector=".Rating input[name='FirstName']",lasNameInputSelector=".Rating input[name='LastName']",emailInputSelector=".About input[name='Email']",numberInputSelector=".About input[name='PhoneNumber']"){
    let userNameElement = document.querySelector(userNameInputSelector);
    let firstNameElement = document.querySelector(firstNameInputSelector);
    let lastNameElement = document.querySelector(lasNameInputSelector);
    let emailElement = document.querySelector(emailInputSelector);
    let numberElement = document.querySelector(numberInputSelector);

    if(userNameElement.value == ""){
        showErrorMessage("add user name",userNameElement);
        return false;
    }
    else if(firstNameElement.value == ""){
        showErrorMessage("add first name",userNameElement);
        return false;
    }
    else if(lastNameElement.value == ""){
        showErrorMessage("add last name",userNameElement);
        return false;
    }
    else if(!emailRegex.test(emailElement.value)){
        showErrorMessage("add valid email",emailElement);
        return false;
    }
    else if(numberElement.value.length !=0){
        if(isNaN(numberElement.value) && numberElement.value.length != 10){
            showErrorMessage("add valid number",numberElement);
            return false;
        }
    }
    return true;
}

export function validationInit(){
    let submitButton = document.querySelector(".profilePicture input[type='submit']");
    let formElement = document.querySelector("main form");
    removeButtonsDefaultBehavior(submitButton);
    submitButton.addEventListener("click",()=>{
        if(isPasswordValid() && isInputFieldsValid()){
            formElement.submit();
        }
    });
}