<ul class="navbar-nav sidebar sidebar-dark ml-2 mt-2 mb-2 accordion rounded <?php if(!isset($_POST['toggle-open'])){echo 'toggled';}?>" style="background-color: #EAEAEA; z-index: 2;" id="accordionSidebar">
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

    <?php
        $role_id=addslashes(trim($_SESSION['id-role']));
        $menuValue="SELECT `menu`.`id_menu`, `menu` FROM `menu` JOIN `menu_access` ON `menu`.`id_menu` = `menu_access`.`id_menu` WHERE `menu_access`.`role_id` = $role_id ORDER BY `menu_access`.`id_menu` ASC";
        $menu=mysqli_query($conn, $menuValue);
    ?>
    <?php foreach($menu as $m):?>
        <hr class="sidebar-divider border-dark">
        <div class="sidebar-heading text-dark">
            <?= $m['menu'];?>
        </div>
        <?php
            $menuId = $m['id_menu'];
            $querySubMenu = "SELECT * FROM `menu_sub` JOIN `menu` ON `menu_sub`.`id_menu` = `menu`.`id_menu` JOIN `menu_sub_access` ON `menu_sub`.`id_sub_menu` = `menu_sub_access`.`id_sub_menu` WHERE `menu_sub`.`id_menu`=$menuId AND `menu_sub`.`is_active`=1 AND `menu_sub_access`.`role_id` = $role_id";
            $subMenu = mysqli_query($conn, $querySubMenu);
        ?>
        <?php foreach($subMenu as $sm):?>
            <li class="nav-item">
                <a class="nav-link text-dark font-weight-bold" href="<?= $sm['url'];?>">
                    <div class="bg-nav">
                        <i class="<?= $sm['icon'];?> text-dark"></i>
                        <span><?= $sm['title'];?></span>
                    </div>
                </a>
            </li>
        <?php endforeach;?>
    <?php endforeach;?>
    <hr class="sidebar-divider d-none d-md-block border-dark">
    <div class="text-center d-none d-md-inline">
        <form action="" method="POST">
            <button type="submit" name="toggle-open" class="rounded-circle border-0" id="sidebarToggle"></button>
        </form>
    </div>
</ul>