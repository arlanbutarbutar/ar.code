<?php if (!isset($_SESSION)) {session_start();}$_SESSION['auth']=1;
    require_once("../Application/session/cookie-auth.php");
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/controller/script.php");
    if(!isset($_SESSION['email'])){header("Location: forgot-password");exit;}
    $_SESSION['page-name']=" - New Password";
?>

<!-- == New Password page == -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../Application/access/header.php") ?>
    </head>
    <body>
        <!-- == New Password bg-video section == -->
            <div class="video-news">
                <video playsinline autoplay muted loop>
                    <source src="../Assets/video/landing-section.mp4" type="video/mp4">
                </video>
            </div>
        <?php require_once("../Application/access/navbar.php") ?>
        <!-- == New Password section == -->
            <div class="container-fluid">
                <div class="d-flex justify-content-start flex-wrap contact">
                    <div class="col-lg-6 col-one-section overflow-hidden animated-ar">
                        <img src="../Assets/img/img-web/new-password.png" alt="image new password">
                    </div>
                    <div class="col-lg-5 my-auto m-0 p-0" data-aos="fade-in" data-aos-delay="0">
                        <div class="col-md-10 mx-auto">
                            <div class="card border-0 shadow">
                                <div class="card-body m-auto text-center">
                                    <h3 class="text-dark font-weight-bold montserrat">New Password</h3>
                                    <p class="text-dark text-center comfortaa">Please enter your new password!</p>
                                    <?php if(isset($message_success)){echo $message_success;}if(isset($message_danger)){echo$message_danger;}?>
                                    <form method="POST" action="" class="mt-4">
                                        <div class="form-group">
                                            <input type="password" name="password" placeholder="Password" class="form-control  shadow text-center border-0 text-dark" required style="background: #F1F1F1">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="re-password" placeholder="re-Password" class="form-control  shadow text-center border-0 text-dark" required style="background: #F1F1F1">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="new-password" class="btn btn-success btn-sm shadow border-0">Apply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php require_once("../Application/access/footer.php") ?>
    </body>
</html>