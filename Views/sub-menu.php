<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-users.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="Sub Menu";
?>

<!-- == Sub Menu page == -->
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
                                <h1 class="h3 mb-0" <?= $color_black ?>><?= $_SESSION['page-name']?></h1>
                            </div>
                        <!-- == Content Info == -->
                            <div class="row flex-row-reverse">
                                <!-- == alert message == -->
                                    <div class="col-md-12">
                                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    </div>
                                <!-- == sub menu insert == -->
                                    <div class="col-lg-4 mt-3">
                                        <div class="card card-body shadow border-0 text-center">
                                            <h4 class="font-weight-bold" <?= $color_black?>>Insert Sub Menu</h4>
                                            <p class="small" <?= $color_black?>>Tambahkan sub menu yang kamu mau sesuai kebutuhan.</p>
                                            <form action="" method="POST">
                                                <div class="form-group">
                                                    <select name="id-menu" class="form-control text-center">
                                                        <option>Pilih Menu</option>
                                                        <?php if(mysqli_num_rows($menus)==0){?>
                                                        <option>Maaf menu kosong.</option>
                                                        <?php }else if(mysqli_num_rows($menus)>0){while($row=mysqli_fetch_assoc($menus)){?>
                                                        <option value="<?= $row['id_menu']?>"><?= $row['menu']?></option>
                                                        <?php }}?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="title" class="form-control text-center" placeholder="Title" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="url" class="form-control text-center" placeholder="Url" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="icon" class="form-control text-center" placeholder="Icon" required>
                                                    <small><a href="https://fontawesome.com/icons?d=gallery&m=free" class="text-decoration-none" target="blank">View all icon</a></small>
                                                </div>
                                                <div class="form-group">
                                                    <select name="is-active" class="form-control text-center" required>
                                                        <option>Pilih Status</option>
                                                        <?php if(mysqli_num_rows($menu_status_insert)==0){?>
                                                        <option>Maaf status kosong.</option>
                                                        <?php }else if(mysqli_num_rows($menu_status_insert)>0){while($row=mysqli_fetch_assoc($menu_status_insert)){?>
                                                        <option value="<?= $row['id_status']?>"><?= $row['status']?></option>
                                                        <?php }}?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="submit-sub-menu" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <!-- == sub menu data == -->
                                    <div class="col-lg-8 mt-3 mb-5">
                                        <div class="card card-body shadow border-0" style="overflow-x: auto">
                                            <table class="table table-sm text-center" <?= $color_black?>>
                                                <thead>
                                                    <tr style="border-top:hidden">
                                                        <th scope="col">No</th>
                                                        <th scope="col">Menu</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Url</th>
                                                        <th scope="col">Icon</th>
                                                        <th scope="col">Active</th>
                                                        <th colspan="2">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1;?>
                                                    <?php if(mysqli_num_rows($menu_sub)==0){?>
                                                        <tr>
                                                            <th colspan="8">Maaf data masih kosong.</th>
                                                        </tr>
                                                    <?php }else if(mysqli_num_rows($menu_sub)>0){while($row=mysqli_fetch_assoc($menu_sub)){?>
                                                        <tr>
                                                            <th scope="row"><?= $no;?></th>
                                                            <td scope="row"><?= $row['menu'];?></td>
                                                            <td scope="row"><?= $row['title'];?></td>
                                                            <td scope="row"><a href="<?= $row['url'];?>"><?= $row['url'];?></a></td>
                                                            <td scope="row"><?= $row['icon'];?></td>
                                                            <td scope="row"><?= $row['status']?></td>
                                                            <td>
                                                                <div class="dropdown no-arrow">
                                                                    <button class="btn btn-warning btn-sm shadow dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-pen"></i> Ubah</button>
                                                                    <div class="dropdown-menu p-2 border-0 shadow text-center" aria-labelledby="dropdownMenuButton">
                                                                        <form action="" method="POST">
                                                                            <input type="hidden" name="id-sub-menu" value="<?= $row['id_sub_menu']?>">
                                                                            <div class="form-group">
                                                                                <select name="id-menu" class="form-control text-center">
                                                                                    <option>Pilih Menu</option>
                                                                                    <?php foreach($menus_edit as $row_menu):?>
                                                                                    <option value="<?= $row_menu['id_menu']?>"><?= $row_menu['menu']?></option>
                                                                                    <?php endforeach;?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input type="text" name="title" value="<?= $row['title']?>" placeholder="Title" class="form-control text-center" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input type="text" name="url" value="<?= $row['url']?>" placeholder="URL" class="form-control text-center" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input type="text" name="icon" value="<?= $row['icon']?>" placeholder="Icon" class="form-control text-center" required>
                                                                                <small><a href="https://fontawesome.com/icons?d=gallery&m=free" class="text-decoration-none" target="blank">View all icon</a></small>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <select name="is-active" class="form-control text-center" required>
                                                                                    <option>Pilih Status</option>
                                                                                    <?php foreach($menu_status_edit as $row_status):?>
                                                                                    <option value="<?= $row_status['id_status']?>"><?= $row_status['status']?></option>
                                                                                    <?php endforeach;?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <button type="submit" name="edit-sub-menu" <?= $style_btn;?> class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><form action="" method="POST">
                                                                <input type="hidden" name="id-sub-menu" value="<?= $row['id_sub_menu'];?>">
                                                                <input type="hidden" name="title" value="<?= $row['title'];?>">
                                                                <input type="hidden" name="url" value="<?= $row['url'];?>">
                                                                <button type="submit" name="delete-sub-menu" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
                                                            </form></td>
                                                        </tr>
                                                    <?php $no++; }}?>
                                                </tbody>
                                            </table>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <?php if(isset($page2)){if(isset($total_page2)){if($page2>1):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" <?= $bg_black?> href="sub-menu?page=<?= $page2-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page2; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page2):?>
                                                                <li class="page-item shadow"><a class="page-link font-weight-bold border-0" <?= $bg_black?> href="sub-menu?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item shadow"><a class="page-link border-0" href="sub-menu?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page2<$total_page2):?>
                                                    <li class="page-item shadow">
                                                        <a class="page-link border-0" <?= $bg_black?> href="sub-menu?page=<?= $page2+1;?>">Next</a>
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