<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/AuthorProfileView/AuthorProfileViewDatabaseHandler.php";
$id = isCookiesThere();
if($id){
    deleteCookiesThere();
    echo queryData("DELETE FROM Author WHERE ID = $id");
    echo "hello world";
    removeUser($id);
    session_name("Check_sing_in");
    session_start();
    header(("Location: /pages/Login/index.php")); // TODO : change to redirect to the author profile view.
    session_write_close();
}
?>
