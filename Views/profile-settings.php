<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="Settings";
?>

<!-- == Settings page == -->
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once("../Application/access/header.php"); ?>
    </head>
    <body id="page-top">
        <div id="wrapper">
            <?php require_once("../Application/access/side-navbar-me.php") ?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php require_once("../Application/access/top-navbar.php") ?>
                    <div class="container-fluid">
                        <!-- == Page Heading == -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0" <?= $color_black ?>><?= $_SESSION['page-name']?></h1>
                            </div>
                        <!-- == Content Info == -->
                            <div class="row">
                                <!-- == alert message == -->
                                    <div class="col-md-12">
                                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    </div>
                                <!-- == ubah password == -->
                                    <?php if(mysqli_num_rows($settings)>0){while($row=mysqli_fetch_assoc($settings)){?>
                                    <div class="col-md-4">
                                        <div class="card shadow border-0">
                                            <div class="card-header" <?= $color_black ?>>
                                                Ubah Kata Sandi
                                            </div>
                                            <div class="card-body">
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                    <input type="hidden" name="password-old" value="<?= $row['password']?>">
                                                    <div class="form-group">
                                                        <label <?= $color_black ?>>Kata sandi baru</label>
                                                        <input type="password" name="password1" placeholder="Sandi baru" class="form-control" <?= $color_black ?> required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label <?= $color_black ?>>Ulangi Kata sandi baru</label>
                                                        <input type="password" name="password2" placeholder="Ulangi sandi" class="form-control" <?= $color_black ?> required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="ubah-sandi-user" class="btn btn-sm"  <?= $bg_black ?>>Apply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }}?>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>