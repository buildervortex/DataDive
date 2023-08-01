<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/PublicationAuthorView/PublicationAuthorViewHandler.php";
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/PublicationAuthorUpdateViewHandler/PublicationAuthorUpdateViewHandler.php";
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/PublicationCreateView/PublicationCreateViewHandler.php";



$id = isCookiesThere();
if(!$id){
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
$postPublicationThumbnalFilePath=null;
$postLanguageId = null;

$pubid = null;

if($_SERVER["REQUEST_METHOD"]=="GET"){

    $pubid = (int)$_GET["prate"];
    $publicationDetails = getPublication($pubid,$id);

    
}

$postTitle = $publicationDetails["Title"];
$postDescription = $publicationDetails["Description"];
$postLanguage = $publicationDetails["Language"];
$postMainCategoryId = $publicationDetails["MainCategoryId"];
$postSubCategoryId = $publicationDetails["SubCategoryId"];
$postLanguageId = $publicationDetails["LanguageId"];
$postPublicationThumbnalFilePath = getThumbnailLocation($id,$pubid);
$SubCategoryList = getAllSubCategory($postMainCategoryId);


if($_SERVER["REQUEST_METHOD"]=="POST"){
    $pubid = $_POST["pubid"];
    $postTitle = $_POST["Title"];
    $postDescription = $_POST["Description"];
    $postLanguageId = $_POST["Language"];
    $postSubCategory = $_POST["subCategorySelector"];
    $postMainCategory = $_POST["mainCategorySelector"];


    if($postMainCategory != 0 && $postSubCategory !=0){

        UpdateThePublication($id,$pubid,$postTitle,$postDescription,$postSubCategoryId,$postLanguageId);
        if($_FILES["Thumbnail"]["name"]!=""){
            $thumbnailName = $_FILES["Thumbnail"]["name"];
            move_uploaded_file($_FILES["Thumbnail"]["tmp_name"],__DIR__."/$thumbnailName");
            addThumbnail($id,$pubid,__DIR__."/$thumbnailName");
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
</head>
<body>
    <?php
        echo "<img src='".getProfilePictureLocation($id)."'></img>";
        ?>
        <form action="" method="post" enctype="multipart/form-data">
        <table>
            <input style="display:none;" type="text" name="pubid" <?php echo "value = $pubid"?>>
            <tr>
                <td>Title</td>
                <td><input type="text" name="Title" <?php echo "value = $postTitle"?>></td>
            </tr>
            <tr>
                <td><input type="file" name="Thumbnail"></td>
                <td><img <?php echo "src= $postPublicationThumbnalFilePath" ?>></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name="Description" cols="30" rows="10" style="resize: none;"><?php echo "$postDescription"?></textarea></td>
            </tr>
            <tr>
                <td>Langugae</td>
                <td>
                    <select name='Language'>
                        <?php
                        $langugaeslist = getAllLanguages();
                        foreach ($langugaeslist as $id => $name) {
                            if($id == $postLanguageId){
                                echo "<option value='$id' selected>$name</option>";
                            }
                                echo "<option value='$id'>$name</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
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
                            if($ID == $postMainCategoryId){
                                echo "<option value='$ID' class='Override' selected>$Name</option>";
                            }
                            else{
                                
                                echo "<option value='$ID' class='Override'>$Name</option>";
                            }
                        }
                        ?>
                </select>
                <select name="subCategorySelector" class="subCategorySelector Override">
                    <option value="0" class="Override">Select The Sub Category</option>
                    <?php
                        foreach($SubCategoryList as $ID => $Name){
                            if($ID == $postSubCategoryId){
                                echo "<option value='$ID' class='Override' selected>$Name</option>";
                            }
                            else{
                                echo "<option value='$ID' class='Override'>$Name</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </table>
        <input type="submit" value="Submit">
        </form>
        <script src="./js/index.js"></script>
</body>
</html>

