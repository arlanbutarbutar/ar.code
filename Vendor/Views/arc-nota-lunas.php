<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>♻ Nota Lunas | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">♻ Nota Lunas</h1>
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
                                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2" autofocus name="keyword-arc-nota-lunas">
                                                        <div class="input-group-append">
                                                            <button class="btn" <?= $style_btn?> type="submit" name="search-arc-nota-lunas">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-end">
                                                    <?php if(isset($page22)){if(isset($total_page22)){if($page22>1):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="arc-nota-lunas?page=<?= $page22-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page22; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page22):?>
                                                                <li class="page-item"><a class="page-link font-weight-bold" href="arc-nota-lunas?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item"><a class="page-link" href="arc-nota-lunas?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page22<$total_page22):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="arc-nota-lunas?page=<?= $page22+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>
                                        <table class="table table-hover text-dark table-responsive table-sm">
                                            <thead style="border-top: hidden">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">#Nota Lunas</th>
                                                    <th scope="col">Tgl Masuk</th>
                                                    <th scope="col">Client</th>
                                                    <th scope="col">Layanan</th>
                                                    <th scope="col">Barang</th>
                                                    <th scope="col">Kerusakan</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Teknisi</th>
                                                    <th scope="col">DP</th>
                                                    <th scope="col">Biaya</th>
                                                    <th scope="col">Pemasukan</th>
                                                    <?php if($_SESSION['id-role']==5){?>
                                                    <th scope="col">Time</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1; foreach($mdata_nota_lunas as $row):?>
                                                <tr>
                                                    <th scope="row"><?= $no?></th>
                                                    <td><?= $row['id_nota_lunas']?></td>
                                                    <td><?= $row['tgl_masuk']?></td>
                                                    <td><?= $row['username']." (".$row['tlpn'].")"?></td>
                                                    <td><?= $row['layanan']?></td>
                                                    <?php $id_layanan=$row['id_layanan'];$id_barang=$row['id_barang'];if($id_layanan==1){$mhandphone=mysqli_query($conn_arc, "SELECT * FROM mhandphone_lunas WHERE id_hp='$id_barang'");if(mysqli_num_rows($mhandphone)>0){$hp=mysqli_fetch_assoc($mhandphone);?>
                                                    <td><?= $hp['type']." (".$hp['seri']." - ".$hp['imei'].")"?></td>
                                                    <?php }else if(mysqli_num_rows($mhandphone)==0){?>
                                                    <td>Terjadi kesalahan!</td>
                                                    <?php }}if($id_layanan==2){$mlaptop=mysqli_query($conn_arc, "SELECT * FROM mlaptop_lunas WHERE id_laptop='$id_barang'");if(mysqli_num_rows($mlaptop)>0){$hp=mysqli_fetch_assoc($mlaptop);?>
                                                    <td><?= $hp['merek']." (".$hp['seri'].")"?></td>
                                                    <?php }else if(mysqli_num_rows($mlaptop)==0){?>
                                                    <td>Terjadi kesalahan!</td>
                                                    <?php }}?>
                                                    <td><?= $row['kerusakan']?></td>
                                                    <td><?= $row['ket']?></td>
                                                    <td><?= $row['name']?></td>
                                                    <td>Rp. <?= number_format($row['dp'])?></td>
                                                    <td>Rp. <?= number_format($row['biaya'])?></td>
                                                    <td>Rp. <?= number_format($row['pemasukan'])?></td>
                                                    <?php if($_SESSION['id-role']==5){?>
                                                    <td><?= $row['time']?></td>
                                                    <?php }?>
                                                </tr>
                                                <?php $no++; endforeach;?>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center">
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-end">
                                                    <?php if(isset($page22)){if(isset($total_page22)){if($page22>1):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="arc-nota-lunas?page=<?= $page22-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page22; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page22):?>
                                                                <li class="page-item"><a class="page-link font-weight-bold" href="arc-nota-lunas?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item"><a class="page-link" href="arc-nota-lunas?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page22<$total_page22):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="arc-nota-lunas?page=<?= $page22+1;?>">Next</a>
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