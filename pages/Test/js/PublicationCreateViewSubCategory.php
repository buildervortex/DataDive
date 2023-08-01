<?php
include_once __DIR__."/../../../php/lib/db/pages/PublicationCreateView/PublicationCreateViewHandler.php";


function subcategory($mainCategory){
    return json_encode(getAllSubCategory($mainCategory),JSON_FORCE_OBJECT);
}

$decodeJsonData;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    $jsonData = file_get_contents('php://input');
    $decodeJsonData = json_decode($jsonData);
}

$subCategoryJson = subcategory($decodeJsonData->category,$Category);
echo $subCategoryJson;