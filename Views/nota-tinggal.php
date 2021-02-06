<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="- Nota Tinggal";
?>

<!-- == nota tinggal page == -->
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
                                <h1 class="h3 mb-0" <?= $color_black ?>>Nota Tinggal</h1>
                            </div>
                        <!-- == Content Info == -->
                            <div class="row">
                                <!-- == alert message == -->
                                    <div class="col-md-12">
                                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    </div>
                                <div class="col-md-12 m-0 p-0">
                                    <div class="row flex-row-reverse">
                                        <!-- == insert data == -->
                                            <div class="col-lg-4">
                                                <div class="card card-body border-0 shadow mt-3 text-center">
                                                    <h4 class="font-weight-bold" <?= $color_black?>>Masukan Data</h4>
                                                    <p class="small" <?= $color_black?>>Masukan data untuk nota tinggal ataupun nota dp disini.</p>
                                                    <button class="btn btn-link btn-sm" <?= $color_black?> type="button" data-toggle="collapse" data-target="#insert-nota" aria-expanded="false" aria-controls="insert-nota">Gulir kebawah <i class="fas fa-hand-point-down"></i></button>
                                                    <div class="collapse" id="insert-nota">
                                                        <div class="card card-body border-0 m-0 p-0">
                                                            <form action="" method="POST">
                                                                <div class='form-group'>
                                                                    <input type="number" name="nota-tinggal" placeholder="Nomor nota tinggal" class="form-control text-center" required>
                                                                    <small class="text-danger">Wajib*</small>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <input type="number" name="nota-dp" placeholder="Nomor nota tinggal" class="form-control text-center" required>
                                                                    <small class="text-info">Jika ada isikan!</small>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <input type="text" name="username" placeholder="Nama pengguna" class="form-control text-center" required>
                                                                    <small class="text-danger">Wajib*</small>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <input type="email" name="email" placeholder="Alamat email" class="form-control text-center">
                                                                    <small class="text-info">Jika diinginkan!</small>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <input type="number" name="tlpn" placeholder="Nomor hp/tlpn" class="form-control text-center" required>
                                                                    <small class="text-danger">Wajib*</small>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <input type="text" name="alamat" placeholder="Alamat" class="form-control text-center">
                                                                </div>
                                                                <div class='form-group'>
                                                                    <select name="id-layanan" class="form-control" required>
                                                                        <option>Pilih layanan</option>
                                                                        <?php ?>
                                                                            <option value=""></option>
                                                                        <?php ?>
                                                                    </select>
                                                                </div>
                                                                <div class="row">
                                                                    <h6 class="font-weight-bold" <?= $color_black?>><span class="badge badge-warning">Perhatian!</span> Mengisi sesui dengan layanan yang dipilih!</h6>
                                                                    <div class="col-lg-6">
                                                                        <h6 class="font-weight-bold" <?= $color_black?>>Handphone</h6>
                                                                        <div class="form-group">
                                                                            <input type="text" name="type" placeholder="Type" class="form-control text-center">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" name="seri" placeholder="Seri" class="form-control text-center">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" name="imei" placeholder="Imei" class="form-control text-center">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h6 class="font-weight-bold" <?= $color_black?>>Laptop</h6>
                                                                        <div class="form-group">
                                                                            <input type="text" name="merek" placeholder="Merek" class="form-control text-center">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" name="seri" placeholder="Seri" class="form-control text-center">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <input type="text" name="kerusakan" placeholder="Kerusakan" class="form-control text-center" required>
                                                                    <small class="text-danger">Wajib*</small>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <input type="text" name="kondisi" placeholder="Kondisi" class="form-control text-center">
                                                                </div>
                                                                <div class='form-group'>
                                                                    <input type="text" name="kelengkapan" placeholder="Kelengkapan" class="form-control text-center">
                                                                </div>
                                                                <div class='form-group'>
                                                                    <select name="id-teknisi" class="form-control" required>
                                                                        <option>Pilih teknisi</option>
                                                                        <?php ?>
                                                                            <option value=""></option>
                                                                        <?php ?>
                                                                    </select>   
                                                                </div>
                                                                <div class='form-group'>
                                                                    <label for="tgl-ambil">Tgl Ambil</label>
                                                                    <input type="date" name="tgl-ambil" id="tgl-ambil" class="form-control text-center">
                                                                </div>
                                                                <div class='form-group'>
                                                                    <input type="number" name="dp" placeholder="DP" class="form-control text-center">
                                                                </div>
                                                                <div class='form-group'>
                                                                    <input type="number" name="biaya" placeholder="Biaya" class="form-control text-center" required>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <button type="submit" name="submit-notes" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- == view data table today == -->
                                            <div class="col-lg-8">
                                                <div class="card card-body border-0 shadow mt-3" style="overflow-x: auto">
                                                    <table class="table table-sm text-center" <?= $color_black?>>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">First</th>
                                                                <th scope="col">Last</th>
                                                                <th scope="col">Handle</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>Mark</td>
                                                                <td>Otto</td>
                                                                <td>@mdo</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-12 m-0 p-0">
                                    <div class="card card-body border-0 shadow mt-3 mb-5" style="overflow-x: auto">
                                        <!-- <table class="table table-sm text-center" <?= $color_black?>>
                                            <thead>
                                                <tr style="border-top:hidden">
                                                    <th scope="col">No</th>
                                                    <th scope="col">Data encrypt</th>
                                                    <th scope="col">Icon</th>
                                                    <th scope="col">Nama depan</th>
                                                    <th scope="col">Nama belakang</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Kategori Layanan</th>
                                                    <th scope="col">No. hp/tlp</th>
                                                    <th scope="col">Alamat</th>
                                                    <th scope="col">Kode pos</th>
                                                    <th scope="col">Kebijakan</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Akses</th>
                                                    <th scope="col">Tgl Buat</th>
                                                    <?php if($_SESSION['id-access']==1){?>
                                                    <th colspan="1">Aksi</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1;?>
                                                <?php if(mysqli_num_rows($users_data)==0){?>
                                                    <tr>
                                                        <th colspan="16">Maaf data users masih kosong.</th>
                                                    </tr>
                                                <?php }else if(mysqli_num_rows($users_data)>0){while($row=mysqli_fetch_assoc($users_data)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <td scope="row"><?= $row['data_encrypt'];?></td>
                                                        <td scope="row"><img src="../Assets/img/img-users/<?= $row['img']?>" alt="icon profile" class="rounded-circle" style="width: 40px"></td>
                                                        <td scope="row"><?= $row['first_name']?></td>
                                                        <td scope="row"><?= $row['last_name']?></td>
                                                        <td scope="row"><?= $row['email']?></td>
                                                        <td scope="row"><?= $row['product']?></td>
                                                        <td scope="row"><?= $row['phone']?></td>
                                                        <td scope="row"><?= $row['address']?></td>
                                                        <td scope="row"><?= $row['postal']?></td>
                                                        <td scope="row"><?= $row['kebijakan']?></td>
                                                        <td scope="row">
                                                            <div class="dropdown no-arrow">
                                                                <button class="btn btn-link btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-pen"></i> <?= $row['role']?></button>
                                                                <?php if($_SESSION['id-access']==1){?>
                                                                <div class="dropdown-menu p-2 border-0 shadow text-center" aria-labelledby="dropdownMenuButton">
                                                                    <form action="" method="POST">
                                                                        <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                        <div class="form-group">
                                                                            <select name="id-role" class="form-control" required>
                                                                                <option>Pilih role</option>
                                                                                <?php foreach($users_data_role as $row_role):?>
                                                                                <option value="<?= $row_role['id_role']?>"><?= $row_role['role']?></option>
                                                                                <?php endforeach;?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button type="submit" name="edit-role-user" <?= $style_btn;?> class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <?php }?>
                                                            </div>
                                                        </td>
                                                        <td scope="row">
                                                            <div class="dropdown no-arrow">
                                                                <button class="btn btn-link btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-pen"></i> <?= $row['status']?></button>
                                                                <?php if($_SESSION['id-access']==1){?>
                                                                <div class="dropdown-menu p-2 border-0 shadow text-center" aria-labelledby="dropdownMenuButton">
                                                                    <form action="" method="POST">
                                                                        <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                        <div class="form-group">
                                                                            <select name="is-active" class="form-control" required>
                                                                                <option>Pilih status</option>
                                                                                <?php foreach($users_data_status as $row_status):?>
                                                                                <option value="<?= $row_status['is_active']?>"><?= $row_status['status']?></option>
                                                                                <?php endforeach;?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button type="submit" name="edit-status-user" <?= $style_btn;?> class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <?php }?>
                                                            </div>
                                                        </td>
                                                        <td scope="row">
                                                            <div class="dropdown no-arrow">
                                                                <button class="btn btn-link btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-pen"></i> <?= $row['access']?></button>
                                                                <?php if($_SESSION['id-access']==1){?>
                                                                <div class="dropdown-menu p-2 border-0 shadow text-center" aria-labelledby="dropdownMenuButton">
                                                                    <form action="" method="POST">
                                                                        <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                        <div class="form-group">
                                                                            <select name="id-access" class="form-control" required>
                                                                                <option>Pilih access</option>
                                                                                <?php foreach($users_data_access as $row_access):?>
                                                                                <option value="<?= $row_access['id_access']?>"><?= $row_access['access']?></option>
                                                                                <?php endforeach;?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button type="submit" name="edit-access-user" <?= $style_btn;?> class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <?php }?>
                                                            </div>
                                                        </td>
                                                        <td scope="row"><?= $row['date_created']?></td>
                                                        <?php if($_SESSION['id-access']==1){?>
                                                        <td><form action="" method="POST">
                                                            <input type="hidden" name="id-user" value="<?= $row['id_user'];?>">
                                                            <button type="submit" name="delete-user" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
                                                        </form></td>
                                                        <?php }?>
                                                    </tr>
                                                <?php $no++; }}?>
                                            </tbody>
                                        </table>
                                        <nav class="small" aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <?php if(isset($page5)){if(isset($total_page5)){if($page5>1):?>
                                                <li class="page-item shadow">
                                                    <a class="page-link border-0" <?= $bg_black?> href="users?page=<?= $page5-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                                <?php endif;?>
                                                <?php for($i=1; $i<=$total_page5; $i++):?>
                                                    <?php if($i<=5):?>
                                                        <?php if($i==$page5):?>
                                                            <li class="page-item shadow"><a class="page-link font-weight-bold border-0" <?= $bg_black?> href="users?page=<?= $i;?>"><?= $i;?></a></li>
                                                        <?php else :?>
                                                            <li class="page-item shadow"><a class="page-link border-0" href="users?page=<?= $i;?>"><?= $i;?></a></li>
                                                        <?php endif;?>
                                                    <?php endif;?>
                                                <?php endfor;?>
                                                <?php if($page5<$total_page5):?>
                                                <li class="page-item shadow">
                                                    <a class="page-link border-0" <?= $bg_black?> href="users?page=<?= $page5+1;?>">Next</a>
                                                </li>
                                                <?php endif;}}?>
                                            </ul>
                                        </nav> -->
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>