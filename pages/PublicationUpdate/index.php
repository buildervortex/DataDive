<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/PublicationAuthorView/PublicationAuthorViewHandler.php";
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/PublicationAuthorUpdateViewHandler/PublicationAuthorUpdateViewHandler.php";
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/PublicationCreateView/PublicationCreateViewHandler.php";



$id = isCookiesThere();
if (!$id) {
    session_name("Check_sing_in");
    session_start();
    header(("Location: /pages/Login/index.php"));
    session_write_close();
}
$MainCategoryList = getAllMainCategory();
$SubCategoryList = null;
$postTitle = null;
$postDescription = null;
$postLanguage = null;
$postMainCategoryId = null;
$postSubCategoryId = null;
$postPublicationThumbnalFilePath = null;
$postLanguageId = null;

$pubid = null;

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $pubid = (int)$_GET["prate"];
    $publicationDetails = getPublication($pubid, $id);
}

$postTitle = $publicationDetails["Title"];
$postDescription = $publicationDetails["Description"];
$postLanguage = $publicationDetails["Language"];
$postMainCategoryId = $publicationDetails["MainCategoryId"];
$postSubCategoryId = $publicationDetails["SubCategoryId"];
$postLanguageId = $publicationDetails["LanguageId"];
$postPublicationThumbnalFilePath = getThumbnailLocation($id, $pubid);
$SubCategoryList = getAllSubCategory($postMainCategoryId);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $postTitle,$postDescription,$postLanguage,$postMainCategoryId,$postSubCategoryId,$postLanguageId,$postPublicationThumbnalFilePath,$SubCategoryList;
    $pubid = $_POST["pubid"];
    $postTitle = $_POST["Title"];
    $postDescription = $_POST["Description"];
    $postLanguageId = $_POST["Language"];
    $postSubCategory = $_POST["subCategorySelector"];
    $postMainCategory = $_POST["mainCategorySelector"];
    

    if ($postMainCategory != 0 && $postSubCategory != 0) {
        UpdateThePublication($id, $pubid, $postTitle, $postDescription, $postSubCategory, $postLanguageId);
        if ($_FILES["Thumbnail"]["name"] != "") {
            $thumbnailName = $_FILES["Thumbnail"]["name"];
            move_uploaded_file($_FILES["Thumbnail"]["tmp_name"], __DIR__ . "/$thumbnailName");
            addThumbnail($id, $pubid, __DIR__ . "/$thumbnailName");
        }

        session_start();
        $_SESSION["PdfUploaded"] = true;
        header(("Location: /pages/PublicationAuthorView/index.php?prate=$pubid"));
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
        <path fill="#00cba9" fill-opacity="1" d="M0,64L48,85.3C96,107,192,149,288,165.3C384,181,480,171,576,192C672,213,768,267,864,261.3C960,256,1056,192,1152,154.7C1248,117,1344,107,1392,101.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
    <form action="" method="post" enctype="multipart/form-data">
        <main>
            <header class="PdfThumbnail">
                <div>
                    <img <?php echo "src= '$postPublicationThumbnalFilePath'" ?>>
                    <input type="file" name="Thumbnail">
                    <button type="submit">Save</button>
                </div>
            </header>
            <header class="About">
                <div>
                    <h2>Title</h2>
                    <input type="text" name="Title" <?php echo "value = '$postTitle'" ?>>
                    <h2>Description</h2>
                    <div class="textareaContainer Override">
                        <textarea name="Description" id="limitedtextarea" class="limitedtextarea Override" placeholder="Enter the description" cols="60" rows="10"><?php echo "$postDescription" ?></textarea>
                        <h5 class="errorMessage Override">The maximum number of characters have added</h5>
                    </div>
                    <h2>Language</h2>
                    <select name='Language'>
                        <?php
                        $langugaeslist = getAllLanguages();
                        foreach ($langugaeslist as $id => $name) {
                            if ($id == $postLanguageId) {
                                echo "<option value='$id' selected>$name</option>";
                            }
                            echo "<option value='$id'>$name</option>";
                        }
                        ?>
                    </select>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if ($postMainCategory == 0 || $postSubCategory == 0) {
                            echo "<h4 style='background-color:red;padding:0.5cqb 2cqb;border-radius:20px'>Select Sub And Main Category</h4>";
                        }
                    }
                    ?>
                    <div class="categorySelectionContainer Override">
                        <h2>Main Category</h2>
                        <select name="mainCategorySelector" class="mainCategorySelector Override">
                            <option value='0' class='Override'>Select The Main Category</option>
                            <?php
                            foreach ($MainCategoryList as $ID => $Name) {
                                if ($ID == $postMainCategoryId) {
                                    echo "<option value='$ID' class='Override' selected>$Name</option>";
                                } else {

                                    echo "<option value='$ID' class='Override'>$Name</option>";
                                }
                            }
                            ?>
                        </select>
                        <h2>Sub Category</h2>
                        <select name="subCategorySelector" class="subCategorySelector Override">
                            <option value="0" class="Override">Select The Sub Category</option>
                            <?php
                            foreach ($SubCategoryList as $ID => $Name) {
                                if ($ID == $postSubCategoryId) {
                                    echo "<option value='$ID' class='Override' selected>$Name</option>";
                                } else {
                                    echo "<option value='$ID' class='Override'>$Name</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </header>
            <input style="display:none;" type="text" name="pubid" <?php echo "value = $pubid" ?>>

        </main>
    </form>
    <script src="./js/index.js"></script>
    <script src="./js/thumbnail.js"></script>
    <script src="./js/module.js" type="module"></script>
</body>

</html>