<nav class="navbar navbar-expand navbar-light bg-white shadow rounded fixed-top m-2 ml-n3" style=" z-index: 1;">
    <form action="" method="POST">
        <button type="submit" name="toggle-open" id="sidebarToggleTop" class="btn btn-light d-md-none rounded-circle mr-3">
            <i class="fa fa-sliders-h"></i>
        </button>
    </form>
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow mx-1 m-auto">
            <a class="nav-link dropdown-toggle text-info" href="apps-store" data-toggle="tooltip" data-placement="bottom" title="Apps Store">
                <i class="fab fa-app-store"></i>
            </a>
        </li>
        
        <li class="nav-item dropdown no-arrow mx-1 m-auto">
            <a class="nav-link dropdown-toggle text-info" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="Chat Whatsapp">
                <i class="fab fa-whatsapp fa-fw mr-3"></i>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in text-center" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header border-0 text-dark">
                    Whatsapp
                </h6>
                <?php foreach($employee_chat as $row_chat):?>
                <a class="dropdown-item d-flex align-items-center text-left" href="https://wa.me/62<?= $row_chat['phone'];?>?text=Hi, saya <?= $row_chat['first_name'];?>!" target="blank">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="../assets/img/img-employee/<?php if(empty($row_chat['img'])){echo "default.png";}else if(!empty($row_chat['img'])){echo $row_chat['img'];}?>" alt="icon-profil" style="width: 50px">
                        <?php if($row_chat['sesi']==1){?><div class="status-indicator bg-success"></div><?php }else if($row_chat['sesi']==2){?><div class="status-indicator bg-secondary"></div><?php }?>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate"><?= $row_chat['first_name'];?> <small class="text-dark"><?= $row_chat['role'];?></small></div>
                        <div class="small text-gray-500"><?= $row_chat['email'];?></div>
                    </div>
                </a>
                <?php endforeach;?>
                <a href="chat-friends" class="text-dark font-weight-bold text-decoration-none">View More</a>
            </div>
        </li>
        <div class="topbar-divider d-none d-sm-block m-auto"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if(mysqli_num_rows($employee_icon)>0){while($row_icon=mysqli_fetch_assoc($employee_icon)){?>
                <span class="mr-2 d-none d-lg-inline small text-warning font-weight-bold"><?= $row_icon['first_name'];?></span>
                <img class="img-profile rounded-circle" src="../assets/img/img-employee/<?php if(empty($row_icon['img'])){echo "default.png";}else if(!empty($row_icon['img'])){echo $row_icon['img'];}?>" style="width: 35px">
                <?php }}?>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu bg-white dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="settings">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="activity-log">
                    <i class="fas fa-skiing fa-sm fa-fw mr-2"></i>
                    Activity Log
                </a>
                <?php if($_SESSION['id-role']==5){?>
                <a class="dropdown-item" href="utilities">
                    <i class="fas fa-glasses fa-sm fa-fw mr-2"></i>
                    Utilities
                </a>
                <?php }?>
                <a class="dropdown-item" href="about">
                    <i class="fab fa-cloudversify fa-sm fa-fw mr-2"></i>
                    About
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= $logout;?>">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>