import {toggleHamburgerMenue} from "./HamburgerMenue/hamburgerMenue.js";

function asideBarToggleOnClick(asideBarElement,asideBarActivatorElement){
    asideBarElement.classList.toggle("asideBarToggler");
    toggleHamburgerMenue(asideBarActivatorElement);
}

function navBarBackgroundToggleOnScroll(navBarElement){
    window.addEventListener("scroll",()=>{
        if(window.scrollY > 20){
            navBarElement.classList.add("onScrollNavBarBackgroundColorToggler");
        }
        else{
            navBarElement.classList.remove("onScrollNavBarBackgroundColorToggler");
        }
    });
}

export function navBarInit(navBarElement=document.querySelector(".navBar"),asideBarElement=document.querySelector(".navBar .links-container"),asideBarActivatorElement=document.querySelector(".navBar .hamburgerMenu #asideBarActivator")){
    navBarBackgroundToggleOnScroll(navBarElement);

    asideBarActivatorElement.addEventListener("click",()=>{
        asideBarToggleOnClick(asideBarElement,asideBarActivatorElement);
    });

}