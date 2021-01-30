<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan-ar.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Controller | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Controller</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h5 class="h5 mb-0 text-gray-800">Pengaturan Umum</h5>
                                    <div class="row mr-0">
                                        <button type="button" <?= $style_btn;?> class="btn border-0 font-weight-bold btn-sm mr-3" data-toggle="modal" data-toggle="tooltip" data-target="#add-control" title="Sebaiknya anda melakukan diskusi terlebih dahulu sebelum memasukan fasilitas kontrol web!">
                                            <i class="fas fa-plus"></i> Add Control
                                        </button>
                                        <div class="modal fade" id="add-control" tabindex="-1" role="dialog" aria-labelledby="add-controlLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Control</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <textarea name="aturan" placeholder="Type for control server" class="form-control" cols="20" rows="10"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <select name="is_active" class="form-control" required>
                                                                    <option>Pilih Status</option>
                                                                    <option value="1">Active</option>
                                                                    <option value="2">Not Active</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Batal</button>
                                                            <button type="submit" name="add-control" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 bg-white rounded shadow p-3">
                                    <?php $no=1;?>
                                    <?php foreach($controller as $row):?>
                                    <div class="d-sm-flex align-items-center justify-content-between ml-3 mb-n3 mt-n2">
                                        <div class="row col-lg-10">
                                            <p><?= $no;?>. <?= $row['aturan']?> <a href="#edit-<?= $row['id_controller']?>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="edit-<?= $row['id_controller']?>" class="text-warning"><i class="fas fa-pen"></i></a></p>
                                            <div class="collapse mb-3" id="edit-<?= $row['id_controller']?>">
                                                <div class="card card-body border-0 shadow">
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="id-controller" value="<?= $row['id_controller']?>">
                                                        <div class="form-group">
                                                            <textarea name="aturan" cols="30" rows="5" placeholder="Kontrol" class="form-control"></textarea>
                                                        </div>
                                                        <div class="from-group">
                                                            <button type="submit" name="edit-control" class="btn btn-warning btn-sm">Apply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row col-lg-2">
                                            <form action="" method="POST">
                                                <input type="hidden" name="id-controller" value="<?= $row['id_controller']?>">
                                                <input type="hidden" name="is-active" value="<?= $row['is_active']?>">
                                                <input type="hidden" name="aturan" value="<?= $row['aturan']?>">
                                                <button type="submit" name="aksi-control" class="btn btn-link" style="font-size: 30px"><i class="fas fa-toggle-<?= $row['toggle']?>"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <?php $no++;?>
                                    <?php endforeach;?>
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