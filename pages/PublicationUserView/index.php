<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/PublicationAuthorView/PublicationAuthorViewHandler.php";
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/PublicationUserViewHandler/publicationUserViewHandler.php";



$id = isCookiesThere();
if (!$id) {
    $id = null;
}


$postTitle = null;
$postDescription = null;
$postLanguage = null;
$postMainCategory = null;
$postSubCategory = null;
$postSize = null;
$postPublishedDate = null;
$postLikeCount = null;
$postCommentCount = null;
$postComments = null;
$postPublicationThumbnalFilePath = null;
$postPublicationPdfFilePath = null;
$publicationId = null;
$authorId = null;
$liked = false;


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    global $publicationId, $authorId;

    $publicationId = (int)$_GET["PID"];
    $authorId = (int)$_GET["AID"];

    if($authorId == $id){
        session_start();
        $_SESSION["Redirecting_to_userView"] = true;
        header(("Location: /pages/PublicationAuthorView/index.php?prate=$publicationId"));
        exit();
    }
    $publicationDetails = getPublication($publicationId, $authorId);

    $postTitle = $publicationDetails["Title"];
    $postDescription = $publicationDetails["Description"];
    $postLanguage = $publicationDetails["Language"];
    $postSize = $publicationDetails["Size"];
    $postPublishedDate = $publicationDetails["PublishedDate"];
    $postMainCategory = $publicationDetails["MainCategory"];
    $postSubCategory = $publicationDetails["SubCategory"];
    $postLikeCount = $publicationDetails["LikeCount"];
    $postCommentCount = $publicationDetails["CommentCount"];
    $postCommentCount = $publicationDetails["CommentCount"];
    $postPublicationThumbnalFilePath = getThumbnailLocation($authorId, $publicationId);
    $postPublicationPdfFilePath = getPdfLocation($authorId, $publicationId);
    $postComments = getComments($publicationId);
    if ($id) {
        $liked = getLike($id, $publicationId);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#0099ff" fill-opacity="1" d="M0,64L48,85.3C96,107,192,149,288,165.3C384,181,480,171,576,192C672,213,768,267,864,261.3C960,256,1056,192,1152,154.7C1248,117,1344,107,1392,101.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
    <main>
        <header class="PdfThumbnail">
            <div>
                <?php
                echo "<img class='AuthorProfile' onclick=profileClick($authorId) src='" . getProfilePictureLocation($authorId) . "'></img>";
                ?>
                <img class="thumbnail" <?php echo "src= '$postPublicationThumbnalFilePath'" ?>>
                <a <?php echo "href = '$postPublicationPdfFilePath'" ?> download="download.pdf">Download</a>
            </div>
        </header>
        <header class="About">
            <div>
                <input type="text" name="Title" id="Title" readonly <?php echo "value = \"$postTitle\"" ?>>
                <h2>Description</h2>
                <p><?php echo "$postDescription" ?></p>
                <h2>Language</h2>
                <input type="text" name="Language" readonly <?php echo "value = '$postLanguage'" ?>>
                <h2>Size</h2>
                <input type="text" name="Size" readonly <?php echo "value = '$postSize'" ?>>
                <h2>Published Date</h2>
                <input type="text" name="Size" readonly <?php echo "value = '$postPublishedDate'" ?>>
                <h2>Main Category</h2>
                <input type="text" name="Size" readonly <?php echo "value = '$postMainCategory'" ?>>
                <h2>Sub Category</h2>
                <input type="text" name="Size" readonly <?php echo "value = '$postSubCategory'" ?>>
                <div>
                    <img src="./icon/like.png">
                    <input type="text" name="Size" id='likeCountElement' readonly <?php echo "value = '$postLikeCount'" ?>>
                </div>
                <div>
                    <img src="./icon/comment.png">
                    <input type="text" name="Size" readonly id='commentCount' <?php echo "value = '$postCommentCount'" ?>>
                </div>
                <div>
                    <?php
                    if ($id) {
                        if ($liked) {
                            echo "<button userId='$id' publicationId='$publicationId' onclick=\"likeHandler(event)\" class='unLiked liked'>Like</button>";
                        } else {
                            echo "<button userId='$id' publicationId='$publicationId' onclick=\"likeHandler(event)\" class='unLiked'>Like</button>";
                        }
                        echo "";
                    }
                    ?>
                </div>
            </div>
        </header>
        <section class="UserFuctions">
            <button onclick="goback()">Back</button>
        </section>
        <header class="Comments">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#0099ff" fill-opacity="1" d="M0,64L48,85.3C96,107,192,149,288,165.3C384,181,480,171,576,192C672,213,768,267,864,261.3C960,256,1056,192,1152,154.7C1248,117,1344,107,1392,101.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
            <div>
                
                    
                    
                
                <?php
                if ($id) {
                    echo "<div class='textareaContainer Override'>";
                    echo "<textarea name='Comment' class='limitedtextarea' userId='$id' publicationId='$publicationId' id='commentbox' class='limitedtextarea Override' placeholder='Enter the Comment' ></textarea>";
                    echo "<h5 class='errorMessage Override'>The maximum number of characters have added</h5></div>";

                    echo "<button onclick='comment(event)'>Add Comment</button><div id='commentViewBox' class='CommentBox'>";

                    foreach ($postComments as $comment) {
                        echo "<div class='comment'><img src='./icon/comment.png'><p>$comment</p></div>";
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </header>
    </main>


    <script src="./js/index.js"></script>
    <script src="./js/importing.js" type="module"></script>
</body>

</html>