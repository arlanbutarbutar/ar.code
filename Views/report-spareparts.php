<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
    if(isset($_SESSION['id-sparepart'])){unset($_SESSION['id-sparepart']);}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Spareparts Report | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Spareparts Belum Terpakai</h1>
                        </div>
                        <div class="row">
                            <?php require_once("../utilities/info.php")?>
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>

                            <div class="col-md-12">
                                <div class="accordion" id="accordionExample">
                                    <div class="card border-0 shadow rounded">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0 text-center">
                                                <button class="btn btn-link text-decoration-none font-weight-bold text-dark" type="button" data-toggle="collapse" data-target="#collapseInsert" aria-expanded="true" aria-controls="collapseInsert">
                                                    Insert Spareparts
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseInsert" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
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
                                                    <div class="form-group">
                                                        <button type="submit" name="insert-sparepart" class="btn btn-success btn-sm">Apply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 mt-3">
                                <div class="card border-0 shadow">
                                    <div class="card-body">

                                        <div class="col-md-12 p-3 d-sm-flex align-items-center justify-content-start" id="scroll-x">

                                            <div class="col-md-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search No Nota" aria-label="Search" aria-describedby="basic-addon2" id="keyword-sparepart">
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control bg-light border-0 small" placeholder="Search Date" aria-label="Search" aria-describedby="basic-addon2" name="keyword-tgl-sparepart">
                                                        <div class="input-group-append">
                                                            <button class="btn" <?= $style_btn?> type="submit" name="search-tgl-sparepart">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-dark font-weight-bold">Stockroom Spareparts</h6>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-end">
                                                    <?php if(isset($page14)){if(isset($total_page14)){if($page14>1):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="report-spareparts?page=<?= $page14-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page14; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page14):?>
                                                                <li class="page-item"><a class="page-link font-weight-bold" href="report-spareparts?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item"><a class="page-link" href="report-spareparts?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page14<$total_page14):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="report-spareparts?page=<?= $page14+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>

                                        <div class="table-responsive" id="container-sparepart">
                                            <table class="table table-borderless text-dark text-center table-responsive">
                                                <thead>
                                                    <tr>
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
                                                    <?php $no=1;if(mysqli_num_rows($laporan_spareparts)==0){?>
                                                    <tr>
                                                        <th colspan="19">Maaf data saat ini kosong!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($laporan_spareparts)>0){while($row=mysqli_fetch_assoc($laporan_spareparts)){?>
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
                                                    <tr>
                                                        <td colspan="10" class="border-0">

                                                            <div class="collapse" id="edit-sparepart<?= $row['id_sparepart']?>">
                                                                <div class="card card-body border-0 shadow">
                                                                    <form action="" method="POST">
                                                                        <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                                                                        <div class="form-group">
                                                                            <input type="text" name="ket" placeholder="Keterangan" class="form-control" value="<?= $row['ket']?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" name="suplayer" placeholder="Suplayer" class="form-control" value="<?= $row['suplayer']?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="number" name="jumlah-barang" placeholder="Jumlah barang" class="form-control" value="<?= $row['jmlh_barang']?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="number" name="harga" placeholder="Harga" class="form-control" value="<?= $row['harga']?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <textarea name="ket-plus" cols="30" rows="5" class="form-control" placeholder="Keterangan tambahan" style="resize: none"><?= $row['ket_plus']?></textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button type="submit" name="edit-sparepart" class="btn btn-success btn-sm">Apply</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    <?php $no++;}}?>
                                                </tbody>
                                            </table>
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