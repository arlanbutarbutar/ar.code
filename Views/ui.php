<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan-ar.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>UI | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">User Interface</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                        </div>
                        <div class="row flex-row-reverse">
                            <div class="col-md-4">
                                <div class="card text-center shadow border-0 mt-3">
                                    <div class="card-header bg-transparent">
                                        <h6 class="text-dark font-weight-bold">Section UI</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <input type="text" name="section" placeholder="Section" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="add-section" class="btn btn-sm" <?= $style_btn?>>Adding</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="accordion" id="accordionExample">
                                    <?php if(mysqli_num_rows($user_interface_section)==0){?>
                                    <div class="card shadow border-0 rounded mt-3">
                                        <div class="card-body">
                                            <p class="text-dark font-weight-bold"></p>
                                        </div>
                                    </div>
                                    <?php }else if(mysqli_num_rows($user_interface_section)>0){while($row=mysqli_fetch_assoc($user_interface)){?>
                                    <div class="card shadow border-0 rounded mt-3">
                                        <div class="card-header bg-transparent" id="headingTwo">
                                            <h2 class="mb-0 d-flex justify-content-between">
                                                <button <?= $color_primary?> class="btn btn-link collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapse<?= $row['id_script']?>" aria-expanded="false" aria-controls="collapse<?= $row['id_script']?>">
                                                    <h6 class="text-dark font-weight-bold"><?= $row['section']?></h6>
                                                </button>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id-script" value="<?= $row['id_script']?>">
                                                    <input type="hidden" name="section" value="<?= $row['section']?>">
                                                    <button type="submit" name="del-section" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                                </form>
                                            </h2>
                                        </div>
                                        <div id="collapse<?= $row['id_script']?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <textarea name="script" class="form-control" cols="30" rows="15"><?= $row['script']?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" name="id-script" value="<?= $row['id_script']?>">
                                                        <input type="hidden" name="section" value="<?= $row['section']?>">
                                                        <!-- <button type="submit" name="edit-script" class="btn btn-sm" <?= $style_btn?>><i class="fas fa-pen"></i> Edit</button> -->
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }}?>
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