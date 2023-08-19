import { showErrorMessage } from "/shared/js/utils/validation.js";
import {removeButtonsDefaultBehavior} from "/shared/js/utils/lang.js";


export function pdfFileNameValidator(fileName){
    if(fileName.split(".").pop().toLowerCase() === "pdf")return true;
    return false;
}

function validateTextInputs(){
    let titleElement = document.querySelector("main header.About input");
    if(titleElement.value.length<2){
        showErrorMessage("Enter Title",titleElement);
        return false;
    }
    return true;
}
function validateCategorySelect(){
    let selectElements = document.querySelectorAll(".categorySelectionContainer select");
    let selected= true;
    selectElements.forEach(element=>{
        if(element.selectedIndex==0){
            showErrorMessage("Select a Category",element);
            selected = false;
        }
    });
    return selected;
}
function pdfFileValidator(){
    const pdfInputElement = document.querySelector("main .PdfThumbnail #PdfUploadInput");
    if(pdfInputElement.value == ""){
        showErrorMessage("Select a pdf",pdfInputElement);
        return false;
    }
    if(!pdfFileNameValidator(pdfInputElement.files[0].name)){
        showErrorMessage("Select a valid pdf",pdfInputElement);
        return false;
    }
    return true;
}
export function initPageValidation(){
    removeButtonsDefaultBehavior(...document.querySelectorAll("button"));
    document.querySelector("main header.PdfThumbnail button").addEventListener("click",()=>{
        if(pdfFileValidator() && validateTextInputs() && validateCategorySelect() ){
            document.querySelector("body form").submit();
        }
    });
}
