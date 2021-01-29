<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan-ar.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Access Menu | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Access Sub Menu</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12 m-0 p-0 d-sm-flex justify-content-between flex-row-reverse">
                                <div class="col-lg-4 mt-3">
                                    <div class="card shadow border-0">
                                        <div class="card-body text-center">
                                            <h6 class="text-dark font-weight-bold mb-4">Insert Access</h6>
                                            <form action="" method="POST">
                                                <div class="form-group">
                                                    <select name="id-role" class="form-control" required>
                                                        <option>Pilih Role</option>
                                                        <?php foreach($users_role_access as $row1):?>
                                                        <option value="<?=$row1['id_role']?>"><?= $row1['role']?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select name="id-sub-menu" class="form-control" required>
                                                        <option>Pilih Sub Menu</option>
                                                        <?php foreach($menu_sub_choise as $row2):?>
                                                        <option value="<?=$row2['id_sub_menu']?>"><?= $row2['title']?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="add-access-sub-menu" class="btn btn-sm" <?= $style_btn;?>>Apply</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <style>#scroll-x{overflow-x: auto}</style>
                                    <table class="table table-sm shadow rounded text-center" id="scroll-x">
                                        <thead>
                                            <tr style="border-top: hidden">
                                                <th scope="col">#</th>
                                                <th scope="col">#Role</th>
                                                <th scope="col">#Sub Menu</th>
                                                <th colspan="2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1;foreach($menu_sub_access as $row):?>
                                            <tr>
                                                <th scope="row"><?= $no;?></th>
                                                <td><?= $row['role']?></td>
                                                <td><?= $row['title']?></td>
                                                <td>
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="id-access-sub-menu" value="<?= $row['id_access_sub_menu']?>">
                                                        <button class="btn btn-warning border-0 btn-sm font-weight-bold" type="button" data-toggle="collapse" data-target="#edit-access-sub-menu<?= $row['id_access_sub_menu']?>" aria-expanded="false" aria-controls="edit-access-sub-menu<?= $row['id_access_sub_menu']?>"><i class="fas fa-pen"></i> Edit</button>
                                                        <div class="collapse mt-3 mb-3" id="edit-access-sub-menu<?= $row['id_access_sub_menu']?>">
                                                            <div class="card card-body border-0 shadow">
                                                                <form action="" method="POST">
                                                                    <div class="form-group">
                                                                        <select name="id-role" class="form-control" required>
                                                                            <option>Pilih Role</option>
                                                                            <?php foreach($users_role_access as $row1):?>
                                                                            <option value="<?=$row1['id_role']?>"><?= $row1['role']?></option>
                                                                            <?php endforeach;?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <select name="id-sub-menu" class="form-control" required>
                                                                            <option>Pilih Menu</option>
                                                                            <?php foreach($menu_sub_choise as $row2):?>
                                                                            <option value="<?= $row2['id_sub_menu']?>"><?= $row2['title']?></option>
                                                                            <?php endforeach;?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" name="edit-access-sub-menu" class="btn btn-sm" <?= $style_btn;?>>Apply</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="id-access-sub-menu" value="<?= $row['id_access_sub_menu']?>"><button type="submit" name="delete-access-sub-menu" class="btn btn-danger btn-sm font-weight-bold border-0"><i class="fas fa-trash"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php $no++;endforeach;?>
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