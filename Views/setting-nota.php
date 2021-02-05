<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="- Setting Nota";
?>

<!-- == Setting Nota page == -->
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php require_once("../Application/access/header.php"); ?>
        <script type="text/javascript">
            var otomatis = setInterval(function (){
                $('#timestamp').load('../Application/controller/ajax_timestamp.php').fadeIn("slow");
            }, 1000);
        </script>
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
                                <h1 class="h3 mb-0" <?= $color_black ?>>Setting Nota</h1>
                            </div>
                        <!-- == Content Info == -->
                            <div class="row">
                                <!-- == alert message == -->
                                    <div class="col-md-12">
                                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    </div>
                                <!-- == insert data == -->
                                    <div class="col-lg-4 mt-3">
                                        <div class="card shadow border-0 mb-3">
                                            <div class="card-body text-center text-dark">
                                                <h3 id="timestamp"><?php require_once("../Application/controller/ajax_timestamp.php")?></h3>
                                                <p>Waktu Indonesia Tengah</p>
                                            </div>
                                        </div>
                                        <div class="card shadow border-0 mb-3">
                                            <div class="card-body text-center">
                                                <button class="btn btn-sm shadow" <?= $style_btn?> type="button" data-toggle="collapse" data-target="#collapseAdding-no-nota" aria-expanded="false" aria-controls="collapseAdding-no-nota">
                                                    Insert No. Nota
                                                </button>
                                                <div class="row d-flex mt-4">
                                                    <?php foreach($setting_nota_view as $row1):?>
                                                    <div class="col-lg-4 text-dark text-align-center pt-2">
                                                        <h6 class="font-weight-bold"><?= $row1['name']?></h6>
                                                        <p><?= $row1['no_nota']?></p>
                                                    </div>
                                                    <?php endforeach;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseAdding-no-nota">
                                            <div class="card card-body shadow border-0 text-center">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="number" name="no-nota" class="form-control" placeholder="Number">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="add-no-nota" class="btn btn-sm" <?= $style_btn?>>Apply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <!-- == data settings == -->
                                    <div class="col-lg-8 mt-3">
                                        <div class="card shadow border-0">
                                            <div class="card-body">
                                                <style>#scroll-x{overflow-x: auto}</style>
                                                <div class="col-md-12 m-0 p-0" id="scroll-x">
                                                    <table class="table table-borderless text-center text-dark mt-3">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Number Nota</th>
                                                                <th scope="col">Date</th>
                                                                <th colspan="2">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(mysqli_num_rows($setting_nota_data)==0){?>
                                                            <tr><td colspan="5" class="text-dark font-weight-bold">Maaf data saat ini kosong!</td></tr>
                                                            <?php }else if(mysqli_num_rows($setting_nota_data)>0){while($row2=mysqli_fetch_assoc($setting_nota_data)){?>
                                                            <tr>
                                                                <td><?= $row2['name']?></td>
                                                                <td><?= $row2['no_nota']?></td>
                                                                <td><?= $row2['date']?></td>
                                                                <td>
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="collapse" data-target="#collapse<?= $row2['id_nota']?>" aria-expanded="false" aria-controls="collapse<?= $row2['id_nota']?>"><i class="fas fa-pen"></i> Edit</button>
                                                                </td>
                                                                <td><form action="" method="POST">
                                                                    <input type="hidden" name="id-nota" value="<?= $row2['id_nota']?>">
                                                                    <button type="submit" name="del-no-nota" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                                                </form></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div class="collapse" id="collapse<?= $row2['id_nota']?>">
                                                                        <div class="card card-body shadow border-0">
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-nota" value="<?= $row2['id_nota']?>">
                                                                                <div class="form-group">
                                                                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input type="number" name="no-nota" class="form-control" placeholder="Number" value="<?= $row2['no_nota']?>">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <button type="submit" name="edit-no-nota" class="btn btn-warning btn-sm">Apply</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php }}?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>