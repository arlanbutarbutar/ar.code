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
                                                                    <input type="number" name="nota-dp" placeholder="Nomor nota dp" class="form-control text-center">
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
                                                                        <?php foreach($category_services as $row_layanan):?>
                                                                            <option value="<?= $row_layanan['id_category']?>"><?= $row_layanan['product']?></option>
                                                                        <?php endforeach;?>
                                                                    </select>
                                                                    <small class="text-danger">Wajib*</small>
                                                                </div>
                                                                <div class="row">
                                                                    <h6 class="font-weight-bold" <?= $color_black?>><span class="badge badge-warning">Perhatian!</span> Mengisi sesui dengan layanan yang dipilih!</h6>
                                                                    <div class="col-lg-6">
                                                                        <button class="btn btn-link btn-sm font-weight-bold" <?= $color_black?> type="button" data-toggle="collapse" data-target="#handphone" aria-expanded="false" aria-controls="handphone">Handphone</button>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <button class="btn btn-link btn-sm font-weight-bold" <?= $color_black?> type="button" data-toggle="collapse" data-target="#laptop" aria-expanded="false" aria-controls="laptop">Laptop</button>
                                                                    </div>
                                                                </div>
                                                                <div class="collapse" id="handphone">
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
                                                                <div class="collapse" id="laptop">
                                                                    <div class="form-group">
                                                                        <input type="text" name="merek" placeholder="Merek" class="form-control text-center">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="text" name="seri" placeholder="Seri" class="form-control text-center">
                                                                    </div>
                                                                </div>
                                                                <div class='form-group mt-3'>
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
                                                                        <?php foreach($users_teknisi as $row_teknisi):?>
                                                                            <option value="<?= $row_teknisi['id_user']?>"><?= $row_teknisi['first_name']?></option>
                                                                        <?php endforeach;?>
                                                                    </select>   
                                                                    <small class="text-danger">Wajib*</small>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <label for="tgl-ambil">Tgl Ambil</label>
                                                                    <input type="date" name="tgl-ambil" id="tgl-ambil" class="form-control text-center">
                                                                </div>
                                                                <div class='form-group'>
                                                                    <input type="number" name="dp" placeholder="DP" class="form-control text-center">
                                                                    <small class="text-info">Jika ada nota dp!</small>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <input type="number" name="biaya" placeholder="Biaya" class="form-control text-center" required>
                                                                    <small class="text-danger">Wajib*</small>
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
                                                <div class="card webkit card-body border-0 shadow mt-3" style="overflow-x: auto;">
                                                    <h4 class="text-center" <?= $color_black?>>Data Hari Ini</h4>
                                                    <table class="table table-sm text-center" <?= $color_black?>>
                                                        <thead>
                                                            <tr style="border-top:hidden">
                                                                <th scope="col">#</th>
                                                                <th scope="col">#Nota Tinggal</th>
                                                                <th scope="col">#Nota DP</th>
                                                                <th scope="col">QR/Barcode</th>
                                                                <th scope="col">Client</th>
                                                                <th scope="col">Layanan</th>
                                                                <th scope="col">Teknisi</th>
                                                                <th scope="col">Status</th>
                                                                <?php if($_SESSION['id-role']<=2){?>
                                                                <th scope="col">Waktu Status</th>
                                                                <?php }?>
                                                                <th scope="col">Tgl Masuk</th>
                                                                <?php if($_SESSION['id-role']<=2){?>
                                                                <th scope="col">Waktu Masuk</th>
                                                                <?php }?>
                                                                <th scope="col">Tgl Ambil</th>
                                                                <th scope="col">Kerusakan</th>
                                                                <th scope="col">Kondisi</th>
                                                                <th scope="col">Kelengkapan</th>
                                                                <th scope="col">DP</th>
                                                                <th scope="col">Biaya</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no=1; if(mysqli_num_rows($notes_views_today)==0){?>
                                                            <tr>
                                                                <th colspan="15">Belum ada data yang dimasukan hari ini!</th>
                                                            </tr>
                                                            <?php }else if(mysqli_num_rows($notes_views_today)>0){while($row_today=mysqli_fetch_assoc($notes_views_today)){?>
                                                            <tr>
                                                                <th scope="row"><?= $no;?></th>
                                                                <td>T<?= $row_today['id_nota_tinggal']?></td>
                                                                <td>DP<?= $row_today['id_nota_dp']?></td>
                                                                <td><a href="qr?auth=<?= $row_today['id_user']?>" class="nav-link" <?= $color_black?>><i class="fas fa-qrcode"></i></a></td>
                                                                <td>
                                                                    <div class="dropdown no-arrow">
                                                                        <button class="btn btn-link btn-sm dropdown-toggle" <?= $color_black?> type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-eye"></i> <?= $row_today['first_name']?></button>
                                                                        <div class="dropdown-menu p-2 border-0 shadow text-center" <?= $color_black?> aria-labelledby="dropdownMenuButton">
                                                                            <p>Nama Depan: <?= $row_today['first_name']?></p>
                                                                            <p>Nama Belakang: <?= $row_today['last_name']?></p>
                                                                            <p>No. Tlpn: <?= $row_today['phone']?></p>
                                                                            <p>Email: <?= $row_today['email']?></p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <?php $id_barang=$row_today['id_barang']; if($row_today['id_layanan']==1){
                                                                    $handphone=mysqli_query($conn, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($handphone as $row_hp):?>
                                                                    <td>
                                                                        <div class="dropdown no-arrow">
                                                                            <button class="btn btn-link btn-sm dropdown-toggle" <?= $color_black?> type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-eye"></i> <?= $row_today['product']?></button>
                                                                            <div class="dropdown-menu p-2 border-0 shadow text-center" <?= $color_black?> aria-labelledby="dropdownMenuButton">
                                                                                <p>Type: <?= $row_hp['type']?></p>
                                                                                <p>Seri: <?= $row_hp['seri']?></p>
                                                                                <p>Imei: <?= $row_hp['imei']?></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                <?php endforeach;}if($row_today['id_layanan']==2){
                                                                    $laptop=mysqli_query($conn, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $row_laptop):?>
                                                                    <td>
                                                                        <div class="dropdown no-arrow">
                                                                            <button class="btn btn-link btn-sm dropdown-toggle" <?= $color_black?> type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-eye"></i> <?= $row_today['product']?></button>
                                                                            <div class="dropdown-menu p-2 border-0 shadow text-center" <?= $color_black?> aria-labelledby="dropdownMenuButton">
                                                                                <p>Type: <?= $row_laptop['merek']?></p>
                                                                                <p>Seri: <?= $row_laptop['seri']?></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                <?php endforeach;}?>
                                                                <td><?php $id_tek=$row_today['id_pegawai'];
                                                                    $teknisi=mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_tek'");foreach($teknisi as $row_tek){echo $row_tek['first_name'];}?></td>
                                                                <td><?= $row_today['status']?></td>
                                                                <?php if($_SESSION['id-role']<=2){?>
                                                                <td><?= $row_today['time_status']?></td>
                                                                <?php }?>
                                                                <td><?= $row_today['tgl_masuk']?></td>
                                                                <?php if($_SESSION['id-role']<=2){?>
                                                                <td><?= $row_today['time']?></td>
                                                                <?php }?>
                                                                <td><?= $row_today['tgl_ambil']?></td>
                                                                <td><?= $row_today['kerusakan']?></td>
                                                                <td><?= $row_today['kondisi']?></td>
                                                                <td><?= $row_today['kelengkapan']?></td>
                                                                <td>Rp. <?= number_format($row_today['dp'])?></td>
                                                                <td>Rp. <?= number_format($row_today['biaya'])?></td>
                                                            </tr>
                                                            <?php $no++; }}?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <!-- == query data all == -->
                                    <div class="col-md-12 m-0 p-0">
                                        <div class="card card-body border-0 shadow mt-3 mb-5" style="overflow-x: auto">
                                            <table class="table table-sm text-center" <?= $color_black?>>
                                                <thead>
                                                    <tr style="border-top:hidden">
                                                        <th scope="col">#</th>
                                                        <th scope="col">#Nota Tinggal</th>
                                                        <th scope="col">#Nota DP</th>
                                                        <th scope="col">QR/Barcode</th>
                                                        <th scope="col">Client</th>
                                                        <th scope="col">Layanan</th>
                                                        <th scope="col">Teknisi</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Tgl Masuk</th>
                                                        <th scope="col">Tgl Ambil</th>
                                                        <th scope="col">Kerusakan</th>
                                                        <th scope="col">Kondisi</th>
                                                        <th scope="col">Kelengkapan</th>
                                                        <th scope="col">DP</th>
                                                        <th scope="col">Biaya</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1; if(mysqli_num_rows($notes_views_all)==0){?>
                                                    <tr>
                                                        <th colspan="15">Belum ada data yang dimasukan hari ini!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($notes_views_all)>0){while($row_all=mysqli_fetch_assoc($notes_views_all)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <td>T<?= $row_all['id_nota_tinggal']?></td>
                                                        <td>DP<?= $row_all['id_nota_dp']?></td>
                                                        <td><a href="qr?auth=<?= $row_all['id_user']?>" class="nav-link" <?= $color_black?>><i class="fas fa-qrcode"></i></a></td>
                                                        <td>
                                                            <div class="dropdown no-arrow">
                                                                <button class="btn btn-link btn-sm dropdown-toggle" <?= $color_black?> type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-eye"></i> <?= $row_all['first_name']?></button>
                                                                <div class="dropdown-menu p-2 border-0 shadow text-center" <?= $color_black?> aria-labelledby="dropdownMenuButton">
                                                                    <p>Nama Depan: <?= $row_all['first_name']?></p>
                                                                    <p>Nama Belakang: <?= $row_all['last_name']?></p>
                                                                    <p>No. Tlpn: <?= $row_all['phone']?></p>
                                                                    <p>Email: <?= $row_all['email']?></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <?php $id_barang=$row_all['id_barang']; if($row_all['id_layanan']==1){
                                                            $handphone=mysqli_query($conn, "SELECT * FROM handphone WHERE id_hp='$id_barang'");foreach($handphone as $row_hp):?>
                                                            <td>
                                                                <div class="dropdown no-arrow">
                                                                    <button class="btn btn-link btn-sm dropdown-toggle" <?= $color_black?> type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-eye"></i> <?= $row_all['product']?></button>
                                                                    <div class="dropdown-menu p-2 border-0 shadow text-center" <?= $color_black?> aria-labelledby="dropdownMenuButton">
                                                                        <p>Type: <?= $row_hp['type']?></p>
                                                                        <p>Seri: <?= $row_hp['seri']?></p>
                                                                        <p>Imei: <?= $row_hp['imei']?></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        <?php endforeach;}if($row_all['id_layanan']==2){
                                                            $laptop=mysqli_query($conn, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");foreach($laptop as $row_laptop):?>
                                                            <td>
                                                                <div class="dropdown no-arrow">
                                                                    <button class="btn btn-link btn-sm dropdown-toggle" <?= $color_black?> type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-eye"></i> <?= $row_all['product']?></button>
                                                                    <div class="dropdown-menu p-2 border-0 shadow text-center" <?= $color_black?> aria-labelledby="dropdownMenuButton">
                                                                        <p>Type: <?= $row_laptop['merek']?></p>
                                                                        <p>Seri: <?= $row_laptop['seri']?></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        <?php endforeach;}?>
                                                        <td><?php $id_tek=$row_all['id_pegawai'];
                                                            $teknisi=mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_tek'");foreach($teknisi as $row_tek){echo $row_tek['first_name'];}?></td>
                                                        <td><?= $row_all['status']?></td>
                                                        <td><?= $row_all['tgl_masuk']?></td>
                                                        <td><?= $row_all['tgl_ambil']?></td>
                                                        <td><?= $row_all['kerusakan']?></td>
                                                        <td><?= $row_all['kondisi']?></td>
                                                        <td><?= $row_all['kelengkapan']?></td>
                                                        <td>Rp. <?= number_format($row_all['dp'])?></td>
                                                        <td>Rp. <?= number_format($row_all['biaya'])?></td>
                                                    </tr>
                                                    <?php $no++; }}?>
                                                </tbody>
                                            </table>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <?php if(isset($page7)){if(isset($total_page7)){if($page7>1):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" <?= $bg_black?> href="notes?page=<?= $page7-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page7; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page7):?>
                                                                <li class="page-item shadow"><a class="page-link font-weight-bold border-0" <?= $bg_black?> href="notes?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item shadow"><a class="page-link border-0" href="notes?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page7<$total_page7):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" <?= $bg_black?> href="notes?page=<?= $page7+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>