<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');require_once('../controller/barcode128.php');require_once('../assets/phpqrcode/qrlib.php');
    if(!isset($_GET['ac'])){header("Location: report-spareparts");exit;}else
    if(isset($_GET['ac'])){$id=htmlspecialchars(addslashes(trim($_GET['ac'])));$barcode=mysqli_query($conn, "SELECT * FROM laporan_spareparts WHERE id_sparepart='$id'");}
    if(isset($_POST['reload-sparepart'])){
        $id_sparepart=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-sparepart']))));
        $qr=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['barcode']))));
        $files=glob("../assets/img/img-barcode-sparepart/".$qr);
        foreach ($files as $file) {
            if(is_file($file))
            unlink($file);
        }
        $qrvalue = "https://www.ugdhp.com/views/qr?ac=".$id_sparepart;
        $tempDir = "../assets/img/img-barcode-sparepart/";
        $codeContents = $qrvalue;
        $fileName = $id_sparepart.".png";
        $pngAbsoluteFilePath = $tempDir.$fileName;
        if(!file_exists($pngAbsoluteFilePath)){
            QRcode::png($codeContents, $pngAbsoluteFilePath);
        }
        mysqli_query($conn, "UPDATE laporan_spareparts SET barcode='$fileName' WHERE id_sparepart='$id_sparepart'");
        header("Location: qr?ac=".$id_sparepart);exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>QR Spareparts | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">QR Spareparts</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <?php if(mysqli_num_rows($barcode)==0){?>
                            <div class="col-md-12">
                                <p class="text-dark">Terjadi kesalahan penampilan data, segera hubungi client services.</p>
                            </div>
                            <?php }else if(mysqli_num_rows($barcode)>0){while($row=mysqli_fetch_assoc($barcode)){?>
                            <div class="col-md-12">
                                <div class="row">
                                    <?php if($row['status_sparepart']==1){?>
                                    <div class="col-md-12">
                                        <?php if($row['status_sparepart']==1){?>
                                        <a href="report-spareparts" class="text-link text-decoration-none">Back Page</a>
                                        <?php }if($row['status_sparepart']==2){?>
                                        <a href="report-spareparts-pickup" class="text-link text-decoration-none">Back Page</a>
                                        <?php }if($row['status_sparepart']==3){?>
                                        <a href="report-spareparts-out" class="text-link text-decoration-none">Back Page</a>
                                        <?php }?>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                    <?php }if($row['status_sparepart']==2 || $row['status_sparepart']==3){?>
                                    <div class="col-md-12">
                                        <a href="report-spareparts-pickup" class="text-link text-decoration-none">Back Page</a>
                                    </div>
                                    <div class="col-lg-6 text-center">
                                    <?php }?>
                                        <div class="card border-0 shadow mt-3">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-center">
                                                    <div class="col-lg-6">
                                                        <h3 class="text-dark font-weight-bold">#<?= $row['id_sparepart']?></h3>
                                                        <img src="../assets/img/img-barcode-sparepart/<?= $row['barcode']?>" alt="qr sparepart" style="width: 200px">
                                                        <div class="d-sm-flex justify-content-center">
                                                            <p class="text-dark mr-2">Reload create barcode</p>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                                                                <input type="hidden" name="barcode" value="<?= $row['barcode']?>">
                                                                <button type="submit" name="reload-sparepart" class="btn btn-link btn-sm text-warning shadow"><i class="fas fa-undo"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 text-dark text-center m-auto">
                                                        <h3 class="font-weight-bold">Data Sparepart</h3>
                                                        <p>Tanggal Masuk <?= $row['tgl_masuk']?> waktu <?= $row['time']?> dengan sparepart <?= $row['ket']?> dari suplayer <?= $row['suplayer']?>. Jumlah barang yang dibeli <?= $row['jmlh_barang']?> dengan harga persatuan Rp. <?= number_format($row['harga'])?> dan total menjadi Rp. <?= number_format($row['total'])?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($row['status_sparepart']==2 || $row['status_sparepart']==3){$id_nota=$row['id_nota'];
                                        $QRnota_tinggal=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_nota_tinggal='$id_nota' OR id_nota_dp='$id_nota' OR id_nota_lunas='$id_nota'");
                                        if(mysqli_num_rows($QRnota_tinggal)>0){
                                            $QRnota=mysqli_query($conn, "SELECT * FROM nota_tinggal JOIN users_local ON nota_tinggal.id_user=users_local.id_user JOIN employee ON nota_tinggal.id_pegawai=employee.id_employee WHERE id_nota_tinggal='$id_nota' OR id_nota_dp='$id_nota' OR id_nota_lunas='$id_nota'");
                                        }else{
                                            $QRnota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_tinggal='$id_nota' OR id_nota_dp='$id_nota' OR id_nota_lunas='$id_nota'");
                                            if(mysqli_num_rows($QRnota_lunas)>0){
                                                $QRnota=mysqli_query($conn, "SELECT * FROM nota_lunas JOIN users_local ON nota_lunas.id_user=users_local.id_user JOIN employee ON nota_lunas.id_pegawai=employee.id_employee WHERE id_nota_tinggal='$id_nota' OR id_nota_dp='$id_nota' OR id_nota_lunas='$id_nota'");
                                            }else{
                                                $QRlaporan_harian=mysqli_query($conn, "SELECT * FROM laporan_harian WHERE id_nota_tinggal='$id_nota' OR id_nota_dp='$id_nota' OR id_nota_lunas='$id_nota'");
                                                if(mysqli_num_rows($QRlaporan_harian)>0){
                                                    $QRnota=mysqli_query($conn, "SELECT * FROM laporan_harian JOIN users_local ON laporan_harian.id_user=users_local.id_user JOIN employee ON laporan_harian.id_pegawai=employee.id_employee WHERE id_nota_tinggal='$id_nota' OR id_nota_dp='$id_nota' OR id_nota_lunas='$id_nota'");
                                                }
                                            }
                                        }
                                        foreach($QRnota as $row_qr):
                                    ?>
                                    <div class="col-lg-6 text-center">
                                        <div class="card border-0 shadow mt-3">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-center">
                                                    <div class="col-lg-6">
                                                        <h3 class="text-dark font-weight-bold">#<?= $row['id_nota']?></h3>
                                                        <img src="../assets/img/img-barcode-modern/<?= $row_qr['barcode']?>" alt="qr nota" style="width: 200px">
                                                    </div>
                                                    <div class="col-lg-6 text-dark text-center m-auto">
                                                        <h3 class="font-weight-bold">Data Nota</h3>
                                                        <p class="font-weight-bold">Nota Tinggal #<?= $row_qr['id_nota_tinggal']?>, Nota DP #<?= $row_qr['id_nota_dp']?>, Nota Lunas #<?= $row_qr['id_nota_lunas']?></p>
                                                        <p>Detail lainnya: </p>
                                                        <p>Tanggal masuk <?= $row_qr['tgl_masuk']?> waktu <?= $row_qr['time']?> dengan kerusakan <?= $row_qr['kerusakan']?> teknisi <?= $row_qr['first_name']?> dp Rp. <?= number_format($row_qr['dp'])?> biaya Rp. <?= number_format($row_qr['biaya'])?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach;}?>
                                </div>
                            </div>
                            <?php }}?>
                        </div>
                    </div>
                </div>
                <?php require_once('../application/access/footer.php');?>
            </div>
        </div>
    </body>
</html>