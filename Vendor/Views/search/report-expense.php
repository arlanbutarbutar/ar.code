<?php
    // require_once('../../controller/connect.php');
    require_once('../../controller/script.php');
    $keyword=addslashes(trim($_GET['keyword-laporan-pengeluaran']));
    $query="SELECT * FROM laporan_pengeluaran WHERE jenis_pengeluaran LIKE '%$keyword%' OR ket LIKE '%$keyword%'";
    $laporan_pengeluaran=mysqli_query($conn, $query);
    
?>
<table class="table table-sm text-dark text-center">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Jenis Pengeluaran</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Biaya Pengeluaran</th>
            <th scope="col">Tgl Pengeluaran</th>
            <?php if($_SESSION['id-role']==5){?>
            <th scope="col">Waktu</th>
            <?php }?>
            <th colspan="2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1;if(mysqli_num_rows($laporan_pengeluaran)==0){?>
        <tr>
            <th colspan="19">Maaf data saat ini kosong!</th>
        </tr>
        <?php }else if(mysqli_num_rows($laporan_pengeluaran)>0){while($row=mysqli_fetch_assoc($laporan_pengeluaran)){?>
        <tr>
            <th scope="row"><?= $no;?></th>
            <td><?= $row['jenis_pengeluaran']?></td>
            <td><?= $row['ket']?></td>
            <td>Rp. <?= number_format($row['biaya_pengeluaran'])?></td>
            <td><?= $row['tgl_pengeluaran']?></td>
            <?php if($_SESSION['id-role']==5){?>
            <td><?= $row['time']?></td>
            <?php }?>
            <td><?php $tgl=$row['tgl_pengeluaran'];$tgl_skrng=date('l, d M Y');if($tgl==$tgl_skrng){?>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="collapse" data-target="#edit-pengeluaran<?= $row['id_pengeluaran']?>" aria-expanded="false" aria-controls="edit-pengeluaran<?= $row['id_pengeluaran']?>"><i class="fas fa-pen"></i></button>
                <?php }else{?>
                <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-pen"></i></button>
            <?php }?></td>
            <td><form action="" method="POST">
                <input type="hidden" name="id-pengeluaran" value="<?= $row['id_pengeluaran']?>">
                <button type="submit" name="hapus-pengeluaran" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </form></td>
        </tr>
        <tr>
            <td colspan="10" class="border-0">

            <div class="collapse" id="edit-pengeluaran<?= $row['id_pengeluaran']?>">
                <div class="card card-body border-0 shadow">
                    <form action="" method="POST">
                        <input type="hidden" name="id-pengeluaran" value="<?= $row['id_pengeluaran']?>">
                        <div class="form-group">
                            <label>Jenis Pengeluaran</label>
                            <input type="text" name="jenis" placeholder="Jenis Pengeluaran" class="form-control" value="<?= $row['jenis_pengeluaran']?>" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="ket" cols="30" rows="5" placeholder="Keterangan" class="form-control" style="resize: none" required><?= $row['ket']?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Biaya Pengeluaran</label>
                            <input type="number" name="biaya" placeholder="Biaya Pengeluaran" class="form-control" value="<?= $row['biaya_pengeluaran']?>" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="edit-pengeluaran" class="btn btn-warning btn-sm">Apply</button>
                        </div>
                    </form>
                </div>
            </div>

            </td>
        </tr>
        <?php $no++;}}?>
    </tbody>
</table>