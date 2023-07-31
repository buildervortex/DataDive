<?php

require_once __DIR__."/cookiesManagement.php";
require_once __DIR__."/../fileManagement.php";

$host = "localhost";
$userName = "lahiru";
$password = "Lahiru";
$dbname = "projectTest";

function createConnection(){
    global $host,$userName,$password,$dbname;
    $Connection = new mysqli($host,$userName,$password,$dbname);
    
    if($Connection ->connect_error){
        die("Connection failed".$Connection->connect_error);
    }
    return $Connection;
}

function queryData($Query){
    $Connection = createConnection();
    try{
        $result = $Connection->query($Query);
        $Connection->close();
        return $result;
    }
    catch(mysqli_sql_exception $e){
        $Connection->close();
        return false;
    }
}
function QueryTupleCreater($Array,$withQutation=false){
    $tuple = "";
    $arraySize = count($Array);
    foreach($Array as $item){
        $arraySize--;
        $tuple.=is_numeric($item) || !$withQutation?$item:"\"$item\"";
        if($arraySize > 0){
            $tuple.=",";
        }
    }

    return $tuple;
}

function InsertQueryCreator($tableName,$columns,$values){
    if(count($columns) != count($values))return null;
    return "INSERT INTO $tableName (".QueryTupleCreater($columns).") VALUES (".QueryTupleCreater($values,true).")";

}

function SelectQueryCreator($tableName,$columns,$where=""){
    return "SELECT ".QueryTupleCreater($columns,false)." FROM $tableName $where";
}



?>
