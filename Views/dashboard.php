<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-users.php");
    require_once("../Application/session/redirect-access-visitor.php");
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
                                <h1 class="h3 mb-0 color-black">Dashboard</h1>
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
                                                            <div class="h5 mb-0 font-weight-bold" <?= $color_black ?>>0</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-users fa-2x" <?= $color_black ?>></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <!-- == Project == -->
                                    <div class="col-xl-3 col-md-6 mb-3">
                                        <a href="users" class="nav-link text-decoration-none m-0 p-0">
                                            <div class="card border-0 card-scale shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1" <?= $color_black ?>>
                                                                Project</div>
                                                            <div class="h5 mb-0 font-weight-bold" <?= $color_black ?>>0</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-tasks fa-2x" <?= $color_black ?>></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <!-- == Databases == -->
                                    <div class="col-xl-3 col-md-6 mb-3">
                                        <a href="databases" class="nav-link text-decoration-none m-0 p-0">
                                            <div class="card border-0 card-scale shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1" <?= $color_black ?>>
                                                                Databases</div>
                                                            <div class="h5 mb-0 font-weight-bold" <?= $color_black ?>>0</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-database fa-2x" <?= $color_black ?>></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <!-- == Deadline == -->
                                    <div class="col-xl-3 col-md-6 mb-3">
                                        <a href="deadline-project" class="nav-link text-decoration-none m-0 p-0">
                                            <div class="card border-0 card-scale shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1" <?= $color_black ?>>Deadline Project
                                                            </div>
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col-auto">
                                                                    <div class="h5 mb-0 mr-3 font-weight-bold" <?= $color_black ?>>0</div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="progress progress-sm mr-2">
                                                                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: <?= $progress_project ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-clipboard-list fa-2x" <?= $color_black ?>></i>
                                                        </div>
                                                        <div class="col-md-12 m-0 p-0 mb-n5">
                                                            <marquee behavior="" direction="" onmouseover="this.stop()" onmouseout="this.start()"><small class="color-black"></small></marquee>
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
                                        <!-- ==>> query row data -->
                                                <div class="card border-0 shadow mb-3">
                                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                        <h6 class="m-0 font-weight-bold" <?= $color_black ?>>data</h6>
                                                        <div class="dropdown no-arrow">
                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v fa-sm fa-fw" <?= $color_black ?>></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                <div class="dropdown-header" <?= $color_black ?>>Aksi data</div>
                                                                <a class="dropdown-item bg-transparent card-scale" <?= $color_black ?> href="project?idp=data">View Project</a>
                                                                <a class="dropdown-item bg-transparent card-scale" <?= $color_black ?> href="../Application/utilities/data" download>Unduh Project</a>
                                                                <a class="dropdown-item bg-transparent card-scale" <?= $color_black ?> href="#">Edit Project</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p <?= $color_black ?>>
                                                            Coder <a href="users?idu=data" class="font-weight-bold" <?= $color_black ?>><i class="fas fa-user"></i> data</a><button type="button" class="btn btn-link btn-sm border-0 font-weight-bold" data-toggle="modal" data-target="#email-coder" <?= $color_black ?>>data</button>telah membuat project dengan nama <strong>data</strong> pada tanggal data berstatus <strong>data</strong> dengan Deadline pada tanggal data.
                                                        </p>
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col-auto">
                                                                <div class="h6 mb-0 mr-3 font-weight-bold" <?= $color_black ?>>Progress: data</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="progress progress-sm mr-2">
                                                                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <!-- ==>> query row data -->
                                            <div class="card border-0 shadow mb-4">
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold" <?= $color_black ?>>Project</h6>
                                                </div>
                                                <div class="card-body">
                                                    <p class="text-center" <?= $color_black ?>>belum ada project</p>
                                                </div>
                                            </div>
                                        <!-- ==>> query row data -->
                                    </div>
                                <!-- Sources - Activity Users -->
                                <div class="col-xl-4 col-lg-5">
                                    <!-- == chart pie for info user == -->
                                        <div class="card border-0 shadow mb-3">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold" <?= $color_black ?>>Sources</h6>
                                            </div>
                                            <div class="card-body">
                                                <!-- ==>> query row data -->
                                                    <div class="chart-pie pt-4 pb-2">
                                                        <canvas id="myPieChart"></canvas>
                                                    </div>
                                                    <div class="mt-4 text-center small">
                                                        <span class="mr-2">
                                                            <i class="fas fa-circle" style="color: #E50909"></i> Developer
                                                        </span>
                                                        <span class="mr-2">
                                                            <i class="fas fa-circle" style="color: #E3DF0A"></i> Designer
                                                        </span>
                                                        <span class="mr-2">
                                                            <i class="fas fa-circle" style="color: #0A8BE2"></i> Code Reviewer
                                                        </span>
                                                    </div>
                                                <!-- ==>> query row data -->
                                                    <p class="text-center m-auto text-dark">belum ada coder yang terdaftar!</p>
                                                <!-- ==>> query row data -->
                                            </div>
                                        </div>

                                    <!-- == Activity Users == -->
                                        <div class="card border-0 shadow-sm mb-3">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold" <?= $color_black ?>>Users Activity</h6>
                                            </div>
                                            <div class="card-body">
                                                <?php ?>
                                                <div class="d-flex align-items-start mb-3">
                                                    <div class="dropdown-list-image mr-3">
                                                        <img class="rounded-circle" src="../Assets/img/person/person_1.png" alt="" style="width: 40px">
                                                        <div class="status-indicator bg-success"></div>
                                                    </div>
                                                    <div class="font-weight-bold">
                                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                                            problem I've been having.</div>
                                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                                    </div>
                                                </div>
                                                <?php ?>
                                            </div>
                                        </div>
                                </div>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>