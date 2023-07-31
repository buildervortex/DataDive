<?php
$root = __DIR__."/db/databaseConnector.php";
require_once $root;

$connection = createConnection();


$array = [
    "a"=>1,
    "b"=>2
];

foreach($array as $key=>$value){
    echo $key." ".$value."\n";
}

$array["8"]=10;

foreach($array as $key=>$value){
    echo $key." ".$value."\n";
}