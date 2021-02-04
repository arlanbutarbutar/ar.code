<ul class="navbar-nav bg-gradient-white sidebar sidebar-light accordion shadow-sm toggled" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-icon">
            <i class="fas fa-server" <?= $color_black?>></i>
        </div>
        <div class="sidebar-brand-text mx-3 font-lato" <?= $color_black?>>UGD HP</div>
    </a>
    <hr class="sidebar-divider my-0 border-dark">
    <li class="nav-item active">
        <a class="nav-link card-scale" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt" <?= $color_black?>></i>
            <span <?= $color_black?>>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider border-dark">
    <div class="sidebar-heading text-dark">
        My Account
    </div>
    <li class="nav-item">
        <a class="nav-link card-scale" href="profile">
            <div class="bg-nav">
                <i class="fas fa-fw fa-user" <?= $color_black?>></i>
                <span <?= $color_black?>>My Profile</span>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link card-scale" href="activity">
            <div class="bg-nav">
                <i class="fas fa-fw fa-list" <?= $color_black?>></i>
                <span <?= $color_black?>>Activity Log</span>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link card-scale" href="profile-settings">
            <div class="bg-nav">
                <i class="fas fa-fw fa-cog" <?= $color_black?>></i>
                <span <?= $color_black?>>Settings</span>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link card-scale" href="help">
            <div class="bg-nav">
                <i class="fas fa-fw fa-question-circle" <?= $color_black?>></i>
                <span <?= $color_black?>>Help</span>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link card-scale" href="report-problem">
            <div class="bg-nav">
                <i class="fas fa-fw fa-envelope" <?= $color_black?>></i>
                <span <?= $color_black?>>Report a Problem</span>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link card-scale" href="" data-toggle="modal" data-target="#logoutModal">
            <div class="bg-nav">
                <i class="fas fa-fw fa-sign-out-alt" <?= $color_black?>></i>
                <span <?= $color_black?>>Logout</span>
            </div>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block border-dark">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>