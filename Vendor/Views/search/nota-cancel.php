<?php
    // require_once('../../controller/connect.php');
    require_once('../../controller/script.php');
    $keyword=addslashes(trim($_GET['keyword-nota-cancel']));
    $query="SELECT * FROM nota_cancel 
        JOIN users_local ON nota_cancel.id_user=users_local.id_user
        JOIN employee ON nota_cancel.id_pegawai=employee.id_employee
        JOIN services_status_ugdhp ON nota_cancel.id_status=services_status_ugdhp.id_status
        WHERE nota_cancel.id_nota_tinggal LIKE '%$keyword%'
        OR nota_cancel.id_nota_dp LIKE '%$keyword%'
        OR users_local.username LIKE '%$keyword%'
        OR users_local.email_user LIKE '%$keyword%'
        OR users_local.tlpn_user LIKE '%$keyword%'
        OR users_local.alamat_user LIKE '%$keyword%'
        OR nota_cancel.kerusakan LIKE '%$keyword%'
    ";
    $nota_cancelOffline=mysqli_query($conn, $query);
    
?>
    <table class="table table-sm text-dark text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">#Nota Tinggal</th>
                <th scope="col">#Nota DP</th>
                <th colspan="3">Aksi</th>
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
            <?php $no=1;if(mysqli_num_rows($nota_cancelOffline)==0){?>
            <tr>
                <th colspan="19">Maaf data saat ini kosong!</th>
            </tr>
            <?php }else if(mysqli_num_rows($nota_cancelOffline)>0){while($row=mysqli_fetch_assoc($nota_cancelOffline)){?>
            <tr>
                <th scope="row"><?= $no;?></th>
                <th><?= $row['id_nota_tinggal']?></th>
                <th><?= $row['id_nota_dp']?></th>
                <td><form action="" method="POST">
                    <input type="hidden" name="id-nota-tinggal" value="<?= $row['id_nota_tinggal']?>">
                    <button type="submit" name="recovery-nota" class="btn btn-warning btn-sm"><i class="fas fa-undo"></i></button>
                </form></td>
                <td><form action="" method="POST">
                    <input type="hidden" name="id-nota-tinggal" value="<?= $row['id_nota_tinggal']?>">
                    <input type="hidden" name="id-layanan" value="<?= $row['id_layanan']?>">
                    <input type="hidden" name="barcode" value="<?= $row['barcode']?>">
                    <button type="submit" name="delete-nota" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                </form></td>
                <td><a href="<?= $link_barcode_NC.$row['id_nota_tinggal']?>" class="btn btn-sm" <?= $style_btn?>><i class="fas fa-qrcode"></i></a></td>
                <td><?= $row['tgl_masuk']?></td>
                <td><?= $row['time']?></td>
                <td><a class="btn btn-sm" <?= $style_btn?> data-toggle="collapse" href="#collapseUser-<?= $row['id_data']?>" role="button" aria-expanded="false" aria-controls="collapseUser-<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?= $row['username']?></a></td>
                <td><a class="btn btn-sm" <?= $style_btn?> data-toggle="collapse" href="#collapseLayanan-<?= $row['id_data']?>" role="button" aria-expanded="false" aria-controls="collapseLayanan-<?= $row['id_data']?>"><i class="fas fa-eye"></i> <?php $id_layanan=$row['id_layanan'];if($id_layanan==1){echo "Handphone";}else if($id_layanan==2){echo "Laptop";}?></a></td>
                <td><?= $row['kerusakan']?></td>
                <td><?= $row['kondisi']?></td>
                <td><?php $kel=$row['kelengkapan'];if($kel="-" || ""){echo "Tidak ada.";}else{echo $kel;}?></td>
                <td><?= $row['first_name']?></td>
                <td><?= $row['status']?></td>
                <td><?= $row['tgl_status']?></td>
                <td><?= $row['tgl_ambil']?></td>
                <td>Rp. <?= number_format($row['dp'])?></td>
                <td>Rp. <?= number_format($row['biaya'])?></td>
            </tr>
            <tr>
                <td colspan="10" class="border-0">

                    <div class="collapse mb-3" id="collapseUser-<?= $row['id_data']?>">
                        <div class="card card-body text-dark border-0 shadow">
                            <p>Username : <?= $row['username']?></p>
                            <p>Email : <?php $em=$row['email_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                            <p>Telepon : <?php $em=$row['tlpn_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                            <p>Alamat : <?php $em=$row['alamat_user'];if(empty($em)){echo "Tidak ada.";}else{echo $em;}?></p>
                        </div>
                    </div>

                    <div class="collapse" id="collapseLayanan-<?= $row['id_data']?>">
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