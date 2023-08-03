<?php

require_once __DIR__."/../../databaseConnector.php";

function like($userId,$publicationId){
    $liked = true;
    if(!queryData("INSERT INTO Likes(AuthorId,PublicationId) VALUES($userId,$publicationId)")){
        queryData("DELETE FROM Likes WHERE AuthorId = $userId AND PublicationId=$publicationId");
        $liked = false;
    }
    return $liked;
}


function comment($userId,$publicationId,$comment){
    return queryData("INSERT INTO Comments(UserId,PublicationId,Comment) VALUES($userId,$publicationId,\"$comment\")");
}

function getLike($userId,$publicationId){
    $result = queryData("SELECT * FROM Likes WHERE AuthorId = $userId AND PublicationId = $publicationId");
    if($result->num_rows == 0){
        return false;
    }
    return true;
}