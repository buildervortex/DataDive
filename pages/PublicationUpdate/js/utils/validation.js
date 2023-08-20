import { showErrorMessage } from "/shared/js/utils/validation.js";
import { removeButtonsDefaultBehavior } from "/shared/js/utils/lang.js";

function isCategoryValid(categoryElement) {
    if (categoryElement.selectedIndex == 0) return false;
    return true;
}
function isInputsAreValid(titleElementSelector=".About input[name='Title']", MainCategorySelector=".About select[name='mainCategorySelector']", SubCategorySelectors=".About select[name='subCategorySelector']") {
    let titleElement = document.querySelector(titleElementSelector);
    let mainCategoryElement = document.querySelector(MainCategorySelector);
    let subCategoryElement = document.querySelector(SubCategorySelectors);

    if (titleElement.value.length == 0) {
        showErrorMessage("Add a title", titleElement);
        return false;
    }
    else if (!isCategoryValid(mainCategoryElement)) {
        showErrorMessage("Select a main category", mainCategoryElement);
        return false;
    }
    else if (!isCategoryValid(subCategoryElement)) {
        showErrorMessage("Select a sub category", subCategoryElement);
        return false;
    }
    return true;

}

export function validationInit() {
    let buttonElement = document.querySelector(".PdfThumbnail button");
    let formElement = document.querySelector("body form");
    removeButtonsDefaultBehavior(buttonElement);

    buttonElement.addEventListener("click",()=>{
        if(isInputsAreValid()){
            formElement.submit();
        }
    });
}