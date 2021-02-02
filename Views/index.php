<?php if (!isset($_SESSION)) {session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="";
?>
<!-- == Early page == -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../Application/access/header.php") ?>
    </head>
    <body id="page-top">
        <!-- == view location == -->
            <?php if(isset($_SESSION['view-location'])){?>
                <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: block; padding-right: 15px; background: rgba(0, 0, 0, 0.781); " aria-modal="true" data-aos="fade-in" data-aos-delay="0">
                    <div class="col-md-12 m-auto text-center justify-content-center align-items-center">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3927.113059896756!2d123.60972794996468!3d-10.171464712581601!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c569ca955438a55%3A0x3379b2089a88b7f4!2sUGD%20HP%20Kupang%20NTT%20(perbaikan%20hp%20android%20%26%20laptop)%20%26%20pembuatan%20website!5e0!3m2!1sid!2sid!4v1611904338238!5m2!1sid!2sid" class="location-ar" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                <form action="" method="POST" class="mt-2">
                                    <button type="submit" name="close-view-location" class="btn btn-light btn-sm shadow">Close</button>
                                    <a href="https://goo.gl/maps/9TAhXjUW6VKJh1kR7" class="btn btn-dark btn-sm shadow ml-2" target="_blank">View More</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        <!-- == Early bg-video section == -->
            <div class="video-container">
                <video playsinline autoplay muted loop>
                    <source src="../Assets/video/landing-section-1.mp4" type="video/mp4">
                </video>
            </div>
        <?php require_once("../Application/access/navbar.php") ?>
        <!-- == Early section == -->
            <div class="container-fluid">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="col-lg-5 mx-5 my-5 col-one-section overflow-hidden">
                        <h1 class="d-flex montserrat text-light font-weight-bold" data-aos="fade-in" data-aos-delay="0">UGD <form action="" method="POST" class="overflow-hidden"><button type="submit" name="view-location" class="btn btn-sedgwick-ar font-weight-bold sedgwick mt-n1 text-light" data-toggle="tooltip" data-placement="right" title="Look at the service location here">HP</button></form></h1>
                        <div class="col-11 p-0">
                            <p class="comfortaa text-light" data-aos="fade-in" data-aos-delay="100">Cellphone and computer equipment repair services and website-based application development services.</p>
                        </div>
                        <div class="overflow-hidden pb-1" data-aos="fade-in" data-aos-delay="200">
                            <a href="#contact" class="btn btn-primary-ar btn-sm font-weight-bold p-2 mx-2 mt-3">Contact us!</a>
                        </div>
                    </div>
                    <div class="col-lg-6 my-auto" data-aos="fade-in" data-aos-delay="0">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="../Assets/img/img-web/landing section 1.png" class=" landing-image w-100 rounded" alt="landing section 1">
                                        </div>
                                        <div class="col-lg-4">
                                            <img src="../Assets/img/img-web/landing section 2.png" class=" landing-image w-100 rounded" alt="landing section 2">
                                        </div>
                                        <div class="col-lg-4">
                                            <img src="../Assets/img/img-web/landing section 3.png" class=" landing-image w-100 rounded" alt="landing section 3">
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="../Assets/img/img-web/landing section 1.png" class=" landing-image w-100 rounded" alt="landing section 1">
                                        </div>
                                        <div class="col-lg-4">
                                            <img src="../Assets/img/img-web/landing section 2.png" class=" landing-image w-100 rounded" alt="landing section 2">
                                        </div>
                                        <div class="col-lg-4">
                                            <img src="../Assets/img/img-web/landing section 3.png" class=" landing-image w-100 rounded" alt="landing section 3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php require_once("../Application/access/footer.php") ?>
    </body>
</html>