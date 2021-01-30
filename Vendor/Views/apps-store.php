<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Apps Store | <?= $_SESSION['name-web']?></title>
    </head>
    <body id="page-top" class="sidebar-toggled">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php require_once('../application/access/side-navbar.php');?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php require_once('../application/access/top-navbar.php');?>
                    <div class="container-fluid" style="margin-top: 100px">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h2 mb-0 text-gray-800">Apps Store</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12 m-0 p-0">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">

                                        <div class="carousel-item active">
                                            <div class="row justify-content-start">
    
                                                <div class="col-lg-3">
                                                    <div class="card border-0 shadow ml-3" style="width: 18rem;">
                                                        <img src="../assets/img/img-web-server/logo-ugdhp.png" class="card-img-top text-center m-auto" alt="Logo UGD HP" style="width: 150px; height: 170px">
                                                        <div class="card-body text-dark">
                                                            <h5 class="card-title font-weight-bold">UGD HP</h5>
                                                            <p class="card-text">Unduh Apps Versi Mobile</p>
                                                            <a href="../utilities/UGD HP_12_2.apk" download class="btn btn-light shadow btn-sm"><i class="fas fa-cloud-download-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="col-lg-3">
                                                    <div class="card border-0 shadow ml-3" style="width: 18rem;">
                                                        <img src="../assets/img/img-web-server/qr-code.png" class="card-img-top text-center m-auto" alt="Logo QR Scanner" style="width: 150px;">
                                                        <div class="card-body text-dark">
                                                            <h5 class="card-title font-weight-bold">QR Scanner</h5>
                                                            <div class="row ml-1">
                                                                <a href="https://play.google.com/store/apps/developer?id=TeaCapps" class="text-decoration-none small font-weight-bold">TeaCapps</a>
                                                                <a href="https://play.google.com/store/apps/category/PRODUCTIVITY" class="text-decoration-none small ml-3 font-weight-bold">Produktivitas</a>
                                                            </div>
                                                            <p class="card-text">Unduh Pembaca QR & Kode Batang</p>
                                                            <a href="https://play.google.com/store/apps/details?id=com.teacapps.barcodescanner" class="btn btn-light shadow btn-sm"><i class="fas fa-cloud-download-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="col-lg-3">
                                                    <div class="card border-0 shadow ml-3" style="width: 18rem;">
                                                        <img src="../assets/img/img-web-server/print.jpg" class="card-img-top text-center m-auto" alt="Logo Sanpidie" style="width: 150px">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Sanpidie</h5>
                                                            <p class="card-text">Unduh Apps Print QR</p>
                                                            <a href="../utilities/BT-POSPrinter.apk" download class="btn btn-light shadow btn-sm"><i class="fas fa-cloud-download-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
    
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('../application/access/footer.php');?>
            </div>
        </div>
    </body>
</html>