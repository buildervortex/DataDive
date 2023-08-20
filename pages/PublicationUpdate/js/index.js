import { navBarInit } from "/shared/js/navBar/navBar.js";
import { setDescriptionTextArea } from "/shared/js/limitedDescription/index.js";
import { setTheThumbnail, setUpTheCategorySelection } from "/pages/PublicationUpdate/js/utils/inputHandler.js";
import { validationInit } from "/pages/PublicationUpdate/js/utils/validation.js";

setDescriptionTextArea(500);
navBarInit();
setTheThumbnail();
setUpTheCategorySelection();
validationInit();