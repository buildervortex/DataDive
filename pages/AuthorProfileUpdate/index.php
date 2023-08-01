<?php

// ! HAVE TO DO THE PROFILE PICTURE DELETE PART
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/AuthorProfileUpdate/AuthorProfileUpdateHandler.php";
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/AuthorProfileView/AuthorProfileViewDatabaseHandler.php";


$id = isCookiesThere();
if(!$id){
    session_name("Check_sing_in");
    session_start();
    header(("Location: /pages/Login/index.php")); // TODO : change to redirect to the author profile view.
    session_write_close();
}


$userData = getUserData($id);
$userSkills = getUserSkills($id);
$userInterests = getUserInterests($id);
$userSocialMedia = getUserSocialMediaLinksWithId($id);
$userMainCategory = getMainCategory($id);

$postSocialMediaList=null;
$postInterestsList=null;
$postSkillsList=null;
$postUserName=null;
$postUserPassword=null;
$postUserEmail=null;
$postPhoneNumber=null;
$postBio=null;
$postCountryId=null;
$postFirstName=null;
$postMiddleName=null;
$postLastName=null;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postFirstName = $_POST["FirstName"];
    $postMiddleName = $_POST["MiddleName"];
    $postLastName = $_POST["LastName"];
    $postUserName = $_POST["UserName"];
    $postUserEmail = $_POST["Email"];
    $postPhoneNumber = $_POST["PhoneNumber"];
    $postUserPassword = $_POST["Password"];
    $postBio = $_POST["Bio"];
    $postCountryId = $_POST["Country"];
    $postInterestsList = $_POST["Interests"];
    $postSkillsList = $_POST["Skills"];



    if($_FILES["ProfilePicture"]["name"]!=""){
        $filename = $_FILES["ProfilePicture"]["name"];
        move_uploaded_file($_FILES["ProfilePicture"]["tmp_name"],__DIR__."/$filename");
        addProfilePicture($id,__DIR__."/$filename");
    }

    foreach($_POST as $key=>$item){
        if(is_numeric($key)){
            $postSocialMediaList[$key]=$item;
        }
    }
    updateUserDetails($id,$postFirstName,$postMiddleName,$postLastName,$postUserName,$postUserEmail,$postPhoneNumber,$postUserPassword,$postBio,$postCountryId,$postInterestsList,$postSkillsList,$postSocialMediaList);

    
    session_start();
    $_SESSION["ProfileUpdated"] = true;
    header(("Location: /pages/AuthorProfileView/index.php"));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/AuthorProfileUpdate.css">
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
    <?php
        echo "<img src='".getProfilePictureLocation($id)."'></img>";
    ?>
        <input type="file" name="ProfilePicture">
        <table>
            <?php
            echo "<tr>
            <td>First Name</td>
            <td><input type='text' name='FirstName' value = '" . $userData["FirstName"] . "' ></td>
        </tr>";
            ?>
            <?php
            echo "<tr>
            <td>Middle Name</td>
            <td><input type='text' name='MiddleName' value = '" . $userData["MiddleName"] . "' ></td>
        </tr>";
            ?>
            <?php
            echo "<tr>
            <td>Last Name</td>
            <td><input type='text' name='LastName' value = '" . $userData["LastName"] . "' ></td>
        </tr>";
            ?>
            <?php
            echo "<tr>
            <td>User Name</td>
            <td><input type='text' name='UserName' value = '" . $userData["UserName"] . "' ></td>
        </tr>";
            ?>
            <?php
            echo "<tr>
            <td>Email</td>
            <td><input type='email' name='Email' value = '" . $userData["Email"] . "' ></td>
        </tr>";
            ?>
            <?php
            echo "<tr>
            <td>Password</td>
            <td><input type='text' name='Password' value = '" . $userData["Password"] . "' ></td>
        </tr>";
            ?>
            <?php
            echo "<tr>
            <td>Number</td>
            <td><input type='text' name='PhoneNumber' value = '" . $userData["PhoneNumber"] . "' ></td>
        </tr>";
            ?>
            <?php
            echo "<tr>
            <td>Bio</td>
            <td><textarea name='Bio' cols='30' rows='10' style='resize: none;'>" . $userData["Bio"] . "</textarea></td>
        </tr>";
            ?>
            <tr>
                <td>Country</td>
                <td><select name='Country'>
                        <?php
                        $currentCountry = $userData["CountryId"];
                        $countrylistdata = CountryList();
                        foreach ($countrylistdata as $id => $name) {
                            if ($currentCountry == $id) {
                                echo "<option value='$id' selected>$name</option>";
                            } else {
                                echo "<option value='$id'>$name</option>";
                            }
                        }
                        ?>
                    </select></td>
            </tr>


            <div class="socialMediaContainer Override">
                <div class="accountAddingContainer Override">
                    <select name="socialMediaAccountType" class="socialMediaAccountType Override" id="Override">
                        <option value="null" class="Override">Choose Account Type</option>
                        <?php
                        foreach (SocialMediaList() as $Id => $Name) {
                            if (!array_key_exists($Id, $userSocialMedia)) {
                                echo "<option value='$Id' class='Override' AccountName='$Name'>$Name</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="url" name="socialMediaAccountUrl" placeholder="Add the url here" class="Override">
                    <button class="Override">Add</button>
                </div>
                <div class="addedAccountContainer Override">
                    <?php
                    foreach ($userSocialMedia as $ID => $values) {
                        echo "<div class='account'><h4>" . $values[0] . "</h4><input type='url' name='$ID' AccountId='$ID' value='" . $values[1] . "' readonly><button>Delete</button></div>";
                    }
                    ?>

                </div>
            </div>
            <div class="DropDownContainer first" name="Interests[]">
                <button class="DropDownContainerAddButton" name="AddButton">ADD</button>
                <?php
                foreach ($userInterests as $interest) {
                    echo "<div class='container'>";
                    echo "<input type='text' name='Interests[]' placeholder='Add Interests' value='$interest'>";
                    echo "<button class='Delete' name='DeleteButton'>Delete</button>";
                    echo "</div>";
                }
                ?>
            </div>

            <div class="DropDownContainer second" name="Skills[]">
                <button class="DropDownContainerAddButton" name="AddButton">ADD</button>
                <?php
                foreach ($userSkills as $skill) {
                    echo "<div class='container'>";
                    echo "<input type='text' name='Skills[]' placeholder='Add Skills' value='$skill'>";
                    echo "<button class='Delete' name='DeleteButton'>Delete</button>";
                    echo "</div>";
                }
                ?>
            </div>
        </table>
        <input type="submit" value="Save">

    </form>

    <a href="/pages/SingOut/index.php">Sing Out</a>
    <script src="./js/index.js"></script>
</body>

</html>
