<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>♻ Laporan Spareparts | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">♻ Laporan Spareparts</h1>
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
                                            <div class="col-lg-4">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2" autofocus name="keyword-arc-sparepart">
                                                        <div class="input-group-append">
                                                            <button class="btn" <?= $style_btn?> type="submit" name="search-arc-sparepart">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-end">
                                                    <?php if(isset($page25)){if(isset($total_page25)){if($page25>1):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="arc-laporan-spareparts?page=<?= $page25-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page25; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page25):?>
                                                                <li class="page-item"><a class="page-link font-weight-bold" href="arc-laporan-spareparts?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item"><a class="page-link" href="arc-laporan-spareparts?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page25<$total_page25):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="arc-laporan-spareparts?page=<?= $page25+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>
                                        <table class="table table-hover text-dark table-responsive table-sm">
                                            <thead style="border-top: hidden">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tgl Masuk</th>
                                                    <th scope="col">Supliyer</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Jumlah Barang</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Ket. Tambahan</th>
                                                    <?php if($_SESSION['id-role']==5){?>
                                                    <th scope="col">Teknisi</th>
                                                    <th scope="col">Time</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1; foreach($mdata_spareparts as $row):?>
                                                <tr>
                                                    <th scope="row"><?= $no?></th>
                                                    <td><?= $row['tgl_masuk']?></td>
                                                    <td><?= $row['suplayer']?></td>
                                                    <td><?= $row['ket']?></td>
                                                    <td><?= $row['jmlh_barang']?></td>
                                                    <td>Rp. <?= number_format($row['harga'])?></td>
                                                    <td>Rp. <?= number_format($row['total'])?></td>
                                                    <td><?= $row['ket_plus']?></td>
                                                    <?php if($_SESSION['id-role']==5){?>
                                                    <td><?= $row['name']?></td>
                                                    <td><?= $row['time']?></td>
                                                    <?php }?>
                                                </tr>
                                                <?php $no++; endforeach;?>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center">
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-end">
                                                    <?php if(isset($page25)){if(isset($total_page25)){if($page25>1):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="arc-laporan-spareparts?page=<?= $page25-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page25; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page25):?>
                                                                <li class="page-item"><a class="page-link font-weight-bold" href="arc-laporan-spareparts?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item"><a class="page-link" href="arc-laporan-spareparts?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page25<$total_page25):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="arc-laporan-spareparts?page=<?= $page25+1;?>">Next</a>
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