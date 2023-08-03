<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/CategoryPageHandler/CategoryPageHandler.php";


// ! ADD THE SIGN IN REDIRECT


$Publications = null;

$id = isCookiesThere();

$Publications = getAllPublications([]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        * {
            color: black;
        }
    </style>
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
                                foreach ($MainCategoryList as $ID => $Name) {
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
                foreach ($Publications as $publication) {
                    echo "<div class=\"card\" name='" . $publication["AuthorId"] . "'>";
                    echo "<h1 name='" . $publication["PublicationId"] . "'>" . $publication["Title"] . "</h1>";
                    echo "<img src=\"" . getThumbnailLocation((int)$publication["AuthorId"], (int)$publication["PublicationId"]) . "\" class=\"thumbnail\">";
                    echo "<p>" . $publication["Description"] . "</p>";
                    echo "<h4 class=\"rating\">" . RatingStar((int)$publication["Ratings"]) . "</h4>";
                    echo "<div class=\"like\">";
                    echo "<img src=\"./img/like.png\">";
                    echo "<span>" . $publication["LikeCount"] . "</span></div>";
                    echo "<div class=\"comment\">";
                    echo "<img src=\"./img/comment.png\">";
                    echo "<span>" . $publication["CommentCount"] . "</span></div></div>";
                }
                ?>
            </div>
        </main>
    </form>
    <footer class="Override"></footer>


    <script type="module" src="./js/index.js"></script>
</body>

</html>