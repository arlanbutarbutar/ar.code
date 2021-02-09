<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="- Dashboard";
?>

<!-- == Dashboard page == -->
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once("../Application/access/header.php"); ?>
    </head>
    <body id="page-top">
        <div id="wrapper">
            <?php require_once("../Application/access/side-navbar.php") ?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php require_once("../Application/access/top-navbar.php") ?>
                    <div class="container-fluid">
                        <!-- == Page Heading == -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0" <?= $color_black ?>>Dashboard</h1>
                                <a href="generate-report" class="d-none d-sm-inline-block btn btn-sm btn-light shadow-sm"><i class="fas fa-download fa-sm"></i> Report</a>
                            </div>
                        <!-- == Content Info == -->
                            <div class="row">
                                <!-- == Users == -->
                                    <div class="col-xl-3 col-md-6 mb-3">
                                        <a href="users" class="nav-link text-decoration-none m-0 p-0">
                                            <div class="card border-0 card-scale shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1" <?= $color_black ?>>
                                                                Users</div>
                                                            <div class="h5 mb-0 font-weight-bold" <?= $color_black ?>><?= $row_many_users?></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-users fa-2x" <?= $color_black ?>></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <!-- == Repair == -->
                                    <div class="col-xl-3 col-md-6 mb-3">
                                        <a href="nota-tinggal" class="nav-link text-decoration-none m-0 p-0">
                                            <div class="card border-0 card-scale shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1" <?= $color_black ?>>
                                                                Repair</div>
                                                            <div class="h5 mb-0 font-weight-bold" <?= $color_black ?>><?= $row_many_notes?></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-tools fa-2x" <?= $color_black ?>></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <!-- == Report == -->
                                    <div class="col-xl-3 col-md-6 mb-3">
                                        <a href="laporan-harian" class="nav-link text-decoration-none m-0 p-0">
                                            <div class="card border-0 card-scale shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1" <?= $color_black ?>>
                                                                Report</div>
                                                            <div class="h5 mb-0 font-weight-bold" <?= $color_black ?>><?= $row_many_report?></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-list fa-2x" <?= $color_black ?>></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <!-- == Spareparts == -->
                                    <div class="col-xl-3 col-md-6 mb-3">
                                        <a href="laporan-spareparts" class="nav-link text-decoration-none m-0 p-0">
                                            <div class="card border-0 card-scale shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1" <?= $color_black ?>>
                                                                Spareparts</div>
                                                            <div class="h5 mb-0 font-weight-bold" <?= $color_black ?>><?= $row_many_spareparts?></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-toolbox fa-2x" <?= $color_black ?>></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            </div>
                        <!-- == Content Berita - Review - Sources - Activity == -->
                            <div class="row flex-wrap-reverse">
                                <!-- == Berita - Review == -->
                                    <div class="col-xl-8 col-lg-7">
                                        <?php if(mysqli_num_rows($news_reviews)==0){?>
                                            <div class="card border-0 shadow mb-3">
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-start">
                                                    <h6 class="m-0 font-weight-bold" <?= $color_black ?>>Repair Data</h6>
                                                </div>
                                                <div class="card-body text-center">
                                                    <p <?= $color_black ?>>
                                                        Belum ada data yang dimasukkan.
                                                    </p>
                                                </div>
                                            </div>
                                        <?php }else if(mysqli_num_rows($news_reviews)>0){while($row=mysqli_fetch_assoc($news_reviews)){?>
                                            <div class="card border-0 shadow mb-3">
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold" <?= $color_black ?>><?= "T".$row['id_nota_tinggal']." | DP".$row['id_nota_dp']." | L".$row['id_nota_lunas']?></h6>
                                                    <div class="dropdown no-arrow">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v fa-sm fa-fw" <?= $color_black ?>></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                            <div class="dropdown-header" <?= $color_black ?>>Action data</div>
                                                            <a class="dropdown-item bg-transparent card-scale" <?= $color_black ?> href="nota-tinggal">Repair View</a>
                                                            <a class="dropdown-item bg-transparent card-scale" <?= $color_black ?> href="qr?auth=<?= $row['id_user']?>">View Barcode</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <p <?= $color_black ?>>
                                                        Perbaikan <?= $row['product']?> dengan kerusakan <?= $row['kerusakan']?> dan kondisi <?= $row['kondisi']?>. Kelengkapan dari <?= $row['product']?> <?php if(empty($row['kelengkapan']) || $row['kelengkapan']=='-'){echo 'tidak ada';}else{echo $row['kelengkapan'];}?>. Perbaikan dikerjakan oleh <?php $id_tek=$row['id_pegawai'];$teknisi=mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_tek'");$row_tek=mysqli_fetch_assoc($teknisi);echo $row_tek['first_name'];?>
                                                    </p>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-lg-4">
                                                            <div class="h6 mb-0 mr-3 font-weight-bold" <?= $color_black ?>>Progress: 
                                                                <?php $id_barang=$row['id_barang']; if($row['id_layanan']==1){
                                                                    $handphone=mysqli_query($conn, "SELECT * FROM handphone WHERE id_hp='$id_barang'");$row_hp=mysqli_fetch_assoc($handphone);echo $row_hp['type']." (".$row_hp['seri']." - ".$row_hp['imei'].")";
                                                                }if($row['id_layanan']==2){
                                                                    $laptop=mysqli_query($conn, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");
                                                                    $row_laptop=mysqli_fetch_assoc($laptop);
                                                                    echo $row_laptop['merek']." (".$row_laptop['seri'].")";
                                                                }?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="progress mr-2">
                                                            <div class="progress-bar progress-bar-striped <?php if($row['progress']<100){echo "bg-warning";}else if($row['progress']==100){echo "bg-success";}?>" role="progressbar" style="width: <?= $row['progress']."%"?>" aria-valuenow="<?= $row['progress']?>" aria-valuemin="0" aria-valuemax="100"><?= $row['progress']."%"?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }}?>
                                    </div>
                                <!-- == Sources - Activity Users == -->
                                    <div class="col-xl-4 col-lg-5">
                                        <!-- == chart pie for info user == -->
                                            <div class="card border-0 shadow mb-3">
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold" <?= $color_black ?>>Data Calculations</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="chart-pie pt-4 pb-2">
                                                        <canvas id="myPieChart"></canvas>
                                                    </div>
                                                    <div class="mt-4 text-center small">
                                                        <span class="mr-2">
                                                            <i class="fas fa-circle" style="color: #55CE12"></i> Handphone
                                                        </span>
                                                        <span class="mr-2">
                                                            <i class="fas fa-circle" style="color: #12CE8B"></i> Laptop
                                                        </span>
                                                        <span class="mr-2">
                                                            <i class="fas fa-circle" style="color: #1255CE"></i> Web Development
                                                        </span>
                                                        <span class="mr-2">
                                                            <i class="fas fa-circle" style="color: #A3C813"></i> Not Available
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- == Activity Users == -->
                                            <div class="card border-0 shadow-sm mb-5 h-50 overflow-auto">
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold" <?= $color_black ?>>Users Activity</h6>
                                                </div>
                                                <div class="card-body">
                                                    <?php if(mysqli_num_rows($users_activity)==0){?>
                                                        <div class="d-flex align-items-start mb-3">
                                                            <div class="dropdown-list-image mr-3">
                                                                <img class="rounded-circle" src="../Assets/img/img-users/default.png" alt="icon profile" style="width: 40px">
                                                            </div>
                                                            <div class="font-weight-bold w-75">
                                                                <div class="text-truncate text-dark">Belum ada user!</div>
                                                                <div class="small text-gray-500">users@gmail.com</div>
                                                            </div>
                                                        </div>
                                                    <?php }else if(mysqli_num_rows($users_activity)>0){while($row=mysqli_fetch_assoc($users_activity)){?>
                                                        <div class="d-flex align-items-start mb-3">
                                                            <div class="dropdown-list-image mr-3">
                                                                <img class="rounded-circle" src="../Assets/img/img-users/<?= $row['img']?>" alt="icon profile" style="width: 40px">
                                                            </div>
                                                            <div class="font-weight-bold w-75">
                                                                <div class="text-truncate text-dark"><strong><?= $row['first_name']?></strong> <?= $row['role']?></div>
                                                                <div class="small text-gray-500"><?= $row['email']?></div>
                                                            </div>
                                                        </div>
                                                    <?php }}?>
                                                </div>
                                            </div>
                                </div>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>