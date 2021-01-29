<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
    if(!isset($_SESSION['id-sparepart'])){header("Location: report-spareparts");exit;}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Pickup Sparepart | <?= $_SESSION['name-web']?></title>
    </head>
    <body id="page-top" class="sidebar-toggled">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php require_once('../application/access/side-navbar.php');?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php require_once('../application/access/top-navbar.php');?>
                    <div class="container-fluid" style="margin-top: 100px">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h2 mb-0 text-gray-800">Pickup Sparepart</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12">
                                <div class="d-sm-flex justify-content-between flex-row-reverse">
                                    <div class="col-md-4">
                                        <div class="card border-0 shadow">
                                            <div class="card-header text-center fa-1x">
                                                <p class="text-info font-weight-bold">Info</p>
                                            </div>
                                            <div class="card-body text-dark">
                                                <li>Cek data yang ingin di pickup/ambil dari stok.</li>
                                                <li>Input no nota dan teknisi.</li>
                                                <li>Pastikan nomor nota dengan benar beserta kodenya.</li>
                                                <li>Nota tinggal berkode T</li>
                                                <li>Nota dp berkode DP</li>
                                                <li>Nota Lunas berkode L</li>
                                                <li>Klik Pickup untuk memasukan data sparepart dari stok ke laporan.</li>
                                            </div>
                                        </div>
                                    </div>
                                    <?php foreach($pickup_sparepart as $row):?>
                                    <div class="col-md-8">
                                        <div class="card border-0 shadow">
                                            <div class="card-body">
                                                <p class="text-dark font-weight-bold">Data Sparepart #<?= $row['id_sparepart']?> - <?= $row['ket']?></p>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                                                    <input type="hidden" name="barang" value="<?= $row['jmlh_barang']?>">
                                                    <!-- <div class="col-12 text-center mb-2">
                                                        <small class="text-danger">*Pilih salah satu nota diantara kedua nota dibawah!</small>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <select name="id-nota-tinggal" class="form-control">
                                                                <option>Pilih No. Nota Tinggal</option>
                                                                <?php if(mysqli_num_rows($data_notaTinggal_pickup)==0){?>
                                                                <option>Maaf data masih kosong!</option>
                                                                <?php }else if(mysqli_num_rows($data_notaTinggal_pickup)>0){while($row_t=mysqli_fetch_assoc($data_notaTinggal_pickup)){?>
                                                                <option value="<?php 
                                                                    if(!empty($row_t['id_nota_tinggal'])){
                                                                        echo $row_t['id_nota_tinggal'];}
                                                                ?>"><?php 
                                                                    if(!empty($row_t['id_nota_tinggal'])){
                                                                        echo $row_t['id_nota_tinggal'];}?>
                                                                </option>
                                                                <?php }}?>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <select name="id-nota-lunas" class="form-control">
                                                                <option>Pilih No. Nota Lunas</option>
                                                                <?php if(mysqli_num_rows($data_notaLunas_pickup)==0){?>
                                                                <option>Maaf data masih kosong!</option>
                                                                <?php }else if(mysqli_num_rows($data_notaLunas_pickup)>0){while($row_l=mysqli_fetch_assoc($data_notaLunas_pickup)){?>
                                                                <option value="<?php 
                                                                    if(!empty($row_l['id_nota_lunas'])){
                                                                        echo $row_l['id_nota_lunas'];}
                                                                ?>"><?php 
                                                                    if(!empty($row_l['id_nota_lunas'])){
                                                                        echo $row_l['id_nota_lunas'];}?>
                                                                </option>
                                                                <?php }}?>
                                                            </select>
                                                        </div>
                                                    </div> -->
                                                    <div class="form-group mt-2">
                                                        <!-- <small class="text-danger">*Jika ingin menginput nota secara manual.</small> -->
                                                        <input type="text" name="no-nota" placeholder="No Nota" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="id-teknisi" class="form-control" required>
                                                            <option>Pilih Teknisi</option>
                                                            <?php foreach( $technicians_data as $row):?>
                                                            <option value="<?= $row['id_employee']?>"><?= $row['first_name']?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" name="pickup-sparepart" class="btn btn-success btn-sm">Pickup</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('../application/access/footer.php');?>
            </div>
        </div>
    </body>
</html>