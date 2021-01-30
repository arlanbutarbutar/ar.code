<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Settings | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Settings</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <?php foreach($employee as $row_data):?>
                            <div class="col-md-12">
                                <h4 class="text-dark">Keamanan dan Info Login</h4>

                                <?php if($_SESSION['id-role']<12){?>
                                <!-- Disarankan -->
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            Disarankan
                                        </div>
                                        <div class="card-body">
                                            <div class="d-sm-flex">
                                                <div class="col-md-10">
                                                    <h6 class="card-title font-weight-bold">Pilih teman untuk dihubungi jika anda tidak bisa masuk</h6>
                                                    <p class="card-text">Jika Anda tidak bisa masuk ke akun Anda, teman dapat membantu. Cukup tunjuk 1 teman untuk menyiapkan ini.</p>
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <a href="#edit-disarankan" class="btn btn-sm" <?= $style_btn;?> data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="collapseExample">Edit</a>
                                                </div>
                                            </div>
                                            <div class="collapse mt-3" id="edit-disarankan">
                                                <div class="card card-body">
                                                    <div class="col-md-12">
                                                        <p>Kontak tepercaya Anda adalah teman yang Anda pilih, yang pasti dapat membantu jika suatu saat Anda mengalami kesulitan untuk mengakses akun Anda.</p>
                                                        <hr>
                                                        <p>Kontak tepercaya Anda:</p>
                                                        <?php if($row_data['id_user_dipercaya']==0){?>
                                                        <form action="" method="POST">
                                                            <button type="button" class="btn btn-sm" <?= $style_btn;?> data-toggle="modal" data-target="#tambah-kontak">
                                                                Tambah Kontak
                                                            </button>
                                                            <div class="modal fade" id="tambah-kontak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kontak Teman</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <select name="id-user-terpercaya" class="form-control">
                                                                            <option>Pilih Teman</option>
                                                                            <?php foreach($user_terpercaya as $row_user_terpercaya):?>
                                                                            <option value="<?= $row_user_terpercaya['id_user']?>"><?= $row_user_terpercaya['first_name']?></option>
                                                                            <?php endforeach;?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="id-user" value="<?= $row_data['id_user']?>">
                                                                    <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Close</button>
                                                                    <button type="submit" name="tambah-user-terpercaya" class="btn btn-sm" <?= $style_btn;?>>Apply</button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </form>
                                                        <?php }else if($row_data['id_user_dipercaya']>0){$id_user_dipercaya=$row_data['id_user_dipercaya'];$user_dipercaya=mysqli_query($conn, "SELECT * FROM employee WHERE id_user='$id_user_dipercaya'");foreach($user_dipercaya as $row_user_dipercaya):?>
                                                        <img src="../assets/img/img-users/<?= $row_user_dipercaya['img']?>" class="img-fluid" alt="Icon Profile" style="width: 75px">
                                                        <p class="mb-4"><?= $row_user_dipercaya['first_name']?></p>
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="id_coder" value="<?= $row_user_dipercaya['id_user']?>">
                                                            <button type="submit" name="hapus-user-dipercaya" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                                        </form>
                                                        <?php endforeach;}?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>

                                <!-- ubah password -->
                                <div class="col-md-12 mt-3">
                                    <div class="card">
                                        <div class="card-header">
                                            Ubah Kata Sandi
                                        </div>
                                        <div class="card-body">
                                            <div class="d-sm-flex">
                                                <div class="col-md-10">
                                                    <h6 class="card-title font-weight-bold">Kata sandi anda saat ini!</h6>
                                                    <input type="password" value="<?php foreach($employee_security as $row_security){echo $row_security['password'];}?>" placeholder="Kata sandi" class="form-control col-4" disabled>
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <a href="#edit-password" class="btn btn-sm" <?= $style_btn;?> data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="collapseExample">Edit</a>
                                                </div>
                                            </div>
                                            <div class="collapse mt-3" id="edit-password">
                                                <div class="card card-body">
                                                    <div class="col-md-4">
                                                        <form action="" method="POST">
                                                            <div class="form-group">
                                                                <label>Kata sandi saat ini</label>
                                                                <input type="password" name="password" placeholder="Sandi saat ini" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Kata sandi baru</label>
                                                                <input type="password" name="kata-sandi1" placeholder="Sandi baru" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ulangi Kata sandi baru</label>
                                                                <input type="password" name="kata-sandi2" placeholder="Konfirmasi sandi" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="hidden" name="id-employee" value="<?= $_SESSION['id-employee']?>">
                                                                <input type="hidden" name="id-security" value="<?= $_SESSION['id-security']?>">
                                                                <button type="submit" name="ubah-sandi-employee" class="btn btn-sm" <?= $style_btn;?>>Apply</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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