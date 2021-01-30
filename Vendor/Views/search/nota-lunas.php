<?php
    // require_once('../../controller/connect.php');
    require_once('../../controller/script.php');
    $keyword=addslashes(trim($_GET['keyword-nota-lunas']));
    $query="SELECT * FROM nota_lunas 
        JOIN users_local ON nota_lunas.id_user=users_local.id_user
        JOIN employee ON nota_lunas.id_pegawai=employee.id_employee
        WHERE nota_lunas.id_nota_lunas LIKE '%$keyword%'
        OR nota_lunas.id_nota_lunas LIKE '%$keyword%'
        OR nota_lunas.id_nota_dp LIKE '%$keyword%'
        OR users_local.username LIKE '%$keyword%'
        OR users_local.email_user LIKE '%$keyword%'
        OR users_local.tlpn_user LIKE '%$keyword%'
        OR users_local.alamat_user LIKE '%$keyword%'
        OR nota_lunas.kerusakan LIKE '%$keyword%'
    ";
    $nota_lunas=mysqli_query($conn, $query);
    
?>
<table class="table table-borderless text-dark text-center table-responsive">
    <thead>
        <tr>
            <th scope="col">#</th>
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
        <?php }else if(mysqli_num_rows($nota_lunas)>0){while($row=mysqli_fetch_assoc($nota_lunas)){?>
        <tr>
            <th scope="row"><?= $no;?></th>
            <th><?= $row['id_nota_lunas']?></th>
            <th><?= $row['id_nota_tinggal']?></th>
            <th><?= $row['id_nota_dp']?></th>
            <?php if($row['id_nota_tinggal']==0){?>
            <td><a class="btn btn-warning btn-sm" data-toggle="collapse" href="#collapseEdit-<?= $row['id_nota_lunas']?>" role="button" aria-expanded="false" aria-controls="collapseEdit-<?= $row['id_nota_lunas']?>"><i class="fas fa-pen"></i></a></td>
            <?php }else if($row['id_nota_tinggal']>0){?>
            <td><p class="btn btn-secondary btn-sm"><i class="fas fa-pen"></i></p></td>
            <?php }?>
            <td><form action="" method="POST">
                <input type="hidden" name="id-nota-lunas" value="<?= $row['id_nota_lunas']?>">
                <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                <input type="hidden" name="id-barang" value="<?= $row['id_barang']?>">
                <input type="hidden" name="id-layanan" value="<?= $row['id_layanan']?>">
                <input type="hidden" name="ket-img" value="<?= $row['ket_img']?>">
                <button type="submit" name="delete-nota-lunas" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </form></td>
            <td><a href="<?= $link_barcode_NL.$row['id_nota_lunas']?>" class="btn btn-sm" <?= $style_btn?>><i class="fas fa-qrcode"></i></a></td>
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
                <a href="checkup-lunas?id-lunas=<?= $row['id_nota_lunas']?>" class="btn btn-sm" <?= $style_btn?>><i class="fas fa-eye"></i> View</a>
                <?php }else{?><p class="text-dark">Bukti Nota</p></tr><?php }?>
            </td>
        </tr>
        <tr>
            <td colspan="10" class="border-0">

                <div class="collapse mb-3" id="collapseEdit-<?= $row['id_nota_lunas']?>">
                    <div class="card card-body border-0 shadow">
                        <form action="" method="POST">
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
                                <label for="teknisi">Teknisi</label>
                                <select name="id-teknisi" id="teknisi" class="form-control text-center" required>
                                    <option>Pilih Teknisi</option>
                                    <?php foreach($technicians_data as $row_teknisi):?>
                                    <option value="<?= $row_teknisi['id_user']?>"><?= $row_teknisi['first_name']?></option>
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
                                <input type="text" name="biaya" class="form-control text-center" id="biaya" placeholder="Biaya" value="<?= $row['biaya']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="garansi">Garansi</label>
                                <input type="text" name="garansi" class="form-control text-center" id="garansi" placeholder="Garansi" value="<?= $row['garansi']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="ket-text">Keterangan Text</label>
                                <input type="text" name="ket-text" class="form-control text-center" id="ket-text" placeholder="Keterangan Text" value="<?= $row['ket_text']?>">
                            </div>
                            <small class="text-danger">Jika ambil barang tanpa nota maka masukan tanda bukti lain seperti KTP/Tanda Pengenal lainnya.</small>
                            <div class="input-group mb-3">
                                <div class="custom-file">
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