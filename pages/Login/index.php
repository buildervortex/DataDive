<img src="/pages/AuthorProfileView/index.php" alt="">
<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/SingIn/SingInDatabaseHandler.php";

if (isCookiesThere()) {
    session_name("Check_sing_in");
    session_start();
    header(("Location: /pages/AuthorProfileView/index.php"));
    session_write_close();
}

$Email = "";
$Password = "";
$result = [
    "Result" => true
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST["Email"];
    $Password = $_POST["Password"];

    $UserDataArray = [
        "Email" => $Email,
        "Password" => $Password
    ];

    $result = ValidateUser($UserDataArray);

    if ($result["Result"]) {
        setCookies_($result["ID"]);
        session_start();
        $_SESSION["SignUp_Success"] = true;
        header(("Location: /pages/AuthorProfileView/index.php")); // TODO : change to redirect to the author profile view.
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
    <title>Get Posted</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <form action="" method="post" enctype="multipart/form-data">
            <?php
            if ($result["Result"] == false) {
                echo "<h4 style=\"Background-color:red;opacity:0.7;text-align:center;padding:10px;border-radius:20px;margin:15px 5px;\">The Credentials was wrong</h4>";
            }
            ?>
            <h1>Login</h1>
            <div class="input-box">
                <input type="email" placeholder="Email" name="Email" required <?php echo "value=\"" . $Email . "\"" ?>>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="Password" placeholder="Password" required <?php echo "value=\"" . $Password . "\"" ?>>
                <i class='bx bxs-lock-alt'></i>
            </div>



            <button type="submit" class="btn">login</button>

            <div class="register-link">
                <p>Don't have an account?
                    <a href="/pages/SignUp/index.php">Sign up</a>
                </p>
            </div>
        </form>

        </div>
        <script src="./js/index.js" type="module"></script>
    </body>

</html>