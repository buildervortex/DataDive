import { LinkElements, setImgFormInput } from "/shared/js/utils/thumbnailHandler.js";
import { clearSelectElement } from "/shared/js/utils/lang.js";

export function setTheThumbnail(thumbnailSelector = "main .PdfThumbnail img", thumbnailInputElementSelector = "main .PdfThumbnail input") {

    const thumbnailElement = document.querySelector(thumbnailSelector);
    const thumbnailInputElement = document.querySelector(thumbnailInputElementSelector);

    LinkElements(thumbnailElement, thumbnailInputElement);

    thumbnailInputElement.addEventListener('change', function (event) {
        setImgFormInput(thumbnailElement, event.target);
    });

}

function setSubCategory(MainCategoryValue, SubCategoryElement, phpFileName) {

    let jsonObject = {
        "category": MainCategoryValue,
    };

    fetch(phpFileName, {
        method: 'POST',
        headers: {
            'Content-Type': "application/json",
        },
        body: JSON.stringify(jsonObject)

    }).then(response => response.json()).then(jsonData => {
        for (let value in jsonData) {
            let optionElement = document.createElement("option");
            optionElement.value = value;
            optionElement.textContent = jsonData[value];
            SubCategoryElement.appendChild(optionElement);
        }
    });
}

export function setUpTheCategorySelection(SubCategoryPhpFileLocation = "./php/PublicationCreateViewSubCategory.php", mainCategorySelector = ".categorySelectionContainer .mainCategorySelector", subCategorySelector = ".categorySelectionContainer .subCategorySelector") {
    let MainCategoryElement = document.querySelector(mainCategorySelector);
    let SubCategoryElement = document.querySelector(subCategorySelector);

    MainCategoryElement.addEventListener("click", (event) => {

        let MainCategorySelectedIndex = MainCategoryElement.selectedIndex;

        if (MainCategorySelectedIndex == 0 && event.target.tagName == "OPTION") {
            clearSelectElement(SubCategoryElement);
        }


        if (event.target.tagName == "OPTION") {
            clearSelectElement(SubCategoryElement);
            setSubCategory((MainCategoryElement.options[MainCategorySelectedIndex]).value, SubCategoryElement, SubCategoryPhpFileLocation);
        }
    });
}