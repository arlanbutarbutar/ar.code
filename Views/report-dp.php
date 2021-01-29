<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>DP Report | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">DP Report</h1>
                        </div>
                        <div class="row">
                            <?php require_once("../utilities/info.php")?>
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12">
                                <div class="card border-0 shadow">
                                    <div class="card-body">

                                        <div class="col-md-12 p-3 d-sm-flex align-items-center justify-content-start" id="scroll-x">

                                            <div class="col-md-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search No Nota DP" aria-label="Search" aria-describedby="basic-addon2" autofocus id="keyword-nota-dp">
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control bg-light border-0 small" placeholder="Search Date" aria-label="Search" aria-describedby="basic-addon2" autofocus name="keyword-tgl-nota-dp">
                                                        <div class="input-group-append">
                                                            <button class="btn" <?= $style_btn?> type="submit" name="search-tgl-nota-dp">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <select name="keyword-teknisi-nota-dp" class="form-control">
                                                            <option>Pilih Teknisi</option>
                                                            <?php foreach($technicians_data as $tek):?>
                                                            <option value="<?= $tek['id_employee']?>"><?= $tek['first_name']?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button class="btn" <?= $style_btn?> type="submit" name="search-teknisi-nota-dp">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-dark font-weight-bold">Laporan DP(Down Payment)</h6>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-end">
                                                    <?php if(isset($page11)){if(isset($total_page11)){if($page11>1):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="report-dp?page=<?= $page11-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page11; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page11):?>
                                                                <li class="page-item"><a class="page-link font-weight-bold" href="report-dp?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item"><a class="page-link" href="report-dp?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page11<$total_page11):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="report-dp?page=<?= $page11+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>

                                        <div class="table-responsive" id="container-nota-dp">
                                            <table class="table table-sm text-dark text-center">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">#Nota Tinggal</th>
                                                        <th scope="col">#Nota DP</th>
                                                        <th colspan="1">Aksi</th>
                                                        <th scope="col">Tgl Masuk</th>
                                                        <th scope="col">Waktu</th>
                                                        <th scope="col">User</th>
                                                        <th scope="col">Layanan</th>
                                                        <th scope="col">Kerusakan</th>
                                                        <th scope="col">Teknisi</th>
                                                        <th scope="col">DP</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1;if(mysqli_num_rows($laporan_dp)==0){?>
                                                    <tr>
                                                        <th colspan="19">Maaf data saat ini kosong!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($laporan_dp)>0){while($row=mysqli_fetch_assoc($laporan_dp)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <th><?= $row['id_nota_tinggal']?></th>
                                                        <th><?= $row['id_nota_dp']?></th>
                                                        <td><form action="" method="POST">
                                                            <input type="hidden" name="id-data-dp" value="<?= $row['id_data_dp']?>">
                                                            <input type="hidden" name="id-nota-dp" value="<?= $row['id_nota_dp']?>">
                                                            <?php if($_SESSION['id-role']==6){$date=date('Y-m-d');$tgl_report=$row['tgl_cari'];if($date==$tgl_report){?>
                                                            <button type="submit" name="delete-laporan-dp" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                            <?php }else{?>
                                                            <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-trash"></i></button>
                                                            <?php }}if($_SESSION['id-role']==4 || $_SESSION['id-role']==5){?>
                                                            <button type="submit" name="delete-laporan-dp" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                            <?php }?>
                                                        </form></td>
                                                        <td><?= $row['tgl_masuk']?></td>
                                                        <td><?= $row['time']?></td>
                                                        <td><a class="btn btn-sm" <?= $style_btn?> data-toggle="collapse" href="#collapseUser-<?= $row['id_nota_tinggal']?>" role="button" aria-expanded="false" aria-controls="collapseUser-<?= $row['id_nota_tinggal']?>"><i class="fas fa-eye"></i> <?= $row['username']?></a></td>
                                                        <td><a class="btn btn-sm" <?= $style_btn?> data-toggle="collapse" href="#collapseLayanan-<?= $row['id_nota_tinggal']?>" role="button" aria-expanded="false" aria-controls="collapseLayanan-<?= $row['id_nota_tinggal']?>"><i class="fas fa-eye"></i> <?php $id_layanan=$row['id_layanan'];if($id_layanan==1){echo "Handphone";}else if($id_layanan==2){echo "Laptop";}?></a></td>
                                                        <td><?= $row['kerusakan']?></td>
                                                        <td><?= $row['first_name']?></td>
                                                        <td>Rp. <?= number_format($row['dp'])?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="10" class="border-0">

                                                            <div class="collapse mb-3" id="collapseUser-<?= $row['id_nota_tinggal']?>">
                                                                <div class="card card-body text-dark border-0 shadow">
                                                                    <p>Username : <?= $row['username']?></p>
                                                                    <p>Email : <?php $em=$row['email_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                                                                    <p>Telepon : <?php $em=$row['tlpn_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                                                                    <p>Alamat : <?php $em=$row['alamat_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                                                                </div>
                                                            </div>

                                                            <div class="collapse" id="collapseLayanan-<?= $row['id_nota_tinggal']?>">
                                                                <div class="card card-body text-dark border-0 shadow">
                                                                    <?php $id_layanan=$row['id_layanan'];if($id_layanan==1){$handphone=mysqli_query($conn, "SELECT * FROM handphone");$row_hp=mysqli_fetch_assoc($handphone);?>
                                                                        <p>Type : <?= $row_hp['type']?></p>
                                                                        <p>Seri : <?= $row_hp['seri']?></p>
                                                                        <p>Imei : <?= $row_hp['imei']?></p>
                                                                    <?php }else if($id_layanan==2){$laptop=mysqli_query($conn, "SELECT * FROM laptop");$row_laptop=mysqli_fetch_assoc($laptop);?>
                                                                        <p>Merek : <?= $row_laptop['merek']?></p>
                                                                        <p>Seri : <?= $row_laptop['seri']?></p>
                                                                    <?php }?>
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