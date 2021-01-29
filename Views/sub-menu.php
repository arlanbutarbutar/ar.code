<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan-ar.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Sub Menu | <?= $_SESSION['name-web']?></title>
    </head>
    <body id="page-top" class="sidebar-toggled">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php require_once('../application/access/side-navbar.php');?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php require_once('../application/access/top-navbar.php');?>
                    <div class="container-fluid" style="margin-top: 100px">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h2 mb-0 text-gray-800">Sub Menu</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12" id="scroll-submenu">
                                <button type="button" <?= $style_btn;?> class="btn btn-sm mt-3 mb-3" data-toggle="modal" data-target="#addsubMenu">Add Sub Menu</button>
                                <div class="modal fade" id="addsubMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header shadow">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Sub Menu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <select name="id-menu" class="form-control">
                                                            <option>Pilih Menu</option>
                                                            <?php if(mysqli_num_rows($menus)==0){?>
                                                            <option>Maaf data saat ini kosong.</option>
                                                            <?php }else if(mysqli_num_rows($menus)>0){while($row=mysqli_fetch_assoc($menus)){?>
                                                            <option value="<?= $row['id_menu']?>"><?= $row['menu']?></option>
                                                            <?php }}?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="title" class="form-control" placeholder="Title">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="url" class="form-control" placeholder="Url">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="icon" class="form-control" placeholder="Icon">
                                                        <small><a href="https://fontawesome.com/icons?d=gallery&m=free" class="text-decoration-none" target="blank">View all icon</a></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="is_active" class="form-control" required>
                                                            <option value="1">Active</option>
                                                            <option value="2">Not Active</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="category" class="form-control" required>
                                                            <option value="1">Standart</option>
                                                            <option value="2">Modular</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-dark border-0 btn-sm" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="add-sub-menu" <?= $style_btn;?> class="btn btn-sm">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <style>#scroll-x{overflow-x: auto}</style>
                                <div class="col-md-12 bg-white shadow rounded" id="scroll-x">
                                    <table class="table table-hover text-center">
                                        <thead>
                                            <tr style="border-top:hidden">
                                                <th scope="col">No</th>
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
                                                    <th colspan="8">Maaf data saat ini kosong.</th>
                                                </tr>
                                            <?php }else if(mysqli_num_rows($menu_sub)>0){while($row=mysqli_fetch_assoc($menu_sub)){?>
                                                <tr>
                                                    <th scope="row"><?= $no;?></th>
                                                    <td scope="row"><?= $row['title'];?></td>
                                                    <td scope="row"><a href="<?= $row['url'];?>"><?= $row['url'];?></a></td>
                                                    <td scope="row"><?= $row['icon'];?></td>
                                                    <td scope="row"><?php if($row['is_active']==1){echo"Active";}else{echo"Not active";}?></td>
                                                    <td><form action="" method="POST">
                                                        <input type="hidden" name="id_sub_menu" value="<?= $row['id_sub_menu'];?>">
                                                        <button class="btn btn-warning border-0 btn-sm font-weight-bold" type="button" data-toggle="collapse" data-target="#edit-sub-menu<?= $row['id_sub_menu']?>" aria-expanded="false" aria-controls="edit-sub-menu<?= $row['id_sub_menu']?>"><i class="fas fa-pen"></i> Edit</button>
                                                        <div class="collapse mt-3" id="edit-sub-menu<?= $row['id_sub_menu']?>">
                                                            <div class="card card-body border-0 shadow">
                                                                <form action="" method="POST">
                                                                    <input type="hidden" name="id-sub-menu" value="<?= $row['id_sub_menu']?>">
                                                                    <div class="form-group">
                                                                        <select name="id-menu" class="form-control" required>
                                                                            <option>Pilih Menu</option>
                                                                            <?php foreach($menus1 as $row1):?>
                                                                            <option value="<?= $row1['id_menu']?>"><?= $row1['menu']?></option>
                                                                            <?php endforeach;?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="text" name="title" value="<?= $row['title']?>" placeholder="Title" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="text" name="url" value="<?= $row['url']?>" placeholder="URL" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="text" name="icon" value="<?= $row['icon']?>" placeholder="Icon" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <select name="is_active" class="form-control" required>
                                                                            <option value="1">Active</option>
                                                                            <option value="2">Not Active</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" name="edit-sub-menu" <?= $style_btn;?> class="btn btn-sm" >Apply</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </form></td>
                                                    <td><form action="" method="POST">
                                                        <input type="hidden" name="id-sub-menu" value="<?= $row['id_sub_menu'];?>">
                                                        <input type="hidden" name="category" value="<?= $row['category'];?>">
                                                        <input type="hidden" name="title" value="<?= $row['title'];?>">
                                                        <input type="hidden" name="url" value="<?= $row['url'];?>">
                                                        <button type="submit" name="delete-sub-menu" class="btn btn-danger border-0 btn-sm font-weight-bold"><i class="fas fa-trash"></i> Delete</button>
                                                    </form></td>
                                                </tr>
                                            <?php $no++?>
                                            <?php }}?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('../application/access/footer.php');?>
            </div>
        </div>
    </body>
</html>