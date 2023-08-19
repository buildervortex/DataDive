export function LinkElements(Element1,Element2){
    Element1.addEventListener("click",()=>{
        Element2.click();
    });
}

export function setImgFormInput(imgElement,inputElement){
    const selectedFile = inputElement.files[0];
    const reader = new FileReader();

    reader.onload = ()=>{
        imgElement.src = reader.result;
    }

    if(selectedFile){
        reader.readAsDataURL(selectedFile);
    }
}