<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="Laporan Harian";
?>

<!-- == Laporan Harian page == -->
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
                                <!-- == query data == -->
                                    <div class="col-md-12">
                                        <div class="card card-body border-0 shadow mt-3 mb-5" style="overflow-x: auto">
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
                                                        <th scope="col">Tgl Status</th>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <th scope="col">Waktu status</th>
                                                        <?php }?>
                                                        <th scope="col">Tgl Masuk</th>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <th scope="col">Waktu Masuk</th>
                                                        <?php }?>
                                                        <th scope="col">Tgl Lunas</th>
                                                        <th scope="col">Tgl Laporan</th>
                                                        <th scope="col">Tgl Cancel</th>
                                                        <th scope="col">Tgl Ambil</th>
                                                        <th scope="col">Kerusakan</th>
                                                        <th scope="col">Kondisi</th>
                                                        <th scope="col">Kelengkapan</th>
                                                        <th scope="col">DP</th>
                                                        <th scope="col">Biaya</th>
                                                        <th scope="col">Bukti Tanpa Nota</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1; if(mysqli_num_rows($report_days)==0){?>
                                                    <tr>
                                                        <th colspan="15">Belum ada data yang dibatalkan!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($report_days)>0){while($row_all=mysqli_fetch_assoc($report_days)){?>
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
                                                        <td><?= $row_all['status']?><?php if($row_all['id_status']<6){?><span class="badge badge-info">GARANSI</span><?php }?></td>
                                                        <td><?= $row_all['tgl_status']?></td>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <td><?= $row_all['time_status']?></td>
                                                        <?php }?>
                                                        <td><?= $row_all['tgl_masuk']?></td>
                                                        <?php if($_SESSION['id-role']<=2){?>
                                                        <td><?= $row_all['time']?></td>
                                                        <?php }?>
                                                        <td><?= $row_all['tgl_lunas']?></td>
                                                        <td><?= $row_all['tgl_laporan']?></td>
                                                        <td><?= $row_all['tgl_cancel']?></td>
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
                                                    <?php if(isset($page12)){if(isset($total_page12)){if($page12>1):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" <?= $bg_black?> href="report-day?page=<?= $page12-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page12; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page12):?>
                                                                <li class="page-item shadow"><a class="page-link font-weight-bold border-0" <?= $bg_black?> href="report-day?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item shadow"><a class="page-link border-0" href="report-day?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page12<$total_page12):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" <?= $bg_black?> href="report-day?page=<?= $page12+1;?>">Next</a>
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