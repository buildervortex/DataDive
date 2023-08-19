<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/AuthorProfileView/AuthorProfileViewDatabaseHandler.php";
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/AuthorProfileUserViewHandler/AuthorProfileUserViewHandler.php";

$id = isCookiesThere();
if (!$id) {
    $id = null;
}

$authorId = null;
$publications = [];
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    global $authorId,$publications;
    $authorId = $_GET["AID"];
    $publications = getPublications($authorId, []);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    global $authorId,$publications;
    $authorId = $_POST["AID"];
    $publications = getPublications($authorId, $_POST);
}

if ($id == $authorId) {
    session_name("redirect");
    session_start();
    header(("Location: /pages/AuthorProfileView/index.php"));
    session_write_close();
}
if (!$authorId) {
    session_name("redirect");
    session_start();
    header(("Location: /index.php"));
    session_write_close();
}


$userData = getUserData($authorId);
$userSkills = getUserSkills($authorId);
$userInterests = getUserInterests($authorId);
$userSocialMedia = getUserSocialMediaLinks($authorId);
$userMainCategory = getMainCategory($authorId);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="/pages/AuthorProfileUserView/js/backend/rating.js"></script>
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#0099ff" fill-opacity="1" d="M0,64L48,85.3C96,107,192,149,288,165.3C384,181,480,171,576,192C672,213,768,267,864,261.3C960,256,1056,192,1152,154.7C1248,117,1344,107,1392,101.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
    <main>
        <header class="UserDetails">
            <div class="profilePicture">
                <?php
                echo "<img src='" . getProfilePictureLocation($authorId) . "'></img>";
                ?>
            </div>
            <div class="About">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#0099ff" fill-opacity="1" d="M0,192L34.3,192C68.6,192,137,192,206,192C274.3,192,343,192,411,208C480,224,549,256,617,256C685.7,256,754,224,823,202.7C891.4,181,960,171,1029,181.3C1097.1,192,1166,224,1234,208C1302.9,192,1371,128,1406,96L1440,64L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path>
                </svg>
                <div>
                    <h1>About</h1>
                    <div>
                        <?php
                        echo $userData["FullName"] != null ? "
                <h2>Full Name</h2>
                <h4>" . $userData["FullName"] . "</h4>" : "";
                        ?>
                        <?php
                        echo $userData["Dob"] != null ? "
                <h2>Dob</h2>
                <h4>" . $userData["Dob"] . "</h4>" : "";
                        ?>
                        <?php
                        echo $userData["Email"] != null ? "
                <h2>Email</h2>
                <h4>" . $userData["Email"] . "</h4>" : "";
                        ?>
                        <?php
                        echo $userData["PhoneNumber"] != null ? "
                <h2>Number</h2>
                <h4>" . $userData["PhoneNumber"] . "</h4>" : "";
                        ?>
                        <?php
                        echo $userData["PublicationCount"] != null ? "
                <h2>Publication Count</h2>
                <h4>" . $userData["PublicationCount"] . "</h4>" : "";
                        ?>
                        <?php
                        if (count($userSocialMedia) != 0) {

                            echo "<h2 >Social Media</h2><div class='SocialMedia'>";
                            foreach ($userSocialMedia as $Media => $url) {

                                echo "<h3>$Media</h3><h4>$url</h4>";
                            }
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="Bio">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#0099ff" fill-opacity="1" d="M0,192L34.3,192C68.6,192,137,192,206,192C274.3,192,343,192,411,208C480,224,549,256,617,256C685.7,256,754,224,823,202.7C891.4,181,960,171,1029,181.3C1097.1,192,1166,224,1234,208C1302.9,192,1371,128,1406,96L1440,64L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path>
                </svg>
                <div>

                    <div>
                        <?php
                        echo $userData["Bio"] != null ? "
                    <h2>Bio</h2>
                    <p>" . $userData["Bio"] . "</p>" : "";
                        ?>
                        <?php
                        if (count($userSkills) != 0) {
                            echo "<h2>Skills</h2><div>";
                            foreach ($userSkills as $skill) {
                                echo "<h4> $skill</h4>";
                            }
                            echo "</div>";
                        }
                        ?>
                        <?php
                        if (count($userInterests) != 0) {
                            echo "<h2>Interests</h2><div>";
                            foreach ($userInterests as $insertest) {
                                echo "<h4> $insertest</h4>";
                            }
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="Rating">
                <div>
                    <?php
                    echo $userData["UserName"] != null ? "
                <h4 id='UserName'>" . $userData["UserName"] . " </h4>" : "";
                    ?>
                    <?php
                    echo $userData["Country"] != null ? "<tr>
                    <h4>" . $userData["Country"] . "</h4>" : "";
                    ?>
                    <?php
                    echo $userData["Ratings"] != null ? "<tr>
                <h2>Ratings</h2>
                <h4>" . $userData["Ratings"] . "</h4>" : "";
                    ?>
                    <?php
                    if ($id) {
                        echo "<select id='RatingBox' ><option value='0'>Select Rating </option>";
                        $rater = getRate($authorId, $id);
                        for ($i = 1; $i <= 5; $i++) {
                            if ($rater == $i) {

                                echo "<option onclick='rate(event,$authorId,$id)' value='$i' selected><h4>" . str_repeat("⭐", $i) . str_repeat("☆", 5 - $i) . "</h4></option>";
                            } else {
                                echo "<option onclick='rate(event,$authorId,$id)' value='$i'><h4>" . str_repeat("⭐", $i) . str_repeat("☆", 5 - $i) . "</h4></option>";
                            }
                        }
                        echo "</select>";
                    }
                    ?>
                </div>
            </div>
        </header>
        <header class="UserPublications">
            <form class="asideContainer" action="" method="post" enctype="multipart/form-data">
                <input type="search" name="FBS" placeholder="Search">
                <div class="categorySelectionContainer Override">
                    <select name="mainCategorySelector" class="mainCategorySelector Override" AuthorId='<?php echo $authorId  ?>'>
                        <option value='0' class='Override'>Select The Main Category</option>
                        <?php
                        foreach ($userMainCategory as $ID => $Name) {
                            echo "<option value='$ID' class='Override'>$Name</option>";
                        }
                        ?>
                    </select>
                    <select name="subCategorySelector" class="subCategorySelector Override">
                        <option value="0" class="Override">Select The Sub Category</option>
                    </select>
                </div>

                <div class="filterbox">
                    <label for="likeFilter">Filter By Likes</label>
                    <div class="filter"><input type="radio" name="FBL" id="likeFilter"></div>
                    <label for="CommentFilter">Filter By Comments</label>
                    <div class="filter"><input type="radio" name="FBC" id="CommentFilter"></div>
                    <label for="DateFilter">Filter By Date</label>
                    <div class="filter"><input type="radio" name="FBD" id="DateFilter"></div>
                    <?php
                        echo "<input type='text' name='AID' value='$authorId' style='display:none;' >";
                    ?>
                    <button type="submit">Filter</button>
                </div>
            </form>
            <?php
            echo "<div class='Cardcontainer'>";
            foreach ($publications as $publication) {
                echo "<div class='card'>";
                echo "<div style='display:none;' id='ThePublicationIdForRedirection' AuthorId=$authorId name='" . $publication["PublicationId"] . "'>" . $publication["PublicationId"] . "</div>";
                echo "<div class='title'>" . $publication["Title"] . "</div>";
                echo "<img src='" . getThumbnailLocation($authorId, $publication["PublicationId"]) . "' class='thumbnail'>";
                echo "<div class='like'><img src='./icon/like.png'>";
                echo "<div class='likecount'>" . $publication["LikeCount"] . "</div></div>";
                echo "<div class='comment'><img src='./icon/comment.png'>";
                echo "<div class='commentcount'>" . $publication["CommentCount"] . "</div></div>";
                echo "</div>";
            }
            echo "</div>";

            ?>

            <script>
                let AuthorProfileViewCards = document.querySelectorAll(".Cardcontainer .card");
                AuthorProfileViewCards.forEach(e => {
                    e.addEventListener("click", () => {
                        let publicationId = parseInt(e.querySelector("#ThePublicationIdForRedirection").getAttribute("name"));
                        let AuthorId = parseInt(e.querySelector("#ThePublicationIdForRedirection").getAttribute("AuthorId"));
                        window.location.href = "/pages/PublicationUserView/index.php?AID=" + AuthorId + "&PID=" + publicationId;

                    });
                });
            </script>
        </header>
    </main>
    <script src="./js/index.js" type="module"></script>
</body>

</html>