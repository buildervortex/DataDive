<?php
    $DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
    include_once $DOCUEMENT_ROOT."/php/lib/db/pages/SingUp/SingUpDatabaseHandler.php";
    
    if(isCookiesThere()){
        session_name("Check_sing_in");
        session_start();
        header(("Location: /pages/AuthorProfileView/index.php"));
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
            header(("Location: /pages/AuthorProfileView/index.php"));
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta nama="viweport" content="width=divice-width,initial-scale=1.0">
    <title>Login form in HTML and CSS | Codeha1</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

    <div class="wrapper">
        <form action="" method="post" enctype="multipart/form-data">
        <?php
        if($result["Result"] == false){
            echo "<h4 style=\"Background-color:red;\">The Email Already exists</h4>";
        }
         ?>
            <h1>Sign up</h1>
            <div class="input-box">

            <input type="text" name="FirstName" required placeholder="First Name" <?php echo "value=\"".$FirstName."\"" ?> >
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
            <input type="text" name="MiddleName" placeholder="Middle Name" <?php echo "value=\"".$MiddleName."\"" ?>>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
            <input type="text" name="LastName" required placeholder="Last Name" <?php echo "value=\"".$LastName."\"" ?>>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
            <input type="text" name="UserName" required placeholder="User Name" <?php echo "value=\"".$UserName."\"" ?>>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
            <input type="email" name="Email" required placeholder="Email" <?php echo "value=\"".$Email."\"" ?>>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">

            <input type="password" name="Password" required placeholder="Password" <?php echo "value=\"".$Password."\"" ?>>
                <i class='bx bxs-lock-alt'></i>

            </div>


            <tr>
                <td>
                    <h4>Date of Birth</h4>
                </td>
                <td><input type="date" name="Dob" <?php echo "value=\"".$Dob."\"" ?> required></td>
            </tr>

            <br>
            <br>
            <br>

            <button type="submit" class="btn">Sign up</button>

            <div class=" register-link ">
                <p>Do have an account?
                    <a href="/pages/Login/index.php">Login</a>
                </p>
            </div>
        </form>

    </div>

</body>

</html>

</html>