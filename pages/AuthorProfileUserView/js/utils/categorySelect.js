import {clearSelectElement} from "/shared/js/utils/lang.js"
function setSubCategory(MainCategoryValue, SubCategoryElement, phpFileName , AuthorId) {

    let jsonObject = {
        "category": MainCategoryValue,
        "AuthorId":AuthorId,
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

export function setUpTheCategorySelection(SubCategoryPhpFileLocation = "./php/AuthorProfileViewSubCategory.php", mainCategorySelector = ".categorySelectionContainer .mainCategorySelector", subCategorySelector = ".categorySelectionContainer .subCategorySelector") {
    let MainCategoryElement = document.querySelector(mainCategorySelector);
    let SubCategoryElement = document.querySelector(subCategorySelector);

    MainCategoryElement.addEventListener("click", (event) => {

        let MainCategorySelectedIndex = MainCategoryElement.selectedIndex;
        let AuthorId = MainCategoryElement.getAttribute("AuthorId");

        if(MainCategorySelectedIndex ==0 && event.target.tagName == "OPTION"){
            clearSelectElement(SubCategoryElement);
        }

        
        if(event.target.tagName == "OPTION"){
            clearSelectElement(SubCategoryElement);
            setSubCategory((MainCategoryElement.options[MainCategorySelectedIndex]).value, SubCategoryElement, SubCategoryPhpFileLocation,AuthorId);
        }
    });
}
