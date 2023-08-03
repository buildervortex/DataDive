<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/AuthorProfileUserViewHandler/AuthorProfileUserViewHandler.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $jsonData = file_get_contents('php://input');
    $decodeJsonData = json_decode($jsonData);

    $UserId = $decodeJsonData->UserId;
    $AutherId = $decodeJsonData->AutherId;
    $rateValue = $decodeJsonData->rate;

    RateTheAuthor($AutherId,$UserId,$rateValue);
}
