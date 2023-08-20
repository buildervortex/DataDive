<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/HomePageHandler/homePageHandler.php";


$id = isCookiesThere();

if (!$id) {
    global $id;
    $id = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Posted</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <nav class="navBar">
        <script>
            function profileRedirect() {
                window.location.href = "/pages/AuthorProfileView/index.php";
            }
        </script>
        <div class="hamburgerMenu">
            <div id="asideBarActivator">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <img src="/shared/img/navBar/CompanyLogo.png" alt="CompanyLogo" id="Logo" />
        <aside class="links-container">
            <a href="/index.php">Home</a>
            <a href="/pages/Category/index.php" id="category"><span>Category</span><img src="/shared/icon/navBar/arrowHead.png" />
            </a>
            <a href="/pages/Services/index.php">Services</a>
            <a href="/pages/contact us/index.php">contact us</a>
            <a href="/pages/About us/index.php">About us</a>
            <?php
            if (!$id) {
                echo "<a href='/pages/SignUp/index.php' id='SignUpButton'>Sign Up</a>";
            } else {
                echo "<a href='/pages/SingOut/index.php' id='SignUpButton'>Sign Out</a>";
            }
            ?>
        </aside>
        <?php
        if (!$id) {
            echo "<a href='/pages/Login/index.php' id='SignInButton'>Sign In</a>";
        } else {
            echo "<img onclick='profileRedirect()' class='profileImage'  src='" . getProfilePictureLocation($id) . "'></img>";
        }
        ?>

    </nav>
    <main>
        <img src="../Services/img/29493.jpg"></img>
        <h1>::: Our Services :::</h1>
        <br>
        <div class="s">
            <h3>Our Education Services are designed to cater to the diverse needs of students, educators, and lifelong learners. We are committed to providing top-notch educational resources and support to help you achieve your academic and professional goals. Below are some of the services we offer:
        </div>
        </h3>
        <br>
        <div class="container">
            <div class="item">
                <h4>Accurate and Reliable Information:</h4><br>
                <h6>
                    <h5> Knowledge-based websites are designed to provide reliable and fact-checked information. They undergo rigorous scrutiny, ensuring that the content presented to users is accurate and up-to-date.</h5><br>
                    <img src="../Services/img/Accurate.jpg" alt="Accurate.jpg">
                </h6>
            </div>
            <div class="item">
                <h4>Business and Professional Use:</h4><br>
                <h5>Knowledge-based websites are valuable for professionals seeking industry-specific information, researchers conducting studies, and businesses looking to educate their employees or customers.</h5><br>
                <img src="../Services/img/Business and professional.jpg" alt="Business and professional.jpg">
            </div>
            <div class="item">
                <h4>Support for Self-Learning: </h4><br>
                <h5>Knowledge-based websites empower individuals to engage in self-learning. Users can explore topics at their own pace, delve deeper into areas of interest, and pursue personal development.</h5><br>
                <img src="../Services/img/Support for self learning (2).jpg" alt="Support for self learning (2).jpg">
            </div>
        </div>
        lor
        fd
    </main>
    <footer></footer>

    <script type="module" src="./js/index.js"></script>
</body>

</html>