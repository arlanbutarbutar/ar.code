<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Months Calculation | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Months Calculation</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-body border-0 shadow">
                                    <table class="table text-center table-responsive">
                                        <thead style="border-top: hidden">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Month</th>
                                                <th scope="col">Income</th>
                                                <th scope="col">Expense</th>
                                                <th scope="col">DP</th>
                                                <th scope="col">Spareparts</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1;?>
                                            <?php if(mysqli_num_rows($cal_month)){while($row=mysqli_fetch_assoc($cal_month)){?>
                                            <tr>
                                                <th scope="row"><?= $no;?></th>
                                                <td><?= $row['date'];?></td>
                                                <td>Rp. <?= number_format($row['report']);?></td>
                                                <td>Rp. <?= number_format($row['expense']);?></td>
                                                <td>Rp. <?= number_format($row['dp']);?></td>
                                                <td>Rp. <?= number_format($row['spareparts']);?></td>
                                                <td><?= $row['time'];?></td>
                                                <td><form action="" method="POST">
                                                    <input type="hidden" name="id-month" value="<?= $row['id_montly'];?>">
                                                    <button type="submit" name="delete-month" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
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