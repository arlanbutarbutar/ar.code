<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
    if(!isset($_SESSION['id-nota-tinggal'])){
        header("Location: nota-tinggal");
        exit;
    }else if(isset($_SESSION['id-nota-tinggal'])){
        $id_nota_tinggal=addslashes(trim($_SESSION['id-nota-tinggal']));
        $nota_tinggal_take=mysqli_query($conn, "SELECT * FROM nota_tinggal 
            JOIN users_local ON nota_tinggal.id_user=users_local.id_user 
            JOIN services_product ON nota_tinggal.id_layanan=services_product.id_product 
            JOIN employee ON nota_tinggal.id_pegawai=employee.id_employee 
            WHERE id_nota_tinggal='$id_nota_tinggal'
        ");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Take Paid Off | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Take Paid Off From Bill</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12">
                                <div class="row flex-row-reverse">

                                    <div class="col-lg-4">
                                        <div class="card border-0 shadow text-center">
                                            <div class="card-body">
                                                <?php foreach($nota_tinggal_take as $row):?>
                                                <h5 class="text-dark font-weight-bold">Detail Nota</h5>
                                                <p class="text-dark font-weight-lighter mb-n4"><i class="fas fa-user"></i> Users</p>
                                                <table class="table table-borderless table-responsive mt-3">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Nama</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">No Telepon</th>
                                                            <th scope="col">Alamat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?= $row['username']?></td>
                                                            <td><?= $row['email_user']?></td>
                                                            <td><?= $row['tlpn_user']?></td>
                                                            <td><?= $row['alamat_user']?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p class="text-dark font-weight-lighter mb-n3"><i class="fas fa-tools"></i> Repair</p>
                                                <table class="table table-borderless table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Tgl Masuk</th>
                                                            <th scope="col">Layanan</th>
                                                            <th scope="col">Kerusakan</th>
                                                            <th scope="col">Kondisi</th>
                                                            <th scope="col">Kelengkapan</th>
                                                            <th scope="col">Teknisi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?= $row['tgl_masuk']?></td>
                                                            <td><?= $row['product']?></td>
                                                            <td><?= $row['kerusakan']?></td>
                                                            <td><?= $row['kondisi']?></td>
                                                            <td><?= $row['kelengkapan']?></td>
                                                            <td><?= $row['first_name']?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <?php endforeach;?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="card border-0 shadow">
                                            <div class="card-body">
                                                <div class="col-8 m-auto">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <?php 
                                                            $nota_ln_auto=mysqli_query($conn, "SELECT * FROM autorisasi_nomor_nota WHERE id_auto='3'");$row_ln=mysqli_fetch_assoc($nota_ln_auto);
                                                            $id_status=$row_ln['id_status'];if($id_status==1){
                                                                $cek_id_nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas ORDER BY id_nota_lunas DESC LIMIT 1");
                                                                $loop_id_nota_lunas=mysqli_fetch_assoc($cek_id_nota_lunas);
                                                                if(isset($loop_id_nota_lunas['id_nota_lunas'])){
                                                                    $idnota_lunas=$loop_id_nota_lunas['id_nota_lunas'];
                                                                    $id_nota_lunas=$idnota_lunas+1;
                                                                }else if(!isset($loop_id_nota_lunas['id_nota_lunas'])){
                                                                    $id_nota_lunas=202027;
                                                                }
                                                        ?>
                                                        <div class="form-group mt-4">
                                                            <input type="number" placeholder="Nota Lunas?" value="<?= $id_nota_lunas;?>" class="form-control text-center" disabled>
                                                        </div>
                                                        <?php }else if($id_status==2){?>
                                                        <div class="form-group mt-4">
                                                            <small class="text-danger">Wajib*</small>
                                                            <input type="number" name="id-nota-lunas" placeholder="Nota Lunas?" class="form-control text-center" required>
                                                        </div>
                                                        <?php }?>
                                                        <div class="form-group">
                                                            <small class="text-danger">Wajib*</small>
                                                            <input type="text" name="garansi" placeholder="Garansi" class="form-control text-center" value="1 Minggu" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <small class="text-danger">Jika ada keterangan isikan.</small>
                                                            <textarea name="ket-text" cols="30" rows="5" placeholder="Keterangan" class="form-control text-center" style="resize: none"></textarea>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <small class="text-danger">Jika ambil barang tanpa nota maka masukan tanda bukti lain seperti KTP/Tanda Pengenal lainnya.</small>
                                                            <div class="custom-file">
                                                                <input type="file" name="ket-img" class="custom-file-input" id="ket-img" aria-describedby="inputGroupFileAddon03">
                                                                <label class="custom-file-label text-center" for="ket-img">Pilih Gambar</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4 text-center">
                                                            <a href="nota-tinggal" class="btn btn-secondary btn-sm">Cancel</a>
                                                            <input type="hidden" class="form-control text-center" name="id-nota-tinggal" value="<?= $_SESSION['id-nota-tinggal']?>">
                                                            <button type="submit" name="apply-take" class="btn btn-success btn-sm">Apply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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