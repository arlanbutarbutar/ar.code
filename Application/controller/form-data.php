<?php if(!isset($_SESSION)){session_start();}
    $_SESSION['id-nota-tinggal']=$id_nota_tinggal;
    $_SESSION['id-nota-dp']=$id_nota_dp;
    $_SESSION['id-nota-lunas']=$id_nota_lunas;
    $_SESSION['username']=$username;
    $_SESSION['email']=$email;
    $_SESSION['tlpn']=$tlpn;
    $_SESSION['alamat']=$alamat;
    if(isset($id_layanan)){
        if($id_layanan==1){
            $_SESSION['type']=$type;
            $_SESSION['seri-hp']=$seri_hp;
            $_SESSION['imei']=$imei;
        }else if($id_layanan==2){
            $_SESSION['merek']=$merek;
            $_SESSION['seri-laptop']=$seri_laptop;
        }
    }
    $_SESSION['kerusakan']=$kerusakan;
    $_SESSION['tgl-ambil']=$tgl_ambil;
    $_SESSION['kondisi']=$kondisi;
    $_SESSION['kelengkapan']=$kelengkapan;
    $_SESSION['dp']=$dp;
    $_SESSION['biaya']=$biaya;
    $_SESSION['pemasukan']=$pemasukan;
    $_SESSION['garansi']=$garansi;