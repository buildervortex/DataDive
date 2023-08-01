<?php
require_once __DIR__."/../../databaseConnector.php";


function getAllPublications($post){
    $FILTERSC1 = ["mainCategorySelector","subCategorySelector","FBS"];
    $FILTERSC2 = ["FBL","FBC","FBD","FBR"];
    $SQLQuery = "SELECT M.Name AS MainCategory,A.ID AS AuthorId,P.ID AS PublicationId,S.Name AS SubCategory,P.PublishedDate,P.Title,PD.LikeCount,PD.CommentCount,PD.Ratings,A.FullName,P.Description FROM Publication AS P LEFT JOIN SubCategory AS S ON S.ID = P.SubCategoryId LEFT JOIN MainCategory AS M ON M.ID = S.MainCategoryId LEFT JOIN PublicationsDetails AS PD ON PD.PublicationId = P.ID LEFT JOIN Author AS A ON A.ID = P.AuthorId ";

    $temp = true;
    $addWhere = true;
    foreach ($post as $key => $value){
        if(in_array($key,$FILTERSC1)){
            if($addWhere){
                $SQLQuery.=" WHERE ";
                $addWhere=false;
            }
            if($temp){
                $SQLQuery.=AddFilter($key,$value,"no");
                $temp = false; 
            }
            else{
                $SQLQuery.=AddFilter($key,$value);
            }
        }
    }
    
    $temp = true;
    foreach ($post as $key => $value){
        if(in_array($key,$FILTERSC2)){
            if($addWhere){
                $SQLQuery.=" WHERE ";
                $addWhere=false;
            }
            if($temp){
                $SQLQuery.=" ORDER BY ";
                $SQLQuery.=AddFilter($key,$value);
            }
            else{
                $SQLQuery.=AddFilter($key,$value,",");
            }
            $temp=false;
            if($temp <2 && $temp > 0 ){
                $SQLQuery.=",";
            }
        }
    }
    $temp = [];
    $query = queryData($SQLQuery);
    for($i = 0; $i < $query->num_rows;$i++){
        $temp[] = $query->fetch_assoc();
    }
    return $temp;

}

function AddFilter($filter,$value,$with=""){
    switch($filter){
        case "mainCategorySelector":
            if($value == 0)return;
            if($with=="no")return " M.ID = $value ";
            return "AND M.ID = $value ";
        case "subCategorySelector":
            if($value == 0)return;
            if($with=="no")return " S.ID = $value ";
            return "AND S.ID = $value ";
        case "FBS":
            if($with=="no")return " P.Title LIKE \"%$value%\" ";
            if($value!=null)return "AND P.Title LIKE \"%$value%\" ";
            break;
        case "FBL":
            return $with." PD.LikeCount ";
        case "FBC":
            return $with." PD.CommentCount ";
        case "FBD":
            return $with." P.PublishedDate ";
        case "FBR":
            return $with." PD.Ratings ";
    }
}


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

function RatingStar($rating){
    $output="";
    $rating = round($rating);
    $maxRating = 5;
    $output.=str_repeat("⭐",$rating);
    $output.=str_repeat("☆",$maxRating-$rating);
    return $output;

}

// $array = [
    // "mainCategorySelector"=>1,
    // "subCategorySelector"=>1,
    // "FBS"=>"",
    // "FBL"=>"on",
    // "FBC"=>"on",
    // "FBD"=>"on",
    // "FBR"=>"on"

// ];
// var_dump(getPublications($array));
// var_dump(getPublications(1,$array));
