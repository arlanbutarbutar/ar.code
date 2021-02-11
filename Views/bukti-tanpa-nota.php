<?php if(!isset($_SESSION)){session_start();}
    if(!isset($_GET['auth']) || empty($_GET['auth'])){
        if($_SESSION['page-name']=="Nota Lunas"){
            header("Location: nota-lunas");exit;
        }else if($_SESSION['page-name']=="Nota Semua"){
            header("Location: nota-all");exit;
        }
    }
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="Bukti Lunas";
    if(isset($_GET['auth'])){
        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['auth']))));
        $notes_bukti=mysqli_query($conn, "SELECT * FROM notes JOIN users ON notes.id_user=users.id_user WHERE notes.id_user='$id_user'");
    }
?>

<!-- == Bukti Lunas page == -->
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once("../Application/access/header.php"); ?>
    </head>
    <body id="page-top">
        <div id="wrapper">
            <?php require_once("../Application/access/side-navbar.php") ?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php require_once("../Application/access/top-navbar.php") ?>
                    <div class="container-fluid">
                        <!-- == Page Heading == -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0" <?= $color_black ?>>Bukti Lunas</h1>
                            </div>
                        <!-- == Content Info == -->
                            <div class="row">
                                <!-- == alert message == -->
                                    <div class="col-md-12">
                                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    </div>
                                <!-- == query data == -->
                                    <?php if(mysqli_num_rows($notes_bukti)==0){?>
                                        <div class="col-lg-12">
                                            <div class="card card-body border-0 shadow text-center mt-3">
                                                <p class="text-danger font-weight-bold">Terjadi kesalahan, silakan coba lagi!</p>
                                            </div>
                                        </div>
                                    <?php }else if(mysqli_num_rows($notes_bukti)>0){while($row=mysqli_fetch_assoc($notes_bukti)){?>
                                        <div class="col-lg-6">
                                            <div class="card card-body shadow border-0 text-center mt-3">
                                                <h4 class="font-weight-bold" <?= $color_black?>>Keterangan bukti</h4>
                                                <p <?= $color_black?>><?= $row['ket_text']?></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card card-body shadow border-0 text-center mt-3" style="overflow: auto">
                                                <h4 class="font-weight-bold" <?= $color_black?>>Bukti Tanpa Nota</h4>
                                                <img src="../Assets/img/img-notes/<?= $row['ket_img']?>" alt="Bukti Lunas" class="img-fluid">
                                            </div>
                                        </div>
                                    <?php }}?>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>