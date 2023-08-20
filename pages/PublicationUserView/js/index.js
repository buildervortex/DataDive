import { navBarInit } from "/shared/js/navBar/navBar.js";
import { setDescriptionTextArea } from "/shared/js/limitedDescription/index.js";
import { setupHandlers } from "/pages/PublicationUserView/js/backend/likeComment.js";
import {pdfInit} from "/pages/PublicationUserView/js/utils/pdfconfig.js";

// add the character limit default is 500
setDescriptionTextArea(500);
navBarInit();
setupHandlers();
pdfInit();
