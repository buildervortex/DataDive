<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/PublicationAuthorView/PublicationAuthorViewHandler.php";


$id = isCookiesThere();
if(!$id){
    session_name("Check_sing_in");
    session_start();
    header(("Location: /pages/Login/index.php"));
    session_write_close();
}
$postTitle = null;
$postDescription = null;
$postLanguage = null;
$postMainCategory = null;
$postSubCategory = null;
$postSize=null;
$postPublishedDate= null;
$postLikeCount =null;
$postCommentCount=null;
$postComments=null;
$postPublicationThumbnalFilePath=null;
$postPublicationPdfFilePath=null;
$pubid = null;


if($_SERVER["REQUEST_METHOD"]=="GET"){
    global $pubid;

    $pubid = (int)$_GET["prate"];
    $publicationDetails = getPublication($pubid,$id);

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
    $postPublicationThumbnalFilePath = getThumbnailLocation($id,$pubid);
    $postPublicationPdfFilePath = getPdfLocation($id,$pubid);
    $postComments = getComments($pubid,$id);
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
        <table>
            <tr>
                <td>Title</td>
                <td><input type="text" name="Title" readonly <?php echo "value = $postTitle"?>></td>
            </tr>
            <tr>
                <td>Thumbnail</td>
                <td><img <?php echo "src= $postPublicationThumbnalFilePath" ?>></td>
            </tr>
            <tr>
                <td>Publication</td>
                <td><a <?php echo "href = $postPublicationPdfFilePath" ?> download="download.pdf">Download</a></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name="Description" cols="30" rows="10" readonly style="resize: none;"><?php echo "$postDescription"?></textarea></td>
            </tr>
            <tr>
                <td>Language</td>
                <td><input type="text" name="Language" readonly <?php echo "value = $postLanguage"?>></td>
            </tr>
            <tr>
                <td>Size</td>
                <td><input type="text" name="Size" readonly <?php echo "value = $postSize"?>></td>
            </tr>
            <tr>
                <td>Published Date</td>
                <td><input type="text" name="Size" readonly <?php echo "value = $postPublishedDate"?>></td>
            </tr>
            <tr>
                <td>Main Category</td>
                <td><input type="text" name="Size" readonly <?php echo "value = $postMainCategory"?>></td>
            </tr>
            <tr>
                <td>Sub Category</td>
                <td><input type="text" name="Size" readonly <?php echo "value = $postSubCategory"?>></td>
            </tr>
            <tr>
                <td>Like Count</td>
                <td><input type="text" name="Size" readonly <?php echo "value = $postLikeCount"?>></td>
            </tr>
            <tr>
                <td>Comment Count</td>
                <td><input type="text" name="Size" readonly <?php echo "value = $postCommentCount"?>></td>
            </tr>
        </table>
        <?php 
            foreach ($postComments as $comment){
                echo "<h2>$comment</h2>";
            }
        ?>
        <?php
        echo "<a href='/pages/PublicationUpdate/index.php?prate=$pubid'>Update</a>";
        
        ?>
<a href="/pages/AuthorProfileView/index.php">Back</a>

<?php
    echo "<a href='/pages/PublicationDelete/index.php?prate=$pubid'>Delete</a>";
?>

</body>
</html>
