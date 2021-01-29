<ul class="navbar-nav sidebar sidebar-dark accordion ml-2 mt-2 mb-2 rounded  <?php if(!isset($_POST['toggle-open'])){echo 'toggled';}?>" style="background-color: #EAEAEA; z-index: 2;" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-icon">
            <i class="fas fa-server text-dark"></i>
        </div>
        <div class="sidebar-brand-text mx-3 text-dark">UGD HP</div>
    </a>
    <small class="text-center text-dark font-weight-lighter">Netmedia Framecode</small>
    <small class="text-center text-dark font-weight-bolder" id="timestamp-sidebar" style="letter-spacing: 2px"></small>
    
    <hr class="sidebar-divider my-0 border-dark">

    <li class="nav-item">
        <a class="nav-link text-dark font-weight-bold" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt text-dark"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider border-dark">
    <div class="sidebar-heading text-dark">
        My Account
    </div>
    <li class="nav-item">
        <a class="nav-link text-dark" href="profile">
            <div class="bg-nav">
                <i class="fas fa-fw fa-user text-dark"></i>
                <span>My Profile</span>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-dark" href="settings">
            <div class="bg-nav">
                <i class="fas fa-fw fa-cogs text-dark"></i>
                <span>Settings</span>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-dark" href="activity-log">
            <div class="bg-nav">
                <i class="fas fa-fw fa-skiing text-dark"></i>
                <span>Activity Log</span>
            </div>
        </a>
    </li>
    <?php if($_SESSION['id-role']==5){?>
    <li class="nav-item">
        <a class="nav-link text-dark" href="utilities">
            <div class="bg-nav">
                <i class="fas fa-fw fa-glasses text-dark"></i>
                <span>Utilities</span>
            </div>
        </a>
    </li>
    <?php }?>
    <li class="nav-item">
        <a class="nav-link text-dark" href="about">
            <div class="bg-nav">
                <i class="fab fa-fw fa-cloudversify text-dark"></i>
                <span>About</span>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-dark" href="<?= $logout;?>">
            <div class="bg-nav">
                <i class="fas fa-fw fa-sign-out-alt text-dark"></i>
                <span>Logout</span>
            </div>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block border-dark">
    <div class="text-center d-none d-md-inline">
        <form action="" method="POST">
            <button type="submit" name="toggle-open" class="rounded-circle border-0" id="sidebarToggle"></button>
        </form>
    </div>
</ul>