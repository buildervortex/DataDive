<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/PublicationUserViewHandler/publicationUserViewHandler.php";



if($_SERVER["REQUEST_METHOD"]=="POST"){
    $jsonData = file_get_contents('php://input');
    $decodeJsonData = json_decode($jsonData);

    $comment = $decodeJsonData->comment;
    $userId = $decodeJsonData->userId;
    $publicationId = $decodeJsonData->publicationId;

    if(strlen($comment)<5)return;
    $result = comment($userId,$publicationId,$comment);

    echo json_encode([
        "Result"=>$result,
    ]);
}
