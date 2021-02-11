<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="Nota Lunas";
?>

<!-- == Nota Lunas page == -->
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
                                <h1 class="h3 mb-0" <?= $color_black ?>><?= $_SESSION['page-name']?></h1>
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
                                            <?php if($_SESSION['id-role']<=3){?>
                                            <div class="col-lg-4">
                                                <div class="card card-body border-0 shadow mt-3 text-center">
                                                    <h4 class="font-weight-bold" <?= $color_black?>>Masukan Data</h4>
                                                    <p class="small" <?= $color_black?>>Masukan data untuk nota lunas disini.</p>
                                                    <button class="btn btn-link btn-sm" <?= $color_black?> type="button" data-toggle="collapse" data-target="#insert-nota" aria-expanded="false" aria-controls="insert-nota">Gulir kebawah <i class="fas fa-hand-point-down"></i></button>
                                                    <div class="collapse" id="insert-nota">
                                                        <div class="card card-body border-0 m-0 p-0">
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                                <div class='form-group'>
                                                                    <input type="number" name="nota-lunas" placeholder="Nomor nota lunas" class="form-control text-center" required>
                                                                    <small class="text-danger">Wajib*</small>
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
                                                                        <input type="text" name="seri-hp" placeholder="Seri" class="form-control text-center">
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
                                                                        <input type="text" name="seri-laptop" placeholder="Seri" class="form-control text-center">
                                                                    </div>
                                                                </div>
                                                                <div class='form-group mt-3'>
                                                                    <input type="text" name="kerusakan" placeholder="Kerusakan" class="form-control text-center" required>
                                                                    <small class="text-danger">Wajib*</small>
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
                                                                    <input type="number" name="biaya" placeholder="Biaya" class="form-control text-center" required>
                                                                    <small class="text-danger">Wajib*</small>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="garansi" <?= $color_black?>>Garansi <small class="text-danger">wajib*</small></label>
                                                                    <input type="date" name="garansi" id="garansi" placeholder="Garansi" value="1 Minggu" class="form-control" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="ket" <?= $color_black?>>Keterangan <small class="text-info">jika ada keterangan isikan.</small></label>
                                                                    <textarea name="ket" id="ket" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <label for="ket-img" <?= $color_black?>>Bukti tanpa nota <small class="text-info">Jika ambil barang tanpa nota maka masukan tanda bukti lain seperti KTP/Tanda Pengenal lainnya.</small></label>
                                                                    <div class="custom-file">
                                                                        <input type="file" name="ket-img" class="custom-file-input" id="ket-img" aria-describedby="inputGroupFileAddon03">
                                                                        <label class="custom-file-label text-center" for="ket-img">Pilih Gambar</label>
                                                                    </div>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <button type="submit" name="submit-notes-lunas" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?>
                                        <!-- == view data table today == -->
                                            <?php if($_SESSION['id-role']<=3){?>
                                            <div class="col-lg-8">
                                            <?php }if($_SESSION['id-role']==4){?>
                                            <div class="col-lg-12">
                                            <?php }?>
                                                <div class="card card-body border-0 shadow mt-3" style="overflow-x: auto;">
                                                    <table class="table table-sm text-center" <?= $color_black?>>
                                                        <thead>
                                                            <tr style="border-top:hidden">
                                                                <th scope="col">#</th>
                                                                <th scope="col">#Nota Tinggal</th>
                                                                <th scope="col">#Nota DP</th>
                                                                <th scope="col">#Nota Lunas</th>
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
                                                                <th scope="col">Tgl Lunas</th>
                                                                <th scope="col">Tgl Ambil</th>
                                                                <th scope="col">Kerusakan</th>
                                                                <th scope="col">Kondisi</th>
                                                                <th scope="col">Kelengkapan</th>
                                                                <th scope="col">DP</th>
                                                                <th scope="col">Biaya</th>
                                                                <th scope="col">Bukti tanpa nota</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no=1; if(mysqli_num_rows($notes_lunas_views_all)==0){?>
                                                            <tr>
                                                                <th colspan="13">Belum ada data yang dimasukan hari ini!</th>
                                                            </tr>
                                                            <?php }else if(mysqli_num_rows($notes_lunas_views_all)>0){while($row_all=mysqli_fetch_assoc($notes_lunas_views_all)){?>
                                                            <tr>
                                                                <th scope="row"><?= $no;?></th>
                                                                <td>T<?= $row_all['id_nota_tinggal']?></td>
                                                                <td>DP<?= $row_all['id_nota_dp']?></td>
                                                                <td>L<?= $row_all['id_nota_lunas']?></td>
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
                                                                <?php if($_SESSION['id-role']<=2){?>
                                                                <td><?= $row_all['time_status']?></td>
                                                                <?php }?>
                                                                <td><?= $row_all['tgl_masuk']?></td>
                                                                <?php if($_SESSION['id-role']<=2){?>
                                                                <td><?= $row_all['time']?></td>
                                                                <?php }?>
                                                                <td><?= $row_all['tgl_lunas']?></td>
                                                                <td><?= $row_all['tgl_ambil']?></td>
                                                                <td><?= $row_all['kerusakan']?></td>
                                                                <td><?= $row_all['kondisi']?></td>
                                                                <td><?= $row_all['kelengkapan']?></td>
                                                                <td>Rp. <?= number_format($row_all['dp'])?></td>
                                                                <td>Rp. <?= number_format($row_all['biaya'])?></td>
                                                                <td><?php if(!empty($row_all['ket_img'])){?>
                                                                    <a href="bukti-tanpa-nota?auth=<?= $row_all['id_user']?>" class="nav-link" <?= $color_black?> target="_blank"><i class="fas fa-eye"></i> Liat</a>
                                                                <?php }if(empty($row_all['ket_img'])){echo "tidak ada";}?></td>
                                                            </tr>
                                                            <?php $no++; }}?>
                                                        </tbody>
                                                    </table>
                                                    <nav class="small" aria-label="Page navigation example">
                                                        <ul class="pagination justify-content-center">
                                                            <?php if(isset($page8)){if(isset($total_page8)){if($page8>1):?>
                                                            <li class="page-item shadow">
                                                                <a class="page-link border-0" <?= $bg_black?> href="nota-lunas?page=<?= $page8-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                            </li>
                                                            <?php endif;?>
                                                            <?php for($i=1; $i<=$total_page8; $i++):?>
                                                                <?php if($i<=5):?>
                                                                    <?php if($i==$page8):?>
                                                                        <li class="page-item shadow"><a class="page-link font-weight-bold border-0" <?= $bg_black?> href="nota-lunas?page=<?= $i;?>"><?= $i;?></a></li>
                                                                    <?php else :?>
                                                                        <li class="page-item shadow"><a class="page-link border-0" href="nota-lunas?page=<?= $i;?>"><?= $i;?></a></li>
                                                                    <?php endif;?>
                                                                <?php endif;?>
                                                            <?php endfor;?>
                                                            <?php if($page8<$total_page8):?>
                                                            <li class="page-item shadow">
                                                                <a class="page-link border-0" <?= $bg_black?> href="nota-lunas?page=<?= $page8+1;?>">Next</a>
                                                            </li>
                                                            <?php endif;}}?>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>