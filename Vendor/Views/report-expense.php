<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Expense Report | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Expense Report</h1>
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
                                                <button class="btn btn-link text-decoration-none text-dark font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Insert Expense Report</button>
                                            </h2>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <input type="text" name="jenis" placeholder="Jenis Pengeluaran" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="ket" cols="30" rows="5" placeholder="Keterangan" class="form-control" style="resize: none" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="number" name="biaya" placeholder="Biaya Pengeluaran" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="expense-report" class="btn btn-sm" <?= $style_btn?>>Report</button>
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
                                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search No Nota DP" aria-label="Search" aria-describedby="basic-addon2" autofocus id="keyword-laporan-pengeluaran">
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control bg-light border-0 small" placeholder="Search Date" aria-label="Search" aria-describedby="basic-addon2" autofocus name="keyword-tgl-laporan-pengeluaran">
                                                        <div class="input-group-append">
                                                            <button class="btn" <?= $style_btn?> type="submit" name="search-tgl-laporan-pengeluaran">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-dark font-weight-bold">Laporan Pengeluaran</h6>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-end">
                                                    <?php if(isset($page13)){if(isset($total_page13)){if($page13>1):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="report-expense?page=<?= $page13-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page13; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page13):?>
                                                                <li class="page-item"><a class="page-link font-weight-bold" href="report-expense?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item"><a class="page-link" href="report-expense?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page13<$total_page13):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="report-expense?page=<?= $page13+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>

                                        <div class="table-responsive" id="container-laporan-pengeluaran">
                                            <table class="table table-sm text-dark text-center">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Jenis Pengeluaran</th>
                                                        <th scope="col">Keterangan</th>
                                                        <th scope="col">Biaya Pengeluaran</th>
                                                        <th scope="col">Tgl Pengeluaran</th>
                                                        <?php if($_SESSION['id-role']==5){?>
                                                        <th scope="col">Waktu</th>
                                                        <?php }?>
                                                        <th colspan="2">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1;if(mysqli_num_rows($laporan_pengeluaran)==0){?>
                                                    <tr>
                                                        <th colspan="19">Maaf data saat ini kosong!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($laporan_pengeluaran)>0){while($row=mysqli_fetch_assoc($laporan_pengeluaran)){?>
                                                    <tr>
                                                        <th scope="row"><?= $no;?></th>
                                                        <td><?= $row['jenis_pengeluaran']?></td>
                                                        <td><?= $row['ket']?></td>
                                                        <td>Rp. <?= number_format($row['biaya_pengeluaran'])?></td>
                                                        <td><?= $row['tgl_pengeluaran']?></td>
                                                        <?php if($_SESSION['id-role']==5){?>
                                                        <td><?= $row['time']?></td>
                                                        <?php }?>
                                                        <td><?php if($_SESSION['id-role']==6){$tgl=$row['tgl_cari'];$tgl_skrng=date('Y-m-d');if($tgl==$tgl_skrng){?>
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="collapse" data-target="#edit-pengeluaran<?= $row['id_pengeluaran']?>" aria-expanded="false" aria-controls="edit-pengeluaran<?= $row['id_pengeluaran']?>"><i class="fas fa-pen"></i></button>
                                                            <?php }else{?>
                                                            <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-pen"></i></button>
                                                            <?php }}if($_SESSION['id-role']==4 || $_SESSION['id-role']==5){?>
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="collapse" data-target="#edit-pengeluaran<?= $row['id_pengeluaran']?>" aria-expanded="false" aria-controls="edit-pengeluaran<?= $row['id_pengeluaran']?>"><i class="fas fa-pen"></i></button>
                                                        <?php }?></td>
                                                        <td><?php if($_SESSION['id-role']==6){$tgl=$row['tgl_cari'];$tgl_skrng=date('Y-m-d');if($tgl==$tgl_skrng){?>
                                                            <form action="" method="POST">
                                                            <input type="hidden" name="id-pengeluaran" value="<?= $row['id_pengeluaran']?>">
                                                            <button type="submit" name="hapus-pengeluaran" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                            </form><?php }else{?>
                                                            <button type="button" name="hapus-pengeluaran" class="btn btn-secondary btn-sm"><i class="fas fa-trash"></i></button>
                                                            <?php }}if($_SESSION['id-role']==4 || $_SESSION['id-role']==5){?>
                                                            <form action="" method="POST">
                                                            <input type="hidden" name="id-pengeluaran" value="<?= $row['id_pengeluaran']?>">
                                                            <button type="submit" name="hapus-pengeluaran" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                        </form><?php }?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="10" class="border-0">

                                                        <div class="collapse" id="edit-pengeluaran<?= $row['id_pengeluaran']?>">
                                                            <div class="card card-body border-0 shadow">
                                                                <form action="" method="POST">
                                                                    <input type="hidden" name="id-pengeluaran" value="<?= $row['id_pengeluaran']?>">
                                                                    <div class="form-group">
                                                                        <label>Jenis Pengeluaran</label>
                                                                        <input type="text" name="jenis" placeholder="Jenis Pengeluaran" class="form-control" value="<?= $row['jenis_pengeluaran']?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Keterangan</label>
                                                                        <textarea name="ket" cols="30" rows="5" placeholder="Keterangan" class="form-control" style="resize: none" required><?= $row['ket']?></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Biaya Pengeluaran</label>
                                                                        <input type="number" name="biaya" placeholder="Biaya Pengeluaran" class="form-control" value="<?= $row['biaya_pengeluaran']?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" name="edit-pengeluaran" class="btn btn-warning btn-sm">Apply</button>
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