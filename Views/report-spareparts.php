<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="Sparepart Masuk";
?>

<!-- == Sparepart page == -->
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
                                <!-- == insert data == -->
                                    <div class="col-md-4">
                                        <div class="card card-body border-0 shadow mt-3 text-center">
                                            <h4 class="font-weight-bold" <?= $color_black?>>Masukan Data</h4>
                                            <p class="small" <?= $color_black?>>Masukan data untuk laporan pengeluaran disini.</p>
                                            <button class="btn btn-link btn-sm" <?= $color_black?> type="button" data-toggle="collapse" data-target="#insert-nota" aria-expanded="false" aria-controls="insert-nota">Gulir kebawah <i class="fas fa-hand-point-down"></i></button>
                                            <div class="collapse" id="insert-nota">
                                                <div class="card card-body border-0 m-0 p-0">
                                                    <form action="" method="POST">
                                                        <div class="form-group">
                                                            <input type="text" name="ket" placeholder="Sparepart" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="suplayer" placeholder="Suplayer" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="number" name="jumlah-barang" placeholder="Jumlah barang" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="number" name="harga" placeholder="Harga (per biji)" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea name="ket-plus" cols="30" rows="5" class="form-control" placeholder="Keterangan tambahan" style="resize: none"></textarea>
                                                        </div>
                                                        <div class='form-group'>
                                                            <button type="submit" name="submit-sparepart" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- == query data == -->
                                    <div class="col-md-8">
                                        <div class="card card-body border-0 shadow mt-3">
                                            <table class="table table-sm text-dark text-center">
                                                <thead>
                                                    <tr style="border-top: hidden">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Tgl masuk</th>
                                                        <?php if($_SESSION['id-role']==5){?>
                                                        <th scope="col">Waktu</th>
                                                        <?php }?>
                                                        <th scope="col">Barcode</th>
                                                        <th scope="col">Sparepart</th>
                                                        <th scope="col">Suplayer</th>
                                                        <th scope="col">Jumlah Barang</th>
                                                        <th scope="col">Harga</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col">Ket. tambahan</th>
                                                        <th colspan="3">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1;if(mysqli_num_rows($report_days)==0){?>
                                                    <tr>
                                                        <th colspan="8">Belum ada data yang dimasukan hari ini!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($report_days)>0){while($row=mysqli_fetch_assoc($report_days)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <td><?= $row['tgl_masuk']?></td>
                                                        <?php if($_SESSION['id-role']==5){?>
                                                        <td><?= $row['time']?></td>
                                                        <?php }?>
                                                        <td><a href="qr?ac=<?= $row['id_sparepart']?>" class="btn btn-light btn-sm shadow-lg"><i class="fas fa-qrcode"></i></a></td>
                                                        <td><?= $row['ket']?></td>
                                                        <td><?= $row['suplayer']?></td>
                                                        <td><?= $row['jmlh_barang']?></td>
                                                        <td>Rp. <?= number_format($row['harga'])?></td>
                                                        <td>Rp. <?= number_format($row['jmlh_barang']*$row['harga'])?></td>
                                                        <td><?= $row['ket_plus']?></td>
                                                        <td>
                                                            <?php if($_SESSION['id-role']==6){$date=date('Y-m-d');$tgl_report=$row['tgl_cari'];if($date==$tgl_report){?>
                                                            <button class="btn btn-warning btn-sm" type="button" data-toggle="collapse" data-target="#edit-sparepart<?= $row['id_sparepart']?>" aria-expanded="false" aria-controls="edit-sparepart<?= $row['id_sparepart']?>"><i class="fas fa-pen"></i></button>
                                                            <?php }else{?>
                                                            <button class="btn btn-secondary btn-sm" type="button"><i class="fas fa-pen"></i></button>
                                                            <?php }}if($_SESSION['id-role']==4 || $_SESSION['id-role']==5){?>
                                                            <button class="btn btn-warning btn-sm" type="button" data-toggle="collapse" data-target="#edit-sparepart<?= $row['id_sparepart']?>" aria-expanded="false" aria-controls="edit-sparepart<?= $row['id_sparepart']?>"><i class="fas fa-pen"></i></button>
                                                            <?php }?>
                                                        </td>
                                                        <td><form action="" method="POST">
                                                            <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                                                            <input type="hidden" name="status" value="<?= $row['status_sparepart']?>">
                                                            <?php if($_SESSION['id-role']==6){$date=date('Y-m-d');$tgl_report=$row['tgl_cari'];if($date==$tgl_report){?>
                                                            <button type="submit" name="delete-sparepart" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                            <?php }else{?>
                                                            <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-trash"></i></button>
                                                            <?php }}if($_SESSION['id-role']==4 || $_SESSION['id-role']==5){?>
                                                            <button type="submit" name="delete-sparepart" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                            <?php }?>
                                                        </form></td>
                                                        <td><form action="" method="POST">
                                                            <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                                                            <button type="submit" name="ambil-sparepart" class="btn btn-success btn-sm"><i class="fas fa-box-open"></i></button>
                                                        </form></td>
                                                    </tr>
                                                    <?php $no++;}}?>
                                                </tbody>
                                            </table>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <?php if(isset($page13)){if(isset($total_page13)){if($page13>1):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" <?= $bg_black?> href="report-expense?page=<?= $page13-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page13; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page13):?>
                                                                <li class="page-item shadow"><a class="page-link font-weight-bold border-0" <?= $bg_black?> href="report-expense?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item shadow"><a class="page-link border-0" href="report-expense?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page13<$total_page13):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" <?= $bg_black?> href="report-expense?page=<?= $page13+1;?>">Next</a>
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