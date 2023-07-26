export function SetupFileUpload(ContainerElementSelector=".FileContainer .container",InputElementSelector=".FileContainer .container input"){
    const containerElement = document.querySelector(ContainerElementSelector);
    const inputElement = document.querySelector(InputElementSelector);

    containerElement.addEventListener("dragover",(element)=>{
        element.preventDefault();
    },false);
    
    containerElement.addEventListener("dragenter",(element)=>{
        containerElement.classList.add("activeDrag");
    })

    containerElement.addEventListener("dragleave",(element)=>{
        containerElement.classList.remove("activeDrag");
    })
    
    containerElement.addEventListener("drop",(element)=>{
        element.preventDefault();
        containerElement.classList.remove("activeDrag");
        inputElement.files = element.dataTransfer.files;
    });
}
