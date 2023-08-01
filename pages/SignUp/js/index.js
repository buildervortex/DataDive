import { setDescriptionTextArea } from "../../../../js/other/limitedDescription/index.js";

import { InitializeTheSocialMediaLinkAdder } from "../../../../js/other/socialMediaLinkList/index.js";

// add the character limit default is 500
setDescriptionTextArea(500);


InitializeTheSocialMediaLinkAdder();


function matchPassword() {
    var pw1 = document.getElementById("pw");
    var pw2 = document.getElementById("rpw");
    if (pw1 != pw2) {
        alert("Passwords did not match");
    } else {
        alert("Password created successfully");
    }
}