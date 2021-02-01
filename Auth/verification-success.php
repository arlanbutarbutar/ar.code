<?php if (!isset($_SESSION)) {session_start();}$_SESSION['auth']=1;
    require_once("../Application/session/cookie-auth.php");
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/controller/script.php");
    if(!isset($_GET['auth']) && !isset($_GET['crypt'])){
        header("Location: signup");exit;
    }else if(isset($_GET['auth']) && isset($_GET['crypt'])){
        $_POST['auth']=$_GET['auth'];
        $_POST['crypt']=$_GET['crypt'];
        if(verification($_POST)){}
    }
    $_SESSION['page-name']=" - Verification Success";
?>

<!-- ==Verification Success page == -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../Application/access/header.php") ?>
    </head>
    <body>
        <!-- ==Verification Success bg-video section == -->
            <div class="video-news">
                <video playsinline autoplay muted loop>
                    <source src="../Assets/video/landing-section-2.mp4" type="video/mp4">
                </video>
            </div>
        <?php require_once("../Application/access/navbar.php") ?>
        <!-- ==Verification Success section == -->
            <div class="container-fluid">
                <div class="d-flex justify-content-between flex-wrap verification-success">
                    <div class="col-lg-5 mx-5 my-5 col-one-section overflow-hidden">
                        <h1 class="montserrat text-dark font-weight-bold" data-aos="fade-in" data-aos-delay="0">Verification Success</h1>
                        <div class="col-11 p-0">
                            <p class="comfortaa text-dark" data-aos="fade-in" data-aos-delay="100">Congratulations, your account has been successfully verified, now you can enter our site.</p>
                        </div>
                        <div class="overflow-hidden pb-1" data-aos="fade-in" data-aos-delay="200">
                            <a href="signin" class="btn btn-primary-ar btn-sm font-weight-bold p-2 mx-2 mt-3">Sign In!</a>
                        </div>
                    </div>
                    <div class="col-lg-6 my-auto m-0 p-0" data-aos="fade-in" data-aos-delay="0">
                        <img src="../Assets/img/img-web/account-verify.png" alt="image signin">
                    </div>
                </div>
            </div>
        <?php require_once("../Application/access/footer.php") ?>
    </body>
</html>