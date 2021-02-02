<?php if (!isset($_SESSION)) {session_start();}$_SESSION['auth']=1;
    require_once("../Application/session/cookie-auth.php");
    require_once("../Application/session/redirect-visitor.php");
    require_once("../Application/controller/script.php");
    if(!isset($_GET['auth'])){header("Location: signup");exit;}
    $_SESSION['page-name']=" - Verification";
?>

<!-- == Verification page == -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../Application/access/header.php") ?>
    </head>
    <body>
        <!-- == Verification bg-video section == -->
            <div class="video-news">
                <video playsinline autoplay muted loop>
                    <source src="../Assets/video/landing-section-2.mp4" type="video/mp4">
                </video>
            </div>
        <?php require_once("../Application/access/navbar.php") ?>
        <!-- == Verification section == -->
            <div class="container-fluid">
                <div class="d-flex justify-content-between flex-wrap verification">
                    <div class="col-lg-5 mx-5 my-5 col-one-section overflow-hidden">
                        <h1 class="montserrat text-dark font-weight-bold" data-aos="fade-in" data-aos-delay="0">Verification</h1>
                        <div class="col-11 p-0">
                            <p class="comfortaa text-dark" data-aos="fade-in" data-aos-delay="100">Please check your email account for the verification code link and click the link we have sent to your email for verification.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 my-auto m-0 p-0" data-aos="fade-in" data-aos-delay="0">
                        <img src="../Assets/img/img-web/send-verification-email.png" alt="image signin">
                    </div>
                </div>
            </div>
        <?php require_once("../Application/access/footer.php") ?>
    </body>
</html>