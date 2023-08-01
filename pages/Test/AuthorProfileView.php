<?php 
// ! EACH PUBLICATIONS VIEW HAVE TO GO TO THE PUBLICATION VIEW PAGE

include_once __DIR__."/../../php/lib/db/pages/AuthorProfileView/AuthorProfileViewDatabaseHandler.php";
$id = isCookiesThere();
if(!$id){
    session_name("Check_sing_in");
    session_start();
    header(("Location: ./SingIn.php")); // TODO : change to redirect to the author profile view.
    session_write_close();
}
$userData = getUserData($id);
$userSkills = getUserSkills($id);
$userInterests = getUserInterests($id);
$userSocialMedia = getUserSocialMediaLinks($id);
$userMainCategory = getMainCategory($id);
$publications = [];




if($_SERVER["REQUEST_METHOD"]=="POST"){
    $publications = getPublications($id,$_POST);
}
else{
    $publications = getPublications($id,[]);
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
        <?php
        echo $userData["UserName"]!=null?"<tr>
            <td>User Name</td>
            <td><input type='text' name='UserName' readonly value = '".$userData["UserName"]."' ></td>
        </tr>":"";
        ?>
        <?php
        echo $userData["FullName"]!=null?"<tr>
            <td>Full Name</td>
            <td><input type='text' name='FullName' readonly value = '".$userData["FullName"]."' ></td>
        </tr>":"";
        ?>
        <?php
        echo $userData["Dob"]!=null?"<tr>
            <td>Dob</td>
            <td><input type='date' name='Dob' readonly value = '".$userData["Dob"]."' ></td>
        </tr>":"";
        ?>
        <?php
        echo $userData["Email"]!=null?"<tr>
            <td>Email</td>
            <td><input type='email' name='Email' readonly value = '".$userData["Email"]."' ></td>
        </tr>":"";
        ?>
        <?php
        echo $userData["PhoneNumber"]!=null?"<tr>
            <td>Number</td>
            <td><input type='text' name='PhoneNumber' readonly value = '".$userData["PhoneNumber"]."' ></td>
        </tr>":"";
        ?>
        <?php
        echo $userData["Bio"]!=null?"<tr>
            <td>Bio</td>
            <td><textarea name='Bio' cols='30' rows='10' readonly style='resize: none;'>".$userData["Bio"]."</textarea></td>
        </tr>":"";
        ?>
        <?php
        echo $userData["Country"]!=null?"<tr>
            <td>Country</td>
            <td><input type='text' name='Country' readonly value = '".$userData["Country"]."' ></td>
        </tr>":"";
        ?>
        <?php
        echo $userData["Ratings"]!=null?"<tr>
            <td>Country</td>
            <td><input type='text' name='Ratings' readonly value = '".$userData["Ratings"]."' ></td>
        </tr>":"";
        ?>
        <?php
        echo $userData["PublicationCount"]!=null?"<tr>
            <td>Publication Count</td>
            <td><input type='text' name='PublicationCount' readonly value = '".$userData["PublicationCount"]."' ></td>
        </tr>":"";
        ?>
        <?php
        if(count($userSkills)!=0){
        echo "<tr><td>Skills</td><td><ul>";
            foreach ($userSkills as $skill){
                echo "<li> $skill</li>";
            }
        echo "</ul></td></tr>";
        }
        ?>
        <?php
        if(count($userInterests)!=0){
        echo "<tr><td>Interests</td><td><ul>";
            foreach ($userInterests as $insertest){
                echo "<li> $insertest</li>";
            }
        echo "</ul></td></tr>";
        }
        ?>
        <?php
        if(count($userSocialMedia)!=0){

            echo "<tr><td>Social Media</td><td><table>";
            foreach ($userSocialMedia as $Media=>$url){

                echo"<tr>
                        <td>$Media</td>
                        <td>$url</td>
                    </tr>";
            }
            echo "</table></td></tr>";
        }
        ?>
    </table>
    <h1>Publications</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="categorySelectionContainer Override">
        <select name="mainCategorySelector" class="mainCategorySelector Override">
            <option value='0' class='Override'>Select The Main Category</option>
            <?php
                foreach($userMainCategory as $ID => $Name){
                    echo "<option value='$ID' class='Override'>$Name</option>";
                }
            ?>
        </select>
        <select name="subCategorySelector" class="subCategorySelector Override">
            <option value="0" class="Override">Select The Sub Category</option>
        </select>
    </div>

    <input type="radio" name="FBL">
    <input type="radio" name="FBC" >
    <input type="radio" name="FBD">
    <input type="search" name="FBS">

    <input type="submit" value="Submit">
</form>
<style>
    .Cardcontainer .card{
        background-color: aqua;
        padding: 20px;
        margin: 20px;
        cursor: pointer;
    }
</style>
<?php 
echo "<div class='Cardcontainer'>";
foreach($publications as $publication)
{
    echo "<div class='card' style='background-color:aqua;'>";
        echo "<div style='display:none;' id='ThePublicationIdForRedirection' name='".$publication["PublicationId"]."'>".$publication["PublicationId"]."</div>";
        echo "<div class='title'>".$publication["Title"]."</div>"; // TODO : CHECK THE THUMBNAILS
        echo "<img src='".getThumbnailLocation($id,$publication["PublicationId"])."' class='thumbnail'>";
        echo "<div class='likecount'>".$publication["LikeCount"]."</div>";
        echo "<div class='commentcount'>".$publication["CommentCount"]."</div>";
    echo "</div>";
}
echo "</div>";

?>
<a href="./AuthorProfileDelete.php">Delete</a>
<a href="./AuthorProfileUpdate.php">Update</a>
<a href="./SingOut.php">Sing Out</a>
<a href="./PublicationCreateView.php">Create Publication</a>
<script src="./js/AuthorProfileView.js"></script>
<script>
    // ! HAVE TO INCLUDE SENDS THE PUBLICATION ID TO THE PUBLICATION VIEW PAGE
    let AuthorProfileViewCards = document.querySelectorAll(".Cardcontainer .card");
    AuthorProfileViewCards.forEach(e=>{
        e.addEventListener("click",()=>{
            let publicationId = parseInt(e.querySelector("#ThePublicationIdForRedirection").getAttribute("name"));
            console.log(publicationId);
            window.location.href="./PublicationAuthorView.php?prate="+publicationId;
            
        });
    });
</script>
</body>
</html>