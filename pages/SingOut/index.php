<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/AuthorProfileView/AuthorProfileViewDatabaseHandler.php";
$id = isCookiesThere();
if($id){
    deleteCookiesThere();
    session_name("Check_sing_in");
    session_start();
    header(("Location: /pages/Login/index.php"));
    session_write_close();
}
?>
