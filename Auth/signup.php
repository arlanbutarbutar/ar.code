<?php if (!isset($_SESSION)) {session_start();}$_SESSION['auth']=1;
    require_once("../Application/session/cookie-auth.php");
    require_once("../Application/session/redirect-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']=" - Sign Up";
?>

<!-- == Sign Up page == -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../Application/access/header.php") ?>
    </head>
    <body>
        <!-- == Sign Up bg-video section == -->
            <div class="video-news">
                <video playsinline autoplay muted loop>
                    <source src="../Assets/video/landing-section.mp4" type="video/mp4">
                </video>
            </div>
        <?php require_once("../Application/access/navbar.php") ?>
        <!-- == Sign Up section == -->
            <div class="container-fluid">
                <div class="d-flex justify-content-start flex-wrap contact">
                    <div class="col-lg-6 col-one-section overflow-hidden animated-ar">
                        <img src="../Assets/img/img-web/signup.png" alt="image signup">
                    </div>
                    <div class="col-lg-5 my-auto m-0 p-0" data-aos="fade-in" data-aos-delay="0">
                        <div class="col-md-10 mx-auto">
                            <div class="card border-0 shadow">
                                <div class="card-body m-auto text-center">
                                    <h3 class="text-dark font-weight-bold montserrat">Sign Up</h3>
                                    <p class="text-dark justify-content-center comfortaa d-flex flex-wrap">Already have an account? please sign in <a href="signin" class="nav-link m-auto text-decoration-none">here.</a></p>
                                    <?php if(isset($message_success)){echo $message_success;}if(isset($message_danger)){echo$message_danger;}?>
                                    <form method="POST" action="" class="mt-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" name="first-name" placeholder="First Name" class="form-control  shadow text-center border-0 text-dark" required style="background: #F1F1F1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" name="last-name" placeholder="Last Name" class="form-control  shadow text-center border-0 text-dark" required style="background: #F1F1F1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Email" class="form-control  shadow text-center border-0 text-dark" required style="background: #F1F1F1">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" placeholder="Password" class="form-control shadow text-center border-0 text-dark" required style="background: #F1F1F1">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="signup" class="btn btn-success btn-sm shadow border-0">Sign In</button>
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