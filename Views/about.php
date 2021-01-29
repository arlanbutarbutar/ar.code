<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>About | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">About</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <?php if(mysqli_num_rows($snf_about)){while($row_data=mysqli_fetch_assoc($snf_about)){if($_SESSION['id-role']!=5){?>
                            <div class="col-lg-12">
                            <?php }else if($_SESSION['id-role']==5){?>
                            <div class="col-lg-8">
                            <?php }?>
                                <div class="card shadow border-0 mt-3">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-lg-4 text-center">
                                                    <img src="../assets/img/img-web-server/<?php if(empty($row_data['img_provider'])){echo "logo-netcode.png";}else if(!empty($row_data['img_provider'])){echo $row_data['img_provider'];}?>" style="width: 200px; height: 200px" class="img rounded-circle shadow" alt="profile">
                                                </div>
                                                <div class="col-lg-8 text-dark mt-3">
                                                    <h4 class="mb-n1 text-center"><?php if(empty($row_data['name_provider'])){echo "Belum ada nama Provider";}else{echo $row_data['name_provider'];}?></h4>
                                                    <small class="text-center"><?php if(empty($row_data['link_web'])){echo "Belum ada link web";}else{?><a href="<?= $row_data['link_web']?>" class="nav-link text-decoration-none" target="blank"><?= $row_data['link_web']?></a><?php }?></small>
                                                    <p class="mt-4 mb-n1 text-center">Pendiri dan pengembang : <?php if(empty($row_data['founder'])){echo "-";}else{echo $row_data['founder'];}?><??></p>
                                                    <p class="mb-n1 text-center">Web Server : <?php if(empty($row_data['server'])){echo "-";}else{echo $row_data['server'];}?></p>
                                                    <p class="text-center">Waktu dibuat/Launching : <?php if(empty($row_data['date_created'])){echo "-";}else{echo $row_data['date_created'];}?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($_SESSION['id-role']==5){?>
                            <div class="col-lg-4">
                                <div class="card shadow border-0 mt-3" id="register">
                                    <div class="card-body text-dark m-auto text-center">
                                        <h4 class="font-weight-bold">Insert Data About</h4>
                                        <form action="" method="POST" enctype="multipart/form-data" id="reg-form">
                                            <input type="hidden" name="id-about" value="<?= $row_data['id_about'];?>">
                                            <input type="hidden" name="img-provider" value="<?= $row_data['img_provider'];?>">
                                            <div class="upload-profile-image d-flex justify-content-center">
                                                <div class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <img class="camera-icon" src="../assets/img/img-web-server/camera-solid.svg" alt="camera">
                                                    </div>
                                                    <img src="../assets/img/img-web-server/<?php if(empty($row_data['img_provider'])){echo "logo-netcode.png";}else if(!empty($row_data['img_provider'])){echo $row_data['img_provider'];}?>" style="width: 200px; height: 200px" class="img rounded-circle" alt="profile">
                                                    <small class="form-text text-black-50">Choise Image</small>
                                                    <input type="file" form="reg-form" class="form-control-file" name="gambar" id="upload-profile">
                                                </div>
                                            </div>
                                            <div class="form-group mt-4">
                                                <button type="submit" name="edit-img-about" class="btn btn-sm" <?= $style_btn;?>>Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card shadow border-0 mt-3">
                                    <div class="card-body text-dark m-auto text-center">
                                        <h4 class="font-weight-bold">Insert Data About</h4>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id-about" value="<?= $row_data['id_about'];?>">
                                            <div class="form-group mt-4">
                                                <input type="text" name="name-provider" placeholder="Nama Provider" class="form-control" required>
                                            </div>
                                            <div class="form-group mt-4">
                                                <input type="text" name="founder" placeholder="Pendiri" class="form-control" required>
                                            </div>
                                            <div class="form-group mt-4">
                                                <input type="text" name="link-web" placeholder="Situs Web" class="form-control" required>
                                            </div>
                                            <div class="form-group mt-4">
                                                <input type="text" name="server" placeholder="Nama Server" class="form-control" required>
                                            </div>
                                            <div class="form-group mt-4">
                                                <input type="date" name="date-created" class="form-control" required>
                                            </div>
                                            <div class="form-group mt-4">
                                                <button type="submit" name="edit-data-about" class="btn btn-sm" <?= $style_btn;?>>Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php }}}?>
                        </div>
                    </div>
                </div>
                <?php require_once('../application/access/footer.php');?>
            </div>
        </div>
    </body>
</html>