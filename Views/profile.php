<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="My Profile";
?>

<!-- == My Profile page == -->
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
                                <?php foreach($my_profile as $row):?>
                                <!-- == photo profile user == -->
                                    <div class="col-lg-4 mt-3" id="register">
                                        <div class="card shadow border-0">
                                            <div class="card-body text-center">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id-user" value="<?= $row['id_user'];?>">
                                                    <input type="hidden" name="img-old" value="<?= $row['img']?>">
                                                    <div class="upload-profile-image d-flex justify-content-center">
                                                        <div class="text-center">
                                                            <div class="d-flex justify-content-center">
                                                                <img class="camera-icon" src="../Assets/img/img-web/camera-solid.svg" alt="camera">
                                                            </div>
                                                            <img src="../Assets/img/img-users/<?= $row['img'];?>" style="width: 200px; height: 200px" class="img rounded-circle" alt="profile">
                                                            <small class="form-text text-black-50">Pilih Fotomu</small>
                                                            <input type="file" class="form-control-file" name="profile" id="upload-profile">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-4">
                                                        <button type="submit" name="edit-profile-employee" class="btn btn-sm shadow card-scale" <?= $bg_black?>>Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <!-- == biodata users == -->
                                    <div class="col-lg-8 mt-3">
                                        <div class="card shadow border-0">
                                            <div class="card-body">
                                                <table class="table table-borderless table-sm">
                                                    <tbody class="text-dark">
                                                        <tr>
                                                            <th scope="row" <?= $color_black?>>Nama Depan</th>
                                                            <td>: <?= $row['first_name']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" <?= $color_black?>>Nama Belakang</th>
                                                            <td>: <?= $row['last_name']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" <?= $color_black?>>Email</th>
                                                            <td>: <?= $row['email']?> <a class="btn btn-link text-decoration-none" data-toggle="collapse" href="#edit-email-user" role="button" aria-expanded="false" aria-controls="edit-email-user">Edit</a>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" <?= $color_black?>>Phone Number</th>
                                                            <td>: <?= $row['phone'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" <?= $color_black?>>Address</th>
                                                            <td>: <?= $row['address'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" <?= $color_black?>>Postal</th>
                                                            <td>: <?= $row['postal'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" <?= $color_black?>>Role</th>
                                                            <td>: <?= $row['role']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" <?= $color_black?>>Date Created</th>
                                                            <td>: <?= $row['date_created']?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p class="text-center">
                                                    <button class="btn btn-sm shadow card-scale" <?= $bg_black?> type="button" data-toggle="collapse" data-target="#edit-biodata-user" aria-expanded="false" aria-controls="edit-biodata-user">
                                                        Edit
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-md-12">
                                    <!-- == edit email user == -->
                                        <div class="collapse" id="edit-email-user">
                                            <div class="card card-body shadow border-0 mt-3 text-center">
                                                <div class="row">
                                                    <div class="col-lg-4 m-auto">
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                            <input type="hidden" name="email-old" value="<?= $row['email']?>">
                                                            <div class="form-group">
                                                                <label for="email-lama" <?= $color_black?>>Email lama</label>
                                                                <input type="email" value="<?= $row['email']?>" id="email-lama" class="form-control text-center" placeholder="Email lama" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email-baru" <?= $color_black?>>Email baru</label>
                                                                <input type="email" name="email" id="email-baru" class="form-control text-center" placeholder="Email baru" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password1" <?= $color_black?>>Password yang kamu gunakan</label>
                                                                <input type="password" name="password1" id="password" class="form-control text-center" placeholder="Password" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password2" <?= $color_black?>>Ulangi Password</label>
                                                                <input type="password" name="password2" id="password2" class="form-control text-center" placeholder="Ulangi Password" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" name="edit-email-user" class="btn btn-sm shadow card-scale" <?= $bg_black?>>Apply</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- == edit biodata user == -->
                                        <div class="collapse" id="edit-biodata-user">
                                            <div class="card card-body shadow border-0 mt-3 text-center">
                                                <h6 class="font-weight-bold text-center" <?= $color_black?>>Silakan masukan data baru anda dan pastikan sesuai fakta(KTP/Tanda pengenal lainnya).</h6>
                                                <div class="col-lg-4 m-auto">
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                        <div class="form-group">
                                                            <label class=" font-weight-bold" for="first-name" <?= $color_black?>>First Name</label>
                                                            <input type="text" name="first-name" value="<?= $row['first_name']?>" placeholder="First Name" class="form-control text-center" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" font-weight-bold" for="last-name" <?= $color_black?>>Last Name</label>
                                                            <input type="text" name="last-name" value="<?= $row['last_name']?>" placeholder="Last Name" class="form-control text-center" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" font-weight-bold" for="email" <?= $color_black?>>Email</label>
                                                            <input type="email" name="email" value="<?= $row['email']?>" placeholder="email" class="form-control text-center" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" font-weight-bold" for="phone" <?= $color_black?>>Phone Number</label>
                                                            <input type="number" name="phone" value="<?= $row['phone']?>" placeholder="Phone Number" class="form-control text-center" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" font-weight-bold" for="address" <?= $color_black?>>Address</label>
                                                            <input type="text" name="address" value="<?= $row['address']?>" placeholder="Address" class="form-control text-center" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=" font-weight-bold" for="postal" <?= $color_black?>>Postal</label>
                                                            <input type="number" name="postal" value="<?= $row['postal']?>" placeholder="Postal" class="form-control text-center" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" name="edit-biodata-user" class="btn btn-sm card-scale" <?= $bg_black;?>>Apply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <?php endforeach;?>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>