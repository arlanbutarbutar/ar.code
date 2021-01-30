<?php
    // require_once('../../controller/connect.php');
    require_once('../../controller/script.php');
    $keyword=addslashes(trim($_GET['keyword-sparepart']));
    $query="SELECT * FROM laporan_spareparts WHERE ket LIKE '%$keyword%' OR suplayer LIKE '%$keyword%'";
    $laporan_spareparts=mysqli_query($conn, $query);
    
?>
<table class="table table-borderless text-dark text-center table-responsive">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tgl masuk</th>
            <?php if($_SESSION['id-role']==5){?>
            <th scope="col">Waktu</th>
            <?php }?>
            <th scope="col">Barcode</th>
            <th scope="col">Sparepart</th>
            <th scope="col">Suplayer</th>
            <th scope="col">Jumlah Barang</th>
            <th scope="col">Harga</th>
            <th scope="col">Total</th>
            <th scope="col">Ket. tambahan</th>
            <th scope="col">Teknisi</th>
            <th colspan="3">Aksi</th>
        </tr> 
    </thead>
    <tbody>
        <?php $no=1;if(mysqli_num_rows($laporan_spareparts)==0){?>
        <tr>
            <th colspan="19">Maaf data saat ini kosong!</th>
        </tr>
        <?php }else if(mysqli_num_rows($laporan_spareparts)>0){while($row=mysqli_fetch_assoc($laporan_spareparts)){?>
        <tr>
            <th scope="row"><?= $no;?></th>
            <td><?= $row['tgl_masuk']?></td>
            <?php if($_SESSION['id-role']==5){?>
            <td><?= $row['time']?></td>
            <?php }?>
            <td><a href="qr?ac=<?= $row['id_sparepart']?>" class="btn btn-light btn-sm shadow-lg"><i class="fas fa-qrcode"></i></a></td>
            <td><?= $row['ket']?></td>
            <td><?= $row['suplayer']?></td>
            <td><?= $row['jmlh_barang']?></td>
            <td>Rp. <?= number_format($row['harga'])?></td>
            <td>Rp. <?= number_format($row['total'])?></td>
            <td><?= $row['ket_plus']?></td>
            <?php if($row['status_sparepart']==2){?>
            <td><?php $id=$row['id_pegawai'];$teknisi=mysqli_query($conn, "SELECT * FROM employee WHERE id_employee='$id'");foreach($teknisi as $tek){echo $tek['first_name'];}?></td>
            <?php }else{?>
            <td>Belum laporan.</td>
            <?php }?>
            <td>
                <?php if($_SESSION['id-role']==6){$date=date('Y-m-d');$tgl_report=$row['tgl_cari'];if($date==$tgl_report){?>
                <button class="btn btn-warning btn-sm" type="button" data-toggle="collapse" data-target="#edit-sparepart<?= $row['id_sparepart']?>" aria-expanded="false" aria-controls="edit-sparepart<?= $row['id_sparepart']?>"><i class="fas fa-pen"></i></button>
                <?php }else{?>
                <button class="btn btn-secondary btn-sm" type="button"><i class="fas fa-pen"></i></button>
                <?php }}if($_SESSION['id-role']==4 || $_SESSION['id-role']==5){?>
                <button class="btn btn-warning btn-sm" type="button" data-toggle="collapse" data-target="#edit-sparepart<?= $row['id_sparepart']?>" aria-expanded="false" aria-controls="edit-sparepart<?= $row['id_sparepart']?>"><i class="fas fa-pen"></i></button>
                <?php }?>
            </td>
            <td><form action="" method="POST">
                <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                <?php if($_SESSION['id-role']==6){$date=date('Y-m-d');$tgl_report=$row['tgl_cari'];if($date==$tgl_report){?>
                <button type="submit" name="delete-sparepart" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                <?php }else{?>
                <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-trash"></i></button>
                <?php }}if($_SESSION['id-role']==4 || $_SESSION['id-role']==5){?>
                <button type="submit" name="delete-sparepart" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                <?php }?>
            </form></td>
            <?php if($row['status_sparepart']==1){?>
            <td><form action="" method="POST">
                <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                <button type="submit" name="ambil-sparepart" class="btn btn-success btn-sm"><i class="fas fa-box-open"></i></button>
            </form></td>
            <?php }else{?>
            <td>
                <button class="btn btn-secondary btn-sm"><i class="fas fa-box-open"></i></button>
            </td>
            <?php }?>
        </tr>
        <tr>
            <td colspan="10" class="border-0">

                <div class="collapse" id="edit-sparepart<?= $row['id_sparepart']?>">
                    <div class="card card-body border-0 shadow">
                        <form action="" method="POST">
                            <input type="hidden" name="id-sparepart" value="<?= $row['id_sparepart']?>">
                            <div class="form-group">
                                <input type="text" name="ket" placeholder="Keterangan" class="form-control" value="<?= $row['ket']?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="suplayer" placeholder="Suplayer" class="form-control" value="<?= $row['suplayer']?>">
                            </div>
                            <div class="form-group">
                                <input type="number" name="jumlah-barang" placeholder="Jumlah barang" class="form-control" value="<?= $row['jmlh_barang']?>">
                            </div>
                            <div class="form-group">
                                <input type="number" name="harga" placeholder="Harga" class="form-control" value="<?= $row['harga']?>">
                            </div>
                            <div class="form-group">
                                <textarea name="ket-plus" cols="30" rows="5" class="form-control" placeholder="Keterangan tambahan" style="resize: none"><?= $row['ket_plus']?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="edit-sparepart" class="btn btn-success btn-sm">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>

            </td>
        </tr>
        <?php $no++;}}?>
    </tbody>
</table>