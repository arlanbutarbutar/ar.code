<?php if (!isset($_SESSION)) {session_start();}
    if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
    require_once("Application/session/redirect-visitor.php");
    require_once("Application/controller/script.php");
    $_SESSION['page-name']=" - Contact";
?>

<!-- == Contact page == -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("Application/access/header.php") ?>
    </head>
    <body>
        <!-- == Contact bg-video section == -->
            <div class="video-news">
                <video playsinline autoplay muted loop>
                    <source src="Assets/video/landing-section-1.mp4" type="video/mp4">
                </video>
            </div>
        <?php require_once("Application/access/navbar.php") ?>
        <!-- == Contact section == -->
            <div class="container-fluid">
                <div class="d-flex justify-content-start flex-wrap contact">
                    <div class="col-lg-6 col-one-section overflow-hidden">
                        <h1 class="d-flex montserrat font-weight-bold" data-aos="fade-in" data-aos-delay="0">Contact</h1>
                        <div class="col-11 p-0">
                            <ul class="list-unstyled li-space-lg">
                                <li class="address comfortaa" data-aos="fade-in" data-aos-delay="100">Feel free to call us or send us a contact form message</li>
                                <li class="comfortaa d-flex">
                                    <i class="fas fa-map-marker-alt pr-2 mr-2 my-auto"></i>
                                    <p class="comfortaa my-auto" data-aos="fade-right" data-aos-delay="200">Jln. W.J Lalamentik no.95 (UGD HP), Kota Kupang, NTT, ID</p>
                                </li>
                                <li class="comfortaa d-flex">
                                    <i class="fas fa-envelope mr-2 my-auto"></i>
                                    <p class="my-auto" data-aos="fade-right" data-aos-delay="300">
                                        <a class="turquoise text-decoration-none" href="mailto:ugdhpmediatalk@ugdhp.com" data-aos="fade-right" data-aos-delay="0" target="_blank">ugdhpmediatalk@ugdhp.com</a>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 my-auto m-0 p-0" data-aos="fade-in" data-aos-delay="0">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <?php if(isset($message_success)){echo $message_success;}if(isset($message_danger)){echo$message_danger;}?>
                                <form method="POST" action="" class="text-center">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Name" class="form-control  shadow text-center border-0 text-dark" required style="background: #F1F1F1">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Email" class="form-control  shadow text-center border-0 text-dark" required style="background: #F1F1F1">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="pesan" placeholder="Message" class="form-control  shadow text-center border-0 text-dark" rows="3" required style="resize: none;background: #F1F1F1"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="mail-visitor" class="btn btn-success btn-sm shadow border-0">Send Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php require_once("Application/access/footer.php") ?>
    </body>
</html>