<?php
include_once __DIR__."/../../../php/lib/db/pages/AuthorProfileView/AuthorProfileViewDatabaseHandler.php";


function subcategory($mainCategory){
    return json_encode(getSubCategory(1,$mainCategory),JSON_FORCE_OBJECT); // TODO: GET THE USER ID FROM THE COOKIES
}

$decodeJsonData;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    $jsonData = file_get_contents('php://input');
    $decodeJsonData = json_decode($jsonData);
}

$subCategoryJson = subcategory($decodeJsonData->category,$Category);
echo $subCategoryJson;