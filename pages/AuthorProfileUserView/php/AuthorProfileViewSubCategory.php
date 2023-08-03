<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/AuthorProfileView/AuthorProfileViewDatabaseHandler.php";


function subcategory($mainCategory,$authorId){
    // ! this iscokies there is the problem
    return json_encode(getSubCategory($authorId,$mainCategory),JSON_FORCE_OBJECT);
}

$decodeJsonData;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    $jsonData = file_get_contents('php://input');
    $decodeJsonData = json_decode($jsonData);
}

$subCategoryJson = subcategory($decodeJsonData->category,$decodeJsonData->AuthorId);
echo $subCategoryJson;