export function clearSelectElement(selectElement){
    while(selectElement.options.length > 1){
        selectElement.options.remove(1);
    }
}

export function addOptionsToSelect(selectElement,optionElementValue,optionElementText){
    let optionElement = document.createElement("option");
    optionElement.value = optionElementValue;
    optionElement.textContent = optionElementText;
    selectElement.appendChild(optionElement);
}
export function removeButtonsDefaultBehavior(...buttons){
    buttons.forEach((button)=>{
        button.addEventListener("click",(event)=>{
            event.preventDefault();
        });
    })
}