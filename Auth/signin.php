<?php if (!isset($_SESSION)) {session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']=" - Sign In";$_SESSION['auth']=1;
?>

<!-- == Sign In page == -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../Application/access/header.php") ?>
    </head>
    <body>
        <!-- == Sign In bg-video section == -->
            <div class="video-news">
                <video playsinline autoplay muted loop>
                    <source src="../Assets/video/landing-section.mp4" type="video/mp4">
                </video>
            </div>
        <?php require_once("../Application/access/navbar.php") ?>
        <!-- == Sign In section == -->
            <div class="container-fluid">
                <div class="d-flex justify-content-start flex-wrap contact">
                    <div class="col-lg-6 col-one-section overflow-hidden animated-ar">
                        <img src="../Assets/img/img-web/signin.png" alt="image signin" style="width: 450px">
                    </div>
                    <div class="col-lg-5 my-auto m-0 p-0" data-aos="fade-in" data-aos-delay="0">
                        <div class="col-md-10 mx-auto">
                            <div class="card border-0 shadow">
                                <div class="card-body m-auto text-center">
                                    <h3 class="text-dark font-weight-bold montserrat">Sign In</h3>
                                    <p class="text-dark comfortaa d-flex flex-wrap">Don't have an account yet? please register <a href="signup" class="nav-link m-auto text-decoration-none">here.</a></p>
                                    <?php if(isset($message_success)){echo $message_success;}if(isset($message_danger)){echo$message_danger;}?>
                                    <form method="POST" action="" class="mt-4">
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Email" class="form-control  shadow text-center border-0 text-dark" required style="background: #F1F1F1">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" placeholder="Password" class="form-control shadow text-center border-0 text-dark" required style="background: #F1F1F1">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group pl-2">
                                                    <input type="checkbox" name="remember-me" class="form-check-input" id="remember me">
                                                    <label class="form-check-label" for="remember me">Remember me?</label>
                                                    <button type="button" class="btn btn-link btn-sm mt-n3 ml-n2" data-toggle="tooltip" data-placement="bottom" title="If your account login session you want to keep in mind this input checklist!">
                                                        <i class="fas fa-question-circle text-secondary"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mt-n2">
                                                    <a href="forget-password" class="nav-link text-decoration-none">Forget Password</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="signin" class="btn btn-success btn-sm shadow border-0">Sign In</button>
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