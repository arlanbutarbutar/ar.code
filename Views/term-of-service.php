<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-users.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="- Term of Service";
?>

<!-- == Term of Service page == -->
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
                                <h1 class="h3 mb-0" <?= $color_black ?>>Term of Service</h1>
                            </div>
                        <!-- == Content Info == -->
                            <div class="row flex-row-reverse">
                                <!-- == alert message == -->
                                    <div class="col-md-12">
                                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    </div>
                                <!-- == data privacy policy == -->
                                    <?php if(mysqli_num_rows($term_of_service)==0){?>
                                        <div class="col-lg-4 mt-3">
                                            <div class="card card-body shadow border-0 text-center">
                                                <h4 class="font-weight-bold" <?= $color_black?>>Insert Term of Service</h4>
                                                <p class="small" <?= $color_black?>>Masukan persyaratan layanan untuk pengguna sebagai pemakai layanan UGD HP.</p>
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <textarea name="term-of-service" cols="30" rows="5" placeholder="Masukan persyaratan layanan" class="form-control" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="submit-term" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 mt-3 mb-5">
                                            <div class="card card-body shadow border-0">
                                                <table class="table table-sm text-center" <?= $color_black?>>
                                                    <thead>
                                                        <tr style="border-top:hidden">
                                                            <th scope="col">Term of Service</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th colspan="1">Belum ada persyaratan layanan</th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php }else if(mysqli_num_rows($term_of_service)>0){while($row=mysqli_fetch_assoc($term_of_service)){?>
                                        <div class="col-lg-12 mt-3 mb-5">
                                            <div class="card card-body shadow border-0">
                                                <table class="table table-sm text-center" <?= $color_black?>>
                                                    <thead>
                                                        <tr style="border-top:hidden">
                                                            <th scope="col">Term of Service</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><form action="" method="POST">
                                                                <input type="hidden" name="id-term" value="<?= $row['id_term']?>">
                                                                <div class="form-group">
                                                                    <textarea name="term-of-service" cols="30" rows="10" class="form-control"><?= $row['term_of_service']?></textarea>
                                                                </div>
                                                                <div class="row justify-content-center">
                                                                    <div class="form-group">
                                                                        <button type="submit" name="edit-term" class="btn btn-warning btn-sm shadow"><i class="fas fa-pen"></i> Ubah</button>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" name="delete-term" class="btn btn-danger btn-sm shadow ml-3"><i class="fas fa-trash"></i> Hapus</button>
                                                                    </div>
                                                                </div>
                                                            </form></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php }}?>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>