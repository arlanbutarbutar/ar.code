<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="Report a Problem";
?>

<!-- == Report a Problem page == -->
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
                                <!-- == Insert Report == -->
                                    <div class="col-md-12 m-0 p-0">
                                        <div class="row flex-row-reverse">
                                            <?php if($_SESSION['id-role']==1 || $_SESSION['id-role']==2){?>
                                                <div class="col-lg-4">
                                                    <div class="card card-body shadow border-0 text-center mt-3">
                                                        <h4 class="font-weight-bold" <?= $color_black ?>>Insert Problem</h4>
                                                        <p class="small" <?= $color_black ?>>Masukan masalah yang terjadi pada system.</p>
                                                        <form action="" method="POST">
                                                            <div class="form-group">
                                                                <textarea name="problem-message" cols="30" rows="5" placeholder="Masukan masalah system" class="form-control" required></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" name="submit-report-problem" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php }else if($_SESSION['id-role']>=3){?>
                                                <div class="col-lg-4">
                                                    <div class="card card-body shadow border-0 text-center mt-3">
                                                        <h4 class="font-weight-bold" <?= $color_black ?>>Penting!!</h4>
                                                        <p class="small text-justify" <?= $color_black ?>>Harap diingat dan diperhatikan bahwa laporan masalah selalu terupdate setiap hari mengenai system yang berjalan di Client Services. Untuk itu selalu pantau terus <strong>Report a Problem</strong> untuk memastikan semua tombol dan data berjalan dengan aman dan baik saat digunakan.</p>
                                                    </div>
                                                </div>
                                            <?php }?>
                                            <div class="col-lg-8 mb-5">
                                                <?php if(mysqli_num_rows($report_problem)==0){?>
                                                    <div class="card card-body shadow border-0 text-center">
                                                        <p <?= $color_black ?>>Belum ada Report a Problem</p>
                                                    </div>
                                                <?php }if(mysqli_num_rows($report_problem)>0){while($row=mysqli_fetch_assoc($report_problem)){?>
                                                    <div class="card card-body shadow border-0 mt-3">
                                                        <blockquote class="blockquote mb-0">
                                                            <p class="small" <?= $color_black ?>><?= $row['problem_message']?></p>
                                                            <footer class="blockquote-footer"><cite title="Source Title"><small><?= $row['date']?></small></cite></footer>
                                                        </blockquote>
                                                    </div>
                                                <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>