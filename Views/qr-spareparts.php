<?php if(!isset($_SESSION)){session_start();}
    if(!isset($_GET['auth']) || empty($_GET['auth'])){
        if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Masuk'){
            header("Location: report-spareparts");exit;
        }else if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Dipakai'){
            header("Location: report-spareparts-pickup");exit;
        }else if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Diambil'){
            header("Location: report-spareparts-out");exit;
        }else if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Semua'){
            header("Location: report-spareparts-all");exit;
        }else if(!isset($_SESSION['page-name'])){
            header("Location: report-spareparts");exit;
        }
    }
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="QR Sparepart";
    if(isset($_GET['auth'])){
        $data_encrypt=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['auth']))));
        $sparepart_qrcode=mysqli_query($conn, "SELECT * FROM laporan_spareparts 
            JOIN supplier ON laporan_spareparts.suplayer=supplier.id_supplier 
            JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status 
            WHERE laporan_spareparts.data_encrypt='$data_encrypt'
        ");
    }
?>

<!-- == QR Sparepart page == -->
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
                            <div class="row flex-row-reverse">
                                <!-- == alert message == -->
                                    <div class="col-md-12">
                                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    </div>
                                <?php if(mysqli_num_rows($sparepart_qrcode)==0){?>
                                    <div class="col-lg-12">
                                        <div class="card card-body border-0 shadow text-center mt-3">
                                            <p class="text-danger font-weight-bold">Terjadi kesalahan, silakan coba lagi!</p>
                                        </div>
                                    </div>
                                <?php }if(mysqli_num_rows($sparepart_qrcode)>0){while($row=mysqli_fetch_assoc($sparepart_qrcode)){?>
                                    <!-- == insert notes == -->
                                        <div class="col-lg-4">
                                            <div class="card card-body border-0 shadow mt-3 text-center" <?= $color_black?>>
                                                <?php if(empty($row['id_nota'])){?>
                                                    <h4 class="font-weight-bold" <?= $color_black?>>Masukan Nota</h4>
                                                    <p class="small" <?= $color_black?>>Tambahkan nota untuk sparepart yang akan digunakan disini.</p>
                                                    <button class="btn btn-link btn-sm" <?= $color_black?> type="button" data-toggle="collapse" data-target="#insert-sparepart" aria-expanded="false" aria-controls="insert-sparepart">Gulir kebawah <i class="fas fa-hand-point-down"></i></button>
                                                    <div class="collapse" id="insert-sparepart">
                                                        <div class="card card-body border-0 m-0 p-0 text-center">
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="jumlah" value="<?= $row['jmlh_barang']?>">
                                                                <input type="hidden" name="data-encrypt" value="<?= $row['data_encrypt']?>">
                                                                <div class="form-group">
                                                                    <select name="id-user" class="form-control" <?= $color_black?>>
                                                                        <option>Pilih No. Nota</option>
                                                                        <?php foreach($notes_for_spareparts as $row_n):?>
                                                                            <option value="<?= $row_n['id_user']?>"><?= "T".$row_n['id_nota_tinggal']."/L".$row_n['id_nota_lunas']?></option>
                                                                        <?php endforeach;?>
                                                                    </select>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <button type="submit" name="notes-sparepart" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php }else if(!empty($row['id_nota'])){?>
                                                    <p <?= $color_black?>>Data telah dimasukan, jika ingin merubahnya cek nota terkait.</p>
                                                <?php }?>
                                            </div>
                                        </div>
                                    <!-- == data qr == -->
                                        <div class="col-lg-8">
                                            <div class="card card-body border-0 shadow mt-3" <?= $color_black?>>
                                                <h6 class="font-weight-bold" <?= $color_black ?>>Rincian Sparepart</h6>
                                                <p <?= $color_black ?>>
                                                    Sparepart <?= $row['ket']?> dibeli dari suplayer <?= $row['supplier']?> dengan harga <?= $row['harga']?>. Total pembelian dari sparepart<?= $row['ket']?> adalah Rp. <?= number_format($row['total'])?>. Jumlah barang yang tersedia saat ini <?= $row['jmlh_barang']?>.
                                                </p>
                                                <p <?= $color_black ?>>Status saat ini : <?= $row['status']?></p>
                                                <?php if(!empty($row['id_nota'])){?>
                                                    <p <?= $color_black ?>>Cek nota terkait klik <a href="qr-aksi?auth=<?= $data_encrypt=crc32($row['id_user']);?>">disini</a></p>
                                                <?php }?>
                                            </div>
                                        </div>
                                <?php }}?>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>