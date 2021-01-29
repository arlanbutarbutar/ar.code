<?php 
if($id_auto==1){
    if($id_auto_status==1){
        $cek_id_nota_tinggal=mysqli_query($conn, "SELECT * FROM nota_tinggal ORDER BY id_nota_tinggal DESC LIMIT 1");
        $loop_id_nota_tinggal=mysqli_fetch_assoc($cek_id_nota_tinggal);
        if(isset($loop_id_nota_tinggal['id_nota_tinggal'])){
            $id_nota_nt1=$loop_id_nota_tinggal['id_nota_tinggal'];
            $id_nota_nt2=$id_nota_nt1+1;
            $nota_cancel=mysqli_query($conn, "SELECT * FROM nota_cancel WHERE id_nota_tinggal='$id_nota_nt2'");
            if(mysqli_num_rows($nota_cancel)>0){
                $id_nota_nt3=$id_nota_nt2+1;
                $nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_tinggal='$id_nota_nt3'");
                if(mysqli_num_rows($nota_lunas)>0){
                    $id_nota_nt4=$id_nota_nt3+1;
                    $laporan_harian=mysqli_query($conn, "SELECT * FROM laporan_harian WHERE id_nota_tinggal='$id_nota_nt4'");
                    if(mysqli_num_rows($laporan_harian)>0){
                        $id_nota_tinggal=$id_nota_nt4+1;
                    }else if(mysqli_num_rows($laporan_harian)==0){
                        $id_nota_tinggal=$id_nota_nt4;
                    }
                }else if(mysqli_num_rows($nota_lunas)==0){
                    $id_nota_tinggal=$id_nota_nt3;
                }
            }else if(mysqli_num_rows($nota_cancel)==0){
                $id_nota_tinggal=$id_nota_nt2;
            }
        }else if(!isset($loop_id_nota_tinggal['id_nota_tinggal'])){
            $id_nota_tinggal=202027;
        }
    }else if($id_auto_status==2){
        $id_nota_tg1=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-nota-tinggal']))));
        $nota_tinggal=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_nota_tinggal='$id_nota_tg1'");
        if(mysqli_num_rows($nota_tinggal)>0){
            $_SESSION['message-danger']="Maaf, nomor nota tinggal yang anda masukan sudah ada!";
            $_SESSION['show']=3;
            header("Location: nota-tinggal");return false;
        }else if(mysqli_num_rows($nota_tinggal)>0){
            $id_nota_tinggal=$id_nota_tg1;
        }
        $nota_cancel=mysqli_query($conn, "SELECT * FROM nota_cancel WHERE id_nota_tinggal='$id_nota_tg1'");
        if(mysqli_num_rows($nota_cancel)>0){
            $_SESSION['message-danger']="Maaf, nomor nota tinggal yang anda masukan sudah ada!";
            $_SESSION['show']=3;
            header("Location: nota-tinggal");return false;
        }else if(mysqli_num_rows($nota_cancel)==0){
            $id_nota_tinggal=$id_nota_tg1;
        }
        $nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_tinggal='$id_nota_tg1'");
        if(mysqli_num_rows($nota_lunas)>0){
            $_SESSION['message-danger']="Maaf, nomor nota tinggal yang anda masukan sudah ada!";
            $_SESSION['show']=3;
            header("Location: nota-tinggal");return false;
        }else if(mysqli_num_rows($nota_lunas)==0){
            $id_nota_tinggal=$id_nota_tg1;
        }
        $laporan_harian=mysqli_query($conn, "SELECT * FROM laporan_harian WHERE id_nota_tinggal='$id_nota_tg1'");
        if(mysqli_num_rows($laporan_harian)>0){
            $_SESSION['message-danger']="Maaf, nomor nota tinggal yang anda masukan sudah ada!";
            $_SESSION['show']=3;
            header("Location: nota-tinggal");return false;
        }else if(mysqli_num_rows($laporan_harian)==0){
            $id_nota_tinggal=$id_nota_tg1;
        }
    }
}else if($id_auto==2){
    if($id_auto_status==1){
        $check_nota_dp=count($add['check-nota-dp']);
        if($check_nota_dp==1){
            $cek_id_nota_dp=mysqli_query($conn, "SELECT * FROM nota_tinggal ORDER BY id_nota_dp DESC LIMIT 1");
            if(mysqli_num_rows($cek_id_nota_dp)>0){
                $loop_id_nota_dp=mysqli_fetch_assoc($cek_id_nota_dp);
                $id_nota_dp1=$loop_id_nota_dp['id_nota_dp'];
                if($id_nota_dp1==0){
                    $id_nota_dp=202027;
                }else{
                    $id_nota_dp2=$id_nota_dp1+1;
                    $nota_cancel=mysqli_query($conn, "SELECT * FROM nota_cancel WHERE id_nota_dp='$id_nota_dp2'");
                    if(mysqli_num_rows($nota_cancel)>0){
                        $id_nota_dp3=$id_nota_dp2+1;
                        $nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_dp='$id_nota_dp3'");
                        if(mysqli_num_rows($nota_lunas)>0){
                            $id_nota_dp4=$id_nota_dp3+1;
                            $laporan_harian=mysqli_query($conn, "SELECT * FROM laporan_harian WHERE id_nota_dp='$id_nota_dp4'");
                            if(mysqli_num_rows($laporan_harian)>0){
                                $id_nota_dp=$id_nota_dp4+1;
                            }else if(mysqli_num_rows($laporan_harian)==0){
                                $id_nota_dp=$id_nota_dp4;
                            }
                        }else if(mysqli_num_rows($nota_lunas)==0){
                            $id_nota_dp=$id_nota_dp3;
                        }
                    }else if(mysqli_num_rows($nota_cancel)==0){
                        $id_nota_dp=$id_nota_dp2;
                    }
                }
            }else if(mysqli_num_rows($cek_id_nota_dp)==0){
                $id_nota_dp=202027;
            }
        }
    }else if($id_auto_status==2){
        $id_nota_downPayment=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-nota-dp']))));
        $nota_dp=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_nota_dp='$id_nota_downPayment'");
        if(mysqli_num_rows($nota_dp)>0){
            $_SESSION['message-danger']="Maaf, nomor nota dp yang anda masukan sudah ada!";
            $_SESSION['show']=3;
            header("Location: nota-tinggal");return false;
        }else if(mysqli_num_rows($nota_dp)==0){
            $id_nota_dp=$id_nota_downPayment;
        }
        $nota_cancel=mysqli_query($conn, "SELECT * FROM nota_cancel WHERE id_nota_dp='$id_nota_downPayment'");
        if(mysqli_num_rows($nota_cancel)>0){
            $_SESSION['message-danger']="Maaf, nomor nota dp yang anda masukan sudah ada!";
            $_SESSION['show']=3;
            header("Location: nota-tinggal");return false;
        }else if(mysqli_num_rows($nota_cancel)==0){
            $id_nota_dp=$id_nota_downPayment;
        }
        $nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_dp='$id_nota_downPayment'");
        if(mysqli_num_rows($nota_lunas)>0){
            $_SESSION['message-danger']="Maaf, nomor nota dp yang anda masukan sudah ada!";
            $_SESSION['show']=3;
            header("Location: nota-tinggal");return false;
        }else if(mysqli_num_rows($nota_lunas)==0){
            $id_nota_dp=$id_nota_downPayment;
        }
        $laporan_harian=mysqli_query($conn, "SELECT * FROM laporan_harian WHERE id_nota_dp='$id_nota_downPayment'");
        if(mysqli_num_rows($laporan_harian)>0){
            $_SESSION['message-danger']="Maaf, nomor nota dp yang anda masukan sudah ada!";
            $_SESSION['show']=3;
            header("Location: nota-tinggal");return false;
        }else if(mysqli_num_rows($laporan_harian)==0){
            $id_nota_dp=$id_nota_downPayment;
        }
    }
}
