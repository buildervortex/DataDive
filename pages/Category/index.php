<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/CategoryPageHandler/CategoryPageHandler.php";
// include_once "/home/lahirukasunidilhara/University/web/Project/php/lib/db/pages/CategoryPageHandler/CategoryPageHandler.php";

// ! ADD THE SIGN IN REDIRECT


$Publications = null;


$Publications = getAllPublications([]);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    global $Publications;
    $Publications = getAllPublications($_POST);
}

$MainCategoryList = getAllMainCategory();

// var_dump($Publications);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./css/style.css">
    <style>
        *{
            color: black;
        }
    </style>
</head>
<body>
<nav class="navBar Override">
        <div class="hamburgerMenu Override">
            <div id="asideBarActivator" class="Override">
                <div class="Override"></div>
                <div class="Override"></div>
                <div class="Override"></div>
            </div>
        </div>
        <img src="../../../img/other/navBar/CompanyLogo.png" alt="CompanyLogo" id="Logo" class="Override" />
        <aside class="links-container Override">
            <a href="/index.php" class="Override">Home</a>
            <a href="/pages/Category/index.php" id="category" class="Override"><span class="Override">Category</span><img src="../../../icon/other/navBar/arrowHead.png" class="Override" /></a>
            <a href="/pages/Services/index.html" class="Override">Services</a>
            <a href="/pages/contact us/index.html" class="Override">contact us</a>
            <a href="/pages/About us/index.html" class="Override">About us</a>
            <a href="/pages/SignUp/index.php" id="SignUpButton" class="Override">Sign Up</a>
        </aside>
        <a href="/pages/Login/index.php" id="SignInButton" class="Override">Sign In</a>
    </nav>
<form action="" method="post" enctype="multipart/form-data">
<main class="mainSection Override">
    <div class="SearchBarBox">
        <div>
            <input type="search" name="FBS" class="SearchBox" placeholder="Search">
            <input type="submit" class="SerachIcon" value="">
        </div>
    </div>
    <aside>
        <div class="asideContainer">
            <div class="categorySelectionContainer Override">
        <div class="categorySelectionContainer Override">
            <select name="mainCategorySelector" class="mainCategorySelector Override">
                <option value='0' class='Override'>Select The Main Category</option>
                <?php
                    foreach($MainCategoryList as $ID => $Name){
                        echo "<option value='$ID' class='Override'>$Name</option>";
                    }
                ?>
            </select>
            <select name="subCategorySelector" class="subCategorySelector Override">
                <option value="0" class="Override">Select The Sub Category</option>
            </select>
        </div>
            </div>
            <div class="filterbox">
                <label for="likeFilter">Filter By Likes</label>
                <div class="filter"><input type="radio" name="FBL" id=""></div>
                <label for="CommentFilter">Filter By Comments</label>
                <div class="filter"><input type="radio" name="FBC" id=""></div>
                <label for="RatingFilter">Filter By Rating</label>
                <div class="filter"><input type="radio" name="FBR" id=""></div>
                <label for="DateFilter">Filter By Date</label>
                <div class="filter"><input type="radio" name="FBD" id=""></div>
                <button type="submit">Filter</button>
            </div>
        </div>
    </aside>
    <div class="cardContainer">
        <?php
        foreach($Publications as $publication){
            echo "<div class=\"card\" name='".$publication["AuthorId"]."'>";
            echo "<h1 name='".$publication["PublicationId"]."'>".$publication["Title"]."</h1>";
            echo "<img src=\"".getThumbnailLocation((int)$publication["AuthorId"],(int)$publication["PublicationId"])."\" class=\"thumbnail\">";
            echo "<p>".$publication["Description"]."</p>";
            echo "<h4 class=\"rating\">".RatingStar((int)$publication["Ratings"])."</h4>";
            echo "<div class=\"like\">";
            echo "<img src=\"./img/like.png\">";
            echo "<span>".$publication["LikeCount"]."</span></div>";
            echo "<div class=\"comment\">";
            echo "<img src=\"./img/comment.png\">";
            echo "<span>".$publication["CommentCount"]."</span></div></div>";
        }
        ?>
    </div>
</main>
</form>
<footer class="Override"></footer>


    <script type="module" src="./js/index.js"></script>
</body>
</html>