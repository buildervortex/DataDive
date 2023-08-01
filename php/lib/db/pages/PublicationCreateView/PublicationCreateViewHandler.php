<?php

require_once __DIR__."/../../databaseConnector.php";

function getAllMainCategory(){
    $MainCategory = [];
    $result = queryData("SELECT * FROM MainCategory");
    for($i = 0 ; $i<$result->num_rows;$i++){
        $Row = $result->fetch_assoc();
        $MainCategory[$Row["ID"]] = $Row["Name"];
    }
    return $MainCategory;
}

function getAllSubCategory($MID){
    $SubCategory = [];
    $result = queryData("SELECT ID,Name FROM SubCategory WHERE MainCategoryId = $MID");
    for($i = 0 ; $i<$result->num_rows;$i++){
        $Row = $result->fetch_assoc();
        $SubCategory[$Row["ID"]] = $Row["Name"];
    }
    return $SubCategory;
}

function getAllLanguages(){
    $Language = [];
    $result = queryData("SELECT * FROM Language");
    for($i = 0 ; $i<$result->num_rows;$i++){
        $Row = $result->fetch_assoc();
        $Language[$Row["ID"]] = $Row["Name"];
    }
    return $Language;
}

function createPublication($ID,$Title="",$Description="",$Size,$LanguageID,$SubCategoryId){
    return queryData("INSERT INTO Publication(Title,Description,AuthorId,Size,LanguageId,SubCategoryId) VALUES(\"$Title\",\"$Description\",$ID,$Size,$LanguageID,$SubCategoryId)");
}

function getPublicationId($ID,$Title=""){
    return (int) queryData("SELECT ID FROM Publication WHERE AuthorId=$ID AND Title = \"$Title\"")->fetch_assoc()["ID"];
}