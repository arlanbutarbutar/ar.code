<?php if(!isset($_SESSION)){session_start();}
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-users.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="- Menu";
?>

<!-- == Menu page == -->
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
                                <h1 class="h3 mb-0" <?= $color_black ?>>Menu</h1>
                            </div>
                        <!-- == Content Info == -->
                            <div class="row">
                                <!-- == alert message == -->
                                    <div class="col-md-12">
                                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    </div>
                                <!-- == data menu == -->
                                    <div class="col-md-12 m-0 p-0">
                                        <div class="row flex-row-reverse">
                                            <div class="col-lg-4 mt-3">
                                                <div class="card card-body shadow border-0 text-center">
                                                    <h4 class="font-weight-bold" <?= $color_black?>>Insert Menu</h4>
                                                    <p class="small" <?= $color_black?>>Tambahkan menu yang kamu mau sesuai kebutuhan.</p>
                                                    <form action="" method="POST">
                                                        <div class="form-group">
                                                            <input type="text" name="menu" placeholder="Nama Menu" class="form-control text-center" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" name="submit-menu" class="btn btn-sm" <?= $bg_black?>>Apply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 mt-3 mb-5">
                                                <div class="card card-body shadow border-0" style="overflow-x: auto">
                                                    <table class="table table-sm text-center" <?= $color_black?>>
                                                        <thead>
                                                            <tr style="border-top:hidden">
                                                                <th scope="col">#</th>
                                                                <th scope="col">Menu</th>
                                                                <th colspan="2">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no=1; if(mysqli_num_rows($menus)==0){?>
                                                                <tr>
                                                                    <th colspan="4">Belum ada menu</th>
                                                                </tr>
                                                            <?php }else if(mysqli_num_rows($menus)>0){while($row=mysqli_fetch_assoc($menus)){$_SESSION['id-menu']=$row['id_menu'];$menu_old=$row['menu'];?>
                                                                <tr>
                                                                    <th scope="row"><?= $no?></th>
                                                                    <td><?= $row['menu']?></td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-warning btn-sm shadow dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-pen"></i> Ubah
                                                                        </button>
                                                                        <div class="dropdown-menu p-2 border-0 shadow text-center">
                                                                            <form action="" method="POST">
                                                                                <input type="hidden" name="id-menu" value="<?= $row['id_menu']?>">
                                                                                <input type="hidden" name="menu-old" value="<?= $row['menu']?>">
                                                                                <div class='form-group'>
                                                                                    <input type="text" name="menu" value="<?= $row['menu']?>" placeholder="Ubah nama menu" class="form-control text-center" required>
                                                                                </div>
                                                                                <div class='form-group'>
                                                                                    <button type="submit" name="ubah-menu" class="btn btn-sm shadow" <?= $bg_black?>>Apply</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </td>
                                                                    <td><form action="" method="POST">
                                                                        <input type="hidden" name="id-menu" value="<?= $row['id_menu']?>">
                                                                        <input type="hidden" name="menu-old" value="<?= $row['menu']?>">
                                                                        <button type="submit" name="hapus-menu" class="btn btn-danger btn-sm shadow"><i class="fas fa-trash"></i> Hapus</button>
                                                                    </form></td>
                                                                </tr>
                                                            <?php $no++;}}?>
                                                        </tbody>
                                                    </table>
                                                    <nav class="small" aria-label="Page navigation example">
                                                        <ul class="pagination justify-content-center">
                                                            <?php if(isset($page1)){if(isset($total_page1)){if($page1>1):?>
                                                            <li class="page-item shadow">
                                                                <a class="page-link border-0" <?= $bg_black?> href="menu?page=<?= $page1-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                            </li>
                                                            <?php endif;?>
                                                            <?php for($i=1; $i<=$total_page1; $i++):?>
                                                                <?php if($i<=5):?>
                                                                    <?php if($i==$page1):?>
                                                                        <li class="page-item shadow"><a class="page-link font-weight-bold border-0" <?= $bg_black?> href="menu?page=<?= $i;?>"><?= $i;?></a></li>
                                                                    <?php else :?>
                                                                        <li class="page-item shadow"><a class="page-link border-0" href="menu?page=<?= $i;?>"><?= $i;?></a></li>
                                                                    <?php endif;?>
                                                                <?php endif;?>
                                                            <?php endfor;?>
                                                            <?php if($page1<$total_page1):?>
                                                            <li class="page-item shadow">
                                                                <a class="page-link border-0" <?= $bg_black?> href="menu?page=<?= $page1+1;?>">Next</a>
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
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>