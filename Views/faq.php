<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan-ar.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>FAQ | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">FAQ</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                        </div>
                        <div class="row flex-row-reverse">
                            <div class="col-lg-4 mt-3">
                                <div class="card border-0 shadow">
                                    <div class="card-header text-center">
                                        <h6 class="text-dark font-weight-bold">Input FAQ</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <textarea name="question" class="form-control" cols="30" rows="5" placeholder="Question"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="answer" class="form-control" cols="30" rows="5" placeholder="Answer"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <select name="is_active" class="form-control" required>
                                                    <option value="1">Active</option>
                                                    <option value="2">Not Active</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="add-faq" <?= $style_btn?> class="btn btn-sm">Apply</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 mt-3">
                                <div class="card border-0 shadow">
                                    <h6 class="text-dark font-weight-bold m-3 mb-n2">Data FAQ</h6>
                                    <?php if(mysqli_num_rows($faq)==0){?>
                                    <div class="card-body text-center">
                                        <p class="text-dark font-weight-bold">Maaf data saat ini kosong!</p>
                                    </div>
                                    <?php }else if(mysqli_num_rows($faq)>0){while($row=mysqli_fetch_assoc($faq)){?>
                                    <div class="card-body mb-n4">
                                        <div class="d-flex">
                                            <blockquote class="blockquote">
                                                <p class="small text-dark mb-n1">Question: <?= $row['question']?></p>
                                                <p class="small text-dark">Answer: <?= $row['answer']?></p>
                                                <footer class="blockquote-footer small text-dark"><?= $row['date_time']?> <cite title="Source Title"><?php if($row['is_active']==1){echo "Active";}else if($row['is_active']==2){echo "Not Active";}?></cite></footer>
                                            </blockquote>
                                            <form action="" method="POST">
                                                <input type="hidden" name="id-faq" value="<?= $row['id_faq']?>">
                                                <button class="btn btn-warning btn-sm" type="button" data-toggle="collapse" data-target="#collapse<?= $row['id_faq']?>" aria-expanded="false" aria-controls="collapse<?= $row['id_faq']?>"><i class="fas fa-pen"></i></button>
                                                <button type="submit" name="del-faq" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                        <div class="collapse" id="collapse<?= $row['id_faq']?>">
                                            <div class="card card-body">
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id-faq" value="<?= $row['id_faq']?>">
                                                    <div class="form-group">
                                                        <textarea name="question" class="form-control" cols="30" rows="5" placeholder="Question"><?= $row['question']?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="answer" class="form-control" cols="30" rows="5" placeholder="Answer"><?= $row['answer']?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="is_active" class="form-control" required>
                                                            <option value="1">Active</option>
                                                            <option value="2">Not Active</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="edit-faq" class="btn btn-warning btn-sm">Apply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><hr>
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