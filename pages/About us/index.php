<?php
$DOCUEMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
include_once $DOCUEMENT_ROOT . "/php/lib/db/pages/HomePageHandler/homePageHandler.php";


$id = isCookiesThere();

if (!$id) {
    global $id;
    $id = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
    <main class="Override">
        <h1 class="our-team">Our Team</h1>
        <section class="carosal Override">
            <img src="/shared/icon/carousel/leftArrow.png" id="leftArrow" class="carosalArrows Override">
            <div class="carosalContainer Override">
                <div class="cards Override">
                    <img src="./img/carousel/cardimage.jpeg" class="Override" />
                    <h3 class="Override">Lahiru dilhara</h3>
                    <div class="description Override">BSc(Hons) in Computer Science</div>
                    <div class="icons">
                        <a href="#">
                            <i class="fab fa-facebook"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-github"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>"
                        </a>

                    </div>
                </div>
                <div class="cards Override">
                    <img src="./img/carousel/nuwan.jpg" class="Override" />
                    <h3 class="Override">Nuwan thilakarathna</h3>
                    <div class="description Override">BSc(Hons) in Software Engineering</div>
                    <div class="icons">
                        <a href="#">
                            <i class="fab fa-facebook"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-github"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>"
                        </a>

                    </div>
                </div>
                <div class="cards Override">
                    <img src="./img/carousel/ravindu.jpg" class="Override" />
                    <h3 class="Override">Ravindu senanayake</h3>
                    <div class="description Override">BSc(Hons) in Software Engineering</div>
                    <div class="icons">
                        <a href="#">
                            <i class="fab fa-facebook"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-github"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>"
                        </a>

                    </div>

                </div>
                <div class="cards Override">
                    <img src="./img/carousel/akash.jpg" class="Override" />
                    <h3 class="Override">Akash hettiarachchi</h3>
                    <div class="description Override">BSc(Hons) in Software Engineering</div>
                    <div class="icons">
                        <a href="#">
                            <i class="fab fa-facebook"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-github"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>"
                        </a>

                    </div>
                </div>
                <div class="cards Override">
                    <img src="./img/carousel/janith.jpg" class="Override" />
                    <h3 class="Override">Janith weerathunga</h3>
                    <div class="description Override">BSc(Hons) in Software Engineering</div>
                    <div class="icons">
                        <a href="#">
                            <i class="fab fa-facebook"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-github"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>"
                        </a>

                    </div>
                </div>
                <div class="cards">
                    <img src="./img/carousel/achintha.jpg" class="" />
                    <h3 class="Override">Achintha rajasinghe</h3>
                    <div class="description Override">BSc(Hons) in Software Engineering</div>
                    <div class="icons">
                        <a href="#">
                            <i class="fab fa-facebook"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-github"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>"
                        </a>

                    </div>
                    </tr>


                </div>
                <div class="cards Override">
                    <img src="./img/carousel/lakmal.jpg" class="Override" />
                    <h3 class="Override">Kasun lakmal</h3>
                    <div class="description Override">BSc(Hons) in Software Engineering</div>
                    <div class="icons">
                        <a href="#">
                            <i class="fab fa-facebook"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-github"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>"
                        </a>

                    </div>

                </div>
                <div class="cards Override">
                    <img src="./img/carousel/hashan.jpg" class="Override" />
                    <h3 class="Override">heshan hansaka</h3>
                    <div class="description Override">BSc(Hons) in Software Engineering</div>
                    <div class="icons">
                        <a href="#">
                            <i class="fab fa-facebook"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-github"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>"
                        </a>

                    </div>
                </div>
                <div class="cards Override">
                    <img src="./img/carousel/kalpani.jpg" class="Override" />
                    <h3 class="Override">Kalpani devindi</h3>
                    <div class="description Override">BSc(Hons) in Software Engineering</div>
                    <div class="icons">
                        <a href="#">
                            <i class="fab fa-facebook"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-github"></i>"
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>"
                        </a>

                    </div>
                </div>
                <span class="overlay"></span>
            </div>
            </div>
            <img src="/shared/icon/carousel/rightArrow.png" id="rightArrow" class="carosalArrows Override">
        </section>
        <div class="description-container">

            <h3>We are from NSBM Green University </h3>

            <img src="./img/NSBM.jpg">

            <p class="page-description"><a href="https://www.nsbm.ac.lk"> NSBM Green University,</a> the nation’s premier degree-awarding institute, is the first of its kind in South Asia. It is a government-owned self-financed institute that operates under the purview of the Ministry of Education. As a leading educational centre in the country, NSBM has evolved into becoming a highly responsible higher education institute that offers unique opportunities and holistic education on par with international standards while promoting sustainable living. NSBM offers a plethora of undergraduate and postgraduate degree programmes under five faculties: Business, Computing, Engineering, Science and Postgraduate & Professional Advancement. These study programmes at NSBM are either its own programmes recognised by the University Grants Commission and the Ministry of Higher Education or world-class international programmes conducted in affiliation with top-ranked foreign universities such as University of Plymouth, UK, and Victoria University, Australia. Focused on producing competent professionals and innovative entrepreneurs for the increasingly globalising world, NSBM nurtures its graduates to become productive citizens of society with their specialisation ranging in study fields such as Business, Management, Computing, IT, Engineering, Science, Psychology, Nursing, Interior design, Quantity Surveying, Law and Multimedia. Inspired by the vision of being Sri Lanka’s best-performing graduate school and being recognised internationally, NSBM currently achieves approximately 3000 new enrollments per year and houses above 11,000 students reading over 50 degree programmes under 4 faculties. Moreover, over the years, NSBM Green University has gifted the nation with 14,000+ graduates and has proved its global presence with an alumni network spread all across the world. Nestling on a 40-acre land amidst the greenery and serenity in Pitipana, Homagama, NSBM Green University, is an ultra-modern university complex constructed with stateof-the-art facilities and amenities that provides the perfect setting for high-quality teaching, learning and research. </p>

        </div>
    </main>
    <footer class="Override"></footer>


    <script type="module" src="./js/index.js"></script>
</body>

</html>