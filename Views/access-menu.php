<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-users.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="- Access Menu";
?>

<!-- == Access Menu page == -->
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
                                <h1 class="h3 mb-0" <?= $color_black ?>>Access Menu</h1>
                            </div>
                        <!-- == Content Info == -->
                            <div class="row flex-row-reverse">
                                <!-- == alert message == -->
                                    <div class="col-md-12">
                                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    </div>
                                <!-- == insert data == -->
                                    <div class="col-lg-4 mt-3">
                                        <div class="card card-body shadow border-0 text-center">
                                            <h4 class="font-weight-bold" <?= $color_black?>>Insert Access Menu</h4>
                                            <p class="small" <?= $color_black?>>Berikan hak akses menu kepada user selain role users.</p>
                                            <form action="" method="POST">
                                                <div class="form-group">
                                                    <select name="id-role" class="form-control text-center" required>
                                                        <option>Pilih role users</option>
                                                        <?php foreach($users_roles as $row_role):?>
                                                        <option value="<?= $row_role['id_role']?>"><?= $row_role['role']?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select name="id-menu" class="form-control text-center" required>
                                                        <option>Pilih menu</option>
                                                        <?php foreach($menus as $row_menu):?>
                                                        <option value="<?= $row_menu['id_menu']?>"><?= $row_menu['menu']?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="submit-access-menu" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <!-- == query data == -->
                                    <div class="col-lg-8 mt-3 mb-5">
                                        <div class="card card-body shadow border-0" style="overflow-x: auto">
                                            <table class="table table-sm text-center" <?= $color_black?>>
                                                <thead>
                                                    <tr style="border-top:hidden">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Role Users</th>
                                                        <th scope="col">Menu</th>
                                                        <th colspan="1">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1; if(mysqli_num_rows($menu_access)==0){?>
                                                        <tr>
                                                            <th colspan="4">Belum ada menu</th>
                                                        </tr>
                                                    <?php }else if(mysqli_num_rows($menu_access)>0){while($row=mysqli_fetch_assoc($menu_access)){?>
                                                        <tr>
                                                            <th scope="row"><?= $no?></th>
                                                            <td><?= $row['role']?></td>
                                                            <td><?= $row['menu']?></td>
                                                            <td><form action="" method="POST">
                                                                <input type="hidden" name="id-access-menu" value="<?= $row['id_access_menu']?>">
                                                                <button type="submit" name="hapus-access-menu" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
                                                            </form></td>
                                                        </tr>
                                                    <?php $no++;}}?>
                                                </tbody>
                                            </table>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <?php if(isset($page3)){if(isset($total_page3)){if($page3>1):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" <?= $bg_black?> href="access-menu?page=<?= $page3-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page3; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page3):?>
                                                                <li class="page-item shadow"><a class="page-link font-weight-bold border-0" <?= $bg_black?> href="access-menu?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item shadow"><a class="page-link border-0" href="access-menu?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page3<$total_page3):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" <?= $bg_black?> href="access-menu?page=<?= $page3+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>