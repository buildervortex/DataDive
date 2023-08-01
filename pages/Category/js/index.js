import {navBarInit} from "../../../../js/other/navBar/navBar.js";
import {setUpTheCategorySelection} from "../../../../js/other/categorySelect/index.js";

setUpTheCategorySelection();
navBarInit();

let AuthorProfileViewCards = document.querySelectorAll(".cardContainer .card");
AuthorProfileViewCards.forEach(e=>{
    e.addEventListener("click",()=>{
        let publicationId = parseInt(e.querySelector("#ThePublicationIdForRedirection").getAttribute("name"));
        console.log(publicationId);
        window.location.href="./PublicationAuthorView.php?prate="+publicationId;
        
    });
});