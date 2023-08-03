export function setDescriptionTextArea(characterlimit=500,textAreaSelector=".textareaContainer .limitedtextarea",errorMessageSelector=".textareaContainer .errorMessage"){
    const textAreaElement = document.querySelector(textAreaSelector);
    const errorMessageElement = document.querySelector(errorMessageSelector);

    textAreaElement.addEventListener("keydown",(element)=>{
        let textAreaValue = textAreaElement.value;
        console.log(textAreaValue.length);
        if((textAreaValue.length >= characterlimit)){
            textAreaElement.value = textAreaValue.substr(0,characterlimit-1);
            errorMessageElement.style.display="block";
            setTimeout(()=>{
                errorMessageElement.style.display="none";
            },2000);
        }
    });
    textAreaElement.addEventListener("keyup",(element)=>{
        let textAreaValue = textAreaElement.value;
        if((textAreaValue.length >= characterlimit)){
            textAreaElement.value = textAreaValue.substr(0,characterlimit);
        }
    });
}