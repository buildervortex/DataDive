<?php
$dbDirectory = __DIR__."/../../databaseConnector.php";
require_once $dbDirectory;

function AddUser($QueryDataArray){
    /*
        * AddUser([
        *   "Dob"=>"2001-09-17",
        *   "FirstName"=>"Lahiru",
        *   "MiddleName"=>"",
        *   "LastName"=>"Dilhara",
        *   "UserName"=>"LahiruDilhara",
        *   "Email"=>"galahirudilhara@gmail.com",
        *   "Password"=>"lahiru"
        * ]);
    */
    $result_ = queryData(InsertQueryCreator("Author",array_keys($QueryDataArray),array_values($QueryDataArray)));
    $userId = queryData(SelectQueryCreator("Author",["ID"],"WHERE Email = \"".$QueryDataArray["Email"]."\""));

    if(!$userId){
        return [
            "Result"=>false
        ];
    }

    return [
        "Result"=>$result_,
        "ID"=>$userId->fetch_assoc()["ID"]
    ];

    
}