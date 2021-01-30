<?php
    // require_once('../../controller/connect.php');
    require_once('../../controller/script.php');
    $keyword=addslashes(trim($_GET['keyword-nota-tinggal']));
    $query="SELECT * FROM nota_tinggal 
        JOIN users_local ON nota_tinggal.id_user=users_local.id_user
        JOIN employee ON nota_tinggal.id_pegawai=employee.id_employee
        JOIN services_status_ugdhp ON nota_tinggal.id_status=services_status_ugdhp.id_status
        WHERE nota_tinggal.id_nota_tinggal LIKE '%$keyword%'
        OR nota_tinggal.id_nota_dp LIKE '%$keyword%'
        OR users_local.username LIKE '%$keyword%'
        OR users_local.email_user LIKE '%$keyword%'
        OR users_local.tlpn_user LIKE '%$keyword%'
        OR users_local.alamat_user LIKE '%$keyword%'
        OR nota_tinggal.kerusakan LIKE '%$keyword%'
    ";
    $nota_tinggalOffline=mysqli_query($conn, $query);
    
?>
    <table class="table table-sm text-dark text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">#Nota Tinggal</th>
                <th scope="col">#Nota DP</th>
                <th colspan="4">Aksi</th>
                <th scope="col">Tgl Masuk</th>
                <th scope="col">Waktu</th>
                <th scope="col">User</th>
                <th scope="col">Layanan</th>
                <th scope="col">Kerusakan</th>
                <th scope="col">Kondisi</th>
                <th scope="col">Kelengkapan</th>
                <th scope="col">Teknisi</th>
                <th scope="col">Status</th>
                <th scope="col">Tgl Status</th>
                <th scope="col">Tgl Ambil</th>
                <th scope="col">DP</th>
                <th scope="col">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1;if(mysqli_num_rows($nota_tinggalOffline)==0){?>
            <tr>
                <th colspan="19">Maaf data saat ini kosong!</th>
            </tr>
            <?php }else if(mysqli_num_rows($nota_tinggalOffline)>0){while($row=mysqli_fetch_assoc($nota_tinggalOffline)){?>
            <tr>
                <th scope="row"><?= $no;?></th>
                <th><?= $row['id_nota_tinggal']?></th>
                <th><?= $row['id_nota_dp']?></th>
                <?php if($row['id_status']==5){?>
                <th><form action="" method="POST">
                    <input type="hidden" name="id-nota-tinggal" value="<?= $row['id_nota_tinggal']?>">
                    <button type="submit" name="take-lunas" class="btn btn-success btn-sm">Lunas</button>
                </form></th>
                <?php }else if($row['id_status']==1){?>
                <th><p class="btn btn-warning btn-sm"><i class="fas fa-hourglass-start"></i></p></th>
                <?php }else if($row['id_status']==3){?>
                <th><p class="btn btn-primary btn-sm"><i class="fas fa-hourglass-half"></i></p></th>
                <?php }else if($row['id_status']==4){?>
                <th><p class="btn btn-secondary btn-sm"><i class="fas fa-user-clock"></i></p></th>
                <?php }?>
                <td><a class="btn btn-warning btn-sm" data-toggle="collapse" href="#collapseEdit-<?= $row['id_nota_tinggal']?>" role="button" aria-expanded="false" aria-controls="collapseEdit-<?= $row['id_nota_tinggal']?>"><i class="fas fa-pen"></i></a></td>
                <td><form action="" method="POST">
                    <input type="hidden" name="id-nota-tinggal" value="<?= $row['id_nota_tinggal']?>">
                    <input type="hidden" name="id-layanan" value="<?= $row['id_layanan']?>">
                    <input type="hidden" name="barcode" value="<?= $row['barcode']?>">
                    <button type="submit" name="delete-nota" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                </form></td>
                <td><a href="<?= $link_barcode_NT.$row['id_nota_tinggal']?>" class="btn btn-sm" <?= $style_btn?>><i class="fas fa-qrcode"></i></a></td>
                <td><?= $row['tgl_masuk']?></td>
                <td><?= $row['time']?></td>
                <td><a class="btn btn-sm" <?= $style_btn?> data-toggle="collapse" href="#collapseUser-<?= $row['id_nota_tinggal']?>" role="button" aria-expanded="false" aria-controls="collapseUser-<?= $row['id_nota_tinggal']?>"><i class="fas fa-eye"></i> <?= $row['username']?></a></td>
                <td><a class="btn btn-sm" <?= $style_btn?> data-toggle="collapse" href="#collapseLayanan-<?= $row['id_nota_tinggal']?>" role="button" aria-expanded="false" aria-controls="collapseLayanan-<?= $row['id_nota_tinggal']?>"><i class="fas fa-eye"></i> <?php $id_layanan=$row['id_layanan'];if($id_layanan==1){echo "Handphone";}else if($id_layanan==2){echo "Laptop";}?></a></td>
                <td><?= $row['kerusakan']?></td>
                <td><?= $row['kondisi']?></td>
                <td><?php $kel=$row['kelengkapan'];if($kel="-" || ""){echo "Tidak ada.";}else{echo $kel;}?></td>
                <td><?= $row['first_name']?></td>
                <td>
                    <a class="btn btn-link btn-sm" data-toggle="collapse" href="#edit-status-<?= $row['id_nota_tinggal']?>" role="button" aria-expanded="false" aria-controls="edit-status-<?= $row['id_nota_tinggal']?>"><?= $row['status']?><i class="fas fa-caret-down"></i></a>
                </td>
                <td><?= $row['tgl_status']?></td>
                <td><?= $row['tgl_ambil']?></td>
                <td>Rp. <?= number_format($row['dp'])?></td>
                <td>Rp. <?= number_format($row['biaya'])?></td>
            </tr>
            <tr>
                <td colspan="10" class="border-0">

                    <div class="collapse mb-3" id="edit-status-<?= $row['id_nota_tinggal']?>">
                        <div class="card card-body shadow border-0">
                            <form action="" method="POST">
                                <input type="hidden" name="id-nota-tinggal" value="<?= $row['id_nota_tinggal']?>">
                                <input type="hidden" name="id-nota-dp" value="<?= $row['id_nota_dp']?>">
                                <input type="hidden" name="id-layanan" value="<?= $row['id_layanan']?>">
                                <div class="form-group">
                                    <select name="id-status" class="form-control">
                                        <option>Pilih Status</option>
                                        <?php foreach($services_status_ugdhp as $row_status):?>
                                        <option value="<?= $row_status['id_status']?>"><?= $row_status['status']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="edit-status-nota" class="btn btn-warning btn-sm">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="collapse mb-3" id="collapseEdit-<?= $row['id_nota_tinggal']?>">
                        <div class="card card-body border-0 shadow">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="nota-tinggal">Nota Tinggal</label>
                                    <input type="hidden" name="id-nota-tinggal" value="<?= $row['id_nota_tinggal']?>">
                                    <input type="text" name="nota-tinggal" class="form-control text-center" id="nota-tinggal" placeholder="Nomor Nota Tinggal">
                                    <small class="text-danger">Hanya jika anda ingin merubahnya saja!</small>
                                </div>
                                <?php if($row['id_nota_dp']>0){?>
                                <div class="form-group">
                                    <label for="nota-dp">Nota DP</label>
                                    <input type="hidden" name="id-nota-dp" value="<?= $row['id_nota_dp']?>">
                                    <input type="text" name="nota-dp" class="form-control text-center" id="nota-dp" placeholder="Nomor Nota DP">
                                </div>
                                <?php }?>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                    <input type="text" name="username" class="form-control text-center" id="username" placeholder="Username" value="<?= $row['username']?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email-user">Email</label>
                                    <input type="email" name="email-user" class="form-control text-center" id="email-user" placeholder="Email">
                                    <small class="text-danger">Hanya jika email ingin di rubah!</small>
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
                                <?php }else if($id_layanan==1){$laptop=mysqli_query($conn, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");$row_laptop=mysqli_fetch_assoc($laptop);?>
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
                                    <label for="kondisi">Kondisi</label>
                                    <input type="text" name="kondisi" class="form-control text-center" id="kondisi" placeholder="Kondisi" value="<?= $row['kondisi']?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="kelengkapan">Kelengkapan</label>
                                    <input type="text" name="kelengkapan" class="form-control text-center" id="kelengkapan" placeholder="Kelengkapan" value="<?= $row['kelengkapan']?>" required>
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
                                <div class="col-md-12 d-sm-flex justify-content-start flex-row-reverse m-0 p-0">
                                    <div class="col-lg-8 mt-4">
                                        <div class="form-group mt-3">
                                            <h6 class="text-dark font-weight-bold">Pengisian tanggal ambil, Hanya jika Client memutuskan saja!</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 m-0 p-0">
                                        <div class="form-group">
                                            <label for="tgl-ambil" class="text-dark font-weight-bold">Tanggal Ambil</label>
                                            <input type="date" name="tgl-ambil" value="<?= $row['tgl_ambil']?>" id="tgl-ambil" class="form-control" placeholder="Tanggal Ambil">
                                        </div>
                                    </div>
                                </div>
                                <?php if($row['id_nota_dp']>0){?>
                                <div class="form-group">
                                    <label for="dp">DP</label>
                                    <input type="text" name="dp" class="form-control text-center" id="dp" placeholder="DP" value="<?= $row['dp']?>">
                                </div>
                                <?php }?>
                                <div class="form-group">
                                    <label for="biaya">Biaya</label>
                                    <input type="text" name="biaya" class="form-control text-center" id="biaya" placeholder="Biaya" value="<?= $row['biaya']?>" required>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" name="edit-nota" class="btn btn-warning btn-sm">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="collapse mb-3" id="collapseUser-<?= $row['id_nota_tinggal']?>">
                        <div class="card card-body text-dark border-0 shadow">
                            <p>Username : <?= $row['username']?></p>
                            <p>Email : <?php $em=$row['email_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                            <p>Telepon : <?php $em=$row['tlpn_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                            <p>Alamat : <?php $em=$row['alamat_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                        </div>
                    </div>

                    <div class="collapse" id="collapseLayanan-<?= $row['id_nota_tinggal']?>">
                        <div class="card card-body text-dark border-0 shadow">
                            <?php $id_layanan=$row['id_layanan'];if($id_layanan==1){$handphone=mysqli_query($conn, "SELECT * FROM handphone");$row_hp=mysqli_fetch_assoc($handphone);?>
                                <p>Type : <?= $row_hp['type']?></p>
                                <p>Seri : <?= $row_hp['seri']?></p>
                                <p>Imei : <?= $row_hp['imei']?></p>
                            <?php }else if($id_layanan==2){$laptop=mysqli_query($conn, "SELECT * FROM laptop");$row_laptop=mysqli_fetch_assoc($laptop);?>
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