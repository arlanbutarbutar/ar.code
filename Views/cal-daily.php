<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Days Calculation | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Days Calculation</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-body border-0 shadow">
                                    <div class="col-md-4 mt-3">
                                        <form action="" method="POST">
                                            <div class="input-group mt-n3">
                                                <input type="date" class="form-control bg-light border-0 small" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2" autofocus name="keyword-tgl-calculation">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-primary" type="submit" name="search-tgl-calculation">
                                                        <i class="fas fa-search fa-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <h5 class="pt-3">Data pemasukan:</h5>
                                    <table class="table text-center table-responsive">
                                        <thead style="border-top: hidden">
                                            <tr>
                                                <th scope="col">#Calculation</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Income</th>
                                                <th scope="col">Expense</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Time</th>
                                                <th colspan="2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; if(mysqli_num_rows($cal_days)){while($row=mysqli_fetch_assoc($cal_days)){?>
                                            <tr>
                                                <th scope="row"><?= $no;?></th>
                                                <td><?= $row['date'];?></td>
                                                <td>Rp. <?= number_format($row['income']);?></td>
                                                <td>Rp. <?= number_format($row['expense']);?></td>
                                                <td>Rp. <?= number_format($row['total']);?></td>
                                                <td><?= $row['time'];?></td>
                                                <td><form action="" method="POST">
                                                    <input type="hidden" name="id-cal" value="<?= $row['id_cal']?>">
                                                    <button type="submit" name="delete-days" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                                </form></td>
                                            </tr>
                                            <?php $no++;}}?>
                                        </tbody>
                                    </table>
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