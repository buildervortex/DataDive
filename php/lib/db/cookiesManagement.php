<?php

function setCookies_($Id,$timeOutSeconds=60){ // TODO: Change the cookies timeout
    setcookie("UserId",$Id."",time()+$timeOutSeconds,"/");
}

function isCookiesThere(){
    return isset($_COOKIE["UserId"]);
}