<?php 
// tinggal
$id_nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-nota-tinggal']))));
$nota_tinggal=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_nota_tinggal='$id_nota_tinggal'");
if(mysqli_num_rows($nota_tinggal)>0){
    $_SESSION['message-danger']="Maaf, nomor nota tinggal yang anda masukan sudah ada!";
    $_SESSION['show']=3;
    header("Location: nota-tinggal");return false;
}
$nota_cancel=mysqli_query($conn, "SELECT * FROM nota_cancel WHERE id_nota_tinggal='$id_nota_tinggal'");
if(mysqli_num_rows($nota_cancel)>0){
    $_SESSION['message-danger']="Maaf, nomor nota tinggal yang anda masukan sudah ada!";
    $_SESSION['show']=3;
    header("Location: nota-tinggal");return false;
}
$nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_tinggal='$id_nota_tinggal'");
if(mysqli_num_rows($nota_lunas)>0){
    $_SESSION['message-danger']="Maaf, nomor nota tinggal yang anda masukan sudah ada!";
    $_SESSION['show']=3;
    header("Location: nota-tinggal");return false;
}
$laporan_harian=mysqli_query($conn, "SELECT * FROM laporan_harian WHERE id_nota_tinggal='$id_nota_tinggal'");
if(mysqli_num_rows($laporan_harian)>0){
    $_SESSION['message-danger']="Maaf, nomor nota tinggal yang anda masukan sudah ada!";
    $_SESSION['show']=3;
    header("Location: nota-tinggal");return false;
}
// dp
if(!empty($add['id-nota-dp'])){
    $id_nota_dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-nota-dp']))));
    $nota_dp=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_nota_dp='$id_nota_dp'");
    if(mysqli_num_rows($nota_dp)>0){
        $_SESSION['message-danger']="Maaf, nomor nota dp yang anda masukan sudah ada!";
        $_SESSION['show']=3;
        header("Location: nota-tinggal");return false;
    }
    $nota_cancel=mysqli_query($conn, "SELECT * FROM nota_cancel WHERE id_nota_dp='$id_nota_dp'");
    if(mysqli_num_rows($nota_cancel)>0){
        $_SESSION['message-danger']="Maaf, nomor nota dp yang anda masukan sudah ada!";
        $_SESSION['show']=3;
        header("Location: nota-tinggal");return false;
    }
    $nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_dp='$id_nota_dp'");
    if(mysqli_num_rows($nota_lunas)>0){
        $_SESSION['message-danger']="Maaf, nomor nota dp yang anda masukan sudah ada!";
        $_SESSION['show']=3;
        header("Location: nota-tinggal");return false;
    }
    $laporan_harian=mysqli_query($conn, "SELECT * FROM laporan_harian WHERE id_nota_dp='$id_nota_dp'");
    if(mysqli_num_rows($laporan_harian)>0){
        $_SESSION['message-danger']="Maaf, nomor nota dp yang anda masukan sudah ada!";
        $_SESSION['show']=3;
        header("Location: nota-tinggal");return false;
    }
}