<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Days Report | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Days Report</h1>
                        </div>
                        <div class="row">
                            <?php require_once("../utilities/info.php")?>
                            
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>

                            <div class="col-md-12">
                                <div class="accordion" id="accordionExample">
                                    <div class="card border-0 shadow rounded">
                                        <?php if($_SESSION['id-role']==5){?>
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0 text-center">
                                                <button class="btn btn-link text-decoration-none font-weight-bold text-dark" type="button" data-toggle="collapse" data-target="#collapseApprove" aria-expanded="true" aria-controls="collapseApprove">
                                                    The Report from the Notes Paid Off
                                                </button>
                                            </h2>
                                        </div>
                                        <?php }?>
                                        <div id="collapseApprove" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="table-responsive" id="container-nota-lunas">
                                                    <table class="table table-borderless text-dark text-center table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">#Nota Lunas</th>
                                                                <th scope="col">#Nota Tinggal</th>
                                                                <th scope="col">#Nota DP</th>
                                                                <th colspan="3">Aksi</th>
                                                                <th scope="col">Tgl Masuk</th>
                                                                <?php if($_SESSION['id-role']==5){?>
                                                                <th scope="col">Waktu</th>
                                                                <?php }?>
                                                                <th scope="col">Garansi</th>
                                                                <th scope="col">User</th>
                                                                <th scope="col">Layanan</th>
                                                                <th scope="col">Kerusakan</th>
                                                                <th scope="col">Teknisi</th>
                                                                <th scope="col">DP</th>
                                                                <th scope="col">Biaya</th>
                                                                <th scope="col">Pemasukan</th>
                                                                <th scope="col">Ket Text</th>
                                                                <th scope="col">Ket Image</th>
                                                            </tr> 
                                                        </thead>
                                                        <tbody>
                                                            <?php $no=1;if(mysqli_num_rows($nota_lunasToReport)==0){?>
                                                            <tr>
                                                                <th colspan="19">Maaf data saat ini kosong!</th>
                                                            </tr>
                                                            <?php }else if(mysqli_num_rows($nota_lunasToReport)>0){while($row=mysqli_fetch_assoc($nota_lunasToReport)){$lapor=$row['lapor'];?>
                                                            <tr class="<?php if($lapor==2){echo "bg-danger text-white";}?>">
                                                                <th scope="row"><?= $no;?></th>
                                                                <th><?= $row['id_nota_lunas']?></th>
                                                                <th><?= $row['id_nota_tinggal']?></th>
                                                                <th><?= $row['id_nota_dp']?></th>
                                                                <td><button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#collapseApprove-<?= $row['id_nota_lunas']?>" aria-expanded="false" aria-controls="collapseApprove-<?= $row['id_nota_lunas']?>">Approve</button></td>
                                                                <td><form action="" method="POST">
                                                                    <input type="hidden" name="id-nota-lunas" value="<?= $row['id_nota_lunas']?>">
                                                                    <button type="submit" name="fix-it-again" class="btn btn-dark btn-sm">Fix It Again</button>
                                                                </form></td>
                                                                <td><a href="<?= $link_barcode.$row['id_user']?>" class="btn btn-sm" <?= $style_btn?>><i class="fas fa-qrcode"></i></a></td>
                                                                <td><?= $row['tgl_masuk']?></td>
                                                                <?php if($_SESSION['id-role']==5){?>
                                                                <td><?= $row['time']?></td>
                                                                <?php }?>
                                                                <td><?= $row['garansi']?></td>
                                                                <td><a class="btn btn-sm" <?= $style_btn?> data-toggle="collapse" href="#collapseUser-<?= $row['id_nota_lunas']?>" role="button" aria-expanded="false" aria-controls="collapseUser-<?= $row['id_nota_lunas']?>"><i class="fas fa-eye"></i> <?= $row['username']?></a></td>
                                                                <td><a class="btn btn-sm" <?= $style_btn?> data-toggle="collapse" href="#collapseLayanan-<?= $row['id_nota_lunas']?>" role="button" aria-expanded="false" aria-controls="collapseLayanan-<?= $row['id_nota_lunas']?>"><i class="fas fa-eye"></i> <?php $id_layanan=$row['id_layanan'];if($id_layanan==1){echo "Handphone";}else if($id_layanan==2){echo "Laptop";}?></a></td>
                                                                <td><?= $row['kerusakan']?></td>
                                                                <td><?= $row['first_name']?></td>
                                                                <td>Rp. <?= number_format($row['dp'])?></td>
                                                                <td>Rp. <?= number_format($row['biaya'])?></td>
                                                                <td>Rp. <?= number_format($row['pemasukan'])?></td>
                                                                <td><?php if(!empty($row['ket_text'])){echo $row['ket_text'];}else{echo "-";}?></td>
                                                                <td><?php if(!empty($row['ket_img'])){?>
                                                                    <a href="checkup-lunas?id-lunas=<?= $row['id_nota_lunas']?>&akses=2" class="btn btn-sm" <?= $style_btn?>><i class="fas fa-eye"></i> View</a>
                                                                    <?php }else{?><p class="text-dark">Bukti Nota</p></tr><?php }?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="10" class="border-0">

                                                                    <div class="collapse" id="collapseApprove-<?= $row['id_nota_lunas']?>">
                                                                        <div class="card card-body border-0 shadow">
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-nota-lunas" value="<?= $row['id_nota_lunas']?>">
                                                                                <div class="form-group">
                                                                                    <label for="garansi">Garansi</label>
                                                                                    <input type="date" name="garansi" class="form-control" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <button type="submit" name="approve-report-day" class="btn btn-success btn-sm">Apply</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                    <div class="collapse mb-3" id="collapseUser-<?= $row['id_nota_lunas']?>">
                                                                        <div class="card card-body text-dark border-0 shadow">
                                                                            <p>Username : <?= $row['username']?></p>
                                                                            <p>Email : <?php $em=$row['email_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                                                                            <p>Telepon : <?php $em=$row['tlpn_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                                                                            <p>Alamat : <?php $em=$row['alamat_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="collapse" id="collapseLayanan-<?= $row['id_nota_lunas']?>">
                                                                        <div class="card card-body text-dark border-0 shadow">
                                                                            <?php $id_layanan=$row['id_layanan'];$id_barang=$row['id_barang'];if($id_layanan==1){$handphone=mysqli_query($conn, "SELECT * FROM handphone WHERE id_hp='$id_barang'");$row_hp=mysqli_fetch_assoc($handphone);?>
                                                                                <p>Type : <?= $row_hp['type']?></p>
                                                                                <p>Seri : <?= $row_hp['seri']?></p>
                                                                                <p>Imei : <?= $row_hp['imei']?></p>
                                                                            <?php }else if($id_layanan==2){$laptop=mysqli_query($conn, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");$row_laptop=mysqli_fetch_assoc($laptop);?>
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

                            <div class="col-md-12 mt-3">
                                <div class="card border-0 shadow">
                                    <div class="card-body">

                                        <div class="col-md-12 p-3 d-sm-flex align-items-center justify-content-start" id="scroll-x">

                                            <div class="col-md-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search No Nota" aria-label="Search" aria-describedby="basic-addon2" id="keyword-nota">
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control bg-light border-0 small" placeholder="Search Date" aria-label="Search" aria-describedby="basic-addon2" name="keyword-tgl-nota">
                                                        <div class="input-group-append">
                                                            <button class="btn" <?= $style_btn?> type="submit" name="search-tgl-nota">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <select name="keyword-teknisi-nota" class="form-control">
                                                            <option>Pilih Teknisi</option>
                                                            <?php foreach($technicians_data as $tek):?>
                                                            <option value="<?= $tek['id_employee']?>"><?= $tek['first_name']?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button class="btn" <?= $style_btn?> type="submit" name="search-teknisi-nota">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-dark font-weight-bold">Laporan Harian</h6>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-end">
                                                    <?php if(isset($page12)){if(isset($total_page12)){if($page12>1):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="report-day?page=<?= $page12-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page12; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page12):?>
                                                                <li class="page-item"><a class="page-link font-weight-bold" href="report-day?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item"><a class="page-link" href="report-day?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page12<$total_page12):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="report-day?page=<?= $page12+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>

                                        <div class="table-responsive" id="container-nota">
                                            <table class="table table-borderless text-dark text-center table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">#Nota Lunas</th>
                                                        <th scope="col">#Nota Tinggal</th>
                                                        <th scope="col">#Nota DP</th>
                                                        <th colspan="2">Aksi</th>
                                                        <th scope="col">Tgl Masuk</th>
                                                        <?php if($_SESSION['id-role']==5){?>
                                                        <th scope="col">Waktu</th>
                                                        <?php }?>
                                                        <th scope="col">Garansi</th>
                                                        <th scope="col">User</th>
                                                        <th scope="col">Layanan</th>
                                                        <th scope="col">Kerusakan</th>
                                                        <th scope="col">Teknisi</th>
                                                        <th scope="col">DP</th>
                                                        <th scope="col">Biaya</th>
                                                        <th scope="col">Pemasukan</th>
                                                        <th scope="col">Ket Text</th>
                                                        <th scope="col">Ket Image</th>
                                                    </tr> 
                                                </thead>
                                                <tbody>
                                                    <?php $no=1;if(mysqli_num_rows($laporan_harian)==0){?>
                                                    <tr>
                                                        <th colspan="19">Maaf data saat ini kosong!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($laporan_harian)>0){while($row=mysqli_fetch_assoc($laporan_harian)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <th><?= $row['id_nota_lunas']?></th>
                                                        <th><?= $row['id_nota_tinggal']?></th>
                                                        <th><?= $row['id_nota_dp']?></th>
                                                        <td><form action="" method="POST">
                                                            <input type="hidden" name="id-laporan" value="<?= $row['id_laporan']?>">
                                                            <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                            <input type="hidden" name="id-layanan" value="<?= $row['id_layanan']?>">
                                                            <input type="hidden" name="ket-img" value="<?= $row['ket_img']?>">
                                                            <input type="hidden" name="barcode" value="<?= $row['barcode']?>">
                                                            <?php if($_SESSION['id-role']==6){$date=date('Y-m-d');$tgl_report=$row['tgl_cari'];if($date==$tgl_report){?>
                                                            <button type="submit" name="delete-report-day" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                            <?php }else{?>
                                                            <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-trash"></i></button>
                                                            <?php }}if($_SESSION['id-role']==4 || $_SESSION['id-role']==5){?>
                                                            <button type="submit" name="delete-report-day" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                            <?php }?>
                                                        </form></td>
                                                        <td><a href="<?= $link_barcode.$row['id_user']?>" class="btn btn-sm" <?= $style_btn?>><i class="fas fa-qrcode"></i></a></td>
                                                        <td><?= $row['tgl_masuk']?></td>
                                                        <?php if($_SESSION['id-role']==5){?>
                                                        <td><?= $row['time']?></td>
                                                        <?php }?>
                                                        <td><?= $row['garansi']?></td>
                                                        <td><a class="btn btn-sm" <?= $style_btn?> data-toggle="collapse" href="#collapseUser-<?= $row['id_laporan']?>" role="button" aria-expanded="false" aria-controls="collapseUser-<?= $row['id_laporan']?>"><i class="fas fa-eye"></i> <?= $row['username']?></a></td>
                                                        <td><a class="btn btn-sm" <?= $style_btn?> data-toggle="collapse" href="#collapseLayanan-<?= $row['id_laporan']?>" role="button" aria-expanded="false" aria-controls="collapseLayanan-<?= $row['id_laporan']?>"><i class="fas fa-eye"></i> <?php $id_layanan=$row['id_layanan'];if($id_layanan==1){echo "Handphone";}else if($id_layanan==2){echo "Laptop";}?></a></td>
                                                        <td><?= $row['kerusakan']?></td>
                                                        <td><?= $row['first_name']?></td>
                                                        <td>Rp. <?= number_format($row['dp'])?></td>
                                                        <td>Rp. <?= number_format($row['biaya'])?></td>
                                                        <td>Rp. <?= number_format($row['pemasukan'])?></td>
                                                        <td><?php if(!empty($row['ket_text'])){echo $row['ket_text'];}else{echo "-";}?></td>
                                                        <td><?php if(!empty($row['ket_img'])){?>
                                                            <a href="checkup-lunas?id-lunas=<?= $row['id_laporan']?>&akses=3" class="btn btn-sm" <?= $style_btn?>><i class="fas fa-eye"></i> View</a>
                                                            <?php }else{?><p class="text-dark">Bukti Nota</p></tr><?php }?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="10" class="border-0">

                                                            <div class="collapse mb-3" id="collapseUser-<?= $row['id_laporan']?>">
                                                                <div class="card card-body text-dark border-0 shadow">
                                                                    <p>Username : <?= $row['username']?></p>
                                                                    <p>Email : <?php $em=$row['email_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                                                                    <p>Telepon : <?php $em=$row['tlpn_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                                                                    <p>Alamat : <?php $em=$row['alamat_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                                                                </div>
                                                            </div>

                                                            <div class="collapse" id="collapseLayanan-<?= $row['id_laporan']?>">
                                                                <div class="card card-body text-dark border-0 shadow">
                                                                    <?php $id_layanan=$row['id_layanan'];$id_barang=$row['id_barang'];if($id_layanan==1){$handphone=mysqli_query($conn, "SELECT * FROM handphone WHERE id_hp='$id_barang'");$row_hp=mysqli_fetch_assoc($handphone);?>
                                                                        <p>Type : <?= $row_hp['type']?></p>
                                                                        <p>Seri : <?= $row_hp['seri']?></p>
                                                                        <p>Imei : <?= $row_hp['imei']?></p>
                                                                    <?php }else if($id_layanan==2){$laptop=mysqli_query($conn, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");$row_laptop=mysqli_fetch_assoc($laptop);?>
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