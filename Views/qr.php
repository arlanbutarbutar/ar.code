<?php if(!isset($_SESSION)){session_start();}
    if(!isset($_GET['auth']) || empty($_GET['auth'])){
        if($_SESSION['page-name']=="Dashboard"){
            header("Location: dashboard");exit;
        }else if($_SESSION['page-name']=="Nota Tinggal"){
            header("Location: nota-tinggal");exit;
        }else if($_SESSION['page-name']=="Nota Lunas"){
            header("Location: nota-lunas");exit;
        }else if($_SESSION['page-name']=="Nota Batal"){
            header("Location: nota-cancel");exit;
        }
    }
    require_once("../Application/session/redirect-user.php");
    require_once("../Application/session/redirect-access-visitor.php");
    require_once("../Application/controller/script.php");
    $_SESSION['page-name']="QR";
    if(isset($_GET['auth'])){
        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['auth']))));
        $notes_qr=mysqli_query($conn, "SELECT * FROM notes
            JOIN users ON notes.id_user=users.id_user 
            JOIN category_services ON notes.id_layanan=category_services.id_category
            JOIN notes_status ON notes.id_status=notes_status.id_status 
            WHERE notes.id_user='$id_user'
        ");
    }
?>

<!-- == qr page == -->
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
                                <h1 class="h3 mb-0" <?= $color_black ?>><?= $_SESSION['page-name']?></h1>
                            </div>
                        <!-- == Content Info == -->
                            <div class="row mb-5">
                                <!-- == alert message == -->
                                    <div class="col-md-12">
                                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    </div>
                                <!-- == data QR == -->
                                    <?php if(mysqli_num_rows($notes_qr)==0){?>
                                        <div class="col-lg-12">
                                            <div class="card card-body border-0 shadow text-center mt-3">
                                                <p class="text-danger font-weight-bold">Terjadi kesalahan, silakan coba lagi!</p>
                                            </div>
                                        </div>
                                    <?php }else if(mysqli_num_rows($notes_qr)>0){while($row=mysqli_fetch_assoc($notes_qr)){?>
                                        <div class="col-lg-4">
                                            <div class="card card-body border-0 shadow h-100 align-items-center text-center mt-3">
                                                <h4 class="font-weight-bold" <?= $color_black ?>><?= "T".$row['id_nota_tinggal']." | DP".$row['id_nota_dp']." | L".$row['id_nota_lunas']?></h4>
                                                <img src="../Assets/img/img-barcode-notes/<?= $row['barcode']?>" alt="barcode" style="width: 75%">
                                                <?php if($_SESSION['id-role']<=3){?>
                                                    <div class="d-flex justify-content-center mt-2">
                                                        <p class="small m-auto" <?= $color_black ?>>Buat ulang barcode!</p>
                                                        <form action="" method="POST">
                                                            <div class="form-group m-auto">
                                                                <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                <input type="hidden" name="barcode-old" value="<?= $row['barcode']?>">
                                                                <button type="submit" name="remake-barcode" class="btn btn-sm ml-2" <?= $bg_black ?>><i class="fas fa-undo"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card card-body border-0 shadow mt-3">
                                                <h6 class="font-weight-bold" <?= $color_black ?>>Rincian Perbaikan</h6>
                                                <p <?= $color_black ?>>
                                                    Perbaikan <?= $row['product']?> dengan kerusakan <?= $row['kerusakan']?> dan kondisi <?= $row['kondisi']?>. Kelengkapan dari <?= $row['product']?> <?php if(empty($row['kelengkapan']) || $row['kelengkapan']=='-'){echo 'tidak ada';}else{echo $row['kelengkapan'];}?>. Perbaikan dikerjakan oleh <?php $id_tek=$row['id_pegawai'];$teknisi=mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_tek'");$row_tek=mysqli_fetch_assoc($teknisi);echo $row_tek['first_name'];?>
                                                </p>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-lg-4">
                                                        <div class="h6 mb-0 mr-3 font-weight-bold" <?= $color_black ?>>Progress: 
                                                            <?php $id_barang=$row['id_barang']; if($row['id_layanan']==1){
                                                                $handphone=mysqli_query($conn, "SELECT * FROM handphone WHERE id_hp='$id_barang'");$row_hp=mysqli_fetch_assoc($handphone);echo $row_hp['type']." (".$row_hp['seri']." - ".$row_hp['imei'].")";
                                                            }if($row['id_layanan']==2){
                                                                $laptop=mysqli_query($conn, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");
                                                                $row_laptop=mysqli_fetch_assoc($laptop);
                                                                echo $row_laptop['merek']." (".$row_laptop['seri'].")";
                                                            }?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="progress mr-2">
                                                        <div class="progress-bar progress-bar-striped <?php if($row['progress']<100){echo "bg-warning";}else if($row['progress']==100){echo "bg-success";}?>" role="progressbar" style="width: <?= $row['progress']."%"?>" aria-valuenow="<?= $row['progress']?>" aria-valuemin="0" aria-valuemax="100"><?= $row['progress']."%"?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }}?>
                            </div>
                    </div>
                </div>
                <?php require_once("../Application/access/footer.php"); ?>
    </body>
</html>