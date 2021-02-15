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
        <style>@media print {body * {visibility: hidden;}#print, #print * {visibility: visible;}#print{position: absolute;left: 0;top: 0;}}</style>
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
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <!-- masukan sparepart -->
                                                <div class="col-md-12">
                                                    <div class="card card-body border-0 shadow mt-3 text-center">
                                                        <h4 class="font-weight-bold" <?= $color_black?>>Masukan Data</h4>
                                                        <p class="small" <?= $color_black?>>Masukan data untuk laporan sparepart yang di stok disini.</p>
                                                        <button class="btn btn-link btn-sm" <?= $color_black?> type="button" data-toggle="collapse" data-target="#insert-nota" aria-expanded="false" aria-controls="insert-nota">Gulir kebawah <i class="fas fa-hand-point-down"></i></button>
                                                        <div class="collapse" id="insert-nota">
                                                            <div class="card card-body border-0 m-0 p-0">
                                                                <form action="" method="POST">
                                                                    <div class="form-group">
                                                                        <input type="text" name="ket" placeholder="Sparepart" class="form-control" <?= $color_black?>>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <select name="suplayer" class="form-control" <?= $color_black?> required>
                                                                            <option>Pilih Penyuplai</option>
                                                                            <?php foreach($supplier as $row_sp):?>
                                                                            <option value="<?= $row_sp['id_supplier']?>"><?= $row_sp['supplier']?></option>
                                                                            <?php endforeach;?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="number" name="jumlah" placeholder="Jumlah barang" class="form-control" <?= $color_black?>>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="number" name="harga" placeholder="Harga (per biji)" class="form-control" <?= $color_black?>>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <textarea name="ket-plus" cols="30" rows="5" class="form-control" placeholder="Keterangan tambahan" style="resize: none" <?= $color_black?>></textarea>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <button type="submit" name="submit-sparepart" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                <!-- == query data == -->
                                    <div class="col-lg-8">
                                        <div class="card card-body border-0 shadow mt-3" style="overflow-x: auto">
                                            <table class="table table-sm text-center" <?= $color_black?>>
                                                <thead>
                                                    <tr style="border-top: hidden">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Tgl masuk</th>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <th scope="col">Waktu</th>
                                                        <?php }?>
                                                        <th scope="col">Barcode</th>
                                                        <th scope="col">Sparepart</th>
                                                        <th scope="col">Suplayer</th>
                                                        <th scope="col">Jumlah Barang</th>
                                                        <th scope="col">Harga</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col">Ket. tambahan</th>
                                                        <th colspan="2">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1;if(mysqli_num_rows($report_spareparts_in)==0){?>
                                                    <tr>
                                                        <th colspan="10">Belum ada data yang dimasukan hari ini!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($report_spareparts_in)>0){while($row=mysqli_fetch_assoc($report_spareparts_in)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <td><?= $row['tgl_masuk']?></td>
                                                        <?php if($_SESSION['id-role']==5){?>
                                                        <td><?= $row['time']?></td>
                                                        <?php }?>
                                                        <td>
                                                            <button type="button" class="btn btn-light btn-sm shadow" data-toggle="modal" data-target="#barcode<?= $row['id_sparepart']?>"><i class="fas fa-qrcode"></i></button>
                                                            <div class="modal fade" id="barcode<?= $row['id_sparepart']?>" tabindex="-1" role="dialog" aria-labelledby="barcode<?= $row['id_sparepart']?>Label" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="barcode<?= $row['id_sparepart']?>Label" <?= $color_black?>>Barcode</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p <?= $color_black?>>Silakan print barcode ini untuk ambil/pakai sparepart dari stok saat ini.</p>
                                                                            <div class="card .card-body border-0 m-0 p-0">
                                                                                <div class="m-auto" id="print"><img src="../Assets/img/img-barcode-spareparts/<?= $row['qrcode']?>" style="width: 100%" alt="qrcode"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-sm" <?= $bg_black?> data-dismiss="modal">Close</button>
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                                                                                <input type="hidden" name="qrcode" value="<?= $row['qrcode']?>">
                                                                                <button type="submit" name="remake-qrcode-sparepart" class="btn btn-sm" <?= $bg_black?>><i class="fas fa-undo"></i> Buat ulang</button>
                                                                            </form>
                                                                            <button type="button" name="print-now" class="btn btn-success btn-sm" onClick="window.print();"><i class="fas fa-print"></i> Print Now</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?= $row['ket']?></td>
                                                        <td><?= $row['supplier']?></td>
                                                        <td><?= $row['jmlh_barang']?></td>
                                                        <td>Rp. <?= number_format($row['harga'])?></td>
                                                        <td>Rp. <?= number_format($row['jmlh_barang']*$row['harga'])?></td>
                                                        <td><?= $row['ket_plus']?></td>
                                                        <td>
                                                            <div class="dropdown no-arrow">
                                                                <button class="btn btn-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-pen"></i></button>
                                                                <div class="dropdown-menu p-2 border-0 shadow text-center" aria-labelledby="dropdownMenuButton">
                                                                    <form action="" method="POST">
                                                                        <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                                                                        <div class="form-group">
                                                                            <input type="text" name="ket" value="<?= $row['ket']?>" placeholder="Sparepart" class="form-control" <?= $color_black?>>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <select name="suplayer" class="form-control" <?= $color_black?> required>
                                                                                <option>Pilih Penyuplai</option>
                                                                                <?php foreach($supplier as $row_sp):?>
                                                                                <option value="<?= $row_sp['id_supplier']?>"><?= $row_sp['supplier']?></option>
                                                                                <?php endforeach;?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="number" name="jumlah" value="<?= $row['jmlh_barang']?>" placeholder="Jumlah barang" class="form-control" <?= $color_black?>>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="number" name="harga" value="<?= $row['harga']?>" placeholder="Harga (per biji)" class="form-control" <?= $color_black?>>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <textarea name="ket-plus" cols="30" rows="5" class="form-control" placeholder="Keterangan tambahan" style="resize: none" <?= $color_black?>><?= $row['ket_plus']?></textarea>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <button type="submit" name="edit-sparepart" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><form action="" method="POST">
                                                            <div class="form-group">
                                                                <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                                                                <input type="hidden" name="ket" value="<?= $row['ket']?>">
                                                                <input type="hidden" name="qrcode" value="<?= $row['qrcode']?>">
                                                                <button type="submit" name="delete-sparepart" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                            </div>
                                                        </form></td>
                                                    </tr>
                                                    <?php $no++;}}?>
                                                </tbody>
                                            </table>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <?php if(isset($page15)){if(isset($total_page15)){if($page15>1):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" <?= $bg_black?> href="report-spareparts?page=<?= $page15-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page15; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page15):?>
                                                                <li class="page-item shadow"><a class="page-link font-weight-bold border-0" <?= $bg_black?> href="report-spareparts?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item shadow"><a class="page-link border-0" href="report-spareparts?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page15<$total_page15):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" <?= $bg_black?> href="report-spareparts?page=<?= $page15+1;?>">Next</a>
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