<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Profile | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Profile <?= $_SESSION['username']?></h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <?php foreach($employee as $row_data):?>
                            <div class="col-lg-4 mt-3" id="register">
                                <div class="card shadow border-0">
                                    <div class="card-body text-center">
                                        <form action="" method="POST" enctype="multipart/form-data" id="reg-form">
                                            <input type="hidden" name="id-employee" value="<?= $id_employee;?>">
                                            <input type="hidden" name="img-old" value="<?= $row_data['img']?>">
                                            <div class="upload-profile-image d-flex justify-content-center">
                                                <div class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <img class="camera-icon" src="../assets/img/img-web-server/camera-solid.svg" alt="camera">
                                                    </div>
                                                    <img src="../assets/img/img-employee/<?php if(empty($row_data['img'])){echo "default.png";}else if(!empty($row_data['img'])){echo $row_data['img'];}?>" style="width: 200px; height: 200px" class="img rounded-circle" alt="profile">
                                                    <small class="form-text text-black-50">Choise Image</small>
                                                    <input type="file" class="form-control-file" name="gambar" id="upload-profile">
                                                </div>
                                            </div>
                                            <div class="form-group mt-4">
                                                <button type="submit" name="edit-profile-employee" class="btn btn-sm" <?= $style_btn;?>>Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 mt-3">
                                <div class="card shadow border-0">
                                    <div class="card-body">
                                        <table class="table table-borderless table-sm">
                                            <tbody class="text-dark">
                                                <tr>
                                                    <th scope="row">First Name</th>
                                                    <td>: <?= $row_data['first_name']?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Last Name</th>
                                                    <td>: <?= $row_data['last_name']?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Email</th>
                                                    <td>: <?= $row_data['email']?> <a class="btn btn-link text-decoration-none" data-toggle="collapse" href="#edit-email-employee" role="button" aria-expanded="false" aria-controls="collapseExample">Edit</a>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Phone Number</th>
                                                    <td>: +62 <?php if(empty($row_data['phone'])){echo "-";}else if(!empty($row_data['phone'])){echo $row_data['phone'];}?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Address</th>
                                                    <td>: <?php if(empty($row_data['address'])){echo "-";}else if(!empty($row_data['address'])){echo $row_data['address'];}?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Postal</th>
                                                    <td>: <?php if(empty($row_data['postal'])){echo "-";}else if(!empty($row_data['postal'])){echo $row_data['postal'];}?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Role</th>
                                                    <td>: <?= $row_data['role']?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Date Created</th>
                                                    <td>: <?= $row_data['date_created']?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="text-center">
                                            <button class="btn btn-sm" <?= $style_btn;?> type="button" data-toggle="collapse" data-target="#edit-profile-employee" aria-expanded="false" aria-controls="edit-profile-employee">
                                                Edit
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="collapse" id="edit-email-employee">
                                    <div class="card card-body shadow border-0 mt-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id-employee" value="<?= $row_data['id_employee']?>">
                                                    <input type="hidden" name="first-name" value="<?= $row_data['first_name']?>">
                                                    <div class="form-group">
                                                        <label for="email-lama">Email lama</label>
                                                        <input type="email" name="email-old" value="<?= $row_data['email']?>" id="email-lama" class="form-control" placeholder="Email lama" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email-baru">Email baru</label>
                                                        <input type="email" name="email" id="email-baru" class="form-control" placeholder="Email baru" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="edit-email-employee" class="btn btn-sm" <?= $style_btn;?>>Apply</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-8 text-dark">
                                                <h6 class="font-weight-bold"><span class="badge badge-warning">Perhatian!!</span> Cara mengganti email baru.</h6>
                                                <li>Langkah 1 : Ubah email yang anda pakai sekarang.</li>
                                                <li>Langkah 2 : Setelah di ubah anda akan langsung diminta verifikasi.</li>
                                                <li>Langkah 3 : Klik kode verifikasi yang telah dikirim ke email baru anda.</li>
                                                <li>Langkah 4 : Selesai.</li>
                                                <p>Harap diingat, jika tidak melakukan verifikasi dan kembali ke halaman anda maka akan otomatis keluar karena akun anda harus di verifikasi terlebih dahulu untuk memastikan bahwa email ini benar <?= $_SESSION['username']?>.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="edit-profile-employee">
                                    <div class="card card-body shadow border-0 mt-3">
                                        <h6 class="font-weight-bold text-dark">Silakan masukan data baru anda dan pastikan sesuai fakta(KTP/Tanda pengenal lainnya).</h6>
                                        <div class="col-4">
                                            <form action="" method="POST">
                                                <input type="hidden" name="id-employee" value="<?= $row_data['id_employee']?>">
                                                <div class="form-group">
                                                    <label class="text-dark font-weight-bold" for="first-name">First Name</label>
                                                    <input type="text" name="first-name" value="<?= $row_data['first_name']?>" placeholder="First Name" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-dark font-weight-bold" for="last-name">Last Name</label>
                                                    <input type="text" name="last-name" value="<?= $row_data['last_name']?>" placeholder="Last Name" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-dark font-weight-bold" for="email">Email</label>
                                                    <input type="email" name="email" value="<?= $row_data['email']?>" placeholder="email" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-dark font-weight-bold" for="phone">Phone Number</label>
                                                    <input type="number" name="phone" value="<?= $row_data['phone']?>" placeholder="Phone Number" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-dark font-weight-bold" for="address">Address</label>
                                                    <input type="text" name="address" value="<?= $row_data['address']?>" placeholder="Address" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-dark font-weight-bold" for="postal">Postal</label>
                                                    <input type="number" name="postal" value="<?= $row_data['postal']?>" placeholder="Postal" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="edit-data-employee" class="btn btn-sm" <?= $style_btn;?>>Apply</button>
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
                <?php require_once('../application/access/footer.php');?>
            </div>
        </div>
    </body>
</html>