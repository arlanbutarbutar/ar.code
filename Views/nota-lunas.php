<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Nota Lunas | <?= $_SESSION['name-web']?></title>
        <script type="text/javascript">
            var otomatis = setInterval(function (){
                $('.container-automation').load('../utilities/nota-automation.php').fadeIn("slow");
            }, 1000);
        </script>
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
                            <h1 class="h2 mb-0 text-gray-800">Nota Lunas</h1>
                            <!-- <div class="container-automation d-flex"><?php require_once("../utilities/nota-automation.php")?></div> -->
                        </div>
                        <div class="row">
                            <?php require_once("../utilities/info.php")?>
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12">
                                <div class="accordion" id="accordionExample">
                                    <div class="card border-0 shadow mb-3 rounded">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0 text-center">
                                                <button class="btn btn-link text-decoration-none text-dark font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseInsert-lunas" aria-expanded="true" aria-controls="collapseInsert-lunas">
                                                    Insert Data Nota Lunas
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseInsert-lunas" class="collapse <?php if(isset($_SESSION['show'])){if($_SESSION['show']==1){echo 'show';}}?>" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <input type="number" name="id-nota-lunas" class="form-control" placeholder="Nomor Nota lunas" value="<?php if(isset($_SESSION['id-nota-lunas'])){echo $_SESSION['id-nota-lunas'];}?>" required>
                                                        <small class="text-danger">Wajib*</small>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <input type="text" name="username" class="form-control" placeholder="Username" value="<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}?>" required>
                                                        <small class="text-danger">Wajib*</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="email" class="form-control" placeholder="Email" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="number" name="tlpn" class="form-control" placeholder="Telepon" value="<?php if(isset($_SESSION['tlpn'])){echo $_SESSION['tlpn'];}?>" required>
                                                        <small class="text-danger">Wajib*</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?php if(isset($_SESSION['alamat'])){echo $_SESSION['alamat'];}?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="id-layanan" class="form-control" required>
                                                            <option>Pilih Layanan</option>
                                                            <option value="1">Handphone</option>
                                                            <option value="2">Laptop</option>
                                                        </select>
                                                        <small class="text-danger">Wajib*</small>
                                                    </div>
                                                    <h6 class="text-dark font-weight-bold"><span class="badge badge-warning">Perhatian!!</span> Mengisi sesuai dengan layanan yg dipilih!</h6>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h6 class="text-dark font-weight-bold">Handphone</h6>
                                                            <div class="form-group">
                                                                <input type="text" name="type" class="form-control" placeholder="Type" value="<?php if(isset($_SESSION['type'])){echo $_SESSION['type'];}?>">
                                                                <small class="text-danger">Wajib*</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="seri-hp" class="form-control" placeholder="Seri" value="<?php if(isset($_SESSION['seri-hp'])){echo $_SESSION['seri-hp'];}?>">
                                                                <small class="text-danger">Wajib*</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="imei" class="form-control" placeholder="Imei" value="<?php if(isset($_SESSION['imei'])){echo $_SESSION['imei'];}?>">
                                                                <small class="text-danger">Wajib jika ada*</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h6 class="text-dark font-weight-bold">Laptop</h6>
                                                            <div class="form-group">
                                                                <input type="text" name="merek" class="form-control" placeholder="Merek" value="<?php if(isset($_SESSION['merek'])){echo $_SESSION['merek'];}?>">
                                                                <small class="text-danger">Wajib*</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="seri-laptop" class="form-control" placeholder="Seri" value="<?php if(isset($_SESSION['seri-laptop'])){echo $_SESSION['seri-laptop'];}?>">
                                                                <small class="text-danger">Wajib*</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="kerusakan" class="form-control" placeholder="Kerusakan" value="<?php if(isset($_SESSION['kerusakan'])){echo $_SESSION['kerusakan'];}?>" required>
                                                        <small class="text-danger">Wajib*</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="id-teknisi" class="form-control" required>
                                                            <option>Pilih Teknisi</option>
                                                            <?php foreach($technicians_data as $row_tech):?>
                                                            <option value="<?= $row_tech['id_employee']?>"><?= $row_tech['first_name']?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                        <small class="text-danger">Wajib*</small>
                                                    </div>
                                                    <div class="col-md-12 d-sm-flex justify-content-start flex-row-reverse m-0 p-0">
                                                        <div class="col-lg-8 mt-4">
                                                            <div class="form-group mt-3">
                                                                <h6 class="text-dark font-weight-bold">Pengisian tanggal ambil, Hanya jika Client memutuskan saja!</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 m-0 p-0">
                                                            <div class="form-group">
                                                                <label for="tgl-ambil" class="text-dark font-weight-bold">Tanggal Ambil</label>
                                                                <input type="date" name="tgl-ambil" value="<?php if(isset($_SESSION['tgl-ambil'])){echo $_SESSION['tgl-ambil'];}?>" id="tgl-ambil" class="form-control" placeholder="Tanggal Ambil">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="number" name="pemasukan" class="form-control" placeholder="Biaya" value="<?php if(isset($_SESSION['pemasukan'])){echo $_SESSION['pemasukan'];}?>" required>
                                                        <small class="text-danger">Wajib jika ada*</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="garansi" placeholder="Garansi" class="form-control text-center" value="<?php if(isset($_SESSION['garansi'])){echo $_SESSION['garansi'];}?>" required>
                                                        <small class="text-danger">Wajib*</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="ket-text" cols="30" rows="5" placeholder="Keterangan" class="form-control text-center" style="resize: none"></textarea>
                                                        <small class="text-danger">Jika ada keterangan isikan.</small>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="custom-file">
                                                            <input type="file" name="ket-img" class="custom-file-input" id="ket-img" aria-describedby="inputGroupFileAddon03">
                                                            <label class="custom-file-label text-center" for="ket-img">Pilih Gambar</label>
                                                        </div>
                                                        <small class="text-danger ml-3 mt-2">Jika ambil barang tanpa nota maka masukan tanda bukti lain seperti KTP/Tanda Pengenal lainnya.</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="add-nota-lunas" class="btn btn-success btn-sm">Lunas</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card border-0 shadow">
                                    <div class="card-body">

                                        <div class="col-md-12 p-3 d-sm-flex align-items-center justify-content-start" id="scroll-x">

                                            <div class="col-md-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search No Nota lunas" aria-label="Search" aria-describedby="basic-addon2" id="keyword-nota-lunas">
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control bg-light border-0 small" placeholder="Search Date" aria-label="Search" aria-describedby="basic-addon2" name="keyword-tgl-nota-lunas">
                                                        <div class="input-group-append">
                                                            <button class="btn" <?= $style_btn?> type="submit" name="search-tgl-nota-lunas">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-3">
                                                <form action="" method="POST">
                                                    <div class="input-group">
                                                        <select name="keyword-teknisi-nota-lunas" class="form-control">
                                                            <option>Pilih Teknisi</option>
                                                            <?php foreach($technicians_data as $tek):?>
                                                            <option value="<?= $tek['id_employee']?>"><?= $tek['first_name']?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button class="btn" <?= $style_btn?> type="submit" name="search-teknisi-nota-lunas">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-dark font-weight-bold">Nota Lunas</h6>
                                            <nav class="small" aria-label="Page navigation example">
                                                <ul class="pagination justify-content-end">
                                                    <?php if(isset($page4)){if(isset($total_page4)){if($page4>1):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="nota-lunas?page=<?= $page4-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <?php endif;?>
                                                    <?php for($i=1; $i<=$total_page4; $i++):?>
                                                        <?php if($i<=5):?>
                                                            <?php if($i==$page4):?>
                                                                <li class="page-item"><a class="page-link font-weight-bold" href="nota-lunas?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php else :?>
                                                                <li class="page-item"><a class="page-link" href="nota-lunas?page=<?= $i;?>"><?= $i;?></a></li>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                    <?php if($page4<$total_page4):?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="nota-lunas?page=<?= $page4+1;?>">Next</a>
                                                    </li>
                                                    <?php endif;}}?>
                                                </ul>
                                            </nav>
                                        </div>

                                        <div class="table-responsive" id="container-nota-lunas">
                                            <table class="table table-borderless text-dark text-center table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col"><i class="fas fa-user-tie"></i> Client Service</th>
                                                        <th scope="col">#Nota Lunas</th>
                                                        <th scope="col">#Nota Tinggal</th>
                                                        <th scope="col">#Nota DP</th>
                                                        <th colspan="3">Aksi</th>
                                                        <th scope="col">Tgl Masuk</th>
                                                        <th scope="col">Waktu</th>
                                                        <th scope="col">User</th>
                                                        <th scope="col">Layanan</th>
                                                        <th scope="col">Kerusakan</th>
                                                        <th scope="col">Teknisi</th>
                                                        <th scope="col">DP</th>
                                                        <th scope="col">Biaya</th>
                                                        <th scope="col">Pemasukan</th>
                                                        <th scope="col">Garansi</th>
                                                        <th scope="col">Ket Text</th>
                                                        <th scope="col">Ket Image</th>
                                                    </tr> 
                                                </thead>
                                                <tbody>
                                                    <?php $no=1;if(mysqli_num_rows($nota_lunas)==0){?>
                                                    <tr>
                                                        <th colspan="19">Maaf data saat ini kosong!</th>
                                                    </tr>
                                                    <?php }else if(mysqli_num_rows($nota_lunas)>0){while($row=mysqli_fetch_assoc($nota_lunas)){$lapor=$row['lapor'];?>
                                                    <tr class="<?php if($lapor==2){echo "bg-danger text-white";}?>">
                                                        <th scope="row"><?= $no;?></th>
                                                        <th><?php if($lapor==0 || $lapor==2){?>
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="id-nota-lunas" value="<?= $row['id_nota_lunas']?>">
                                                            <button type="submit" name="report-lunas" class="btn btn-light btn-sm shadow font-weight-bold">Report</button>
                                                        </form>
                                                        <?php }else if($lapor==1){?>
                                                        <p class="btn btn-success btn-sm"><i class="fas fa-check-double"></i></p>
                                                        <?php }?></th>
                                                        <th><?= $row['id_nota_lunas']?></th>
                                                        <th><?= $row['id_nota_tinggal']?></th>
                                                        <th><?= $row['id_nota_dp']?></th>
                                                        <?php if($row['id_nota_tinggal']==0){?>
                                                            <td><?php if($lapor==0 || $lapor==2){?>
                                                                <a class="btn btn-warning btn-sm" data-toggle="collapse" href="#collapseEdit-<?= $row['id_nota_lunas']?>" role="button" aria-expanded="false" aria-controls="collapseEdit-<?= $row['id_nota_lunas']?>"><i class="fas fa-pen"></i></a>
                                                            <?php }else if($lapor==1){?>
                                                                <p class="btn btn-secondary btn-sm"><i class="fas fa-pen"></i></p>
                                                            <?php }?></td>
                                                        <?php }else if($row['id_nota_tinggal']>0){?>
                                                        <td><p class="btn btn-secondary btn-sm"><i class="fas fa-pen"></i></p></td>
                                                        <?php }?>
                                                        <td><?php if($lapor==0 || $lapor==2){?>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id-nota-lunas" value="<?= $row['id_nota_lunas']?>">
                                                                <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                <input type="hidden" name="id-barang" value="<?= $row['id_barang']?>">
                                                                <input type="hidden" name="id-layanan" value="<?= $row['id_layanan']?>">
                                                                <input type="hidden" name="ket-img" value="<?= $row['ket_img']?>">
                                                                <input type="hidden" name="barcode" value="<?= $row['barcode']?>">
                                                                <button type="submit" name="delete-nota-lunas" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                            </form>
                                                        <?php }else if($lapor==1){?>
                                                            <p class="btn btn-secondary btn-sm"><i class="fas fa-trash"></i></p>
                                                        <?php }?></td>
                                                        <td><a href="<?= $link_barcode.$row['id_user']?>" class="btn btn-sm" <?= $style_btn?>><i class="fas fa-qrcode"></i></a></td>
                                                        <td><?= $row['tgl_masuk']?></td>
                                                        <td><?= $row['time']?></td>
                                                        <td><a class="btn btn-sm" <?= $style_btn?> data-toggle="collapse" href="#collapseUser-<?= $row['id_nota_lunas']?>" role="button" aria-expanded="false" aria-controls="collapseUser-<?= $row['id_nota_lunas']?>"><i class="fas fa-eye"></i> <?= $row['username']?></a></td>
                                                        <td><a class="btn btn-sm" <?= $style_btn?> data-toggle="collapse" href="#collapseLayanan-<?= $row['id_nota_lunas']?>" role="button" aria-expanded="false" aria-controls="collapseLayanan-<?= $row['id_nota_lunas']?>"><i class="fas fa-eye"></i> <?php $id_layanan=$row['id_layanan'];if($id_layanan==1){echo "Handphone";}else if($id_layanan==2){echo "Laptop";}?></a></td>
                                                        <td><?= $row['kerusakan']?></td>
                                                        <td><?= $row['first_name']?></td>
                                                        <td>Rp. <?= number_format($row['dp'])?></td>
                                                        <td>Rp. <?= number_format($row['biaya'])?></td>
                                                        <td>Rp. <?= number_format($row['pemasukan'])?></td>
                                                        <td><?= $row['garansi']?></td>
                                                        <td><?php if(!empty($row['ket_text'])){echo $row['ket_text'];}else{echo "-";}?></td>
                                                        <td><?php if(!empty($row['ket_img'])){?>
                                                            <a href="checkup-lunas?id-lunas=<?= $row['id_nota_lunas']?>&akses=1" class="btn btn-sm" <?= $style_btn?>><i class="fas fa-eye"></i> View</a>
                                                            <?php }else{?><p class="text-dark">Bukti Nota</p></tr><?php }?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="10" class="border-0">

                                                            <div class="collapse mb-3" id="collapseEdit-<?= $row['id_nota_lunas']?>">
                                                                <div class="card card-body border-0 shadow">
                                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                                        <div class="form-group">
                                                                            <label for="nota-lunas">Nota Lunas</label>
                                                                            <input type="hidden" name="id-nota-lunas" value="<?= $row['id_nota_lunas']?>">
                                                                            <input type="text" name="nota-lunas" class="form-control text-center" id="nota-lunas" placeholder="Nomor Nota Lunas">
                                                                            <small class="text-danger">Hanya jika anda ingin merubahnya saja!</small>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="username">Username</label>
                                                                            <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                            <input type="text" name="username" class="form-control text-center" id="username" placeholder="Username" value="<?= $row['username']?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="email-user">Email</label>
                                                                            <input type="email" name="email-user" class="form-control text-center" id="email-user" placeholder="Email" value="<?= $row['email_user']?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tlpn-user">Telepon</label>
                                                                            <input type="number" name="tlpn-user" class="form-control text-center" id="tlpn-user" placeholder="Telepon" value="<?= $row['tlpn_user']?>" required>
                                                                            <small class="text-danger">Harus ada untuk dapat dihubungi!</small>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="alamat-user">Alamat</label>
                                                                            <input type="text" name="alamat-user" class="form-control text-center" id="alamat-user" placeholder="Alamat" value="<?= $row['alamat_user']?>">
                                                                        </div>
                                                                        <input type="hidden" name="id-layanan" value="<?= $row['id_layanan']?>">
                                                                        <input type="hidden" name="id-barang" value="<?= $row['id_barang']?>">
                                                                        <?php $id_layanan=$row['id_layanan'];$id_barang=$row['id_barang']; if($id_layanan==1){$handphone=mysqli_query($conn, "SELECT * FROM handphone WHERE id_hp='$id_barang'");$row_hp=mysqli_fetch_assoc($handphone);?>
                                                                        <div class="form-group">
                                                                            <label for="type">Type</label>
                                                                            <input type="text" name="type" class="form-control text-center" id="type" placeholder="Type" value="<?= $row_hp['type']?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="seri">Seri</label>
                                                                            <input type="text" name="seri-hp" class="form-control text-center" id="seri" placeholder="Seri" value="<?= $row_hp['seri']?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="imei">Imei</label>
                                                                            <input type="text" name="imei" class="form-control text-center" id="imei" placeholder="Imei" value="<?= $row_hp['imei']?>" required>
                                                                        </div>
                                                                        <?php }else if($id_layanan==2){$laptop=mysqli_query($conn, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");$row_laptop=mysqli_fetch_assoc($laptop);?>
                                                                        <div class="form-group">
                                                                            <label for="merek">Merek</label>
                                                                            <input type="text" name="merek" class="form-control text-center" id="merek" placeholder="Merek" value="<?= $row_laptop['merek']?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="seri">Seri</label>
                                                                            <input type="text" name="seri-laptop" class="form-control text-center" id="seri" placeholder="Seri" value="<?= $row_laptop['seri']?>" required>
                                                                        </div>
                                                                        <?php }?>
                                                                        <div class="form-group">
                                                                            <label for="kerusakan">Kerusakan</label>
                                                                            <input type="text" name="kerusakan" class="form-control text-center" id="kerusakan" placeholder="Kerusakan" value="<?= $row['kerusakan']?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="teknisi">Teknisi</label>
                                                                            <select name="id-teknisi" id="teknisi" class="form-control text-center" required>
                                                                                <option>Pilih Teknisi</option>
                                                                                <?php foreach($technicians_data as $row_teknisi):?>
                                                                                <option value="<?= $row_teknisi['id_employee']?>"><?= $row_teknisi['first_name']?></option>
                                                                                <?php endforeach;?>
                                                                            </select>
                                                                        </div>
                                                                        <?php if($row['id_nota_dp']>0){?>
                                                                        <div class="form-group">
                                                                            <label for="dp">DP</label>
                                                                            <input type="text" name="dp" class="form-control text-center" id="dp" placeholder="DP" value="<?= $row['dp']?>">
                                                                        </div>
                                                                        <?php }?>
                                                                        <div class="form-group">
                                                                            <label for="biaya">Biaya</label>
                                                                            <input type="text" name="pemasukan" class="form-control text-center" id="biaya" placeholder="Biaya" value="<?= $row['pemasukan']?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="garansi">Garansi</label>
                                                                            <input type="text" name="garansi" class="form-control text-center" id="garansi" placeholder="Garansi" value="<?= $row['garansi']?>" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="ket-text">Keterangan Text</label>
                                                                            <input type="text" name="ket-text" class="form-control text-center" id="ket-text" placeholder="Keterangan Text">
                                                                        </div>
                                                                        <small class="text-danger">Jika ambil barang tanpa nota maka masukan tanda bukti lain seperti KTP/Tanda Pengenal lainnya.</small>
                                                                        <div class="input-group mb-3">
                                                                            <div class="custom-file">
                                                                                <input type="hidden" name="ket-img-old" value="<?= $row['ket_img']?>">
                                                                                <input type="file" name="ket-img" class="custom-file-input" id="ket-img" aria-describedby="inputGroupFileAddon03">
                                                                                <label class="custom-file-label text-center" for="ket-img">Pilih Gambar</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group text-center">
                                                                            <button type="submit" name="edit-nota-lunas" class="btn btn-warning btn-sm">Apply</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                            <div class="collapse mb-3" id="collapseUser-<?= $row['id_nota_lunas']?>">
                                                                <div class="card card-body text-dark border-0 shadow">
                                                                    <p>Username : <?= $row['username']?></p>
                                                                    <p>Email : <?php $em=$row['email_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                                                                    <p>Telepon : <?php $em=$row['tlpn_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                                                                    <p>Alamat : <?php $em=$row['alamat_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                                                                </div>
                                                            </div>

                                                            <div class="collapse" id="collapseLayanan-<?= $row['id_nota_lunas']?>">
                                                                <div class="card card-body text-dark border-0 shadow">
                                                                    <?php $id_layanan=$row['id_layanan'];$id_barang=$row['id_user'];if($id_layanan==1){$handphone=mysqli_query($conn, "SELECT * FROM handphone WHERE id_hp='$id_barang'");$row_hp=mysqli_fetch_assoc($handphone);?>
                                                                        <p>Type : <?= $row_hp['type']?></p>
                                                                        <p>Seri : <?= $row_hp['seri']?></p>
                                                                        <p>Imei : <?= $row_hp['imei']?></p>
                                                                    <?php }else if($id_layanan==2){$laptop=mysqli_query($conn, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");$row_laptop=mysqli_fetch_assoc($laptop);?>
                                                                        <p>Merek : <?= $row_laptop['merek']?></p>
                                                                        <p>Seri : <?= $row_laptop['seri']?></p>
                                                                    <?php }?>
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    <?php $no++;}}?>
                                                </tbody>
                                            </table>
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