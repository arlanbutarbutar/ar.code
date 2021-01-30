<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Spareparts All | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Spareparts All</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
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
                                                        <input type="date" class="form-control bg-light border-0 small" placeholder="Search Date" aria-label="Search" aria-describedby="basic-addon2" name="keyword-tgl-sparepart-out">
                                                        <div class="input-group-append">
                                                            <button class="btn" <?= $style_btn?> type="submit" name="search-tgl-sparepart-out">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <select name="keyword-teknisi-sparepart-out" class="form-control">
                                                            <option>Pilih Teknisi</option>
                                                            <?php foreach($technicians_data as $tek):?>
                                                            <option value="<?= $tek['id_employee']?>"><?= $tek['first_name']?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button class="btn" <?= $style_btn?> type="submit" name="search-teknisi-sparepart-out">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-dark font-weight-bold">Spareparts Kosong/Ambil</h6>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-end">
                                                    <?php if(isset($page16)){if(isset($total_page16)){if($page16>1):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="report-spareparts-out?page=<?= $page16-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page16; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page16):?>
                                                                <li class="page-item"><a class="page-link font-weight-bold" href="report-spareparts-out?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item"><a class="page-link" href="report-spareparts-out?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page16<$total_page16):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="report-spareparts-out?page=<?= $page16+1;?>">Next</a>
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
                                                        <th scope="col">Teknisi</th>
                                                    </tr> 
                                                </thead>
                                                <tbody>
                                                    <?php $no=1;if(mysqli_num_rows($all_spareparts)==0){?>
                                                    <tr>
                                                        <th colspan="19">Maaf data saat ini kosong!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($all_spareparts)>0){while($row=mysqli_fetch_assoc($all_spareparts)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <td><?= $row['tgl_masuk']?></td>
                                                        <?php if($_SESSION['id-role']==5){?>
                                                        <td><?= $row['time']?></td>
                                                        <?php }?>
                                                        <td><a class="btn btn-light shadow-lg btn-sm text-dark" href="qr?ac=<?= $row['id_sparepart']?>"><i class="fas fa-qrcode"></i></a></td>
                                                        <td><?= $row['ket']?></td>
                                                        <td><?= $row['suplayer']?></td>
                                                        <td><?= $row['jmlh_barang']?></td>
                                                        <td>Rp. <?= number_format($row['harga'])?></td>
                                                        <td>Rp. <?= number_format($row['jmlh_barang']*$row['harga'])?></td>
                                                        <td><?= $row['ket_plus']?></td>
                                                        <td><?= $row['first_name']?></td>
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