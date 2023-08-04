<?php

require_once __DIR__."/../../databaseConnector.php";


function RateTheAuthor($AuthorId,$UserId,$Rating){
    if(!queryData("INSERT INTO Rate(Value,Ratee,Rater) VALUES($Rating,$AuthorId,$UserId)")){
        queryData("UPDATE Rate SET Value = $Rating WHERE Ratee = $AuthorId AND Rater = $UserId");
    }
}

function getRate($AuthorId,$UserId){
    $result = queryData("SELECT Value FROM Rate WHERE Ratee = $AuthorId AND Rater = $UserId")->fetch_assoc()["Value"];
    if($result){
        return (int)$result;
    }
    else{
        return 0;
    }
}
