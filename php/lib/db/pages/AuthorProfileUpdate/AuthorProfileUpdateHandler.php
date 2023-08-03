<?php

require_once __DIR__."/../../databaseConnector.php";

function CountryList(){
    $temp = [];
    $data = queryData("SELECT ID,Name FROM Country");
    for($i = 0 ; $i < $data->num_rows;$i++){
        $queried = $data->fetch_assoc();
        $temp[$queried["ID"]]=$queried["Name"];
    }
    return $temp;
}

function SocialMediaList(){
    $temp = [];
    $data = queryData("SELECT ID,Name FROM SocialMedia");
    for($i = 0 ; $i < $data->num_rows;$i++){
        $queried = $data->fetch_assoc();
        $temp[$queried["ID"]]=$queried["Name"];
    }
    return $temp;
}

function getUserSocialMediaLinksWithId($ID){
    $SocialMedia = [];
    $result = queryData("SELECT Url,S.Name,ID FROM Has AS H LEFT JOIN SocialMedia AS S ON S.ID = H.SocialMediaId WHERE AuthorId = ".$ID);
    for($i = 0 ; $i<$result->num_rows;$i++){
        $data = $result->fetch_assoc();
        $SocialMedia[$data["ID"]] = [$data["Name"],$data["Url"]];
    }
    return $SocialMedia;
}

function updateSkills($ID,$skills){
    queryData("DELETE FROM Skills WHERE AuthorId = $ID");
    foreach($skills as $skill){
        queryData(("INSERT INTO Skills(AuthorId,Skills) VALUES($ID,\"$skill\")"));
    }
}

function updateInterests($ID,$interests){
    queryData("DELETE FROM Interests WHERE AuthorId = $ID");
    foreach($interests as $interest){
        queryData(("INSERT INTO Interests(AuthorId,Interest) VALUES($ID,\"$interest\")"));
    }
}

function updateSoialMedia($ID,$SocialMediaList){
    queryData("DELETE FROM Has WHERE AuthorId = $ID");
    foreach($SocialMediaList as $socialMediaId=>$Url){
        queryData(("INSERT INTO Has(AuthorId,SocialMediaId,Url) VALUES($ID,$socialMediaId,\"$Url\")"));
    }
}

function updateUserDetails($ID,$FirstName,$MiddleName,$LastName,$UserName,$Email,$PhoneNumber,$Password,$Bio,$CountryIdNumber=1,$Interests,$Skills,$SocialMediaList){
    $Query = "UPDATE Author SET UserName=\"$UserName\" , FirstName=\"$FirstName\" , MiddleName = \"$MiddleName\" , LastName=\"$LastName\",PhoneNumber=\"$PhoneNumber\",Email=\"$Email\" , Bio = \"$Bio\" , CountryId =$CountryIdNumber , Password = \"$Password\" WHERE ID=$ID";
    queryData($Query);
    updateSkills($ID,$Skills);
    updateInterests($ID,$Interests);
    updateSoialMedia($ID,$SocialMediaList);
}