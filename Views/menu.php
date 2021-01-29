<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan-ar.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Menu | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Menu</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-lg-8">
                                <button type="button" <?= $style_btn;?> class="btn btn-sm mt-3 mb-3" data-toggle="modal" data-target="#addMenu">Add Menu</button>
                                <div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header shadow">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" name="menu" class="form-control" placeholder="Semoga menunya menarik yah :)" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-dark border-0 btn-sm" data-dismiss="modal">Close</button>
                                                    <button type="submit" <?= $style_btn;?> name="add-menu" class="btn btn-sm">Add</button>
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
                                                <th scope="col">Menu</th>
                                                <th colspan="2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(mysqli_num_rows($menus)==0){?>
                                            <tr>
                                                <th colspan="3">Maaf data saat ini kosong.</th>
                                            </tr>
                                            <?php }else if(mysqli_num_rows($menus)>0){while($row=mysqli_fetch_assoc($menus)){?>
                                            <tr>
                                                <th scope="row"><?= $row['id_menu'];?></th>
                                                <td><?= $row['menu'];?></td>
                                                <td><form action="" method="POST">
                                                    <input type="hidden" name="id-menu" value="<?= $row['id_menu'];?>">
                                                    <input type="hidden" name="menu-old" value="<?= $row['menu'];?>">
                                                    <button class="btn btn-warning btn-sm" type="button" data-toggle="collapse" data-target="#collapse-edit-menu<?= $row['id_menu'];?>" aria-expanded="false" aria-controls="collapse-edit-menu<?= $row['id_menu'];?>"><i class="fas fa-pen"></i> Edit</button>
                                                    <div class="collapse mt-2" id="collapse-edit-menu<?= $row['id_menu'];?>">
                                                        <div class="card card-body">
                                                            <input type="text" name="menu" class="form-control mb-2" placeholder="Edit menu" required>
                                                            <button type="submit" name="edit-menu" <?= $style_btn;?> class="btn btn-sm">Apply</button>
                                                        </div>
                                                    </div>
                                                </form></td>
                                                <td><form action="" method="POST">
                                                    <input type="hidden" name="id-menu" value="<?= $row['id_menu'];?>">
                                                    <input type="hidden" name="menu" value="<?= $row['menu'];?>">
                                                    <button type="submit" name="delete-menu" class="btn btn-danger btn-sm border-0"><i class="fas fa-trash"></i> Delete</button>
                                                </form></td>
                                            </tr>
                                            <?php }}?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card shadow border-0 mt-3">
                                    <div class="card-body text-dark">
                                        <h6 class="text-dark font-weight-bold">Detail Penggunaan Menu</h6>
                                        <p>
                                            <li>No : id dari menu.</li>
                                            <li>Menu : nama yang mewakili file project.</li>
                                            <li>Aksi : dapat merubah dan menghapus menu.</li>
                                        </p>
                                        <p class="text-justify">Menu ini hanya dapat diaccess oleh administrator, dan apabila anda bukan administrator maka anda menyalahi aturan dan bisa terkena bokir dari server.</p>
                                        <p class="mt-n3"><span class="badge badge-warning">Warning</span> Input Menu sesuai kebutuhan!!</p>
                                    </div>
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