<?php if (isset($_SESSION['index'])) { ?>
    <nav class="navbar navbar-expand navbar-light bg-white m-3 rounded topbar mb-4 fixed-top shadow">
    <?php } else if (!isset($_SESSION['index'])) { ?>
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars" <?= $color_black ?>></i>
            </button>

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
        <?php } ?>

        <ul class="navbar-nav ml-auto">


            <?php if (!isset($_SESSION['index'])) { ?>
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
            <?php } ?>

            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle card-scale" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw color-black"></i>
                    <span class="badge badge-danger badge-counter">3+</span>
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header border-0" style="background: #000">
                        Alerts Center
                    </h6>

                    <a class="dropdown-item d-flex align-items-center card-scale" href="#">
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

                    <a class="dropdown-item d-flex align-items-center card-scale" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-donate text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 7, 2019</div>
                            $290.29 has been deposited into your account!
                        </div>
                    </a>

                    <a class="dropdown-item d-flex align-items-center card-scale" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 2, 2019</div>
                            Spending Alert: We've noticed unusually high spending for your account.
                        </div>
                    </a>

                    <a class="dropdown-item text-center small color-black card-scale" href="#">Show All Alerts</a>
                </div>
            </li>

            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle card-scale" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw color-black"></i>
                    <span class="badge badge-danger badge-counter">7</span>
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header border-0" style="background: #000">
                        Message Center
                    </h6>

                    <a class="dropdown-item d-flex align-items-center card-scale" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="../Assets/img/person/person_1.png" alt="">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                problem I've been having.</div>
                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                        </div>
                    </a>

                    <a class="dropdown-item d-flex align-items-center card-scale" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="../Assets/img/person/person_2.png" alt="">
                            <div class="status-indicator"></div>
                        </div>
                        <div>
                            <div class="text-truncate">I have the photos that you ordered last month, how
                                would you like them sent to you?</div>
                            <div class="small text-gray-500">Jae Chun · 1d</div>
                        </div>
                    </a>

                    <a class="dropdown-item d-flex align-items-center card-scale" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="../Assets/img/person/person_3.png" alt="">
                            <div class="status-indicator bg-warning"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Last month's report looks great, I am very happy with
                                the progress so far, keep up the good work!</div>
                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                        </div>
                    </a>

                    <a class="dropdown-item d-flex align-items-center card-scale" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                told me that people say this to all dogs, even if they aren't good...</div>
                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                        </div>
                    </a>

                    <a class="dropdown-item text-center small color-black" href="#">Read More Messages</a>
                </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle card-scale color-black" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline small"><?= $_SESSION['name'] ?></span>
                    <img class="img-profile rounded-circle" src="../Assets/img/person/default.png">
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item card-scale bg-transparent" href="profile">
                        <i class="fas fa-user fa-sm fa-fw mr-2 color-black"></i>
                        My Profile
                    </a>
                    <a class="dropdown-item card-scale bg-transparent" href="activity">
                        <i class="fas fa-list fa-sm fa-fw mr-2 color-black"></i>
                        Activity Log
                    </a>
                    <a class="dropdown-item card-scale bg-transparent" href="profile-settings">
                        <i class="fas fa-cog fa-sm fa-fw mr-2 color-black"></i>
                        Settings
                    </a>
                    <a class="dropdown-item card-scale bg-transparent" href="help">
                        <i class="fas fa-question-circle fa-sm fa-fw mr-2 color-black"></i>
                        Help
                    </a>
                    <a class="dropdown-item card-scale bg-transparent" href="report-problem">
                        <i class="fas fa-envelope fa-sm fa-fw mr-2 color-black"></i>
                        Report a Problem
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item color-black card-scale bg-transparent" href="" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 color-black"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>
        </nav>