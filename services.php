<?php if (!isset($_SESSION)) {session_start();}
    require_once("Application/session/cookie-auth.php");
    if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
    require_once("Application/session/redirect-visitor.php");
    require_once("Application/controller/script.php");
    $_SESSION['page-name']=" - Services";
?>

<!-- == Services page == -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("Application/access/header.php") ?>
    </head>
    <body>
        <!-- == Services bg-video section == -->
            <div class="video-news">
                <video playsinline autoplay muted loop>
                    <source src="Assets/video/landing-section-1.mp4" type="video/mp4">
                </video>
            </div>
        <?php require_once("Application/access/navbar.php") ?>
        <!-- == Services section == -->
            <div class="container-fluid">
                <div class="d-flex justify-content-start flex-wrap services">
                    <div class="col-lg-6 mx-5 my-5 col-one-section overflow-hidden">
                        <h1 class="d-flex montserrat font-weight-bold" data-aos="fade-in" data-aos-delay="0">Services</h1>
                        <div class="col-11 p-0 overflow-hidden">
                            <p class="comfortaa" data-aos="fade-in" data-aos-delay="100">The services we offer to you. If interested please contact us!</p>
                        </div>
                        <div class="overflow-hidden pb-1" data-aos="fade-in" data-aos-delay="200">
                            <a href="contact" class="btn btn-primary-ar btn-sm font-weight-bold p-2 mx-2 mt-3">Contact us!</a>
                        </div>
                    </div>
                    <div class="col-lg-5 my-auto m-0 p-0" data-aos="fade-in" data-aos-delay="0">
                        <div id="news" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner content-news">
                                <div class="carousel-item active">
                                    <div class="card border-0 shadow text-center">
                                        <img class="card-image m-auto w-50" src="Assets/img/img-web/video-call.svg" alt="alternative">
                                        <div class="card-body">
                                            <h4 class="card-title overflow-hidden pb-1">Handphone</h4>
                                            <p>Repair cellphones from minor to severe damage with various types of mobile brands.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="card border-0 shadow text-center" data-aos="fade-in" data-aos-delay="100">
                                        <img class="card-image m-auto w-50" src="Assets/img/img-web/044-error.png" alt="alternative">
                                        <div class="card-body">
                                            <h4 class="card-title overflow-hidden pb-1">Laptop/PC</h4>
                                            <p>Resolving problems that occur in the Laptop program and repairing Laptop hardware to completion.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="card border-0 shadow text-center" data-aos="fade-in" data-aos-delay="300">
                                        <img class="card-image m-auto w-50" src="Assets/img/img-web/026-code.png" alt="alternative">
                                        <div class="card-body">
                                            <h4 class="card-title overflow-hidden pb-1">Web Developer</h4>
                                            <p>Creating a Website-based Application with a complex and systematic design.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="card border-0 shadow text-center" data-aos="fade-in" data-aos-delay="600">
                                        <img class="card-image m-auto w-50" src="Assets/img/img-web/responsive.svg" alt="alternative">
                                        <div class="card-body">
                                            <h4 class="card-title overflow-hidden pb-1">Web Design</h4>
                                            <p>Provides convenience in accessing a website and optimal use. We also prioritize security and user security on our UI & UX.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php require_once("Application/access/footer.php") ?>
    </body>
</html>