<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars" <?= $color_black ?>></i>
    </button>
    <!-- == search anything == -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" <?= $color_black ?> aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-light" type="button">
                        <i class="fas fa-search fa-sm" <?= $color_black ?>></i>
                    </button>
                </div>
            </div>
        </form>
    <ul class="navbar-nav ml-auto">
        <!-- == search anything == -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw" <?= $color_black ?>></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" <?= $color_black ?> aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-light shadow" type="button">
                                    <i class="fas fa-search fa-sm" <?= $color_black ?>></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        <!-- == notification == -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw" <?= $color_black ?>></i>
                    <span class="badge badge-danger badge-counter">3+</span>
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header border-0" style="background: #000">
                        Alerts Center
                    </h6>
                    <!-- ==> data query -->
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 12, 2019</div>
                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                        </div>
                    </a>
                    <!-- ==> end data query -->
                    <a class="dropdown-item text-center small" href="#">Show All Alerts</a>
                </div>
            </li>
        <!-- == message == -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw" <?= $color_black ?>></i>
                    <span class="badge badge-danger badge-counter">7</span>
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header border-0" style="background: #000">
                        Message Center
                    </h6>
                    <!-- ==> data query -->
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="../Assets/img/img-web/..." alt="">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                problem I've been having.</div>
                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                        </div>
                    </a>
                    <!-- ==> end data query -->
                    <a class="dropdown-item text-center small color-black" href="#">Read More Messages</a>
                </div>
            </li>
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- == view profile == -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle text-dark" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if(mysqli_num_rows($user_views_profile)==0){?>
                        <p class="text-danger">Query error!</p>
                    <?php }if(mysqli_num_rows($user_views_profile)>0){while($row=mysqli_fetch_assoc($user_views_profile)){?>
                        <span class="mr-2 d-none d-lg-inline small"><?= $row['first_name'] ?></span>
                        <img class="img-profile rounded-circle" src="../Assets/img/img-users/<?= $row['img']?>">
                    <?php }}?>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item card-scale bg-transparent" <?= $color_black?> href="profile">
                        <i class="fas fa-user fa-sm fa-fw mr-2" <?= $color_black?>></i>
                        My Profile
                    </a>
                    <a class="dropdown-item card-scale bg-transparent" <?= $color_black?> href="activity">
                        <i class="fas fa-list fa-sm fa-fw mr-2" <?= $color_black?>></i>
                        Activity Log
                    </a>
                    <a class="dropdown-item card-scale bg-transparent" href="profile-settings">
                        <i class="fas fa-cog fa-sm fa-fw mr-2" <?= $color_black?>></i>
                        Settings
                    </a>
                    <a class="dropdown-item card-scale bg-transparent" href="help">
                        <i class="fas fa-question-circle fa-sm fa-fw mr-2" <?= $color_black?>></i>
                        Help
                    </a>
                    <a class="dropdown-item card-scale bg-transparent" href="report-problem">
                        <i class="fas fa-envelope fa-sm fa-fw mr-2" <?= $color_black?>></i>
                        Report a Problem
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item card-scale bg-transparent" href="" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2" <?= $color_black?>></i>
                        Logout
                    </a>
                </div>
            </li>
    </ul>
</nav>