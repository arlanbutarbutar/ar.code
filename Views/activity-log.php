<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Activity Log | <?= $_SESSION['name-web']?></title>
    </head>
    <body id="page-top" class="sidebar-toggled">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php require_once('../application/access/side-navbar-me.php');?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php require_once('../application/access/top-navbar.php');?>
                    <div class="container-fluid" style="margin-top: 100px">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h2 mb-0 text-gray-800">Activity Log</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <?php foreach($employee as $row_data):?>
                            <div class="col-md-12">
                                <div class="card shadow border-0 mt-3">
                                    <div class="card-header font-weight-bold text-dark">
                                        Aktifitas terbaru yang saya lakukan.
                                    </div>
                                    <?php if(mysqli_num_rows($employee_log)==0){?>
                                    <div class="card-body">
                                        <p class="text-dark text-center">Belum ada aktifitas yang dilakukan.</p>
                                    </div>
                                    <?php }else if(mysqli_num_rows($employee_log)>0){while($row_log=mysqli_fetch_assoc($employee_log)){if($row_data['id_log']==$row_log['id_log']){?>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p class="text-dark small"><?= $row_log['log']?></p>
                                            <footer class="blockquote-footer small"><?= $row_log['date']?> <cite title="Source Title"><?= $row_log['time']?></cite></footer>
                                        </blockquote><hr>
                                    </div>
                                    <?php }}}?>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <?php require_once('../application/access/footer.php');?>
            </div>
        </div>
    </body>
</html>