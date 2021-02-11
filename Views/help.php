<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="Help";
?>

<!-- == Help page == -->
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
                                <!-- == help message == -->
                                    <div class="col-md-12 m-0 p-0">
                                        <div class="row flex-row-reverse">
                                            <?php if($_SESSION['id-role']>=3){?>
                                            <div class="col-lg-4">
                                                <div class="card card-body border-0 shadow mt-3 text-center">
                                                    <h4 <?= $color_black ?>>Apa Yang Dapat Dibantu?</h4>
                                                    <p <?= $color_black ?>>Masukan masalah dibawah ini dan akan kami jawab.</p>
                                                    <form action="" method="POST">
                                                        <div class="form-group">
                                                            <textarea name="help-message" cols="30" rows="5" placeholder="Masukan yang ingin dibantu" class="form-control" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" name="submit-help" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                            <?php }if($_SESSION['id-role']==1 || $_SESSION['id-role']==2){?>
                                                <div class="col-lg-12">
                                            <?php }?>
                                                <?php if($_SESSION['id-role']==1 || $_SESSION['id-role']==2){
                                                    if(mysqli_num_rows($help_message_admin)==0){?>
                                                        <div class="card card-body border-0 shadow mt-3">
                                                            <p class="text-center" <?= $color_black ?>>Belum ada pesan bantuan yang masuk.</p>
                                                        </div>
                                                    <?php }else if(mysqli_num_rows($help_message_admin)>0){while($row_admin=mysqli_fetch_assoc($help_message_admin)){?>
                                                        <div class="card card-body border-0 shadow mt-3">
                                                            <blockquote class="blockquote mb-0">
                                                                <p class="small" <?= $color_black ?>><?= $row_admin['help_message']?></p>
                                                                <form action="" method="POST">
                                                                    <input type="hidden" name="id-help" value="<?= $row_admin['id_help']?>">
                                                                    <div class="form-group">
                                                                        <textarea name="answer" cols="30" rows="5" placeholder="Answer Help" class="form-control" required><?= $row_admin['answer']?></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" name="help-admin" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                    </div>
                                                                </form>
                                                                <footer class="blockquote-footer"><cite title="Source Title"><small><?= $row_admin['date']?></small></cite></footer>
                                                            </blockquote>
                                                        </div>
                                                    <?php }}?>
                                                <?php }if($_SESSION['id-role']>=3){
                                                    if(mysqli_num_rows($help_message)==0){?>
                                                        <div class="card card-body border-0 shadow mt-3">
                                                            <p class="text-center" <?= $color_black ?>>Belum ada pesan bantuan yang kamu masukan.</p>
                                                        </div>
                                                    <?php }else if(mysqli_num_rows($help_message)>0){while($row_user=mysqli_fetch_assoc($help_message)){?>
                                                        <div class="card card-body border-0 shadow mt-3">
                                                            <blockquote class="blockquote mb-0">
                                                                <p class="small" <?= $color_black ?>><strong>Pesan kamu</strong> <?= $row_user['help_message']?></p>
                                                                <p class="small mt-n3" <?= $color_black ?>><strong>Jawabannya</strong> <?= $row_user['answer']?></p>
                                                                <footer class="blockquote-footer"><cite title="Source Title"><small><?= $row_user['date']?></small></cite></footer>
                                                            </blockquote>
                                                        </div>
                                                    <?php }}?>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>