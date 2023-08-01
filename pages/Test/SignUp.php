<?php
    include_once __DIR__."/../../php/lib/db/pages/SingUp/SingUpDatabaseHandler.php";

    if(isCookiesThere()){
        session_name("Check_sing_in");
        session_start();
        header(("Location: ./AuthorProfileView.php")); // TODO : change to redirect to the author profile view.
        session_write_close();
    }

    $Dob="";
    $FirstName = "";
    $MiddleName = "";
    $LastName = "";
    $UserName = "";
    $Email = "";
    $Password = "";
    $result = [
        "Result"=>true,
    ];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $Dob = $_POST["Dob"];
        $FirstName = $_POST["FirstName"];
        $MiddleName = $_POST["MiddleName"];
        $LastName = $_POST["LastName"];
        $UserName = $_POST["UserName"];
        $Email = $_POST["Email"];
        $Password = $_POST["Password"];
    
        $UserDataArray=[
            "Dob"=>$Dob,
            "FirstName"=>$FirstName,
            "LastName"=>$LastName,
            "UserName"=>$UserName,
            "Email"=>$Email,
            "Password"=>$Password
        ];
    
        if(!$MiddleName == null){
            $UserDataArray["MiddleName"]=$MiddleName;
        }
    
        $result = AddUser($UserDataArray);
        
        if($result["Result"]){
            setCookies_($result["ID"]);
            session_start();
            $_SESSION["SignUp_Success"] = true;
            header(("Location: ./AuthorProfileView.php")); // TODO : change to redirect to the author profile view.
            exit(); //exit the code without executing below html
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="" alt="">
    <h1>Sign Up</h1>
    <form action="SignUp.php" name="SignInForm" method="post" enctype="multipart/form-data">
        <?php
        if($result["Result"] == false){
            echo "<h4 style=\"Background-color:red;\">The Email Already exists</h4>";
        }
         ?>
        <input type="date" name="Dob" <?php echo "value=\"".$Dob."\"" ?> required><br>
        <input type="text" name="FirstName" required placeholder="First Name" <?php echo "value=\"".$FirstName."\"" ?> ><br>
        <input type="text" name="MiddleName" placeholder="Middle Name" <?php echo "value=\"".$MiddleName."\"" ?>><br>
        <input type="text" name="LastName" required placeholder="Last Name" <?php echo "value=\"".$LastName."\"" ?>><br>
        <input type="text" name="UserName" required placeholder="User Name" <?php echo "value=\"".$UserName."\"" ?>><br>
        <input type="email" name="Email" required placeholder="Email" <?php echo "value=\"".$Email."\"" ?>><br>
        <input type="password" name="Password" required placeholder="Password" <?php echo "value=\"".$Password."\"" ?>><br>
        <input type="submit" value="Submit"><br>
    </form>
    <a href="./SingIn.php">Sing in</a>
</body>
</html>