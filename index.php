<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT."/php/lib/db/pages/HomePageHandler/homePageHandler.php";


$id = isCookiesThere();

if(!$id){
    global $id;
    $id =null;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    
    <link rel="stylesheet" href="/css/css/style.css" />
    <link rel="stylesheet" href="/shared/css/navBar/navBarStyle.css" />

    <link rel="stylesheet" href="/css/css/main/heading/pageHead.css" />
    <link rel="stylesheet" href="/shared/css/carousel/carousel.css" />
    <link rel="stylesheet" href="/shared/css/footer/footer.css"/>

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
    <main>
        <header class="pageHead">
            <div class="container">
                <h1>"Empower Humanity With Your Knowledge"</h1>
                <div class="searchBar">
                    <script>function submitForm(){document.getElementById("searchbarform").submit();}</script>
                    <form action="/pages/Category/index.php" id="searchbarform" method="post">
                        <input name="FBS" type="text" placeholder="Search" />
                        <img onclick="submitForm()" src="./icon/icon/main/heading/searchIcon.png" id="searchIcon" />
                    </form>
                </div>
            </div>
        </header>
        <section class="carosal">
            <img src="/shared/icon/carousel/leftArrow.png" id="leftArrow" class="carosalArrows">
            <div class="carosalContainer">
                <div class="cards">
                    <img src="/shared/img/carousel/information.jpg"/>
                    <h1>Information Technology</h1>
                    <div class="description"><b>Data Revolution:</b> Pushing the Posibilities of Cyber Environment, over the Imaginary Probability by Innovating, Transforming & Elevating the existing uses of Information & Resources. </div>
                </div>
                <div class="cards">
                    <img src="/shared/img/carousel/science.jpg"/>
                    <h1>Science with Human-Being </h1>
                    <div class="description"><b>Pursuit of Truth:</b> Cruising through the Universe of Mysteries & Expanding the Vision of Everything by Exploring new Theories & Uncovering new Dimentions to put a Forward Step as a whole Humanity.</div>
                </div>
                <div class="cards">
                    <img src="/shared/img/carousel/maths.jpg"/>
                    <h1>Mathematics & Statistical Logics</h1>
                    <div class="description"><b>Symphony of Equations:</b> Indicating the ways of  Unlocking the Gates of Patterns & Possibilities by the Keys of Creativity & Precision to Uncover Numerical Secrets</div>
                </div>
                <div class="cards">
                    <img src="/shared/img/carousel/graphic.jpg"/>
                    <h1>Graphics with Digitalism</h1>
                    <div class="description"><b>Creating Imaginary Realties:</b> Embracing the World of Digital-Arts that Pushes the Pixels to Perfect Combinations</div>
                </div>
                <div class="cards">
                    <img src="/shared/img/carousel/business.png"/>
                    <h1>Business & Enterpreneurship</h1>
                    <div class="description"><b>Venturing into Success:</b> Observing the Dynamics of Economic Interraction & Empower the Innovative Mind to build-up from Startup to Success</div>
                </div>
                <div class="cards">
                    <img src="/shared/img/carousel/language.png"/>
                    <h1>Languages, Culture & Diversity</h1>
                    <div class="description"><b>Beyond Borders:</b> Breaking the Barriers of Comphrehension, Expression, Literation & Communication to Strengthen the Bonds of Humanity.</div>
                </div>
                <div class="cards">
                    <img src="/shared/img/carousel/art.jpg"/>
                    <h1>Art with Creativity</h1>
                    <div class="description"><b>Unbound Imagination:</b> Exploring the Depths of Artistic Expression by A Language Without Boundaries, Spoken by the Heart that expresses The Emotive Power of Visual Art.</div>
                </div>
                <div class="cards">
                    <img src="/shared/img/carousel/music.jpg"/>
                    <h1>Rhythm & Music</h1>
                    <div class="description"><b>Heartbeat of Art:</b> Perfect Combination of  Tones, Melodies and Vocals in Perfect Dose, that's the core of a Rhythmic SoundWave which gives Supreme Sensation.</div>
                </div>
                <div class="cards">
                    <img src="/shared/img/carousel/interests.jpg"/>
                    <h1>Lifestyle & Interests</h1>
                    <div class="description"><b>Art of Living:</b> Harmonizing Health, Work and Pleasure in day-to-day Routine by Finding New Methods of Living with Joy and Making the Best Choices on Every Instance.</div>
                </div>
            </div>
            <img src="/shared/icon/carousel/rightArrow.png" id="rightArrow" class="carosalArrows">
        </section>
    </main>
    
    <footer class="footer">
        <div class="container">
         <div class="row">
           <div class="footer-col">
             <h4>Website</h4>
             <ul>
               <li><a href="#">Explore</a></li>
               <li><a href="#">About Us</a></li>
               <li><a href="#">Services</a></li>
               <li><a href="#">Help</a></li>
             </ul>
           </div>
           <div class="footer-col">
             <h4>Operations</h4>
             <ul>
               <li><a href="#">Create Account</a></li>
               <li><a href="#">User Login</a></li>
               <li><a href="#">Category Requests</a></li>
               <li><a href="#">Report a Problem</a></li>
             </ul>
           </div>
           <div class="footer-col">
             <h4>Quick Links</h4>
             <ul>
               <li><a href="#">User Profile</a></li>
               <li><a href="#">Publish</a></li>
               <li><a href="#">Your Posts</a></li>
               <li><a href="#">Instructions </a></li>
             </ul>
           </div>
           <div class="footer-col">
             <h4>Get Connected</h4>
             <div class="social-links">
                <a href="https://www.gmail.com"><i class="fab fa-email"><img src="/shared/icon/footer/icons8-email-67.png" height="40cqh" width="40cqh"></i></a>
                <a href="https://www.github.com"><i class="fab fa-github"><img src="/shared/icon/footer/icons8-github-64.png"height="40cqh" width="40cqh"></i></a>
                <a href="https://www.facebook.com"><i class="fab fa-facebook-f"><img src="/shared/icon/footer/icons8-facebook-50.png" height="40cqh" width="40cqh"></i></a>
                <a href="https://www.linkedin.com"><i class="fab fa-linkedin-in"><img src="/shared/icon/footer/icons8-linked-in-50.png" height="40cqh" width="40cqh"></i></a>
                <div>
                    <br><p id="bbv">#BinaryBuilderVorteX</p>
                    <p id="bbv">#TeamEffort @ 2023</p>
                </div>
             </div>
           </div>
         </div>
        </div>
     </footer>
    
    <script type="module" src="./js/js/index.js"></script>

</body>

</html>