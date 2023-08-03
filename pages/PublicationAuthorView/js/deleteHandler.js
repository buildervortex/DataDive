function handlePublicationDelete(button){
    button = document.querySelector(button);
    button.addEventListener("click",()=>{
        let publicationId = button.getAttribute("publicationId");
        if(window.prompt("Are You Sure to Delete. Enter \"Yes\" ")==="Yes"){
            window.location.href = "/pages/PublicationDelete/index.php?prate="+publicationId;
        }
    });
}

handlePublicationDelete("#PublicationDeleteButton");