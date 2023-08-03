import {navBarInit} from "/shared/js/navBar/navBar.js";
import {setUpTheCategorySelection} from "/shared/js/categorySelect/index.js";

setUpTheCategorySelection();
navBarInit();

let AuthorProfileViewCards = document.querySelectorAll(".cardContainer .card");
AuthorProfileViewCards.forEach(e=>{
    e.addEventListener("click",()=>{
        let AuthorId = e.getAttribute("name");
        let publicationId = parseInt(e.querySelector("h1").getAttribute("name"));
        window.location.href="/pages/PublicationUserView/index.php?AID="+AuthorId+"&PID="+publicationId;
    });
});