<?php 
    include_once __DIR__."/../../php/lib/db/pages/SingIn/SingInDatabaseHandler.php";

    if(isCookiesThere()){
        session_name("Check_sing_in");
        session_start();
        header(("Location: ./AuthorProfileView.php")); // TODO : change to redirect to the author profile view.
        session_write_close();
    }
    
    $Email = "";
    $Password = "";
    $result = [
        "Result"=>true
    ];

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $Email = $_POST["Email"];
        $Password = $_POST["Password"];

        $UserDataArray=[
            "Email"=>$Email,
            "Password"=>$Password
        ];

        $result = ValidateUser($UserDataArray);

        if($result["Result"]){
            setCookies_($result["ID"]);
            session_start();
            $_SESSION["SignUp_Success"] = true;
            header(("Location: ./AuthorProfileView.php")); // TODO : change to redirect to the author profile view.
            exit();
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
    <form action="" method="post" enctype="multipart/form-data">
        <?php
        if($result["Result"] == false){
            echo "<h4 style=\"Background-color:red;\">The Credentials was wrong</h4>";
        }
         ?>
        <input type="email" placeholder="Email" name="Email" required <?php echo "value=\"".$Email."\"" ?>><br>
        <input type="password" name="Password" placeholder="Password" required <?php echo "value=\"".$Password."\"" ?>><br>
        <input type="submit" value="Submit"><br>
        <a href="./SignUp.php">Sing up</a>
    </form>
</body>
</html>