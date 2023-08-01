<?php

include_once __DIR__."/../../php/lib/db/pages/AuthorProfileView/AuthorProfileViewDatabaseHandler.php";
$id = isCookiesThere();
if($id){
    deleteCookiesThere();
    session_name("Check_sing_in");
    session_start();
    header(("Location: ./SingIn.php")); // TODO : change to redirect to the author profile view.
    session_write_close();
}