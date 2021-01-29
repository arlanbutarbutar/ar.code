<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
    if(!isset($_GET['id-lunas'])){
        header("Location: nota-lunas");
        exit;
    }else if(isset($_GET['id-lunas'])){
        $id_nota_lunas=addslashes(trim($_GET['id-lunas']));
        $akses=addslashes(trim($_GET['akses']));
        if($akses<=2){
            $nota_lunas_check=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_lunas='$id_nota_lunas'");
        }else if($akses==3){
            $nota_lunas_check=mysqli_query($conn, "SELECT * FROM laporan_harian WHERE id_laporan='$id_nota_lunas'");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Bukti Lunas | <?= $_SESSION['name-web']?></title>
    </head>
    <body id="page-top" class="sidebar-toggled">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php require_once('../application/access/side-navbar.php');?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php require_once('../application/access/top-navbar.php');?>
                    <div class="container-fluid" style="margin-top: 100px">
                        <div class="d-block">
                            <h1 class="h2 mb-0 text-gray-800">Bukti Lunas</h1>
                            <p class="text-dark ml-1">Bukti yang ditampilkan dalam bentuk gambar.</p>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12">
                                <?php if(mysqli_num_rows($nota_lunas_check)){while($row=mysqli_fetch_assoc($nota_lunas_check)){?>
                                <div class="card border-0 shadow">
                                    <div class="card-body">
                                        <a href="<?php if($akses==1){echo "nota-lunas";}else if($akses==2 || 3){echo "report-day";}?>" class="btn btn-sm d-block text-left font-weight-bold mb-3" <?= $style_btn?>>Back</a>
                                        <img src="../assets/img/img-nota-lunas/<?= $row['ket_img']?>" alt="Bukti Lunas" class="img-fluid" style="width: 500px">
                                    </div>
                                </div>
                                <?php }}?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('../application/access/footer.php');?>
            </div>
        </div>
    </body>
</html>