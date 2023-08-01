<?php

include_once __DIR__."/../../php/lib/db/pages/PublicationCreateView/PublicationCreateViewHandler.php";

$id = isCookiesThere();
if(!$id){
    session_name("Check_sing_in");
    session_start();
    header(("Location: ./SingIn.php")); // TODO : change to redirect to the author profile view.
    session_write_close();
}

$MainCategoryList = getAllMainCategory();

$postTitle = null;
$postDescription = null;
$postLanguage = null;
$postMainCategory = null;
$postSubCategory = null;
$mainCategorySelected = true;
$SubCategorySelected = true;

$selectedthePdf=true;


if($_SERVER["REQUEST_METHOD"]=="POST"){

    $postTitle = $_POST["Title"];
    $postDescription = $_POST["Description"];
    $postLanguage = $_POST["Language"];
    $postMainCategory = $_POST["mainCategorySelector"];
    $postSubCategory = $_POST["subCategorySelector"];
    $pdfName = $_FILES["Publication"]["name"];

    if(pathinfo($pdfName,PATHINFO_EXTENSION) != "pdf"){
        $selectedthePdf = false;
    }
    if($postMainCategory != 0 && $postSubCategory !=0 && $selectedthePdf){
        if(createPublication($id,$postTitle,$postDescription,$_FILES["Publication"]["size"],$postLanguage,$postSubCategory)){

            $thumbnailName = $_FILES["Thumbnail"]["name"];
            move_uploaded_file($_FILES["Thumbnail"]["tmp_name"],__DIR__."/$thumbnailName");
            $publicationId =getPublicationId($id,$postTitle);
            addThumbnail($id,$publicationId,__DIR__."/$thumbnailName");
            move_uploaded_file($_FILES["Publication"]["tmp_name"],__DIR__."/$pdfName");
            addPdf($id,$publicationId,__DIR__."/$pdfName");
    
            session_start();
            $_SESSION["PdfUploaded"] = true;
            header(("Location: ./AuthorProfileView.php"));
            exit();
        }
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
    <?php
        echo "<img src='".getProfilePictureLocation($id)."'></img>";
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Title</td>
                <td><input type="text" name="Title" required <?php echo "value = $postTitle"?>></td>
            </tr>
            <tr>
                <td>Thumbnail</td>
                <td><input type="file" name="Thumbnail"></td>
            </tr>
            <?php
                if(!$selectedthePdf){
                    echo "<h4 style='background-color:red;'>Select valid pdf file</h4>";
                }
            ?>
            <tr>
                <td>Publication</td>
                <td><input type="file" name="Publication" required></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name="Description" cols="30" rows="10" style="resize: none;"><?php echo "$postDescription"?></textarea></td>
            </tr>
            <tr>
                <td>Langugae</td>
                <td><select name='Language'>
                        <?php
                        $langugaeslist = getAllLanguages();
                        foreach ($langugaeslist as $id => $name) {
                            if($id == $postLanguage){
                                echo "<option value='$id' selected>$name</option>";
                            }
                                echo "<option value='$id'>$name</option>";
                        }
                        ?>
                    </select></td>
            </tr>
        </table>
        <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if($postMainCategory == 0 || $postSubCategory == 0){
                echo "<h4 style='background-color:red;'>Select Sub And Main Category</h4>";
            }
        }
        
        ?>
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
        <input type="submit" value="Submit">
    </form>
    <script src="./js/PublicationCreateView.js"></script>

</body>
</html>

<!-- if main,sub == 0 redirect to this page -->