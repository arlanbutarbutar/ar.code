<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>♻ Laporan Spareparts Lama | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">♻ Laporan Spareparts Lama</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12">
                                <div class="card border-0 shadow">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-dark font-weight-bold"></h6>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-end">
                                                    <?php if(isset($page26)){if(isset($total_page26)){if($page26>1):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="arc-laporan-spareparts-lama?page=<?= $page26-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page26; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page26):?>
                                                                <li class="page-item"><a class="page-link font-weight-bold" href="arc-laporan-spareparts-lama?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item"><a class="page-link" href="arc-laporan-spareparts-lama?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page26<$total_page26):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="arc-laporan-spareparts-lama?page=<?= $page26+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>
                                        <table class="table table-hover text-dark table-sm table-responsive">
                                            <thead style="border-top: hidden">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tgl</th>
                                                    <th scope="col">Supliyer</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Jumlah Barang</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Total</th>
                                                    <?php if($_SESSION['id-role']==5){?>
                                                    <th scope="col">Teknisi</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1; foreach($mdata_spareparts_lama as $row):?>
                                                <tr>
                                                    <th scope="row"><?= $no?></th>
                                                    <td><?= $row['tanggal']?></td>
                                                    <td><?= $row['suplayer']?></td>
                                                    <td><?= $row['ket']?></td>
                                                    <td><?= $row['jmlh_barang']?></td>
                                                    <td>Rp. <?= number_format($row['harga'])?></td>
                                                    <td>Rp. <?php $jb=$row['jmlh_barang'];$harga=$row['harga']; echo number_format($total=$jb*$harga);?></td>
                                                    <?php if($_SESSION['id-role']==5){?>
                                                    <td><?= $row['teknisi']?></td>
                                                    <?php }?>
                                                </tr>
                                                <?php $no++; endforeach;?>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center">
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-end">
                                                    <?php if(isset($page26)){if(isset($total_page26)){if($page26>1):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="arc-laporan-spareparts-lama?page=<?= $page26-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page26; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page26):?>
                                                                <li class="page-item"><a class="page-link font-weight-bold" href="arc-laporan-spareparts-lama?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item"><a class="page-link" href="arc-laporan-spareparts-lama?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page26<$total_page26):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="arc-laporan-spareparts-lama?page=<?= $page26+1;?>">Next</a>
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
                <?php require_once('../application/access/footer.php');?>
            </div>
        </div>
    </body>
</html>