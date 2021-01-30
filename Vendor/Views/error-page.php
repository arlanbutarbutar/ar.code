<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan-ar.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Error Page | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Error Page</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card shadow border-0">
                                    <?php if(mysqli_num_rows($error_page)==0){?>
                                    <div class="card-body">
                                        <h6 class="text-center text-dark font-weight-bold mb-3">Insert Error</h6>
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <input type="text" name="error" placeholder="Name Error" class="form-control text-center">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="small-text" placeholder="Small Text" class="form-control text-center">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="description" cols="30" rows="3" placeholder="Description" class="form-control text-center"></textarea>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" name="add-error" class="btn btn-sm" <?= $style_btn?>>Apply</button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php }else if(mysqli_num_rows($error_page)>0){?>
                                    <div class="card-header bg-transparent">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h6 class="text-dark font-weight-bold">Data Error Page</h6>
                                            </div>
                                            <div class="col-lg-6">
                                                <button class="btn btn-sm float-right" <?= $style_btn?> type="button" data-toggle="collapse" data-target="#collapseAdding" aria-expanded="false" aria-controls="collapseAdding">
                                                    Insert
                                                </button>
                                            </div>
                                        </div>
                                        <div class="collapse mt-3" id="collapseAdding">
                                            <div class="card card-body shadow border-0">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <input type="text" name="error" placeholder="Name Error" class="form-control text-center">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="small-text" placeholder="Small Text" class="form-control text-center">
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="description" cols="30" rows="3" placeholder="Description" class="form-control text-center"></textarea>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" name="add-error" class="btn btn-sm" <?= $style_btn?>>Apply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <style>#scroll-x{overflow-x: auto}</style>
                                        <table class="table table-sm table-borderless text-center" id="scroll-x">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Error</th>
                                                    <th colspan="1">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while($row=mysqli_fetch_assoc($error_page)){?>
                                                <tr>
                                                    <td><?= $row['error']?></td>
                                                    <td>
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="id-error" value="<?= $row['id_error']?>">
                                                            <input type="hidden" name="error" value="<?= $row['error']?>">
                                                            <button type="submit" name="view-data-error" class="btn btn-link mr-n4"><span class="badge badge-success">View</span></button>
                                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $row['id_error']?>" aria-expanded="false" aria-controls="collapse<?= $row['id_error']?>"><span class="badge badge-warning">Edit</span></button>
                                                            <button type="submit" name="del-data-error" class="btn btn-link ml-n4"><span class="badge badge-danger">Delete</span></button>
                                                            <div class="collapse mt-3" id="collapse<?= $row['id_error']?>">
                                                                <div class="card card-body shadow border-0">
                                                                    <form action="" method="POST">
                                                                        <div class="form-group">
                                                                            <input type="text" name="error" value="<?= $row['error']?>" placeholder="Name Error" class="form-control text-center">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" name="small-text" value="<?= $row['small_text']?>" placeholder="Small Text" class="form-control text-center">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <textarea name="description" cols="30" rows="3" placeholder="Description" class="form-control text-center"><?= $row['description']?></textarea>
                                                                        </div>
                                                                        <div class="form-group text-center">
                                                                            <button type="submit" name="edit-data-error" class="btn btn-sm" <?= $style_btn?>>Apply</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card shadow border-0">
                                    <?php if(!isset($_POST['view-data-error'])){?>
                                    <div class="card-body font-weight-bold text-center text-dark">Pilih data untuk dilihat!</div>
                                    <?php }else if(isset($_POST['view-data-error'])){$id_error=$_POST['id-error'];$error_page_view=mysqli_query($conn, "SELECT * FROM error_page WHERE id_error='$id_error'");$row_view=mysqli_fetch_assoc($error_page_view);?>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p class="text-dark"><?= $row_view['small_text']?></p>
                                            <p class="text-dark"><?= $row_view['description']?></p>
                                            <footer class="blockquote-footer">Error Page <cite title="Source Title"><?= $row_view['error']?></cite></footer>
                                        </blockquote>
                                    </div>
                                    <?php }?>
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