import {navBarInit} from "../../../../js/other/navBar/navBar.js";
import {setUpTheCategorySelection} from "../../../../js/other/categorySelect/index.js";

setUpTheCategorySelection();
navBarInit();

let AuthorProfileViewCards = document.querySelectorAll(".cardContainer .card");
AuthorProfileViewCards.forEach(e=>{
    e.addEventListener("click",()=>{
        let AuthorId = e.getAttribute("name");
        let publicationId = parseInt(e.querySelector("h1").getAttribute("name"));
        console.log(publicationId);
        console.log(AuthorId);
        // window.location.href="./PublicationAuthorView.php?prate="+publicationId;
        // TODO : HAVE TO INCLUDE THE PATH TO REDIRECT TO THE USER VIEW OF THE PDF.
        // TODO : BY COMPARING PDF AUTHOR ID WITH THE LOGGED USER ID CAN IDENTIFY THE USER VS AUTHOR
        
    });
});