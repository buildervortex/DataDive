<?php

function setCookies_($Id,$timeOutSeconds=3600){ // TODO: Change the cookies timeout
    setcookie("UserId",$Id."",time()+$timeOutSeconds,"/");
}

function isCookiesThere(){
    $value = $_COOKIE["UserId"];
    if(isset($value)){
        return $value;
    }
    return null;
}

function deleteCookiesThere(){
    setcookie("UserId","",time()-3600,"/");
}