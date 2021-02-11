<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="Setting Nota";
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
                                <h1 class="h3 mb-0" <?= $color_black ?>><?= $_SESSION['page-name']?></h1>
                            </div>
                        <!-- == Content Info == -->
                            <div class="row">
                                <!-- == alert message == -->
                                    <div class="col-md-12">
                                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    </div>
                                <!-- == insert data == -->
                                    <div class="col-lg-4 mt-3">
                                        <!-- == card time == -->
                                            <div class="card shadow border-0 mb-3">
                                                <div class="card-body text-center text-dark">
                                                    <h3 id="timestamp"><?php require_once("../Application/controller/ajax_timestamp.php")?></h3>
                                                    <p>Waktu Indonesia Tengah</p>
                                                </div>
                                            </div>
                                        <!-- card insert data -->
                                            <div class="card shadow border-0 mb-3">
                                                <div class="card-body text-center">
                                                    <button class="btn btn-sm shadow" <?= $color_black?> type="button" data-toggle="collapse" data-target="#collapseAdding-no-nota" aria-expanded="false" aria-controls="collapseAdding-no-nota">Insert Notes Type</button>
                                                    <p class="small" <?= $color_black?>>Masukan tipe nota jika ingin ditambahakan.</p>
                                                </div>
                                            </div>
                                        <!-- collapse insert data -->
                                            <div class="collapse" id="collapseAdding-no-nota">
                                                <div class="card card-body shadow border-0 text-center mb-5">
                                                    <form action="" method="POST">
                                                        <div class="form-group">
                                                            <input type="text" name="name" class="form-control text-center" placeholder="Nama" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="number" name="no-nota" class="form-control text-center" placeholder="Nomor nota" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="kombinasi" class="form-control text-center" placeholder="Kombinasi">
                                                            <small class="text-info small">Memasukan karakter kombinasi hanya jika diperlukan!</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" name="submit-notes-type" class="btn btn-sm shadow" <?= $bg_black?>>Apply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                <!-- == data settings == -->
                                    <div class="col-lg-8">
                                        <div class="card shadow border-0 mb-5 mt-3" style="overflow-x: auto">
                                            <div class="card-body">
                                                <table class="table table-sm text-center" <?= $color_black?>>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Nama</th>
                                                            <th scope="col">Monor Nota</th>
                                                            <th scope="col">Kombinasi</th>
                                                            <th scope="col">Tgl Buat</th>
                                                            <th colspan="2">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no=1; if(mysqli_num_rows($notes_type)==0){?>
                                                            <tr><td colspan="5" class="text-dark font-weight-bold">Maaf data saat ini kosong!</td></tr>
                                                        <?php }else if(mysqli_num_rows($notes_type)>0){while($row=mysqli_fetch_assoc($notes_type)){?>
                                                            <tr>
                                                                <td><?= $no?></td>
                                                                <td><?= $row['name']?></td>
                                                                <td><?= $row['no_nota']?></td>
                                                                <td><?= $row['kombinasi']?></td>
                                                                <td><?= $row['date']?></td>
                                                                <td scope="row">
                                                                    <div class="dropdown no-arrow">
                                                                        <button class="btn btn-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-pen"></i> Ubah</button>
                                                                        <?php if($_SESSION['id-access']==1){?>
                                                                        <div class="dropdown-menu p-2 border-0 shadow text-center" aria-labelledby="dropdownMenuButton">
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-nota" value="<?= $row['id_nota']?>">
                                                                                <input type="hidden" name="name" value="<?= $row['name']?>">
                                                                                <div class="form-group">
                                                                                    <input type="number" name="no-nota" class="form-control text-center" placeholder="Nomor nota" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="kombinasi" class="form-control text-center" placeholder="Kombinasi">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <button type="submit" name="edit-notes-type" class="btn btn-sm shadow" <?= $bg_black?>>Apply</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <?php }?>
                                                                    </div>
                                                                </td>
                                                                <td><form action="" method="POST">
                                                                    <input type="hidden" name="id-nota" value="<?= $row['id_nota']?>">
                                                                    <input type="hidden" name="name" value="<?= $row['name']?>">
                                                                    <button type="submit" name="delete-notes-type" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                                                </form></td>
                                                            </tr>
                                                        <?php $no++; }}?>
                                                    </tbody>
                                                </table>
                                                <nav class="small" aria-label="Page navigation example">
                                                    <ul class="pagination justify-content-center">
                                                        <?php if(isset($page6)){if(isset($total_page6)){if($page6>1):?>
                                                        <li class="page-item shadow">
                                                            <a class="page-link border-0" <?= $bg_black?> href="setting-nota?page=<?= $page6-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                        </li>
                                                        <?php endif;?>
                                                        <?php for($i=1; $i<=$total_page6; $i++):?>
                                                            <?php if($i<=5):?>
                                                                <?php if($i==$page6):?>
                                                                    <li class="page-item shadow"><a class="page-link font-weight-bold border-0" <?= $bg_black?> href="setting-nota?page=<?= $i;?>"><?= $i;?></a></li>
                                                                <?php else :?>
                                                                    <li class="page-item shadow"><a class="page-link border-0" href="setting-nota?page=<?= $i;?>"><?= $i;?></a></li>
                                                                <?php endif;?>
                                                            <?php endif;?>
                                                        <?php endfor;?>
                                                        <?php if($page6<$total_page6):?>
                                                        <li class="page-item shadow">
                                                            <a class="page-link border-0" <?= $bg_black?> href="setting-nota?page=<?= $page6+1;?>">Next</a>
                                                        </li>
                                                        <?php endif;}}?>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>