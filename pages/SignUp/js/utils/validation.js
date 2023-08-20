import { showErrorMessage,emailRegex } from "/shared/js/utils/validation.js";
function areInputsValid(firstNameElementSelector="input[name='FirstName']",lastNameElementSelector="input[name='LastName']",userNameSelector="input[name='UserName']",emailElementSelector="input[name='Email']",passwordElementSelector="input[name='Password']",dobElementSelector="input[name='Dob']"){
    let firstNameElement = document.querySelector(firstNameElementSelector);
    let lastNameElement = document.querySelector(lastNameElementSelector);
    let userNameElement = document.querySelector(userNameSelector);
    let emailElement = document.querySelector(emailElementSelector);
    let passwordElement  = document.querySelector(passwordElementSelector);
    let dobElement = document.querySelector(dobElementSelector);

    if(firstNameElement.value.length<1){
        showErrorMessage("Enter first Name",firstNameElement);
        return false;
    }
    else if(lastNameElement.value.length<1){
        showErrorMessage("Enter last Name",lastNameElement);
        return false;
    }
    else if(userNameElement.value.length<1){
        showErrorMessage("Enter user Name",userNameElement);
        return false;
    }
    else if(emailElement.value.length<1){
        showErrorMessage("Enter email",emailElement);
        return false;
    }
    else if(!emailRegex.test(emailElement.value)){
        showErrorMessage("Enter valid email",emailElement);
        return false;
    }
    else if(passwordElement.value.length <1){
        showErrorMessage("Enter password",passwordElement);
        return false;
    }
    else if(dobElement.value.length<1){
        showErrorMessage("Enter dob",dobElement);
        return false;
    }
    return true;
}

export function validationInit(){
    let buttonElement = document.querySelector("button.btn");
    let formElement = document.querySelector("form");

    buttonElement.addEventListener("click",()=>{
        if(areInputsValid()){
            formElement.submit();
        }
    });
}