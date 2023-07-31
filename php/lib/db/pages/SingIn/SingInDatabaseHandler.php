<?php

require_once __DIR__."/../../databaseConnector.php";

function ValidateUser($QueryDataArray){
    /*
        * ValidateUser([
            *   "Email"=>"galahirudilhara@gmail.com",
            *   "Password"=>"lahiru"
        * ]);
    */
    $whereClause = "WHERE Email = \"".$QueryDataArray["Email"]."\" AND Password = \"".$QueryDataArray["Password"]."\"";
    $QueryDataArray["ID"]="";
    $result_ =  queryData(SelectQueryCreator("Author",array_keys($QueryDataArray),$whereClause));
    $result = $result_->num_rows>0?true:false;

    if(!$result){
        return [
            "Result" => false
        ];
    }
    return [
        "Result" => $result,
        "ID" => $result_->fetch_assoc()["ID"]
    ];
    
}

// test data
// var_dump(ValidateUser([
//     "Email"=>"galahirudilhara@gmail.com",
//     "Password"=>"lahiru",
// ]));
