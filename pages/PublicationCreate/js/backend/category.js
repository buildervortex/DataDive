import {clearSelectElement,addOptionsToSelect} from "/shared/js/utils/lang.js";

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
            addOptionsToSelect(SubCategoryElement,value,jsonData[value])
        }
    });
}

export function setUpTheCategorySelection(SubCategoryPhpFileLocation = "/pages/PublicationCreate/php/PublicationCreateViewSubCategory.php", mainCategorySelector = ".categorySelectionContainer .mainCategorySelector", subCategorySelector = ".categorySelectionContainer .subCategorySelector") {
    let MainCategoryElement = document.querySelector(mainCategorySelector);
    let SubCategoryElement = document.querySelector(subCategorySelector);

    MainCategoryElement.addEventListener("click", (event) => {

        let MainCategorySelectedIndex = MainCategoryElement.selectedIndex;

        if(MainCategorySelectedIndex ==0 && event.target.tagName == "OPTION"){
            clearSelectElement(SubCategoryElement);
        }

        
        if(event.target.tagName == "OPTION"){
            clearSelectElement(SubCategoryElement);
            setSubCategory((MainCategoryElement.options[MainCategorySelectedIndex]).value, SubCategoryElement, SubCategoryPhpFileLocation);
        }
    });
}