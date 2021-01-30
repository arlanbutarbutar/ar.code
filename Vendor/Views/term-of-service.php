<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan-ar.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Term Of Service | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Term Of Service</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12">
                                <?php foreach($term_of_service as $row):?>
                                <form action="" method="POST">
                                    <input type="hidden" name="id-term" value="<?= $row['id_term']?>">
                                    <div class="card shadow border-0">
                                        <div class="card-header d-flex justify-content-between">
                                            <h6 class="text-dark font-weight-bold">Term Of Service</h6>
                                            <button type="submit" name="edit-term" <?= $style_btn?> class="btn btn-sm">Apply</button>
                                        </div>
                                        <div class="card-body">
                                            <textarea name="term-of-service" class="form-control text-dark" cols="30" rows="12" placeholder="Input Term Of Service" required><?php if($row['term_of_service']=="-"){echo "";}else if($row['term_of_service']!="-"){echo $row['term_of_service'];}?></textarea>
                                        </div>
                                    </div>
                                </form>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('../application/access/footer.php');?>
            </div>
        </div>
    </body>
</html>