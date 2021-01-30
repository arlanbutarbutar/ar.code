<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Administrator <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Dashboard</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>

                            <div class="col-md-12 m-0 p-0">
                                <div class="row">
                                    <div class="col-lg-6 mt-2">

                                        <div class="row">
                                            <!-- data users -->
                                            <div class="col-lg-6 m-0 p-0">
                                                <a class="nav-link" href="user-online">
                                                    <div class="card border-left-info border-0 shadow h-100 py-2">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col mr-2">
                                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users</div>
                                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_users?></div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <!-- data repair -->
                                            <div class="col-lg-6 m-0 p-0">
                                                <a class="nav-link" href="nota-tinggal">
                                                    <div class="card border-left-info border-0 shadow h-100 py-2">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col mr-2">
                                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Repair</div>
                                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_repair?></div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <i class="fas fa-tools fa-2x text-gray-300"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-12 m-0 p-0">
                                            <!-- data status -->
                                            <div class="col-md-12 m-0 p-0">

                                                <div class="card border-left-info border-0 shadow h-100 py-2 mt-3 m-1">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Status</div>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800" style="font-size: 14px">Pending : <?= $total_pending?></div>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800" style="font-size: 14px">Cancel : <?= $total_cancel?></div>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800" style="font-size: 14px">On Progress : <?= $total_on_progress?></div>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800" style="font-size: 14px">Waiting to be taken : <?= $total_waiting?></div>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800" style="font-size: 14px">Finish/Success : <?= $total_finish?></div>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800" style="font-size: 14px">Block : -</div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-business-time fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="card shadow mt-3 m-3">
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        <div class="d-sm-flex justify-content-between">
                                                            <div class="col-lg-8">
                                                                <p class="text-dark font-weight-bold mb-n1">Hallo Dokter</p>
                                                                <small>Silakan uji kesehatanmu disini!</small>
                                                            </div>
                                                            <div class="col-lg-4 text-center text-warning">
                                                                <div class="col-md-12 mb-n2">
                                                                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 25px;"></i>
                                                                </div>
                                                                <div class="col-md-12 mb-n2">
                                                                    <small>Peringatan!</small>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <small>COVID 19</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="col-md-12">
                                                        <h4 class="text-dark font-weight-bold">Apakah anda mengalami gejala COVID 19?</h4>
                                                        <form action="" method="POST">
                                                            <a href="halodoc" class="btn btn-danger btn-large" data-toggle='tooltip' data-placement="bottom" title="Pertanyaan yang akan kami uji sudah sesuai dengan prosedur atau protokol COVID 19. Diambil dari sumber 'Hallodoc'."><i class="fas fa-heartbeat"></i> Uji Sekarang</a>
                                                        </form>
                                                        <a href="https://covid19.go.id/peta-sebaran" class="nav-link" target="blank">Status COVID 19 saat ini!</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col md-12 m-0 p-0 mt-3">
                                <div class="row">
                                    <div class="col-lg-3 m-0 p-0">
                                        <a class="nav-link" href="report-day">
                                            <div class="card border-left-info border-0 shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Report Days</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($total_days)?></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 m-0 p-0">
                                        <a class="nav-link" href="report-dp">
                                            <div class="card border-left-info border-0 shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Report DP</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($total_dp)?></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-moon fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 m-0 p-0">
                                        <a class="nav-link" href="report-spareparts">
                                            <div class="card border-left-info border-0 shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Report Spareparts</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($total_spareparts)?></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 m-0 p-0">
                                        <a class="nav-link" href="report-expense">
                                            <div class="card border-left-info border-0 shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Report Expense</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($total_expenses)?></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <?php if($_SESSION['id-role']==5){?>
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 m-0 p-0">
                                        <div class="card shadow mb-4 m-1">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-info">Earnings Overview</h6>
                                                <div class="dropdown no-arrow">
                                                    <a class="btn btn-outline-warning border-0 btn-sm mr-2" href="chart-edit">Edit</a>
                                                    <a class="btn btn-outline-info btn-sm border-0" href="cal-monthly">View Details</a>
                                                </div>
                                            </div>
                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <?php $income_grafik = mysqli_query($conn, "SELECT * FROM cal_grafik WHERE category='Income'");
                                                $expense_grafik = mysqli_query($conn, "SELECT * FROM cal_grafik WHERE category='Expense'");
                                                $dp_grafik = mysqli_query($conn, "SELECT * FROM cal_grafik WHERE category='DP'");
                                                $sparepart_grafik = mysqli_query($conn, "SELECT * FROM cal_grafik WHERE category='Sparepart'");?>
                                                <div class="container">
                                                    <canvas id="linechart" style="height: 400px"></canvas>
                                                </div>
                                                <!-- chart -->
                                                <script>
                                                    var ctx = document.getElementById("linechart").getContext("2d");
                                                    var data = {
                                                        labels: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
                                                        datasets: [{
                                                            label: "Income",
                                                            fill: false,
                                                            lineTension: 0.1,
                                                            backgroundColor: "#29B0D0",
                                                            borderColor: "#29B0D0",
                                                            pointHoverBackgroundColor: "#29B0D0",
                                                            pointHoverBorderColor: "#29B0D0",
                                                            data: [<?php while ($p = mysqli_fetch_array($income_grafik)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['dex'] . '",';}?>]
                                                        },
                                                        {
                                                            label: "Expense",
                                                            fill: false,
                                                            lineTension: 0.1,
                                                            backgroundColor: "#2A516E",
                                                            borderColor: "#2A516E",
                                                            pointHoverBackgroundColor: "#2A516E",
                                                            pointHoverBorderColor: "#2A516E",
                                                            data: [<?php while ($p = mysqli_fetch_array($expense_grafik)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['dex'] . '",';}?>]
                                                        },
                                                        {
                                                            label: "DP",
                                                            fill: false,
                                                            lineTension: 0.1,
                                                            backgroundColor: "#F07124",
                                                            borderColor: "#F07124",
                                                            pointHoverBackgroundColor: "#F07124",
                                                            pointHoverBorderColor: "#F07124",
                                                            data: [<?php while ($p = mysqli_fetch_array($dp_grafik)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['dex'] . '",';}?>]
                                                        },
                                                        {
                                                            label: "Sparepart",
                                                            fill: false,
                                                            lineTension: 0.1,
                                                            backgroundColor: "#CBE0E3",
                                                            borderColor: "#CBE0E3",
                                                            pointHoverBackgroundColor: "#CBE0E3",
                                                            pointHoverBorderColor: "#CBE0E3",
                                                            data: [<?php while ($p = mysqli_fetch_array($sparepart_grafik)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['dex'] . '",';}?>]
                                                        },
                                                        ]
                                                    };
                                                    var myBarChart = new Chart(ctx, {
                                                        type: 'line',
                                                        data: data,
                                                        options: {
                                                            legend: {
                                                                display: true
                                                            },
                                                            barValueSpacing: 20,
                                                            scales: {
                                                                yAxes: [{
                                                                    ticks: {
                                                                        min: 0,
                                                                    }
                                                                }],
                                                                xAxes: [{
                                                                    gridLines: {
                                                                        color: "rgba(0, 0, 0, 0)",
                                                                    }
                                                                }]
                                                            }
                                                        }
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 m-0 p-0">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3 m-0 p-0">
                                                <a class="nav-link" href="activity-logs">
                                                    <div class="card border-left-info border-0 shadow h-100 py-2">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col mr-2">
                                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Logs</div>
                                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_logs?></div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <i class="fas fa-skiing fa-2x text-gray-300"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <div class="card border-0 shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <h6 class="text-dark font-weight-bold text-center">Jumlah Log</h6>
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2 text-center">
                                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Admin</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?= $admin_logs?></div>
                                                            </div>
                                                            <div class="col mr-2 text-center">
                                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Employee</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?= $em_logs?></div>
                                                            </div>
                                                            <div class="col mr-2 text-center">
                                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"><?= $users_logs?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card shadow border-0 m-auto">
                                            <div class="card-header bg-transparent border-0 mb-n4">
                                                <h6 class="text-dark font-weight-bold text-center">Aktivitas saat ini.</h6><hr>
                                            </div>
                                            <div class="card-body">
                                                <?php foreach($activity_log as $row):?>
                                                <blockquote class="blockquote mb-0 mt-3">
                                                    <p class="text-dark small"><?= $row['log']?><a href="activity-logs?ide="><i class="fas fa-eye text-info"></i></a></p>
                                                    <footer class="blockquote-footer small text-dark"><?= $row['first_name']?> <cite title="Source Title small text-dark"><?= $row['date']." ".$row['time']?></cite></footer>
                                                </blockquote><hr>
                                                <?php endforeach;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card shadow border-0 mt-3">
                                            <div class="card-header bg-transparent border-0">
                                                <h6 class="text-info font-weight-bold text-center">Daftar User Aktif</h6>
                                            </div>
                                            <div class="card-body mt-n4"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card border-0 shadow mt-3">
                                            <div class="card-header bg-transparent border-0">
                                                <h6 class="text-info font-weight-bold text-center">Detail User Aktif</h6>
                                            </div>
                                            <div class="card-body mt-n4">
                                                <table class="table table-sm text-dark">
                                                    <thead style="border-top: hidden">
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">First</th>
                                                            <th scope="col">Last</th>
                                                            <th scope="col">Handle</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>Mark</td>
                                                            <td>Otto</td>
                                                            <td>@mdo</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <?php }?>
                        </div>
                    </div>
                </div>
                <?php require_once('../application/access/footer.php');?>
            </div>
        </div>
    </body>
</html>