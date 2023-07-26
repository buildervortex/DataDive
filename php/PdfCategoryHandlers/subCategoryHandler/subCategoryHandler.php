<?php

$Category = array(
    0=>array("Programming","Web development","Networking","Data Science","Database","Data structures and algorithms"),
    1=>array("Astronomy","Biology","Psychology","Oceanagraphy"),
    2=>array("Statistics","Probability","Intergration","Defferentiation"),
    3=>array("Logo Design","Illustration","Animation","3D modling"),
    4=>array("Seo","Analytics","Mobile Marketing","Nueromarketing"),
    5=>array("Food","Fithness","Travel","Hobbies"),
    6=>array("Marketing","Advertiesing","Finance","Partnership"),
    7=>array("English","Lathin","Sinhala","Chinese"),
    8=>array("Painting","Sculpting","Photography","Architecture"),
    9=>array("Audio engineering","Mixing and mastering","Beat making","Vocal Training"),
);

function getSubCategory($mainCategory,$Category){
    return json_encode($Category[$mainCategory],JSON_FORCE_OBJECT);
}

$decodeJsonData;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    $jsonData = file_get_contents('php://input');
    $decodeJsonData = json_decode($jsonData);
}

$subCategoryJson = getSubCategory($decodeJsonData->category,$Category);
echo $subCategoryJson;