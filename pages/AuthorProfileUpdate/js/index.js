import {navBarInit} from "/shared/js/navBar/navBar.js";
import {setDescriptionTextArea} from "/shared/js/limitedDescription/index.js";
import {initDropDown,InitializeTheSocialMediaLinkAdder,setTheProfile} from "/pages/AuthorProfileUpdate/js/utils/inputHandler.js"
import {validationInit} from "/pages/AuthorProfileUpdate/js/utils/validation.js"

navBarInit();
setDescriptionTextArea(500);
initDropDown();
setTheProfile();
InitializeTheSocialMediaLinkAdder();
validationInit();