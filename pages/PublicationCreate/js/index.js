import {navBarInit} from "/shared/js/navBar/navBar.js";
import {setDescriptionTextArea} from "/shared/js/limitedDescription/index.js";
import { setUpTheCategorySelection } from "./backend/category.js"
import {pdfFileUploadHandler,setTheThumbnail} from "./utils/fileinputs.js";
import {initPageValidation} from "./utils/validation.js";

setDescriptionTextArea(500);
navBarInit();
setUpTheCategorySelection();
initPageValidation();
pdfFileUploadHandler();
setTheThumbnail();