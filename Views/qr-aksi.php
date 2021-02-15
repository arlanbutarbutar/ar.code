<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="QR";
    if(isset($_GET['auth'])){
        $data_encrypt=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['auth']))));
        $notes_qr=mysqli_query($conn, "SELECT * FROM notes
            JOIN users ON notes.id_user=users.id_user 
            JOIN category_services ON notes.id_layanan=category_services.id_category
            JOIN notes_status ON notes.id_status=notes_status.id_status 
            WHERE users.data_encrypt='$data_encrypt'
        ");
    }
?>

<!-- == qr aksi page == -->
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
                                <?php if(mysqli_num_rows($notes_qr)==0){?>
                                    <div class="col-lg-12">
                                        <div class="card card-body border-0 shadow text-center mt-3">
                                            <p class="text-danger font-weight-bold">Terjadi kesalahan, silakan coba lagi!</p>
                                        </div>
                                    </div>
                                <?php }else if(mysqli_num_rows($notes_qr)>0){while($row=mysqli_fetch_assoc($notes_qr)){?>
                                <!-- == view data == -->
                                    <?php if($_SESSION['id-role']<=3){?>
                                    <div class="col-lg-8">
                                    <?php }if($_SESSION['id-role']==4){?>
                                    <div class="col-lg-12">
                                    <?php }?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- == rincian perbaikan == -->
                                                    <div class="card card-body shadow border-0 mt-3">
                                                        <h6 class="font-weight-bold" <?= $color_black ?>>Rincian Perbaikan</h6>
                                                        <p <?= $color_black ?>>
                                                            Perbaikan <?= $row['product']?> dengan kerusakan <?= $row['kerusakan']?> dan kondisi <?= $row['kondisi']?>. Kelengkapan dari <?= $row['product']?> <?php if(empty($row['kelengkapan']) || $row['kelengkapan']=='-'){echo 'tidak ada';}else{echo $row['kelengkapan'];}?>. Perbaikan dikerjakan oleh <?php $id_tek=$row['id_pegawai'];$teknisi=mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_tek'");$row_tek=mysqli_fetch_assoc($teknisi);echo $row_tek['first_name'];?>
                                                        </p>
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col-lg-4">
                                                                <div class="h6 mb-0 mr-3 font-weight-bold" <?= $color_black ?>>Progress: 
                                                                    <?php $id_barang=$row['id_barang']; if($row['id_layanan']==1){
                                                                        $handphone=mysqli_query($conn, "SELECT * FROM handphone WHERE id_hp='$id_barang'");$row_hp=mysqli_fetch_assoc($handphone);echo $row_hp['type']." (".$row_hp['seri']." - ".$row_hp['imei'].")";
                                                                    }if($row['id_layanan']==2){
                                                                        $laptop=mysqli_query($conn, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");
                                                                        $row_laptop=mysqli_fetch_assoc($laptop);
                                                                        echo $row_laptop['merek']." (".$row_laptop['seri'].")";
                                                                    }?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <div class="progress mr-2">
                                                                <div class="progress-bar progress-bar-striped <?php if($row['progress']<100){echo "bg-warning";}else if($row['progress']==100){echo "bg-success";}?>" role="progressbar" style="width: <?= $row['progress']."%"?>" aria-valuenow="<?= $row['progress']?>" aria-valuemin="0" aria-valuemax="100"><?= $row['progress']."%"?></div>
                                                                </div>
                                                                <p class="small" <?= $color_black ?>>Jika Progress telah mencapai 75% maka status client mengambil barangnya.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <?php if($_SESSION['id-role']<=3){?>
                                                    <div class="col-lg-6">
                                                    <?php }if($_SESSION['id-role']==4){?>
                                                    <div class="col-lg-12">
                                                    <?php }?>
                                                        <!-- == ubah status == -->
                                                            <div class="card card-body shadow border-0 mt-3 text-center">
                                                                <p <?= $color_black ?>>Status saat ini <?= $row['status']?>, lakukan perubahan status jika ingin melanjutkan. Tekan tombol dibawah ini untuk merubah status.</p>
                                                                <form action="" method="POST" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                        <input type="hidden" name="data-encrypt" value="<?= $row['data_encrypt']?>">
                                                                        <input type="hidden" name="id-nota" value="<?= $row['id_nota']?>">
                                                                        <?php $id_status=$row['id_status'];if($id_status==1){?>
                                                                            <button type="submit" name="ubah-status-progress" class="btn btn-warning btn-sm">On Progress</button>
                                                                        <?php }else if($id_status==2){if($_SESSION['id-role']<=3){?>
                                                                            <button type="submit" name="ubah-status-pending" class="btn btn-danger btn-sm">Pending</button>
                                                                        <?php }}else if($id_status==3){?>
                                                                            <button type="submit" name="ubah-status-waiting" class="btn btn-info btn-sm">Waiting to be taken</button>
                                                                        <?php }else if($id_status==4){if($_SESSION['id-role']<=3){?>
                                                                            <button type="submit" name="ubah-status-success" class="btn btn-success btn-sm">Finish/Success</button>
                                                                        <?php }}else if($id_status==5){if($_SESSION['id-role']<=3){?>
                                                                            <button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#collapse-report" aria-expanded="false" aria-controls="collapse-report">Report</button>
                                                                            <div class="collapse" id="collapse-report">
                                                                                <div class="card card-body border-0 m-0 p-0 mt-3">
                                                                                    <div class="form-group">
                                                                                        <label for="nota-lunas" <?= $color_black?>>Nota Lunas <small class="text-danger">wajib*</small></label>
                                                                                        <input type="number" name="nota-lunas" id="nota-lunas" placeholder="Nota Lunas" class="form-control" required>
                                                                                    </div>
                                                                                    <?php if($row['garansi']!='GARANSI TERPAKAI'){?>
                                                                                    <div class="form-group">
                                                                                        <label for="garansi" <?= $color_black?>>Garansi <small class="text-danger">wajib*</small></label>
                                                                                        <input type="date" name="garansi" id="garansi" placeholder="Garansi" value="1 Minggu" class="form-control" required>
                                                                                    </div>
                                                                                    <?php }?>
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
                                                                                    <div class="form-group">
                                                                                        <button type="submit" name="submit-report" class="btn btn-sm ml-3" <?= $bg_black?>><i class="fas fa-check-double"></i> Apply</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php }}else if($id_status==6){?>
                                                                            <p <?= $color_black?>>Data telah dimasukan ke laporan harian.</p>
                                                                            <?php if($row['garansi']=='GARANSI TERPAKAI'){?>
                                                                            <p class="fa-1x text-success"><?= $row['garansi']?></p>
                                                                            <?php }else if($row['garansi']!='GARANSI TERPAKAI'){?>
                                                                            <p class="fa-2x" <?= $color_black?> id="demo"></p>
                                                                            <?php if($_SESSION['id-role']<=3){$date_now=date('Y-m-d');if($date_now<$row['garansi']){?>
                                                                                <div class="form-group">
                                                                                    <button type="submit" name="submit-garansi" class="btn btn-sm ml-3" <?= $bg_black?>><i class="fas fa-toolbox"></i> Garansi</button>
                                                                                </div>
                                                                            <?php }}}?>
                                                                            <script>
                                                                                var countDownDate = new Date("<?= $row['garansi']?> 00:00:00").getTime();
                                                                                var x = setInterval(function() {
                                                                                    var now = new Date().getTime();
                                                                                    var distance = countDownDate - now;
                                                                                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                                                    document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
                                                                                    if (distance < 0) {
                                                                                        clearInterval(x);
                                                                                        document.getElementById("demo").innerHTML = "EXPIRED";
                                                                                    }
                                                                                }, 1000);
                                                                            </script>
                                                                        <?php }?>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                    </div>
                                                    <?php if($_SESSION['id-role']<=3){?>
                                                    <div class="col-lg-6">
                                                        <!-- == hapus data == -->
                                                            <div class="card card-body shadow border-0 mt-3 text-center">
                                                                <p <?= $color_black ?>>Jika ingin menghapus data ini silakan klik tombol hapus atau jika hanya ingin mengbatalkan perbaikan silakan klik tombol batal.</p>
                                                                <?php if($row['id_status']<6){?>
                                                                <form action="" method="POST" class="d-flex justify-content-center">
                                                                    <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                    <input type="hidden" name="barcode" value="<?= $row['barcode']?>">
                                                                    <input type="hidden" name="data-encrypt" value="<?= $row['data_encrypt']?>">
                                                                    <input type="hidden" name="id-layanan" value="<?= $row['id_layanan']?>">
                                                                    <input type="hidden" name="id-nota" value="<?= $row['id_nota']?>">
                                                                    <div class="form-group">
                                                                        <button type="submit" name="delete-notes" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" name="cancel-notes" class="btn btn-danger btn-sm ml-3"><i class="fas fa-times"></i> Batal</button>
                                                                    </div>
                                                                </form>
                                                                <?php }if($row['id_status']==6){?>
                                                                <p <?= $color_black?>>Data ini telah dimasukan ke dalam laporan sehingga tidak dapat dirubah lagi.</p>
                                                                <?php }?>
                                                            </div>
                                                    </div>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- == edit data == -->
                                    <?php if($_SESSION['id-role']<=3){?>
                                        <div class="col-lg-4">
                                            <div class="row">
                                                <!-- == tambah sparepart == -->
                                                    <div class="col-lg-12">
                                                        <div class="card card-body shadow border-0 mt-3 text-center">
                                                            <?php $id_user=$row['id_user']; $view_sparepart=mysqli_query($conn, "SELECT * FROM laporan_spareparts WHERE id_user='$id_user'"); if(mysqli_num_rows($view_sparepart)==0){?>
                                                                <h4 class="font-weight-bold" <?= $color_black?>>Sparepart</h4>
                                                                <p class="small" <?= $color_black?>>Tambahkan sparepart untuk barang yang diperbaiki disini.</p>
                                                                <?php if($row['id_status']<6){?>
                                                                    <button class="btn btn-link btn-sm" <?= $color_black?> type="button" data-toggle="collapse" data-target="#insert-sparepart" aria-expanded="false" aria-controls="insert-sparepart">Gulir kebawah <i class="fas fa-hand-point-down"></i></button>
                                                                    <div class="collapse" id="insert-sparepart">
                                                                        <div class="card card-body border-0 m-0 p-0 text-center">
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                                <input type="hidden" name="id-teknisi" value="<?= $row['id_pegawai']?>">
                                                                                <?php if(!empty($row['id_nota_tinggal'])){?>
                                                                                    <input type="hidden" name="id-nota" value="<?= $row['id_nota_tinggal']?>">
                                                                                <?php }else{?>
                                                                                    <input type="hidden" name="id-nota" value="<?= $row['id_nota_lunas']?>">
                                                                                <?php }?>
                                                                                <input type="hidden" name="data-encrypt" value="<?= $row['data_encrypt']?>">
                                                                                <div class="form-group">
                                                                                    <input type="text" name="ket" placeholder="Sparepart" class="form-control text-center" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="suplayer" placeholder="Suplayer" class="form-control text-center" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input type="number" name="harga" placeholder="Harga (per biji)" class="form-control text-center" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <textarea name="ket-plus" cols="30" rows="5" class="form-control" placeholder="Keterangan tambahan"></textarea>
                                                                                </div>
                                                                                <div class='form-group'>
                                                                                    <button type="submit" name="submit-sparepart-qr" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                <?php }if($row['id_status']==6){?>
                                                                    <p <?= $color_black?>>Data ini telah dimasukan ke dalam laporan sehingga tidak dapat dirubah lagi.</p>
                                                            <?php }}else if(mysqli_num_rows($view_sparepart)>0){?>
                                                                <h4 class="font-weight-bold" <?= $color_black?>>Sparepart</h4>
                                                                <p class="small" <?= $color_black?>>Data sparepart telah dimasukan, berikut data dan barcode dari sparepart.</p>
                                                                <?php if(mysqli_num_rows($view_sparepart)==1){if($row['garansi']=="GARANSI TERPAKAI"){?>
                                                                    <button class="btn btn-link btn-sm" <?= $color_black?> type="button" data-toggle="collapse" data-target="#insert-sparepart" aria-expanded="false" aria-controls="insert-sparepart">Gulir kebawah untuk garansi <i class="fas fa-hand-point-down"></i></button>
                                                                    <div class="collapse" id="insert-sparepart">
                                                                        <div class="card card-body border-0 m-0 p-0 text-center">
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                                <input type="hidden" name="id-teknisi" value="<?= $row['id_pegawai']?>">
                                                                                <?php if(!empty($row['id_nota_tinggal'])){?>
                                                                                    <input type="hidden" name="id-nota" value="<?= $row['id_nota_tinggal']?>">
                                                                                <?php }else{?>
                                                                                    <input type="hidden" name="id-nota" value="<?= $row['id_nota_lunas']?>">
                                                                                <?php }?>
                                                                                <input type="hidden" name="data-encrypt" value="<?= $row['data_encrypt']?>">
                                                                                <div class="form-group">
                                                                                    <input type="text" name="ket" placeholder="Sparepart" class="form-control text-center" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="suplayer" placeholder="Suplayer" class="form-control text-center" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input type="number" name="harga" placeholder="Harga (per biji)" class="form-control text-center" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <textarea name="ket-plus" cols="30" rows="5" class="form-control" placeholder="Keterangan tambahan"></textarea>
                                                                                </div>
                                                                                <div class='form-group'>
                                                                                    <button type="submit" name="submit-sparepart-qr" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                <?php }}?>
                                                                <button class="btn btn-link btn-sm mb-2" <?= $color_black?> type="button" data-toggle="collapse" data-target="#sparepart" aria-expanded="false" aria-controls="sparepart">Gulir kebawah <i class="fas fa-hand-point-down"></i></button>
                                                                <?php while($row_sp=mysqli_fetch_assoc($view_sparepart)){?>
                                                                <div class="collapse" id="sparepart">
                                                                    <div class="card card-body border-0 m-0 p-0 text-center">
                                                                        <div class="m-auto"><?= $row_sp['barcode']?></div>
                                                                        <p <?= $color_black?>><?= $row_sp['data_encrypt']?></p>
                                                                        <p <?= $color_black?>>Sparepart yang digunakan <?= $row_sp['ket']?> di dapat dari <?= $row_sp['suplayer']?> dengan harga Rp. <?= number_format($row_sp['harga'])?></p>
                                                                        <?php if($row['id_nota']<=3 || $row_sp['status_sparepart']<=3){?>
                                                                            <div class="dropdown no-arrow small" <?= $color_black?>>Ingin mengubah data klik
                                                                                <button class="btn btn-link btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">disini</button>
                                                                                <p <?= $color_black?>>Jika ingin hapus </p>
                                                                                <form action="" method="POST">
                                                                                    <input type="hidden" name="id-sparepart" value="<?= $row_sp['id_sparepart']?>">
                                                                                    <input type="hidden" name="ket" value="<?= $row_sp['ket']?>">
                                                                                    <input type="hidden" name="data-encrypt" value="<?= $row['data_encrypt']?>">
                                                                                    <div class="form-group">
                                                                                        <button type="submit" name="delete-sparepart-qr" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                                                    </div>
                                                                                </form>
                                                                                <div class="dropdown-menu p-2 border-0 shadow text-center" <?= $color_black?> aria-labelledby="dropdownMenuButton">
                                                                                    <form action="" method="POST">
                                                                                        <input type="hidden" name="id-sparepart" value="<?= $row_sp['id_sparepart']?>">
                                                                                        <input type="hidden" name="data-encrypt" value="<?= $row['data_encrypt']?>">
                                                                                        <div class="form-group">
                                                                                            <label for="ket" <?= $color_black?>>Keterangan</label>
                                                                                            <input type="text" name="ket" value="<?= $row_sp['ket']?>" placeholder="Sparepart" class="form-control text-center" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="suplayer" <?= $color_black?>>Suplayer</label>
                                                                                            <input type="text" name="suplayer" value="<?= $row_sp['suplayer']?>" placeholder="Suplayer" class="form-control text-center" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="harga" <?= $color_black?>>Harga</label>
                                                                                            <input type="number" name="harga" value="<?= $row_sp['harga']?>" placeholder="Harga (per biji)" class="form-control text-center" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="ket-plus" <?= $color_black?>>Keterangan Tambahan</label>
                                                                                            <textarea name="ket-plus" cols="30" rows="5" class="form-control" placeholder="Keterangan tambahan"><?= $row_sp['ket_plus']?></textarea>
                                                                                        </div>
                                                                                        <div class='form-group'>
                                                                                            <button type="submit" name="edit-sparepart-qr" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        <?php }?>
                                                                    </div>
                                                                </div>
                                                            <?php }}?>
                                                        </div>
                                                    </div>
                                                <!-- == edit data == -->
                                                    <div class="col-lg-12">
                                                        <div class="card card-body shadow border-0 mt-3 mb-5 text-center">
                                                            <h4 class="font-weight-bold" <?= $color_black?>>Edit Data</h4>
                                                            <p class="small" <?= $color_black?>>Ubah data untuk nota tinggal ataupun nota dp disini.</p>
                                                            <?php if($row['id_status']<6){?>
                                                            <button class="btn btn-link btn-sm" <?= $color_black?> type="button" data-toggle="collapse" data-target="#insert-nota" aria-expanded="false" aria-controls="insert-nota">Gulir kebawah <i class="fas fa-hand-point-down"></i></button>
                                                            <div class="collapse" id="insert-nota">
                                                                <div class="card card-body border-0 m-0 p-0 text-center">
                                                                    <form action="" method="POST">
                                                                        <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                        <input type="hidden" name="data-encrypt" value="<?= $row['data_encrypt']?>">
                                                                        <input type="hidden" name="id-layanan" value="<?= $row['id_layanan']?>">
                                                                        <?php if($row['id_nota']!=3){?>
                                                                        <div class='form-group'>
                                                                            <label for="nota-tinggal" <?= $color_black?>>Nota Tinggal</label>
                                                                            <input type="number" name="nota-tinggal" id="nota-tinggal" value="<?= $row['id_nota_tinggal']?>" placeholder="Nomor nota tinggal"  class="form-control text-center" required>
                                                                            <small class="text-danger">Wajib*</small>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label for="nota-dp" <?= $color_black?>>Nota DP</label>
                                                                            <input type="number" name="nota-dp" id="nota-dp" value="<?= $row['id_nota_dp']?>" placeholder="Nomor nota dp" class="form-control text-center">
                                                                            <small class="text-info">Jika ada isikan!</small>
                                                                        </div>
                                                                        <?php }if($row['id_nota']==3){?>
                                                                        <div class='form-group'>
                                                                            <label for="nota-lunas" <?= $color_black?>>Nota Lunas</label>
                                                                            <input type="number" name="nota-lunas" id="nota-lunas" value="<?= $row['id_nota_lunas']?>" placeholder="Nomor nota lunas" class="form-control text-center" required>
                                                                            <small class="text-danger">Wajib*</small>
                                                                        </div>
                                                                        <?php }?>
                                                                        <div class='form-group'>
                                                                            <label for="username" <?= $color_black?>>Username</label>
                                                                            <input type="text" name="username" id="username" value="<?= $row['first_name']?>" placeholder="Nama pengguna" class="form-control text-center" required>
                                                                            <small class="text-danger">Wajib*</small>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label for="email" <?= $color_black?>>Email</label>
                                                                            <input type="email" name="email" id="email" value="<?= $row['email']?>" placeholder="Alamat email" class="form-control text-center">
                                                                            <small class="text-info">Jika diinginkan!</small>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label for="tlpn" <?= $color_black?>>Tlpn/No. HP</label>
                                                                            <input type="number" name="tlpn" id="tlpn" value="<?= $row['phone']?>" placeholder="Nomor hp/tlpn" class="form-control text-center" required>
                                                                            <small class="text-danger">Wajib*</small>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label for="alamat" <?= $color_black?>>Alamat</label>
                                                                            <input type="text" name="alamat" id="alamat" value="<?= $row['address']?>" placeholder="Alamat" class="form-control text-center">
                                                                        </div>
                                                                        <?php $id_barang=$row['id_barang']; if($row['id_layanan']==1){
                                                                            $handphone=mysqli_query($conn, "SELECT * FROM handphone WHERE id_hp='$id_barang'");$row_hp=mysqli_fetch_assoc($handphone);?>
                                                                            <div class="form-group">
                                                                                <label for="type" <?= $color_black?>>Type</label>
                                                                                <input type="text" name="type" id="type" value="<?= $row_hp['type']?>" placeholder="Type" class="form-control text-center">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="seri" <?= $color_black?>>Seri</label>
                                                                                <input type="text" name="seri-hp" id="seri" value="<?= $row_hp['seri']?>" placeholder="Seri" class="form-control text-center">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="imei" <?= $color_black?>>Imei</label>
                                                                                <input type="text" name="imei" id="imei" value="<?= $row_hp['imei']?>" placeholder="Imei" class="form-control text-center">
                                                                            </div>
                                                                        <?php }else if($row['id_layanan']==2){
                                                                            $laptop=mysqli_query($conn, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");$row_laptop=mysqli_fetch_assoc($laptop);?>
                                                                            <div class="form-group">
                                                                                <label for="merek" <?= $color_black?>>Merek</label>
                                                                                <input type="text" name="merek" id="merek" value="<?= $row_laptop['merek']?>" placeholder="Merek" class="form-control text-center">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="seri" <?= $color_black?>>Seri</label>
                                                                                <input type="text" name="seri-laptop" id="seri" value="<?= $row_laptop['seri']?>" placeholder="Seri" class="form-control text-center">
                                                                            </div>
                                                                        <?php }?>
                                                                        <div class='form-group mt-3'>
                                                                            <label for="kerusakan" <?= $color_black?>>Kerusakan</label>
                                                                            <input type="text" name="kerusakan" id="kerusakan" value="<?= $row['kerusakan']?>" placeholder="Kerusakan" class="form-control text-center" required>
                                                                            <small class="text-danger">Wajib*</small>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label for="kondisi" <?= $color_black?>>Kondisi</label>
                                                                            <input type="text" name="kondisi" id="kondisi" value="<?= $row['kondisi']?>" placeholder="Kondisi" class="form-control text-center">
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label for="kelengapan" <?= $color_black?>>Kelengkapan</label>
                                                                            <input type="text" name="kelengkapan" id="kelengkapan" value="<?= $row['kelengkapan']?>" placeholder="Kelengkapan" class="form-control text-center">
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
                                                                            <label for="tgl-ambil" <?= $color_black?>>Tgl Ambil</label>
                                                                            <input type="date" name="tgl-ambil" id="tgl-ambil" class="form-control text-center">
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label for="dp" <?= $color_black?>>DP/Uang muka</label>
                                                                            <input type="number" name="dp" id="dp" value="<?= $row['dp']?>" placeholder="DP" class="form-control text-center">
                                                                            <small class="text-info">Jika ada nota dp!</small>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label for="biaya" <?= $color_black?>>Biaya</label>
                                                                            <input type="number" name="biaya" id="biaya" value="<?= $row['biaya']?>" placeholder="Biaya" class="form-control text-center" required>
                                                                            <small class="text-danger">Wajib*</small>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <button type="submit" name="edit-notes" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <?php }if($row['id_status']==6){?>
                                                            <p <?= $color_black?>>Data ini telah dimasukan ke dalam laporan sehingga tidak dapat dirubah lagi.</p>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                <?php }}}?>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>