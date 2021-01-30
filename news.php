<?php if (!isset($_SESSION)) {session_start();}
    if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
    require_once("Application/session/redirect-user.php");
    require_once("Application/controller/script.php");
    $_SESSION['page-name']=" - News";
?>

<!-- == News page == -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("Application/access/header.php") ?>
    </head>
    <body>
        <!-- == News bg-video section == -->
            <div class="video-news">
                <video playsinline autoplay muted loop>
                    <source src="Assets/video/landing-section-1.mp4" type="video/mp4">
                </video>
            </div>
        <?php require_once("Application/access/navbar.php") ?>
        <!-- == News section == -->
            <div class="container-fluid">
                <div class="d-flex justify-content-start flex-wrap news">
                    <div class="col-lg-6 mx-5 my-5 col-one-section overflow-hidden">
                        <h1 class="d-flex montserrat font-weight-bold" data-aos="fade-in" data-aos-delay="0">News</h1>
                        <div class="col-11 p-0">
                            <p class="comfortaa" data-aos="fade-in" data-aos-delay="100">The latest news every day here, stay tuned!</p>
                        </div>
                    </div>
                    <div class="col-lg-5 my-auto m-0 p-0" data-aos="fade-in" data-aos-delay="0">
                        <div id="news" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner content-news">
                                <div class="carousel-item active">
                                    <img src="Assets/img/img-web/news-image.png" class="d-block w-100 rounded" alt="news-image">
                                </div>
                                <div class="carousel-item">
                                    <div class="card border-0 shadow">
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0 comfortaa">
                                                <h6 class="text-dark font-weight-bold">Judul</h6>
                                                <p class="small text-dark comfortaa">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                <footer class="blockquote-footer text-dark" style="font-size: 12px">Friday, 27 Aug 2020</footer>
                                            </blockquote>
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