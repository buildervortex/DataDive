export const emailRegex = /\w*@(\w+.)+\.\w+/;

export function showErrorMessage(message, adjacentElement,timeout=1000) {
    let errorMessage = document.createElement("h4");
    errorMessage.style = "background-color:red;padding: 1cqb 2.9cqb;border-radius:20px;white-space:nowrap;font-weight:100;text-align:center;transition: all 200ms ease-out;";
    errorMessage.innerText = message;
    adjacentElement.insertAdjacentElement("afterend", errorMessage);

    setTimeout(() => {
        adjacentElement.parentElement.removeChild(errorMessage);
    }, timeout);
}

export function passwordValidator(passwordElement,passwordRetypeElement){
    if(passwordElement.value === passwordRetypeElement.value)return true;
    return false;
}