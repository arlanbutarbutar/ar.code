<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="- Activity Log";
?>

<!-- == Activity Log page == -->
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
                                <h1 class="h3 mb-0" <?= $color_black ?>>Activity Log</h1>
                            </div>
                        <!-- == Content Info == -->
                            <div class="row">
                                <!-- == alert message == -->
                                    <div class="col-md-12">
                                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    </div>
                                <!-- == activity log == -->
                                    <?php if(mysqli_num_rows($activity)==0){?>
                                        <div class="col-md-12">
                                            <div class="card card-body border-0 shadow">
                                                <p class="text-center" <?= $color_black ?>>Belum ada aktivitas kamu.</p>
                                            </div>
                                        </div>
                                    <?php }else if(mysqli_num_rows($activity)>=0){while($row=mysqli_fetch_assoc($activity)){?>
                                        <div class="col-md-12">
                                            <div class="card border-0 shadow mb-3">
                                                <div class="card-body">
                                                    <blockquote class="blockquote mb-0">
                                                        <p class="small" <?= $color_black ?>><?= $row['log']?></p>
                                                        <footer class="blockquote-footer"><cite title="Source Title"><small><?= $row['date']?></small></cite></footer>
                                                    </blockquote>
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