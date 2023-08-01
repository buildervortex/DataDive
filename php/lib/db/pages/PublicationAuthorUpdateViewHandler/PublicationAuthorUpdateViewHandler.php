<?php

require_once __DIR__."/../../databaseConnector.php";

function UpdateThePublication($ID,$PUBID,$Title,$Description,$SubCategory,$Language){
    $Query = "UPDATE Publication SET Title=\"$Title\", Description = \"$Description\", SubCategoryId = $SubCategory,LanguageId =$Language WHERE ID = $PUBID AND AuthorId = $ID";
}