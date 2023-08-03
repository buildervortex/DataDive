<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/PublicationUserViewHandler/publicationUserViewHandler.php";



if($_SERVER["REQUEST_METHOD"]=="POST"){
    $jsonData = file_get_contents('php://input');
    $decodeJsonData = json_decode($jsonData);

    $UserId = $decodeJsonData->UserId;
    $PublicationId = $decodeJsonData->PublicationId;

    $result = like($UserId,$PublicationId);

    echo json_encode([
        "Result"=>$result,
    ]);
}
