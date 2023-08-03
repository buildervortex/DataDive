<?php

require_once __DIR__."/../../databaseConnector.php";


function getPublication($PublicationId,$AuthorId){
    $Query = "SELECT Title,Size,PublishedDate,Description,M.Name AS MainCategory,M.ID AS MainCategoryId, S.ID AS SubCategoryId,S.Name AS SubCategory,L.Name AS Language,L.ID AS LanguageId,PD.CommentCount,PD.LikeCount FROM Publication AS P LEFT JOIN SubCategory AS S ON S.ID= P.SubCategoryId LEFT JOIN MainCategory AS M ON M.ID=S.MainCategoryId LEFT JOIN Language AS L ON L.ID = P.LanguageId LEFT JOIN PublicationsDetails AS PD ON PD.PublicationId = P.ID WHERE P.ID = $PublicationId AND P.AuthorId = $AuthorId";
    return queryData($Query)->fetch_assoc();
}

// var_dump(getPublication(1,1));

function getComments($PublicationId){
    $comments=[];
    $Query = "SELECT Comment FROM Comments WHERE PublicationId=$PublicationId";
    $CommentsList =  queryData($Query);
    for($i = 0 ; $i<$CommentsList->num_rows;$i++){
        $comments[]=$CommentsList->fetch_assoc()["Comment"];
    }
    return $comments;
}

// var_dump(getComments(1,1));