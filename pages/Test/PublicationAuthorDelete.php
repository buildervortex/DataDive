<?php

include_once __DIR__."/../../php/lib/db/pages/PublicationAuthorView/PublicationAuthorViewHandler.php";
include_once __DIR__."/../../php/lib/db/pages/PublicationAuthorUpdateViewHandler/PublicationAuthorUpdateViewHandler.php";
include_once __DIR__."/../../php/lib/db/pages/PublicationCreateView/PublicationCreateViewHandler.php";

$id = isCookiesThere();
if(!$id){
    session_name("Check_sing_in");
    session_start();
    header(("Location: ./SingIn.php"));
    session_write_close();
}

if($_SERVER["REQUEST_METHOD"]=="GET"){
    $pubid = (int)$_GET["prate"];
    queryData("DELETE FROM Publication WHERE ID = $pubid AND AuthorId = $id");
    removePublication($id,$pubid);
    session_name("deleted_publication");
    session_start();
    header(("Location: ./AuthorProfileView.php"));
    session_write_close();
}

?>
