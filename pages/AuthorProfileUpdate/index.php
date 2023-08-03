<?php

// ! HAVE TO DO THE PROFILE PICTURE DELETE PART
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/AuthorProfileUpdate/AuthorProfileUpdateHandler.php";
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/AuthorProfileView/AuthorProfileViewDatabaseHandler.php";


$id = isCookiesThere();
if (!$id) {
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

$postSocialMediaList = null;
$postInterestsList = null;
$postSkillsList = null;
$postUserName = null;
$postUserPassword = null;
$postUserEmail = null;
$postPhoneNumber = null;
$postBio = null;
$postCountryId = null;
$postFirstName = null;
$postMiddleName = null;
$postLastName = null;



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



    if ($_FILES["ProfilePicture"]["name"] != "") {
        $filename = $_FILES["ProfilePicture"]["name"];
        move_uploaded_file($_FILES["ProfilePicture"]["tmp_name"], __DIR__ . "/$filename");
        addProfilePicture($id, __DIR__ . "/$filename");
    }

    foreach ($_POST as $key => $item) {
        if (is_numeric($key)) {
            $postSocialMediaList[$key] = $item;
        }
    }
    updateUserDetails($id, $postFirstName, $postMiddleName, $postLastName, $postUserName, $postUserEmail, $postPhoneNumber, $postUserPassword, $postBio, $postCountryId, $postInterestsList, $postSkillsList, $postSocialMediaList);


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
    <main>
        <form action="" method="post" enctype="multipart/form-data">
            <header class="UserDetails">
                <div class="profilePicture">
                    <?php
                    echo "<img src='" . getProfilePictureLocation($id) . "'></img>";
                    ?>
                    <input type="file" name="ProfilePicture" id="ProfilePicture">
                    <?php
                    echo "<div class='Password'>
                    <h2>Password</h2>
                    <input type='text' name='Password' value = '" . $userData["Password"] . "' placeholder='Enter the Passworld'></div>";
                    ?>
                    <input type="submit" value="Save">

                </div>
                <div class="About">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#00cba9" fill-opacity="1" d="M0,192L34.3,192C68.6,192,137,192,206,192C274.3,192,343,192,411,208C480,224,549,256,617,256C685.7,256,754,224,823,202.7C891.4,181,960,171,1029,181.3C1097.1,192,1166,224,1234,208C1302.9,192,1371,128,1406,96L1440,64L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path>
                    </svg>
                    <div>
                        <h1>About</h1>
                        <div>

                            <?php
                            echo "
            <h2>Email</h2>
            <input type='email' name='Email' value = '" . $userData["Email"] . "' placeholder='Enter the email' >";
                            ?>
                            <?php
                            echo "
            <h2>Number</h2>
            <input type='text' name='PhoneNumber' value = '" . $userData["PhoneNumber"] . "' placeholder='Enter the Mobile Number'>";
                            ?>
                            <h2>Social Media</h2>
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
                        </div>
                    </div>
                </div>
                <div class="Bio">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#00cba9" fill-opacity="1" d="M0,192L34.3,192C68.6,192,137,192,206,192C274.3,192,343,192,411,208C480,224,549,256,617,256C685.7,256,754,224,823,202.7C891.4,181,960,171,1029,181.3C1097.1,192,1166,224,1234,208C1302.9,192,1371,128,1406,96L1440,64L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path>
                    </svg>
                    <div>
                        <?php
                        echo "
            <h2>Bio</h2>";
                        echo "<div class='textareaContainer Override'>";
                        echo "<textarea name='Bio' id='limitedtextarea' class='limitedtextarea Override' placeholder='Enter the description' cols='60' rows='10'>".$userData["Bio"]."</textarea>";
                        echo "<h5 class='errorMessage Override'>The maximum number of characters have added</h5></div>";
                        ?>
                        <h2>Interests</h2>
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
                        <h2>Skills</h2>
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
                    </div>
                </div>
                <div class="Rating">
                    <div>
                        <?php
                        echo "
            <h2>User Name</h2>
            <input placeholder='Enter the User Name' type='text' name='UserName' value = '" . $userData["UserName"] . "' >";
                        ?>
                        <?php
                        echo "
            <h2>First Name</h2>
            <input placeholder='Enter the First Name' type='text' name='FirstName' value = '" . $userData["FirstName"] . "' >";
                        ?>
                        <?php
                        echo "
            <h2>Middle Name</h2>
        <input placeholder='Enter the Middle Name' type='text' name='MiddleName' value = '" . $userData["MiddleName"] . "' >";
                        ?>
                        <?php
                        echo "
            <h2>Last Name</h2>
            <input placeholder='Enter the Last Name' type='text' name='LastName' value = '" . $userData["LastName"] . "' >";
                        ?>
                        <h2>Country</h2>
                        <select name='Country'>
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
                        </select>
                    </div>
                </div>

        </form>
        </header>
    </main>
    <script src="./js/index.js" type="module"></script>
    <script src="./js/profilePicture.js"></script>
</body>

</html>