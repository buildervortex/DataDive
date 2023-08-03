<?php

require_once __DIR__."/../../databaseConnector.php";

function getUserData($ID){
    echo "$ID";
    // SELECT A.UserName,A.FullName,A.Dob,A.Email,A.PhoneNumber,A.Bio,C.Name AS Country , R.Ratings , COUNT(P.ID) AS PublicationCount FROM Author AS A INNER JOIN Country AS C ON A.CountryId = C.ID LEFT JOIN Ratings AS R ON A.ID = R.AuthorId LEFT JOIN Publication AS P ON A.ID = P.AuthorId WHERE A.ID = 1 GROUP BY A.ID;
    $result = queryData("SELECT A.UserName,A.Password,A.FullName,A.FirstName,A.MiddleName,A.LastName,A.Dob,A.Email,A.PhoneNumber,A.Bio,C.Name AS Country,C.ID AS CountryId , R.Ratings , COUNT(P.ID) AS PublicationCount FROM Author AS A INNER JOIN Country AS C ON A.CountryId = C.ID LEFT JOIN Ratings AS R ON A.ID = R.AuthorId LEFT JOIN Publication AS P ON A.ID = P.AuthorId WHERE A.ID = ".$ID." GROUP BY A.ID");
    return $result->fetch_assoc();
}

function getUserSkills($ID){
    $skills = [];
    $result = queryData("SELECT Skills FROM Skills WHERE AuthorId = ".$ID);
    for($i = 0 ; $i<$result->num_rows;$i++){
        $skills[$i] = $result->fetch_assoc()["Skills"];
    }
    return $skills;
}

function getUserInterests($ID){
    $interests = [];
    $result = queryData("SELECT Interest FROM Interests WHERE AuthorId = ".$ID);
    for($i = 0 ; $i<$result->num_rows;$i++){
        $interests[$i] = $result->fetch_assoc()["Interest"];
    }
    return $interests;
}


function getUserSocialMediaLinks($ID){
    $SocialMedia = [];
    $result = queryData("SELECT Url,S.Name AS SocialMedia FROM Has AS H LEFT JOIN SocialMedia AS S ON S.ID = H.SocialMediaId WHERE AuthorId = ".$ID);
    for($i = 0 ; $i<$result->num_rows;$i++){
        $Row = $result->fetch_assoc();
        $SocialMedia[$Row["SocialMedia"]] = $Row["Url"];
    }
    return $SocialMedia;
}


function getMainCategory($ID){
    $MainCategory = [];
    $result = queryData("SELECT M.Name AS MainCategory,M.ID FROM Publication AS P LEFT JOIN SubCategory AS S ON S.ID = P.SubCategoryId LEFT JOIN MainCategory AS M ON M.ID = S.MainCategoryId LEFT JOIN PublicationsDetails AS PD ON PD.PublicationId = P.ID  WHERE AuthorId = ".$ID);
    for($i = 0 ; $i<$result->num_rows;$i++){
        $Row = $result->fetch_assoc();
        $MainCategory[$Row["ID"]] = $Row["MainCategory"];
    }
    return $MainCategory;
}

function getSubCategory($ID,$MID){
    $SubCategory = [];
    $result = queryData("SELECT S.Name AS SubCategory, S.ID AS SubCategoryId FROM Publication AS P LEFT JOIN SubCategory AS S ON S.ID = P.SubCategoryId LEFT JOIN MainCategory AS M ON M.ID = S.MainCategoryId LEFT JOIN PublicationsDetails AS PD ON PD.PublicationId = P.ID  WHERE AuthorId = $ID AND M.ID = $MID");
    for($i = 0 ; $i<$result->num_rows;$i++){
        $Row = $result->fetch_assoc();
        $SubCategory[$Row["SubCategoryId"]] = $Row["SubCategory"];
    }
    return $SubCategory;
}

function getPublications($ID,$post){
    $FILTERSC1 = ["mainCategorySelector","subCategorySelector","FBS"]; // TODO HAVE TO CHANGE THIS IF CHANGING THE NAMES OF HTML ELEMENTS
    $FILTERSC2 = ["FBL","FBC","FBD"];
    $SQLQuery = "SELECT P.ID as PublicationId , M.Name AS MainCategory,S.Name AS SubCategory,P.PublishedDate,P.Title,PD.LikeCount,PD.CommentCount FROM Publication AS P LEFT JOIN SubCategory AS S ON S.ID = P.SubCategoryId LEFT JOIN MainCategory AS M ON M.ID = S.MainCategoryId LEFT JOIN PublicationsDetails AS PD ON PD.PublicationId = P.ID  WHERE AuthorId = $ID ";

    foreach ($post as $key => $value){
        if(in_array($key,$FILTERSC1)){
            $SQLQuery.=AddFilter($key,$value);
        }
    }
    
    $temp = true;
    foreach ($post as $key => $value){
        if(in_array($key,$FILTERSC2)){
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
            return "AND M.ID = $value ";
        case "subCategorySelector":
            if($value == 0)return;
            return "AND S.ID = $value ";
        case "FBS":
            if($value!=null)return "AND P.Title LIKE \"%$value%\" ";
            break;
        case "FBL":
            return $with." PD.LikeCount ";
        case "FBC":
            return $with." PD.CommentCount ";
        case "FBD":
            return $with." P.PublishedDate ";
    }
}

$array = [
    // "mainCategorySelector"=>1,
    // "subCategorySelector"=>1,
    // "FBS"=>"",
    // "FBL"=>"on",
    // "FBC"=>"on",
    // "FBD"=>"on",

];
// var_dump(getPublications(1,$array)[0]["LikeCount"]);
// var_dump(getPublications(1,$array));
