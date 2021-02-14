<?php if(!isset($_SESSION)){session_start();}
    require_once('time.php');require_once('server.php');

    // == class Public ==
        function contact($msg){global $conn;
            $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $msg['name']))));
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $msg['email']))));
            $pesan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $msg['pesan']))));
            require "mail-send.php";
            $to       = 'arlan270899@gmail.com';
            $subject  = 'Visitor Messages '.$name;
            $message  = '
                <div style="margin: 0; padding: 0;">
                    <p>'.$email.' send the following message: '.$pesan.'</p>
                </div>
            ';
            smtp_mail($to, $subject, $message, '', '', 0, 0, true);
            return mysqli_affected_rows($conn);
        }
        function signin($data){global $conn;
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
            $password=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
            $users=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
            if(mysqli_num_rows($users)>0){
                while($row=mysqli_fetch_assoc($users)){
                    $pass=$row['password'];
                    if(password_verify($password, $pass)){
                        if(isset($_SESSION['message-danger'])||isset($_SESSION['message-success'])){unset($_SESSION['message-danger']);unset($_SESSION['message-success']);}
                        if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
                        $_SESSION['id-user']=$row['id_user'];
                        $_SESSION['id-log']=$row['id_user'];
                        $_SESSION['is-active']=$row['is_active'];
                        $_SESSION['id-access']=$row['id_access'];
                        $_SESSION['id-role']=$row['id_role'];
                        $_SESSION['username']=$row['first_name'];
                        if(isset($data['remember-me'])||!empty($data['remember-me'])){
                            setcookie('mobileAR',$row['id_user'],time());
                            setcookie('keyAR',hash('sha256', $row['email']),time());
                        }
                    }else{
                        $_SESSION['message-danger']="Sorry, the password you entered is wrong, please try again.";
                        header("Location: signin");return false;
                    }
                }
            }else if(mysqli_num_rows($users)==0){
                $_SESSION['message-danger']="Sorry your account is not registered yet! please register first.";
                header("Location: signin");return false;
            }
            return mysqli_affected_rows($conn);
        }
        function signup($data){global $conn; // == mail-access => 1/signup
            $first_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['first-name']))));
            $last_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['last-name']))));
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
            $pass=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
            $check_lenght_pass=strlen($pass);
            if($check_lenght_pass<8){
                $_SESSION['message-danger']="Sorry, your password is too short (Min: 8)!";
                header("Location: signup");return false;
            }
            $kebijakan="SETUJU";
            $date_created=date("l, d M Y");
            $check_users=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
            if(mysqli_num_rows($check_users)>0){
                $_SESSION['message-danger']="Sorry, the account you registered already exists!";
                header("Location: signup");return false;
            }
            $encrypt_email=password_hash($email, PASSWORD_DEFAULT);
            $data_encrypt=crc32($email);
            $password=password_hash($pass, PASSWORD_DEFAULT);
            $_SESSION['mail-access']=1; require "mail-send.php";
            $to       = $email;
            $subject  = 'Account Verification UGD HP';
            $message  = '
                <div style="margin: 0; padding: 0;">
                    <p>Congratulations, you have registered in the UGD HP where you can repair cellphones and laptops as well as website creation services. Please click the link below to verify your account:</p><br>
                    <a href="http://localhost/ar.code/Auth/verification-success?auth='.$encrypt_email.'&crypt='.$data_encrypt.'" style="font-weight: bold">'.$encrypt_email.'</a>
                    <p>This code is confidential do not give it to anyone. Also read our terms of service policy at
                        <a href="www.ugdhp.com" style="text-decoration: none;">here.</a>
                    </p>
                </div>
            ';
            smtp_mail($to, $subject, $message, '', '', 0, 0, true);
            mysqli_query($conn, "INSERT INTO users(data_encrypt,first_name,last_name,email,password,kebijakan,date_created) VALUES('$data_encrypt','$first_name','$last_name','$email','$password','$kebijakan','$date_created')");
            return mysqli_affected_rows($conn);
        }
        function verification($data){global $conn;
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['auth']))));
            $crypt=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['crypt']))));
            $check_users=mysqli_query($conn, "SELECT * FROM users WHERE data_encrypt='$crypt'");
            $row=mysqli_fetch_assoc($check_users);
            $email_pass=$row['email'];
            if(password_verify($email_pass,$email)){
                mysqli_query($conn, "UPDATE users SET is_active=1 WHERE data_encrypt='$crypt'");
                return mysqli_affected_rows($conn);
            }
        }
        function forgot_password($data){global $conn;
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
            $check_users=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
            if(mysqli_num_rows($check_users)==0){
                $_SESSION['message-danger']="Sorry your account is not registered yet! please register first.";
                header("Location: forgot-password");return false;
            }else if(mysqli_num_rows($check_users)>0){
                $_SESSION['email']=$email;
                return mysqli_affected_rows($conn);
            }
        }
        function new_password($data){global $conn;
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['email']))));
            $pass=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
            $check_lenght_pass=strlen($pass);
            if($check_lenght_pass<8){
                $_SESSION['message-danger']="Sorry, your password is too short (Min: 8)!";
                header("Location: new-password");return false;
            }
            $re_password=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['re-password']))));
            $check_users=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
            $row=mysqli_fetch_assoc($check_users);
            $password_pass=$row['password'];
            if(password_verify($pass, $password_pass)){
                $_SESSION['message-danger']="Sorry, your password is still the same as the old one, we suggest that you only use the password that you remember.";
                header("Location: new-password");return false;
            }else{
                if($pass==$re_password){
                    $password=password_hash($pass, PASSWORD_DEFAULT);
                    mysqli_query($conn, "UPDATE users SET password='$password' WHERE email='$email'");
                    return mysqli_affected_rows($conn);
                }else{
                    $_SESSION['message-danger']="Sorry, the passwords you entered are not the same.";
                    header("Location: new-password");return false;
                }
            }
        }
    // == class Private ==
        if(isset($_SESSION['id-user'])){
            // => all roles
                $link_log="http://localhost/arcode/views/";
                $date=date('l, d M Y'); $date_search=date('Y-m-d');
                $link_qr="https://eefbd0fbc609.ngrok.io/ar.code/Views/qr-aksi?auth=";
            // => role selection
                if($_SESSION['id-role']<=6){ // => all administrator || ==> Dashboard || ==> web client services
                    function contact_user($msg){global $conn; // == mail-access => 2/contact user
                        $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $msg['name']))));
                        $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $msg['email']))));
                        $pesan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $msg['pesan']))));
                        $_SESSION['mail-access']=2; require "mail-send.php";
                        $to       = 'arlan270899@gmail.com';
                        $subject  = 'Visitor Messages '.$name;
                        $message  = '
                            <div style="margin: 0; padding: 0;">
                                <p>'.$email.' send the following message: '.$pesan.'</p>
                            </div>
                        ';
                        smtp_mail($to, $subject, $message, '', '', 0, 0, true);
                        return mysqli_affected_rows($conn);
                    }
                    function photo_profile($data){global $conn,$time,$date;
                        $id_user=addslashes(trim($data['id-user']));
                        $img=file_photo_user($id_user);
                        if(!$img){return false;}
                        $img_old=$data['img-old'];
                        if($img_old!='default.png'){unlink('../Assets/img/img-users/'.$img_old);}
                        $id_log=$_SESSION['id-log'];
                        $log="Mengubah foto profile.";
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE users SET img='$img' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function file_photo_user(){
                        $namaFile=$_FILES["profile"]["name"];
                        $ukuranFile=$_FILES["profile"]["size"];
                        $error=$_FILES["profile"]["error"];
                        $tmpName=$_FILES["profile"]["tmp_name"];
                        if($error===4){
                            $_SESSION['message-danger']="Pilih gambar profil kamu terlebih dahulu!";
                            header("Location: ../Views/profile");
                            return false;
                        }
                        $ekstensiGambarValid=['jpg','jpeg','png'];
                        $ekstensiGambar=explode('.',$namaFile);
                        $ekstensiGambar=strtolower(end($ekstensiGambar));
                        if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
                            $_SESSION['message-danger']="Maaf, file kamu bukan gambar!";
                            header("Location: ../Views/profile");
                            return false;
                        }
                        if($ukuranFile>2000000){
                            $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2MB)";
                            header("Location: ../Views/profile");
                            return false;
                        }
                        $namaFile_encrypt=crc32($namaFile);
                        $encrypt=$namaFile_encrypt.".jpg";
                        move_uploaded_file($tmpName,'../Assets/img/img-users/'.$encrypt);
                        return $encrypt;
                    }
                    function email_profile($data){global $conn,$time,$date;
                        $id_user=addslashes(trim($data['id-user']));
                        $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
                        $email_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email-old']))));
                        $password1=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password1']))));
                        $password2=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password2']))));
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $_SESSION['message-danger']="Email yang kamu masukan tidak sesuai.";
                            header("Location: profile");return false;
                        }
                        if($email==$email_old){
                            $_SESSION['message-danger']="Email yang kamu masukan sama dengan email lama kamu.";
                            header("Location: profile");return false;
                        }
                        if($password1!=$password2){
                            $_SESSION['message-danger']="Password yang kamu masukan tidak sama.";
                            header("Location: profile");return false;
                        }
                        $check_lenght_pass=strlen($password1);
                        if($check_lenght_pass<=8){
                            $_SESSION['message-danger']="Password yang kamu masukan terlalu pendek (Min: 8)!";
                            header("Location: profile");return false;
                        }
                        $check_users=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
                        if(mysqli_num_rows($check_users)>0){
                            $_SESSION['message-danger']='Email yang ingin kamu ubah: '. $email .' sudah ada atau telah dipakai!';
                            header("Location: profile");return false;
                        }else if(mysqli_num_rows($check_users)==0){
                            $id_log=$_SESSION['id-log'];
                            $log="Ubah email dari ".$email_old." menjadi email baru ".$email.".";
                            mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            mysqli_query($conn, "UPDATE users SET email='$email' WHERE id_user='$id_user'");
                            return mysqli_affected_rows($conn);
                        }
                    }
                    function biodata_profile($data){global $conn,$time,$date;
                        $id_user=addslashes(trim($data['id-user']));
                        $first_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['first-name']))));
                        $last_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['last-name']))));
                        $phone=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['phone']))));
                        $address=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['address']))));
                        $postal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['postal']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Ubah biodata diri menjadi ".$first_name." ".$last_name.", nomor handphone ".$phone.", alamat ".$address.", kode pos ".$postal.".";
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE users SET first_name='$first_name', last_name='$last_name', phone='$phone', address='$address', postal='$postal' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function password_profile($data){global $conn,$time,$date;
                        $id_user=addslashes(trim($data['id-user']));
                        $password1=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password1']))));
                        $password2=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password2']))));
                        $password_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password-old']))));
                        if(password_verify($password1, $password_old)){
                            $_SESSION['message-danger']="Password yang kamu masukan sama dengan password lama.";
                            header("Location: profile-settings");return false;
                        }
                        if($password1!=$password2){
                            $_SESSION['message-danger']="Password yang kamu masukan tidak sama.";
                            header("Location: profile-settings");return false;
                        }
                        $check_lenght_pass=strlen($password1);
                        if($check_lenght_pass<=8){
                            $_SESSION['message-danger']="Password yang kamu masukan terlalu pendek (Min: 8)!";
                            header("Location: profile-settings");return false;
                        }
                        $password=password_hash($password1, PASSWORD_DEFAULT);
                        $id_log=$_SESSION['id-log'];
                        $log="telah mengubah password pada tanggal".$date;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE users SET password='$password' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function help_message($data){global $conn,$time,$date;
                        $id_user=$_SESSION['id-user'];
                        $help_message=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['help-message']))));
                        $tgl_cari=date('Y-m-d');
                        $id_log=$_SESSION['id-log'];
                        $log="Mengirimkan pesan help kepada Client Service UGD HP";
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO users_help(id_user,help_message,date,tgl_cari) VALUES('$id_user','$help_message','$date','$tgl_cari')");
                        return mysqli_affected_rows($conn);
                    }
                    // function blank__($data){global $conn,$time,$date;}
                }
                if($_SESSION['id-role']<=2){ // => founder & developer app
                    function help_answer_message($data){global $conn,$time,$date;
                        $id_help=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-help']))));
                        $answer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['answer']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Membalas help dengan id help #".$id_help;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE users_help SET answer='$answer' WHERE id_help='$id_help'");
                        return mysqli_affected_rows($conn);
                    }
                    function report_problem($data){global $conn,$time,$date;
                        $problem_message=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['problem-message']))));
                        $tgl_cari=date('Y-m-d');
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan report a problem: ".$problem_message;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO report_problem(problem_message,date,tgl_cari) VALUES('$problem_message','$date','$tgl_cari')");
                        return mysqli_affected_rows($conn);
                    }
                    function menu($data){global $conn,$time,$date;
                        $menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['menu']))));
                        $check_menu=mysqli_query($conn, "SELECT * FROM menu WHERE menu LIKE '%$menu%'");
                        if(mysqli_num_rows($check_menu)>0){
                            $_SESSION['message-danger']="Menu yang kamu masukan sudah ada, silakan masukan nama menu yang lain.";
                            header("Location: menu");return false;
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan menu menejemen baru";
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO menu(menu) VALUES('$menu')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_menu($data){global $conn,$time,$date;
                        $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-menu']))));
                        $menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['menu']))));
                        $menu_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['menu-old']))));
                        $check_menu=mysqli_query($conn, "SELECT * FROM menu WHERE menu='$menu'");
                        if(mysqli_num_rows($check_menu)>0){
                            $_SESSION['message-danger']="Menu yang kamu masukan sudah ada, silakan masukan nama menu yang lain.";
                            header("Location: menu");return false;
                        }else if(mysqli_num_rows($check_menu)==0){
                            $id_log=$_SESSION['id-log'];
                            $log="Mengubah nama menu dari ".$menu_old." menjadi ".$menu;
                            mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            mysqli_query($conn, "UPDATE menu SET menu='$menu' WHERE id_menu='$id_menu'");
                            return mysqli_affected_rows($conn);
                        }
                    }
                    function delete_menu($data){global $conn,$time,$date;
                        $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-menu']))));
                        $menu_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['menu-old']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus menu ".$menu_old;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM menu WHERE id_menu='$id_menu'");
                        return mysqli_affected_rows($conn);
                    }
                    function sub_menu($data){global $conn,$time,$date;
                        $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-menu']))));
                        $title=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['title']))));
                        $check_title=mysqli_query($conn, "SELECT * FROM menu_sub WHERE title LIKE '%$title%'");
                        if(mysqli_num_rows($check_title)>0){
                            $_SESSION['message-danger']="Sub Menu yang kamu masukan sudah ada, silakan masukan nama sub menu yang lain.";
                            header("Location: sub-menu");return false;
                        }
                        $url=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['url']))));
                        $icon=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['icon']))));
                        $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['is-active']))));
                        $dir=".";
                        $file_to_write=$url.".php";
                        $content_to_write='
                        <?php if(!isset($_SESSION)){session_start();}
                            require_once("../Application/session/redirect-user.php");
                            require_once("../Application/session/redirect-access-full.php");
                            require_once("../Application/session/redirect-access-users.php");
                            require_once("../Application/session/redirect-access-visitor.php");
                            require_once("../Application/controller/script.php");
                            $_SESSION["page-name"]="- -";
                        ?>
                    
                        <!-- == - page == -->
                        <!DOCTYPE html>
                        <html lang="id">
                            <head>
                                <?php require_once("../Application/access/header.php"); ?>
                            </head>
                            <body id="page-top">
                                <div id="wrapper">
                                    <?php require_once("../Application/access/side-navbar.php") ?>
                                    <div id="content-wrapper" class="d-flex flex-column">
                                        <div id="content">
                                            <?php require_once("../Application/access/top-navbar.php") ?>
                                            <div class="container-fluid">
                                                <!-- == Page Heading == -->
                                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                                        <h1 class="h3 mb-0" <?= $color_black ?>><?= $_SESSION["page-name"]?></h1>
                                                    </div>
                                                <!-- == Content Info == -->
                                                    <div class="row">
                                                        <!-- == alert message == -->
                                                            <div class="col-md-12">
                                                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                                            </div>
                                                        <!-- == insert data == -->
                                                    </div>
                                            </div>
                                        </div>
                                        <?php require_once("../Application/access/footer.php"); ?>
                            </body>
                        </html>';
                        if(is_dir($dir)===false ){mkdir($dir);}
                        $file=fopen($dir.'/'.$file_to_write,"w");
                        fwrite($file, $content_to_write);
                        fclose($file);
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan sub menu dengan nama ".$title;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO menu_sub(id_menu,title,url,icon,is_active) VALUES('$id_menu','$title','$url','$icon','$is_active')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_sub_menu($data){global $conn,$time,$date;
                        $id_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-sub-menu']))));
                        $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-menu']))));
                        $title=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['title']))));
                        $url=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['url']))));
                        $icon=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['icon']))));
                        $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['is-active']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit sub menu dengan nama ".$title;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE menu_sub SET id_menu='$id_menu', title='$title', url='$url', icon='$icon', is_active='$is_active' WHERE id_sub_menu='$id_sub_menu'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_sub_menu($data){global $conn,$time,$date;
                        $id_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-sub-menu']))));
                        $title=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['title']))));
                        $url=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['url']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus sub menu dengan nama ".$title;
                        $files=glob($url.".php");
                        foreach ($files as $file) {
                            if (is_file($file))
                            unlink($file);
                        }
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM menu_sub WHERE id_sub_menu='$id_sub_menu'");
                        return mysqli_affected_rows($conn);
                    }
                    function access_menu($data){global $conn,$time,$date;
                        $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-role']))));
                        $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-menu']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan hak akses menu kepada id role #".$id_role;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO menu_access(role_id,id_menu) VALUES('$id_role','$id_menu')");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_access_menu($data){global $conn,$time,$date;
                        $id_access_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-access-menu']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus hak akses menu dengan id #".$id_access_menu;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM menu_access WHERE id_access_menu='$id_access_menu'");
                        return mysqli_affected_rows($conn);
                    }
                    function access_sub_menu($data){global $conn,$time,$date;
                        $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-role']))));
                        $id_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-sub-menu']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan hak akses sub menu kepada id role #".$id_role;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO menu_sub_access(role_id,id_sub_menu) VALUES('$id_role','$id_sub_menu')");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_access_sub_menu($data){global $conn,$time,$date;
                        $id_access_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-access-sub-menu']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus hak akses sub menu dengan id #".$id_access_sub_menu;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM menu_sub_access WHERE id_access_sub_menu='$id_access_sub_menu'");
                        return mysqli_affected_rows($conn);
                    }
                    function privacy_policy($data){global $conn,$time,$date;
                        $privacy_policy=$data['privacy-policy'];
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan kebijakan privasi yang baru!";
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO privacy_policy(privacy_policy) VALUES('$privacy_policy')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_privacy_policy($data){global $conn,$time,$date;
                        $id_pp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-pp']))));
                        $privacy_policy=$data['privacy-policy'];
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit kebijakan privasi!";
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE privacy_policy SET privacy_policy='$privacy_policy' WHERE id_pp='$id_pp'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_privacy_policy($data){global $conn,$time,$date;
                        $id_pp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-pp']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus kebijakan privasi!";
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM privacy_policy WHERE id_pp='$id_pp'");
                        return mysqli_affected_rows($conn);
                    }
                    function term_of_service($edit){global $conn,$time,$date;
                        $term_of_service=$edit['term-of-service'];
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan persyaratan layanan!";
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO term_of_service(term_of_service) VALUES('$term_of_service')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_term_of_service($data){global $conn,$time,$date;
                        $id_term=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-term']))));
                        $term_of_service=$data['term-of-service'];
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit persyaratan layanan!";
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE term_of_service SET term_of_service='$term_of_service' WHERE id_term='$id_term'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_term_of_service($data){global $conn,$time,$date;
                        $id_term=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-term']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus persyaratan layanan!";
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM term_of_service WHERE id_term='$id_term'");
                        return mysqli_affected_rows($conn);
                    }
                    function users_role($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-role']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengubah role user dengan id #".$id_user;
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE users SET id_role='$id_role' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function users_status($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['is-active']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengubah status user dengan id #".$id_user;
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE users SET is_active='$is_active' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function users_access($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $id_access=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-access']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengubah akses user dengan id #".$id_user;
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE users SET id_access='$id_access' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_users($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus akun user dengan id #".$id_user;
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    // function blank__($data){global $conn,$time,$date;}
                }
                if($_SESSION['id-role']<=3){ // => administrasi
                    function notes_type($data){global $conn,$time,$date;
                        $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['name']))));
                        $check_name=mysqli_query($conn, "SELECT * FROM notes_type WHERE name LIKE '%$name%'");
                        if(mysqli_num_rows($check_name)>0){
                            $_SESSION['message-danger']="Nama nota yang kamu masukan sudah ada, silakan masukan nama nota yang lain.";
                            header("Location: setting-nota");return false;
                        }
                        $no_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['no-nota']))));
                        $kombinasi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kombinasi']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan nota baru dengan nama ".$name;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO notes_type(name,no_nota,kombinasi,date) VALUES('$name','$no_nota','$kombinasi','$date')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_notes_type($data){global $conn,$time,$date;
                        $id_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-nota']))));
                        $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['name']))));
                        $no_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['no-nota']))));
                        $kombinasi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kombinasi']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengubah nota ".$name." dengan nomor nota ".$no_nota;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE notes_type SET no_nota='$no_nota', kombinasi='$kombinasi' WHERE id_nota='$id_nota'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_notes_type($data){global $conn,$time,$date;
                        $id_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-nota']))));
                        $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['name']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus nota ".$name;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM notes_type WHERE id_nota='$id_nota'");
                        return mysqli_affected_rows($conn);
                    }
                    function notes($data){global $conn,$time,$date,$date_search;
                        $check_users=mysqli_query($conn, "SELECT * FROM users ORDER BY id_user DESC LIMIT 1");
                        if(mysqli_num_rows($check_users)>0){
                            $row=mysqli_fetch_assoc($check_users);
                            $id_users=$row['id_user'];
                            $id_user=$id_users+1;
                        }else if(mysqli_num_rows($check_users)==0){
                            $id_user=202101;
                        }
                        $id_barang=$id_user;
                        $data_encrypt=crc32($id_user);
                        $nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nota-tinggal']))));
                        $check_tinggal=mysqli_query($conn, "SELECT * FROM notes WHERE id_nota_tinggal='$nota_tinggal'");
                        if(mysqli_num_rows($check_tinggal)>0){
                            $notes_type_tinggal=mysqli_query($conn, "SELECT * FROM notes_type WHERE name LIKE '%Nota Tinggal%'");
                            $row_notes_type_tinggal=mysqli_fetch_assoc($notes_type_tinggal);
                            $no_nota_tinggal=$row_notes_type_tinggal['no_nota'];
                            if($nota_tinggal==$no_nota_tinggal || $nota_tinggal>$no_nota_tinggal){
                                $_SESSION['message-danger']="Nomor nota tinggal saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota tinggal!";
                                header("Location: nota-tinggal");return false;
                            }else{
                                $_SESSION['message-danger']="Nomor nota tinggal yang kamu masukan sudah ada, cek kembali!";
                                header("Location: nota-tinggal");return false;
                            }
                        }else if(mysqli_num_rows($check_tinggal)==0){
                            $notes_type_tinggal=mysqli_query($conn, "SELECT * FROM notes_type WHERE name LIKE '%Nota Tinggal%'");
                            $row_notes_type_tinggal=mysqli_fetch_assoc($notes_type_tinggal);
                            $no_nota_tinggal=$row_notes_type_tinggal['no_nota'];
                            if($nota_tinggal==$no_nota_tinggal || $nota_tinggal>$no_nota_tinggal){
                                $_SESSION['message-danger']="Nomor nota tinggal yang kamu masukan saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota tinggal!";
                                header("Location: nota-tinggal");return false;
                            }
                        }
                        if(!empty($data['nota-dp'])){
                            $nota_dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nota-dp']))));
                            $check_dp=mysqli_query($conn, "SELECT * FROM notes WHERE id_nota_dp='$nota_dp'");
                            if(mysqli_num_rows($check_dp)>0){
                                $notes_type_dp=mysqli_query($conn, "SELECT * FROM notes_type WHERE name LIKE '%Nota DP%'");
                                $row_notes_type_dp=mysqli_fetch_assoc($notes_type_dp);
                                $no_nota_dp=$row_notes_type_dp['no_nota'];
                                if($nota_dp==$no_nota_dp || $nota_dp>$no_nota_dp){
                                    $_SESSION['message-danger']="Nomor nota dp yang kamu masukan saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota dp!";
                                    header("Location: nota-tinggal");return false;
                                }else{
                                    $_SESSION['message-danger']="Nomor nota dp yang kamu masukan sudah ada, cek kembali!";
                                    header("Location: nota-tinggal");return false;
                                }
                            }else if(mysqli_num_rows($check_dp)==0){
                                $notes_type_dp=mysqli_query($conn, "SELECT * FROM notes_type WHERE name LIKE '%Nota DP%'");
                                $row_notes_type_dp=mysqli_fetch_assoc($notes_type_dp);
                                $no_nota_dp=$row_notes_type_dp['no_nota'];
                                if($nota_dp==$no_nota_dp || $nota_dp>$no_nota_dp){
                                    $_SESSION['message-danger']="Nomor nota dp yang kamu masukan saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota dp!";
                                    header("Location: nota-tinggal");return false;
                                }
                            }
                        }else if(empty($data['nota-dp'])){
                            $nota_dp="-";
                        }
                        if(!empty($data['nota-dp'])){
                            if(empty($data['dp']) || $data['dp']==0){
                                $_SESSION['message-danger']="Kamu belum memasukan uang muka atau DP sementara nomor DP ada, sialakan cek lagi!";
                                header("Location: nota-tinggal");return false;
                            }
                        }
                        $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
                        $tlpn=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tlpn']))));
                        if(!empty($data['email'])){
                            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
                            $password=$email;
                        }else if(empty($data['email'])){
                            $email=$tlpn;
                            $password=$email;
                        }
                        if(!empty($data['alamat'])){
                            $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
                        }else if(empty($data['alamat'])){
                            $alamat='-';
                        }
                        $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-layanan']))));
                        if($id_layanan==1){
                            $type=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['type']))));
                            $seri_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['seri-hp']))));
                            $imei=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imei']))));
                        }else if($id_layanan==2){
                            $merek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['merek']))));
                            $seri_laptop=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['seri-laptop']))));
                        }
                        $kerusakan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kerusakan']))));
                        if(!empty($data['kondisi'])){
                            $kondisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kondisi']))));
                        }else if(empty($data['kondisi'])){
                            $kondisi="-";
                        }
                        if(!empty($data['kelengkapan'])){
                            $kelengkapan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kelengkapan']))));
                        }else if(empty($data['kelengkapan'])){
                            $kelengkapan="-";
                        }
                        $id_teknisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-teknisi']))));
                        if(!empty($data['tgl-ambil'])){
                            $tgl_ambil=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl-ambil']))));
                        }else if(empty($data['tgl-ambil'])){
                            $tgl_ambil="-";
                        }
                        if(!empty($data['dp'])){
                            $dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['dp']))));
                        }else if(empty($data['dp'])){
                            $dp=0;
                        }
                        $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['biaya']))));
                        if($biaya<=10000){
                            $_SESSION['message-danger']="Pastikan anda memasukan biaya dengan benar!";
                            header("Location: nota-tinggal");return false;
                        }
                        $barcode=barcode_notes($data_encrypt);
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan nota tinggal dengan nomor nota ".$nota_tinggal;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO users(id_user,data_encrypt,first_name,email,password,phone,address,kebijakan) VALUES('$id_user','$data_encrypt','$username','$email','$password','$tlpn','$alamat','-')");
                        if($id_layanan==1){
                            mysqli_query($conn, "INSERT INTO handphone(id_hp,type,seri,imei) VALUES('$id_barang','$type','$seri_hp','$imei')");
                        }else if($id_layanan==2){
                            mysqli_query($conn, "INSERT INTO laptop(id_laptop,merek,seri) VALUES('$id_barang','$merek','$seri_laptop')");
                        }
                        mysqli_query($conn, "INSERT INTO notes(id_nota_tinggal,id_nota_dp,id_user,id_layanan,id_barang,id_pegawai,tgl_cari,tgl_masuk,tgl_status,tgl_ambil,time,kerusakan,kondisi,kelengkapan,dp,biaya,barcode) VALUES('$nota_tinggal','$nota_dp','$id_user','$id_layanan','$id_barang','$id_teknisi','$date_search','$date','$date','$tgl_ambil','$time','$kerusakan','$kondisi','$kelengkapan','$dp','$biaya','$barcode')");
                        return mysqli_affected_rows($conn);
                    }
                    function barcode_notes($data_encrypt){global $link_qr;
                        require_once('../Vendor/phpqrcode/qrlib.php');
                        $qrvalue = $link_qr.$data_encrypt;
                        $tempDir = "../Assets/img/img-barcode-notes/";
                        $codeContents = $qrvalue;
                        $fileName = $data_encrypt.".png";
                        $pngAbsoluteFilePath = $tempDir.$fileName;
                        if(!file_exists($pngAbsoluteFilePath)){
                            QRcode::png($codeContents, $pngAbsoluteFilePath);
                        }
                        return $fileName;
                    }
                    function remake_barcode($data){global $conn,$time,$date,$link_qr;
                        require_once('../Vendor/phpqrcode/qrlib.php');
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $barcode_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['barcode-old']))));
                        $files=glob("../Assets/img/img-barcode-notes/".$barcode_old);
                        foreach ($files as $file) {
                            if (is_file($file))
                            unlink($file);
                        }
                        $data_encrypt=crc32($id_user);
                        $qrvalue = $link_qr.$data_encrypt;
                        $tempDir = "../Assets/img/img-barcode-notes/";
                        $codeContents = $qrvalue;
                        $barcode = $data_encrypt.".png";
                        $pngAbsoluteFilePath = $tempDir.$barcode;
                        if(!file_exists($pngAbsoluteFilePath)){
                            QRcode::png($codeContents, $pngAbsoluteFilePath);
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Membuat ulang barcode #".$barcode;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE notes SET barcode='$barcode' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function notes_cancel($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        if($data['id-nota']==5){
                            $id_nota=5; $id_status=6; $progress=100;
                        }else if($data['id-nota']<5){
                            $id_nota=4; $id_status=2; $progress=0;
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Merubah status nota user #".$id_user." menjadi Cancel";
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE notes SET id_nota='$id_nota', id_status='$id_status', tgl_cancel='$date', tgl_status='$date', time_status='$time', progress='$progress' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function notes_pending($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Merubah status nota user #".$id_user." menjadi Pending";
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE notes SET id_nota='1', id_status='1', tgl_status='$date', time_status='$time', progress='10' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_notes($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nota-tinggal']))));
                        $nota_dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nota-dp']))));
                        if(!empty($data['nota-dp'])){
                            if(empty($data['dp']) || $data['dp']==0){
                                $_SESSION['message-danger']="Kamu belum memasukan uang muka atau DP sementara nomor DP ada, sialakan cek lagi!";
                                header("Location: qr-aksi?auth=".$_POST['data-encrypt']);return false;
                            }
                        }
                        $nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nota-lunas']))));
                        $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
                        $tlpn=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tlpn']))));
                        if(!empty($data['email'])){
                            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
                            $password=$email;
                        }else if(empty($data['email'])){
                            $email=$tlpn;
                            $password=$email;
                        }
                        if(!empty($data['alamat'])){
                            $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
                        }else if(empty($data['alamat'])){
                            $alamat='-';
                        }
                        $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-layanan']))));
                        if($id_layanan==1){
                            $type=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['type']))));
                            $seri_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['seri-hp']))));
                            $imei=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imei']))));
                        }else if($id_layanan==2){
                            $merek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['merek']))));
                            $seri_laptop=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['seri-laptop']))));
                        }
                        $kerusakan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kerusakan']))));
                        if(!empty($data['kondisi'])){
                            $kondisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kondisi']))));
                        }else if(empty($data['kondisi'])){
                            $kondisi="-";
                        }
                        if(!empty($data['kelengkapan'])){
                            $kelengkapan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kelengkapan']))));
                        }else if(empty($data['kelengkapan'])){
                            $kelengkapan="-";
                        }
                        $id_teknisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-teknisi']))));
                        if(!empty($data['tgl-ambil'])){
                            $tgl_ambil=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl-ambil']))));
                        }else if(empty($data['tgl-ambil'])){
                            $tgl_ambil="-";
                        }
                        if(!empty($data['dp'])){
                            $dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['dp']))));
                        }else if(empty($data['dp'])){
                            $dp=0;
                        }
                        $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['biaya']))));
                        if($biaya<=10000){
                            $_SESSION['message-danger']="Pastikan anda memasukan biaya dengan benar!";
                            header("Location: nota-tinggal");return false;
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit nota tinggal dengan nomor nota ".$nota_tinggal;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        if($id_layanan==1){
                            mysqli_query($conn, "UPDATE handphone SET type='$type', seri='$seri_hp', imei='$imei' WHERE id_hp='$id_user'");
                        }else if($id_layanan==2){
                            mysqli_query($conn, "UPDATE laptop SET merek='$merek', seri='$seri_laptop' WHERE id_laptop='$id_user'");
                        }
                        mysqli_query($conn, "UPDATE users SET first_name='$username', email='$email', phone='$tlpn', address='$alamat' WHERE id_user='$id_user'");
                        mysqli_query($conn, "UPDATE notes SET id_nota_tinggal='$nota_tinggal', id_nota_dp='$nota_dp', id_nota_lunas='$nota_lunas', kerusakan='$kerusakan', kondisi='$kondisi', kelengkapan='$kelengkapan', id_pegawai='$id_teknisi', tgl_ambil='$tgl_ambil', dp='$dp', biaya='$biaya' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_notes($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus nota user #".$id_user;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        if($data['id-layanan']==1){
                            mysqli_query($conn, "DELETE FROM handphone WHERE id_hp='$id_user'");
                        }else if($data['id-layanan']==2){
                            mysqli_query($conn, "DELETE FROM laptop WHERE id_laptop='$id_user'");
                        }
                        mysqli_query($conn, "DELETE FROM notes WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function notes_report($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $data_encrypt=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['data-encrypt']))));
                        $nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nota-lunas']))));
                        $check_lunas=mysqli_query($conn, "SELECT * FROM notes WHERE id_nota_lunas='$nota_lunas'");
                        if(mysqli_num_rows($check_lunas)>0){
                            $notes_type_lunas=mysqli_query($conn, "SELECT * FROM notes_type WHERE name LIKE '%Nota Lunas%'");
                            $row_notes_type_lunas=mysqli_fetch_assoc($notes_type_lunas);
                            $no_nota_lunas=$row_notes_type_lunas['no_nota'];
                            if($nota_lunas==$no_nota_lunas || $nota_lunas>$no_nota_lunas){
                                $_SESSION['message-danger']="Nomor nota lunas saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota lunas!";
                                header("Location: qr-aksi?auth=".$data_encrypt);return false;
                            }else{
                                $_SESSION['message-danger']="Nomor nota lunas yang kamu masukan sudah ada, cek kembali!";
                                header("Location: qr-aksi?auth=".$data_encrypt);return false;
                            }
                        }else if(mysqli_num_rows($check_lunas)==0){
                            $notes_type_lunas=mysqli_query($conn, "SELECT * FROM notes_type WHERE name LIKE '%Nota Lunas%'");
                            $row_notes_type_lunas=mysqli_fetch_assoc($notes_type_lunas);
                            $no_nota_lunas=$row_notes_type_lunas['no_nota'];
                            if($nota_lunas==$no_nota_lunas || $nota_lunas>$no_nota_lunas){
                                $_SESSION['message-danger']="Nomor nota lunas yang kamu masukan saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota lunas!";
                                header("Location: qr-aksi?auth=".$data_encrypt);return false;
                            }
                        }
                        if($data['id-nota']==3){
                            $garansi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['garansi']))));
                        }else if($data['id-nota']==5){
                            $garansi="GARANSI TERPAKAI";
                        }
                        $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ket']))));
                        if(!empty($ket)){
                            $ket_img=ket_img($data_encrypt);
                            if(!$ket_img){
                                return false;
                            }
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Nota dimasukan ke laporan";
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $check_sparepart=mysqli_query($conn, "SELECT * FROM laporan_spareparts WHERE id_user='$id_user'");
                        if(mysqli_num_rows($check_sparepart)>0){
                            mysqli_query($conn, "UPDATE laporan_spareparts SET status_sparepart='4' WHERE id_user='$id_user' ORDER BY id_sparepart DESC LIMIT 1");
                        }
                        mysqli_query($conn, "UPDATE notes SET id_nota='5', id_status='6', tgl_laporan='$date', tgl_status='$date', id_nota_lunas='$nota_lunas', garansi='$garansi', ket_text='$ket', ket_img='$ket_img' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function ket_img($data_encrypt){
                        $namaFile=$_FILES["ket-img"]["name"];
                        $ukuranFile=$_FILES["ket-img"]["size"];
                        $tmpName=$_FILES["ket-img"]["tmp_name"];
                        $ekstensiGambarValid=['jpg','jpeg','png'];
                        $ekstensiGambar=explode('.',$namaFile);
                        $ekstensiGambar=strtolower(end($ekstensiGambar));
                        if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
                            $_SESSION['message-danger']="Maaf, bukan gambar!";
                            header("Location: ../Views/qr-aksi?auth=".$data_encrypt);
                            return false;
                        }
                        if($ukuranFile>2000000){
                            $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2MB)";
                            header("Location: ../Views/qr-aksi?auth=".$data_encrypt);
                            return false;
                        }
                        $verifyPhoto=$data_encrypt.".jpg";
                        move_uploaded_file($tmpName,'../Assets/img/img-notes/'.$verifyPhoto);
                        return $verifyPhoto;
                    }
                    function notes_garansi($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Melakukan perbaikan ulang dari garansi client.";
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE notes SET id_status='1', tgl_status='$date', garansi='GARANSI TERPAKAI', progress='10' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function notes_lunas($data){global $conn,$time,$date,$date_search;
                        $check_users=mysqli_query($conn, "SELECT * FROM users ORDER BY id_user DESC LIMIT 1");
                        if(mysqli_num_rows($check_users)>0){
                            $row=mysqli_fetch_assoc($check_users);
                            $id_users=$row['id_user'];
                            $id_user=$id_users+1;
                        }else if(mysqli_num_rows($check_users)==0){
                            $id_user=202101;
                        }
                        $id_barang=$id_user;
                        $data_encrypt=crc32($id_user);
                        $nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nota-lunas']))));
                        $check_lunas=mysqli_query($conn, "SELECT * FROM notes WHERE id_nota_lunas='$nota_lunas'");
                        if(mysqli_num_rows($check_lunas)>0){
                            $notes_type_lunas=mysqli_query($conn, "SELECT * FROM notes_type WHERE name LIKE '%Nota Lunas%'");
                            $row_notes_type_lunas=mysqli_fetch_assoc($notes_type_lunas);
                            $no_nota_lunas=$row_notes_type_lunas['no_nota'];
                            if($nota_lunas==$no_nota_lunas || $nota_lunas>$no_nota_lunas){
                                $_SESSION['message-danger']="Nomor nota lunas saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota lunas!";
                                header("Location: nota-lunas");return false;
                            }else{
                                $_SESSION['message-danger']="Nomor nota lunas yang kamu masukan sudah ada, cek kembali!";
                                header("Location: nota-lunas");return false;
                            }
                        }else if(mysqli_num_rows($check_lunas)==0){
                            $notes_type_lunas=mysqli_query($conn, "SELECT * FROM notes_type WHERE name LIKE '%Nota Lunas%'");
                            $row_notes_type_lunas=mysqli_fetch_assoc($notes_type_lunas);
                            $no_nota_lunas=$row_notes_type_lunas['no_nota'];
                            if($nota_lunas==$no_nota_lunas || $nota_lunas>$no_nota_lunas){
                                $_SESSION['message-danger']="Nomor nota lunas yang kamu masukan saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota lunas!";
                                header("Location: nota-lunas");return false;
                            }
                        }
                        $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
                        $tlpn=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tlpn']))));
                        if(!empty($data['email'])){
                            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
                            $password=$email;
                        }else if(empty($data['email'])){
                            $email=$tlpn;
                            $password=$email;
                        }
                        if(!empty($data['alamat'])){
                            $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
                        }else if(empty($data['alamat'])){
                            $alamat='-';
                        }
                        $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-layanan']))));
                        if($id_layanan==1){
                            $type=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['type']))));
                            $seri_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['seri-hp']))));
                            $imei=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imei']))));
                        }else if($id_layanan==2){
                            $merek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['merek']))));
                            $seri_laptop=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['seri-laptop']))));
                        }
                        $kerusakan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kerusakan']))));
                        $id_teknisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-teknisi']))));
                        $garansi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['garansi']))));
                        $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ket']))));
                        if(!empty($ket)){
                            $ket_img=ket_img_lunas($data_encrypt);
                            if(!$ket_img){
                                return false;
                            }
                        }
                        $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['biaya']))));
                        if($biaya<=10000){
                            $_SESSION['message-danger']="Pastikan anda memasukan biaya dengan benar!";
                            header("Location: nota-lunas");return false;
                        }
                        $barcode=barcode_notes_lunas($data_encrypt);
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan nota tinggal dengan nomor nota ".$nota_lunas;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO users(id_user,data_encrypt,first_name,email,password,phone,address,kebijakan) VALUES('$id_user','$data_encrypt','$username','$email','$password','$tlpn','$alamat','-')");
                        if($id_layanan==1){
                            mysqli_query($conn, "INSERT INTO handphone(id_hp,type,seri,imei) VALUES('$id_barang','$type','$seri_hp','$imei')");
                        }else if($id_layanan==2){
                            mysqli_query($conn, "INSERT INTO laptop(id_laptop,merek,seri) VALUES('$id_barang','$merek','$seri_laptop')");
                        }
                        mysqli_query($conn, "INSERT INTO notes(id_nota,id_nota_lunas,id_user,id_layanan,id_barang,id_pegawai,id_status,tgl_cari,tgl_masuk,tgl_lunas,tgl_status,tgl_ambil,time,time_status,kerusakan,ket_text,ket_img,garansi,biaya,barcode,progress) VALUES('5','$nota_lunas','$id_user','$id_layanan','$id_barang','$id_teknisi','6','$date_search','$date','$date','$date','$date','$time','$time','$kerusakan','$ket','$ket_img','$garansi','$biaya','$barcode','100')");
                        return mysqli_affected_rows($conn);
                    }
                    function barcode_notes_lunas($data_encrypt){global $link_qr;
                        require_once('../Vendor/phpqrcode/qrlib.php');
                        $qrvalue = $link_qr.$data_encrypt;
                        $tempDir = "../Assets/img/img-barcode-notes/";
                        $codeContents = $qrvalue;
                        $fileName = $data_encrypt.".png";
                        $pngAbsoluteFilePath = $tempDir.$fileName;
                        if(!file_exists($pngAbsoluteFilePath)){
                            QRcode::png($codeContents, $pngAbsoluteFilePath);
                        }
                        return $fileName;
                    }
                    function ket_img_lunas($data_encrypt){
                        $namaFile=$_FILES["ket-img"]["name"];
                        $ukuranFile=$_FILES["ket-img"]["size"];
                        $tmpName=$_FILES["ket-img"]["tmp_name"];
                        $ekstensiGambarValid=['jpg','jpeg','png'];
                        $ekstensiGambar=explode('.',$namaFile);
                        $ekstensiGambar=strtolower(end($ekstensiGambar));
                        if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
                            $_SESSION['message-danger']="Maaf, bukan gambar!";
                            header("Location: ../Views/nota-lunas");
                            return false;
                        }
                        if($ukuranFile>2000000){
                            $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2MB)";
                            header("Location: ../Views/nota-lunas");
                            return false;
                        }
                        $verifyPhoto=$data_encrypt.".jpg";
                        move_uploaded_file($tmpName,'../Assets/img/img-notes/'.$verifyPhoto);
                        return $verifyPhoto;
                    }
                    function report_expense($data){global $conn,$time,$date,$date_search;
                        $jenis=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jenis']))));
                        $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ket']))));
                        $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['biaya']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Memasukan data pengeluaran jenis: ".$jenis." dengan biaya ".$biaya;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO laporan_pengeluaran(jenis_pengeluaran,ket,biaya_pengeluaran,tgl_pengeluaran,tgl_cari,time) VALUES('$jenis','$ket','$biaya','$date','$date_search','$time')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_report_expense($data){global $conn,$time,$date;
                        $id_pengeluaran=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-pengeluaran']))));
                        $jenis=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jenis']))));
                        $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ket']))));
                        $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['biaya']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit data pengeluaran dengan id: ".$id_pengeluaran;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE laporan_pengeluaran SET jenis_pengeluaran='$jenis', ket='$ket', biaya_pengeluaran='$biaya' WHERE id_pengeluaran='$id_pengeluaran'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_report_expense($data){global $conn,$time,$date;
                        $id_pengeluaran=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-pengeluaran']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus data pengeluaran dengan id: ".$id_pengeluaran;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM laporan_pengeluaran WHERE id_pengeluaran='$id_pengeluaran'");
                        return mysqli_affected_rows($conn);
                    }
                    function report_sparepart_qr($data){global $conn,$time,$date,$date_search;
                        $cek_idSparepart=mysqli_query($conn, "SELECT * FROM laporan_spareparts ORDER BY id_sparepart DESC LIMIT 1");
                        $loop_idSparepart=mysqli_fetch_assoc($cek_idSparepart);
                        if(isset($loop_idSparepart['id_sparepart'])){
                            $idSparepart=$loop_idSparepart['id_sparepart'];
                            $id_sparepart=$idSparepart+1;
                        }else if(!isset($loop_idSparepart['id_sparepart'])){
                            $id_sparepart=1;
                        }
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $id_teknisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-teknisi']))));
                        $id_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-nota']))));
                        $data_encrypt=crc32($id_sparepart);
                        $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ket']))));
                        $suplayer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['suplayer']))));
                        $harga=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['harga']))));
                        $total=$harga*1;
                        $ket_plus=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ket-plus']))));
                        require_once('../Assets/vendor/autoload.php');
                        $Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
                        $barcode = $Bar->getBarcode($data_encrypt, $Bar::TYPE_CODE_128);
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan data sparepart dengan ket ".$ket.", suplayer ".$suplayer." dan harga ".$harga;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO laporan_spareparts(id_user,data_encrypt,tgl_masuk,tgl_cari,time,ket,suplayer,jmlh_barang,harga,total,ket_plus,id_pegawai,id_nota,barcode,status_sparepart) VALUES('$id_user','$data_encrypt','$date','$date_search','$time','$ket','$suplayer','1','$harga','$total','$ket_plus','$id_teknisi','$id_nota','$barcode','2')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_report_sparepart_qr($data){global $conn,$time,$date;
                        $id_sparepart=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-sparepart']))));
                        $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ket']))));
                        $suplayer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['suplayer']))));
                        $harga=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['harga']))));
                        $total=$harga*1;
                        $ket_plus=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ket-plus']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit data sparepart dengan ket ".$ket.", suplayer ".$suplayer." dan harga ".$harga;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE laporan_spareparts SET ket='$ket', suplayer='$suplayer', harga='$harga', total='$total', ket_plus='$ket_plus' WHERE id_sparepart='$id_sparepart'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_report_sparepart_qr($data){global $conn,$time,$date;
                        $id_sparepart=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-sparepart']))));
                        $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ket']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus sparepart dengan id sparepart #".$id_sparepart." sparepart ".$ket;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM laporan_spareparts WHERE id_sparepart='$id_sparepart'");
                        return mysqli_affected_rows($conn);
                    }
                    function report_sparepart($data){global $conn,$time,$date,$date_search,$link_qr;
                        $cek_idSparepart=mysqli_query($conn, "SELECT * FROM laporan_spareparts ORDER BY id_sparepart DESC LIMIT 1");
                        $loop_idSparepart=mysqli_fetch_assoc($cek_idSparepart);
                        if(isset($loop_idSparepart['id_sparepart'])){
                            $idSparepart=$loop_idSparepart['id_sparepart'];
                            $id_sparepart=$idSparepart+1;
                        }else if(!isset($loop_idSparepart['id_sparepart'])){
                            $id_sparepart=1;
                        }
                        $data_encrypt=crc32($id_sparepart);
                        $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ket']))));
                        $suplayer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['suplayer']))));
                        $jumlah=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jumlah']))));
                        $harga=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['harga']))));
                        $total=$harga*$jumlah;
                        $ket_plus=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ket-plus']))));
                        require_once('../Vendor/phpqrcode/qrlib.php');
                        $qrvalue = $link_qr.$data_encrypt;
                        $tempDir = "../Assets/img/img-barcode-spareparts/";
                        $codeContents = $qrvalue;
                        $barcode = $data_encrypt.".png";
                        $pngAbsoluteFilePath = $tempDir.$barcode;
                        if(!file_exists($pngAbsoluteFilePath)){
                            QRcode::png($codeContents, $pngAbsoluteFilePath);
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan data sparepart dengan ket ".$ket.", suplayer ".$suplayer." dan harga ".$harga;
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO laporan_spareparts(data_encrypt,tgl_masuk,tgl_cari,time,ket,suplayer,jmlh_barang,harga,total,ket_plus,qrcode,status_sparepart) VALUES('$data_encrypt','$date','$date_search','$time','$ket','$suplayer','$jumlah','$harga','$total','$ket_plus','$barcode','1')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_report_sparepart($data){global $conn,$time,$date;}
                    function delete_report_sparepart($data){global $conn,$time,$date;}
                    // function blank__($data){global $conn,$time,$date;}
                }
                if($_SESSION['id-role']<=5){ // => teknisi & web dev/des
                    function notes_progress($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Merubah status nota user #".$id_user." menjadi On Progress";
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE notes SET id_status='3', tgl_status='$date', time_status='$time', progress='50' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function notes_waiting($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Merubah status nota user #".$id_user." menjadi Waiting to be taken";
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE notes SET id_status='4', tgl_ambil='$date', tgl_status='$date', time_status='$time', progress='75' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function notes_success($data){global $conn,$time,$date;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
                        if($data['id-nota']==5){
                            $id_nota=5;
                        }else if($data['id-nota']<5){
                            $id_nota=3;
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Merubah status nota user #".$id_user." menjadi Finish/Success";
                        mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $check_sparepart=mysqli_query($conn, "SELECT * FROM laporan_spareparts WHERE id_user='$id_user'");
                        if(mysqli_num_rows($check_sparepart)>0){
                            mysqli_query($conn, "UPDATE laporan_spareparts SET status_sparepart='3' WHERE id_user='$id_user' ORDER BY id_sparepart DESC LIMIT 1");
                        }
                        mysqli_query($conn, "UPDATE notes SET id_nota='$id_nota', id_status='5', tgl_lunas='$date', tgl_status='$date', time_status='$time', progress='100' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    // function blank__($data){global $conn,$time,$date;}
                }
                if($_SESSION['id-role']==7){ // => users
                    // function blank__($data){global $conn,$time,$date;}
                }
        }


        // == data lama
        if(isset($_SESSION['id-employee'])){
            if(isset($_SESSION['id-role'])){
                if($_SESSION['id-role']<13){
                    
                    function add_pickup_sparepart($add){global $conn, $time;
                        $id_sparepart=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-sparepart']))));
                        $barang=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['barang']))));
                        $no_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['no-nota']))));
                        // $id_nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-nota-tinggal']))));
                        // $id_nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-nota-lunas']))));
                        // $id_nota_manual=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-nota-manual']))));
                        // if($id_nota_tinggal==0 || empty($id_nota_tinggal) || $id_nota_lunas==0 || empty($id_nota_lunas) || empty($id_nota_manual)){
                        //     $_SESSION['message-danger']="Maaf, anda belum mengisi atau memilih nota!";
                        //     header("Location: pickup-sparepart");return false;
                        // }else if($id_nota_tinggal>0 || !empty($id_nota_tinggal)){
                        //     $no_nota=$id_nota_tinggal;
                        // }else if($id_nota_lunas>0 || !empty($id_nota_lunas)){
                        //     $no_nota=$id_nota_lunas;
                        // }else if(!empty($id_nota_manual)){
                        //     $no_nota=$id_nota_manual;
                        // }
                        $id_teknisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-teknisi']))));
                        if(empty($id_teknisi)){
                            $_SESSION['message-danger']="Maaf, anda belum memilih teknisi!";
                            header("Location: pickup-sparepart");return false;
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Menambah data sparepart di pickup dengan kode ".$id_sparepart;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        if($barang>1){
                            $barang_baru=$barang-1;
                            $cek_idSparepart=mysqli_query($conn, "SELECT * FROM laporan_spareparts ORDER BY id_sparepart DESC LIMIT 1");
                            $loop_idSparepart=mysqli_fetch_assoc($cek_idSparepart);
                            if(isset($loop_idSparepart['id_sparepart'])){
                                $idSparepart=$loop_idSparepart['id_sparepart'];
                                $id_sparepart_new=$idSparepart+1;
                            }else if(!isset($loop_idSparepart['id_sparepart'])){
                                $id_sparepart_new=202027;
                            }
                            $sparepart=mysqli_query($conn, "SELECT * FROM laporan_spareparts WHERE id_sparepart='$id_sparepart'");
                            $row=mysqli_fetch_assoc($sparepart);
                            $tgl_masuk=$row['tgl_masuk'];
                            $tgl_cari=$row['tgl_cari'];
                            $time=$row['time'];
                            $ket=$row['ket'];
                            $suplayer=$row['suplayer'];
                            $harga=$row['harga'];
                            $ket_plus=$row['ket_plus'];
                            $barcode=$row['barcode'];
                            mysqli_query($conn, "UPDATE laporan_spareparts SET jmlh_barang='$barang_baru' WHERE id_sparepart='$id_sparepart'");
                            mysqli_query($conn, "INSERT INTO laporan_spareparts(id_sparepart,tgl_masuk,tgl_cari,time,ket,suplayer,jmlh_barang,harga,total,ket_plus,id_pegawai,id_nota,barcode,status_sparepart) VALUES('$id_sparepart_new','$tgl_masuk','$tgl_cari','$time','$ket','$suplayer','1','$harga','$harga','$ket_plus','$id_teknisi','$no_nota','$barcode','2')");
                        }else if($barang==1){
                            mysqli_query($conn, "UPDATE laporan_spareparts SET id_nota='$no_nota', id_pegawai='$id_teknisi', status_sparepart='2' WHERE id_sparepart='$id_sparepart'");
                        }
                        return mysqli_affected_rows($conn);
                    }
                    function edit_report_sparepart($edit){global $conn,$time;
                        $id_sparepart=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-sparepart']))));
                        $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['ket']))));
                        $suplayer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['suplayer']))));
                        $jumlah_barang=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['jumlah-barang']))));
                        $harga=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['harga']))));
                        $total=$harga*$jumlah_barang;
                        $ket_plus=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['ket-plus']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit data sparepart dengan ket ".$ket;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "UPDATE laporan_spareparts SET ket='$ket', suplayer='$suplayer', jmlh_barang='$jumlah_barang', harga='$harga', total='$total', ket_plus='$ket_plus' WHERE id_sparepart='$id_sparepart'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_report_sparepart($delete){global $conn,$time;
                        $id_sparepart=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $delete['id-sparepart']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus data sparepart dengan id ".$id_sparepart;
                        $date_log=date('l, d M Y');
                        $files2=glob("../assets/img/img-barcode-sparepart/".$id_sparepart.".png");
                        foreach($files2 as $file){
                            if(is_file($file))
                            unlink($file);
                        }
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "DELETE FROM laporan_spareparts WHERE id_sparepart='$id_sparepart'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_cal_days($del){global $conn,$time;
                        $id_cal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-cal']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus data Kalkulasi harian dengan id ".$id_cal;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "DELETE FROM cal_days WHERE id_cal='$id_cal'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_cal_month($del){global $conn,$time;
                        $id_month=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-month']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus data Kalkulasi bulanan dengan id ".$id_month;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "DELETE FROM cal_month WHERE id_montly='$id_month'");
                        return mysqli_affected_rows($conn);
                    }
                }
            }
            
            // class covid_19{
                function ya_halodoc($ques){
                    global $conn;
                    $count_ques=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ques['count_ques']))));
                    $cate_yes=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ques['count_cate_yes']))));
                    $cate_no=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ques['count_cate_no']))));
                    $count_ques_next=$count_ques+1;
                    if($count_ques_next==2){
                        $covid=mysqli_query($conn, "SELECT * FROM covid_question WHERE id_ques=2");
                        $row=mysqli_fetch_assoc($covid);
                        $question=$row['question'];
                        $count_cate_yes=$cate_yes+1;
                        $_SESSION['test-halodoc']=$question;
                        $_SESSION['count-ques']=$count_ques_next;
                        $_SESSION['count-cate-yes']=$count_cate_yes;
                        $_SESSION['count-cate-no']=$cate_no;
                        return mysqli_affected_rows($conn);
                    }else if($count_ques_next==3){
                        $covid=mysqli_query($conn, "SELECT * FROM covid_question WHERE id_ques=3");
                        $row=mysqli_fetch_assoc($covid);
                        $question=$row['question'];
                        $count_cate_yes=$cate_yes+1;
                        $_SESSION['test-halodoc']=$question;
                        $_SESSION['count-ques']=$count_ques_next;
                        $_SESSION['count-cate-yes']=$count_cate_yes;
                        $_SESSION['count-cate-no']=$cate_no;
                        return mysqli_affected_rows($conn);
                    }else if($count_ques_next==4){
                        $covid=mysqli_query($conn, "SELECT * FROM covid_question WHERE id_ques=4");
                        $row=mysqli_fetch_assoc($covid);
                        $question=$row['question'];
                        $count_cate_yes=$cate_yes+1;
                        $_SESSION['test-halodoc']=$question;
                        $_SESSION['count-ques']=$count_ques_next;
                        $_SESSION['count-cate-yes']=$count_cate_yes;
                        $_SESSION['count-cate-no']=$cate_no;
                        return mysqli_affected_rows($conn);
                    }else if($count_ques_next==5){
                        if($cate_yes>2){
                            $_SESSION['cate']=2;
                            $_SESSION['retest-halodoc']=1;
                            return mysqli_affected_rows($conn);
                        }else if($cate_no>2){
                            $_SESSION['cate']=1;
                            $_SESSION['retest-halodoc']=1;
                            return mysqli_affected_rows($conn);
                        }
                    }
                }
                function tidak_halodoc($ques){
                    global $conn;
                    $count_ques=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ques['count_ques']))));
                    $cate_yes=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ques['count_cate_yes']))));
                    $cate_no=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $ques['count_cate_no']))));
                    $count_ques_next=$count_ques+1;
                    if($count_ques_next==2){
                        $covid=mysqli_query($conn, "SELECT * FROM covid_question WHERE id_ques=2");
                        $row=mysqli_fetch_assoc($covid);
                        $question=$row['question'];
                        $count_cate_no=$cate_no+1;
                        $_SESSION['test-halodoc']=$question;
                        $_SESSION['count-ques']=$count_ques_next;
                        $_SESSION['count-cate-no']=$count_cate_no;
                        $_SESSION['count-cate-yes']=$cate_yes;
                        return mysqli_affected_rows($conn);
                    }else if($count_ques_next==3){
                        $covid=mysqli_query($conn, "SELECT * FROM covid_question WHERE id_ques=3");
                        $row=mysqli_fetch_assoc($covid);
                        $question=$row['question'];
                        $count_cate_no=$cate_no+1;
                        $_SESSION['test-halodoc']=$question;
                        $_SESSION['count-ques']=$count_ques_next;
                        $_SESSION['count-cate-no']=$count_cate_no;
                        $_SESSION['count-cate-yes']=$cate_yes;
                        return mysqli_affected_rows($conn);
                    }else if($count_ques_next==4){
                        $covid=mysqli_query($conn, "SELECT * FROM covid_question WHERE id_ques=4");
                        $row=mysqli_fetch_assoc($covid);
                        $question=$row['question'];
                        $count_cate_no=$cate_no+1;
                        $_SESSION['test-halodoc']=$question;
                        $_SESSION['count-ques']=$count_ques_next;
                        $_SESSION['count-cate-no']=$count_cate_no;
                        $_SESSION['count-cate-yes']=$cate_yes;
                        return mysqli_affected_rows($conn);
                    }else if($count_ques_next==5){
                        if($cate_no>2){
                            $_SESSION['cate']=1;
                            $_SESSION['retest-halodoc']=1;
                            return mysqli_affected_rows($conn);
                        }else if($cate_yes>2){
                            $_SESSION['cate']=2;
                            $_SESSION['retest-halodoc']=1;
                            return mysqli_affected_rows($conn);
                        }
                    }
                }
            // }

        }
    // }