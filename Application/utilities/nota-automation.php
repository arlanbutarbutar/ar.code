<?php 
    require_once("connect.php");
    $nota_tinggal_auto=mysqli_query($conn, "SELECT * FROM autorisasi_nomor_nota WHERE id_auto='1'");
    $row_nt=mysqli_fetch_assoc($nota_tinggal_auto);
    $nota_dp_auto=mysqli_query($conn, "SELECT * FROM autorisasi_nomor_nota WHERE id_auto='2'");
    $row_dp=mysqli_fetch_assoc($nota_dp_auto);
    $nota_ln_auto=mysqli_query($conn, "SELECT * FROM autorisasi_nomor_nota WHERE id_auto='3'");
    $row_ln=mysqli_fetch_assoc($nota_ln_auto);
    if(isset($_POST['nota-tinggal-auto'])){
        $id_status=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['nota-tinggal']))));
        if($id_status==1){
            mysqli_query($conn, "UPDATE autorisasi_nomor_nota SET id_status='2' WHERE id_auto='1'");
        }else if($id_status==2){
            mysqli_query($conn, "UPDATE autorisasi_nomor_nota SET id_status='1' WHERE id_auto='1'");
        }
    }
    if(isset($_POST['nota-dp-auto'])){
        $id_status=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['nota-dp']))));
        if($id_status==1){
            mysqli_query($conn, "UPDATE autorisasi_nomor_nota SET id_status='2' WHERE id_auto='2'");
        }else if($id_status==2){
            mysqli_query($conn, "UPDATE autorisasi_nomor_nota SET id_status='1' WHERE id_auto='2'");
        }
    }
    if(isset($_POST['nota-ln-auto'])){
        $id_status=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['nota-ln']))));
        if($id_status==1){
            mysqli_query($conn, "UPDATE autorisasi_nomor_nota SET id_status='2' WHERE id_auto='3'");
        }else if($id_status==2){
            mysqli_query($conn, "UPDATE autorisasi_nomor_nota SET id_status='1' WHERE id_auto='3'");
        }
    }
?>
<form action="" method="POST">
    <input type="hidden" name="nota-tinggal" value="<?= $row_nt['id_status']?>">
    <input type="hidden" name="nota-dp" value="<?= $row_dp['id_status']?>">
    <input type="hidden" name="nota-ln" value="<?= $row_ln['id_status']?>">
    <button type="submit" name="nota-tinggal-auto" data-toggle="tooltip" data-placement="bottom" title="Membuat nomor Nota Tinggal otomatis." class="btn btn-link btn-sm mr-n2">
        <?php $id_status=$row_nt['id_status'];if($id_status==1){?>
        <i class="fas fa-toggle-on text-primary fa-2x"></i>
        <?php }else if($id_status==2){?>
        <i class="fas fa-toggle-off text-secondary fa-2x"></i>
        <?php }?>
    </button>
    <button type="submit" name="nota-dp-auto" data-toggle="tooltip" data-placement="bottom" title="Membuat nomor Nota DP otomatis." class="btn btn-link btn-sm mr-n2">
        <?php $id_status=$row_dp['id_status'];if($id_status==1){?>
        <i class="fas fa-toggle-on text-primary fa-2x"></i>
        <?php }else if($id_status==2){?>
        <i class="fas fa-toggle-off text-secondary fa-2x"></i>
        <?php }?>
    </button>
    <button type="submit" name="nota-ln-auto" data-toggle="tooltip" data-placement="bottom" title="Membuat nomor Nota Lunas otomatis." class="btn btn-link btn-sm mr-5">
        <?php $id_status=$row_ln['id_status'];if($id_status==1){?>
        <i class="fas fa-toggle-on text-primary fa-2x"></i>
        <?php }else if($id_status==2){?>
        <i class="fas fa-toggle-off text-secondary fa-2x"></i>
        <?php }?>
    </button>
</form>