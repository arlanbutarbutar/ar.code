<ul class="navbar-nav bg-gradient-white sidebar sidebar-light accordion shadow-sm toggled" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-code " <?= $color_black?>></i>
        </div>
        <div class="sidebar-brand-text mx-3 font-lato" <?= $color_black?>>UGD HP</div>
    </a>
    <small class="text-center font-caveat fa-1x" <?= $color_black?>>Netmedia Framecode</small>
    <hr class="sidebar-divider my-0 border-dark">
    <li class="nav-item active">
        <a class="nav-link card-scale" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt" <?= $color_black?>></i>
            <span <?= $color_black?>>Dashboard</span>
        </a>
    </li>
    <?php if (isset($_SESSION['profile-page'])) { ?>
    <?php }
    if (!isset($_SESSION['profile-page'])) {
        $role_id = addslashes(trim($_SESSION['id-role']));
        $menuValue = "SELECT `menu`.`id_menu`, `menu` FROM `menu` JOIN `menu_access` ON `menu`.`id_menu` = `menu_access`.`id_menu` WHERE `menu_access`.`role_id` = $role_id ORDER BY `menu_access`.`id_menu` ASC";
        $menu = mysqli_query($conn, $menuValue);
    ?>
        <?php foreach ($menu as $m) : ?>
            <hr class="sidebar-divider border-dark">
            <div class="sidebar-heading text-center" <?= $color_black?>>
                <?= $m['menu']; ?>
            </div>
            <?php
            $menuId = $m['id_menu'];
            $querySubMenu = "SELECT * FROM `menu_sub` JOIN `menu` ON `menu_sub`.`id_menu` = `menu`.`id_menu` JOIN `menu_sub_access` ON `menu_sub`.`id_sub_menu` = `menu_sub_access`.`id_sub_menu` WHERE `menu_sub`.`id_menu`=$menuId AND `menu_sub`.`is_active`=1 AND `menu_sub_access`.`role_id` = $role_id";
            $subMenu = mysqli_query($conn, $querySubMenu);
            ?>
            <?php foreach ($subMenu as $sm) : ?>
                <li class="nav-item">
                    <a class="nav-link card-scale font-weight-bold" <?= $color_black?> href="<?= $sm['url']; ?>">
                        <div class="bg-nav">
                            <i class="<?= $sm['icon']; ?>" <?= $color_black?>></i>
                            <span <?= $color_black?>><?= $sm['title']; ?></span>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
    <?php endforeach;
    } ?>
    <hr class="sidebar-divider d-none d-md-block border-dark">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <div class="sidebar-card">
        <img class="sidebar-card-illustration mb-2" <?= $color_black?> src="../Assets/img/NETCode_logo.png" alt="Image Sidebar">
        <p class="text-center mb-2" <?= $color_black?>><strong>GUI Apps</strong> Coba apps kami yang telah support dengan android!</p>
        <a class="btn btn-light shadow-sm btn-sm" href="../Application/utilities/GUI SQL.apk" download><i class="fas fa-download"></i> Unduh</a>
    </div>
</ul>