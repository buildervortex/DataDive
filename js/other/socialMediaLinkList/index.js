function deleteButtonHanlder(AccountElement,socialMediaAccountTypeSelectingElement){
    let AccountTypeText = AccountElement.querySelector("h4").innerText.toLowerCase();
    AccountElement.parentElement.removeChild(AccountElement);
    
    let optionElement = document.createElement("option");
    optionElement.value = AccountTypeText;
    optionElement.innerText = AccountTypeText;
    socialMediaAccountTypeSelectingElement.appendChild(optionElement);

}
function checkInputValidity(InputElement){
    if(!InputElement.checkValidity()){
        let DefaultColor = InputElement.style.color;
        InputElement.value = "Add Valid Url";
        InputElement.style.color = "red";
        InputElement.readOnly = true;
        setTimeout(()=>{
            InputElement.value="";
            InputElement.style.color = DefaultColor;
            InputElement.readOnly =false;
        },1000);
        return false;
    }
    return true;

}
function createAccountElement(Heading,linkAddress,accountTypeSelectingElement){
    let AccountContainerElement = document.createElement("div");
    AccountContainerElement.classList.add("account");

    let HeadingElement = document.createElement("h4");
    HeadingElement.innerText = Heading;

    let InputElement = document.createElement("input");
    InputElement.type = "url";
    InputElement.name = Heading;
    InputElement.readOnly=true;
    InputElement.value = linkAddress;

    let DeleteButtonElement = document.createElement("button");
    DeleteButtonElement.innerText = "Delete";
    DeleteButtonElement.addEventListener("click",()=>{
        deleteButtonHanlder(AccountContainerElement,accountTypeSelectingElement);
    });


    AccountContainerElement.appendChild(HeadingElement);
    AccountContainerElement.appendChild(InputElement);
    AccountContainerElement.appendChild(DeleteButtonElement);

    return AccountContainerElement;
    
}

function AddButtonHandler(socialMediaAccountAddedContainerElement,socialMediaAccountTypeSelectingElement,socialMediaAccountUrlElement){
    let selectElementSelectedIndex = socialMediaAccountTypeSelectingElement.selectedIndex;
    if(selectElementSelectedIndex == 0)return;
    if(!checkInputValidity(socialMediaAccountUrlElement))return;

    let AccountTypeText = (socialMediaAccountTypeSelectingElement.options[socialMediaAccountTypeSelectingElement.selectedIndex]).value;
    socialMediaAccountTypeSelectingElement.options.remove(selectElementSelectedIndex);
    socialMediaAccountTypeSelectingElement.selectedIndex=0;

    let UrlText = socialMediaAccountUrlElement.value;
    socialMediaAccountUrlElement.value="";

    socialMediaAccountAddedContainerElement.appendChild(createAccountElement(AccountTypeText,UrlText,socialMediaAccountTypeSelectingElement));

}

export function InitializeTheSocialMediaLinkAdder(socialMediaAccountTypeSelectingSelector=".socialMediaContainer .accountAddingContainer .socialMediaAccountType",socialMediaAccountAddedContainerSelector=".socialMediaContainer .addedAccountContainer",socialMediaAccountUrlSelector=".socialMediaContainer .accountAddingContainer input",socialMediaAccountAddButtonSeletor=".socialMediaContainer .accountAddingContainer button"){
   let addedAccountContainerElement = document.querySelector(socialMediaAccountAddedContainerSelector);
   let accountTypeSelectingElement = document.querySelector(socialMediaAccountTypeSelectingSelector);
   let socialMediaAccountUrlElement = document.querySelector(socialMediaAccountUrlSelector);
   let socialMediaAccountAddButtonElement = document.querySelector(socialMediaAccountAddButtonSeletor);

   socialMediaAccountAddButtonElement.addEventListener("click",()=>{
    AddButtonHandler(addedAccountContainerElement,accountTypeSelectingElement,socialMediaAccountUrlElement);
   });
}
