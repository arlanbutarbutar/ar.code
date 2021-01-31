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
                        $_SESSION['id-log']=$row['id_log'];
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
            if(password_verify($email_pass, $email)){
                mysqli_query($conn, "UPDATE users SET is_active='1' WHERE data_encrypt='$crypt'");
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
    // == class Private =={
        if(isset($_SESSION['id-employee'])){
            if(isset($_SESSION['id-role'])){
                if($_SESSION['id-role']<13){
                    $akses_hp=202027;$akses_laptop=202028;
                    $link_log="http://localhost/arcode/views/";
                    function web_access(){global $conn;
                        $web_access=mysqli_query($conn, "SELECT * FROM web_access");
                        $row_web_access=mysqli_fetch_assoc($web_access);
                        $id_web_access=$row_web_access['id_web_access'];
                        $is_active=$row_web_access['is_active'];
                        if($is_active==1){
                            $_SESSION['aksi']="Server administrasi UGD HP telah ditutup!";
                            $is_active_new=2;
                            mysqli_query($conn, "UPDATE web_access SET is_active='$is_active_new' WHERE id_web_access='$id_web_access'");
                            return mysqli_affected_rows($conn);
                        }else if($is_active==2){
                            $_SESSION['aksi']="Server administrasi UGD HP telah dibuka!";
                            $is_active_new=1;
                            mysqli_query($conn, "UPDATE web_access SET is_active='$is_active_new' WHERE id_web_access='$id_web_access'");
                            return mysqli_affected_rows($conn);
                        }
                    }
                    function edit_profile_employee($edit){global $conn,$time;
                        $id_employee=addslashes(trim($edit['id-employee']));
                        $img=upload_photo_employee($id_employee);
                        if(!$img){
                            return false;
                        }
                        $img_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['img-old']))));
                        if(!empty($img_old)){
                            unlink('../assets/img/img-employee/'.$img_old);
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Ubah foto profile.";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE employee SET img='$img' WHERE id_employee='$id_employee'");
                        return mysqli_affected_rows($conn);
                    }
                    function upload_photo_employee($id_employee){global $conn;
                        $namaFile=$_FILES["gambar"]["name"];
                        $ukuranFile=$_FILES["gambar"]["size"];
                        $error=$_FILES["gambar"]["error"];
                        $tmpName=$_FILES["gambar"]["tmp_name"];
                        if($error===4){
                            $_SESSION['message-danger']="Pilih gambar profil Anda!";
                            header("Location: ../views/profile");
                            return false;
                        }
                        $ekstensiGambarValid=['jpg','jpeg','png'];
                        $ekstensiGambar=explode('.',$namaFile);
                        $ekstensiGambar=strtolower(end($ekstensiGambar));
                        if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
                            $_SESSION['message-danger']="Maaf, bukan gambar!";
                            header("Location: ../views/profile");
                            return false;
                        }
                        if($ukuranFile>2000000){
                            $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2MB)";
                            header("Location: ../views/profile");
                            return false;
                        }
                        $scripting=htmlspecialchars(addslashes(trim(mysqli_escape_string($conn, $namaFile))));
                        $hashPhoto=md5($scripting);
                        $verifyPhoto=$id_employee.$hashPhoto.".jpg";
                        move_uploaded_file($tmpName,'../assets/img/img-employee/'.$verifyPhoto);
                        return $verifyPhoto;
                    }
                    function edit_email_employee($edit){global $conn,$time;
                        $id_employee=addslashes(trim($edit['id-employee']));
                        $id_employee_hash=password_hash($id_employee, PASSWORD_DEFAULT);
                        $first_name=addslashes(trim($edit['first-name']));
                        $email_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['email-old']))));
                        $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['email']))));
                        $cek_users=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
                        if(mysqli_num_rows($cek_users)>0){
                            $_SESSION['message-danger']='Maaf, akun yang ingin anda ubah: '. $email .' sudah ada atau telah dipakai!';
                            header("Location: profile");
                            return false;
                        }else if(mysqli_num_rows($cek_users)==0){
                            $cek_employee=mysqli_query($conn, "SELECT * FROM employee WHERE email='$email'");
                            if(mysqli_num_rows($cek_employee)>0){
                                $_SESSION['message-danger']='Maaf, akun yang ingin anda ubah: '. $email .' sudah ada atau telah dipakai!';
                                header("Location: profile");
                                return false;
                            }
                        }
                        $is_active=2;
                        require "mail-send.php";
                        $to       = $email;
                        $subject  = 'Verification Service Netmedia Framecode';
                        $message  = '
                            <div style="margin: 0; padding: 0;">
                                <p>Silakan klik link di bawah ini untuk verifikasi ulang akun anda:</p><br>
                                <a href="https://www.ugdhp.com/auth/verification-success?u='.$id_employee_hash.'&c='.$id_employee.'" style="font-weight: bold">'.$id_employee_hash.'</a>
                                <p>Kode ini bersifat rahasia jangan berikan kepada siapapun itu. Baca juga peraturan kebijakan layanan kami di
                                    <a href="https://www.ugdhp.com/terms-conditions" style="text-decoration: none;">disini</a>
                                </p>
                            </div>';
                        smtp_mail($to, $subject, $message, '', '', 0, 0, true);
                        $id_log=$_SESSION['id-log'];
                        $log="Ubah email dari ".$email_old." menjadi email baru ".$email.".";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE employee SET email='$email', is_active='$is_active' WHERE id_employee='$id_employee'");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_data_employee($edit){global $conn,$time;
                        $id_employee=addslashes(trim($edit['id-employee']));
                        $first_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['first-name']))));
                        $last_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['last-name']))));
                        $phone=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['phone']))));
                        $address=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['address']))));
                        $postal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['postal']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Ubah biodata diri menjadi ".$first_name." ".$last_name.", nomor handphone ".$phone.", alamat ".$address.", kode pos ".$postal.".";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log VALUES('','$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE employee SET first_name='$first_name', last_name='$last_name', phone='$phone', address='$address', postal='$postal' WHERE id_employee='$id_employee'");
                        return mysqli_affected_rows($conn);
                    }
                    function tambah_user_terpercaya($add){
                        global $conn;
                        // code
                    }
                    function hapus_user_dipercaya($del){
                        global $conn;
                        // code
                    }
                    function ubah_sandi_employee($edit){global $conn,$time;
                        $id_employee=addslashes(trim($edit['id-employee']));
                        $id_security=addslashes(trim($edit['id-security']));
                        $password=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['password']))));
                        $kata_sandi1=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['kata-sandi1']))));
                        $kata_sandi2=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['kata-sandi2']))));
                        $employee=mysqli_query($conn, "SELECT * FROM employee WHERE id_employee='$id_employee'");
                        $row=mysqli_fetch_assoc($employee);
                        $hash=$row['password'];
                        if(password_verify($password, $hash)){
                            if($kata_sandi1!=$kata_sandi2){
                                $_SESSION['message-danger']="Maaf, kata sandi baru yang anda masukan tidak sama!";
                                header("Location: settings");
                                return false;
                            }
                            $cekPass=strlen($kata_sandi1);
                            if($cekPass<8){
                                $_SESSION['message-danger']="Maaf, kata sandi baru kamu terlalu pendek (Min: 8)!";
                                header("Location: settings");
                                return false;
                            }
                            $employee_security=mysqli_query($conn, "SELECT * FROM employee_security WHERE id_security='$id_security'");
                            $row=mysqli_fetch_assoc($employee_security);
                            $pass_sec=$row['password'];
                            if($kata_sandi1==$pass_sec){
                                $_SESSION['message-danger']="Kata sandi baru kamu sama dengan kata sandi lama!";
                                header("Location: settings");
                                return false;
                            }
                            $new_password=password_hash($kata_sandi1,PASSWORD_DEFAULT);
                            $id_log=$_SESSION['id-log'];
                            $log="Ubah kata sandi menjadi ".$new_password.". Kata sandi anda dipastikan aman.";
                            $date=date('l, d M Y');
                            mysqli_query($conn, "INSERT INTO employee_log VALUES('','$id_log','$log','$date','$time')");
                            mysqli_query($conn, "UPDATE employee SET password='$new_password' WHERE id_employee='$id_employee'");
                            mysqli_query($conn, "UPDATE employee_security SET password='$kata_sandi1' WHERE id_security='$id_security'");
                            return mysqli_affected_rows($conn);
                        }else{
                            $_SESSION['message-danger']="Periksa kembali kata sandi kamu saat ini, tidak sesuai!";
                            header("Location: settings");
                            return false;
                        }
                    }
                    function edit_logo_web($edit){global $conn;
                        $id_about=addslashes(trim($edit['id-about']));
                        $img=upload_logo_web($id_about);
                        if(!$img){
                            return false;
                        }
                        $img_old=addslashes(trim($edit['img-provider']));
                        if(!empty($img_old)){
                            unlink('../assets/img/img-web-server/'.$img_old);
                        }
                        mysqli_query($conn, "UPDATE snf_about SET img_provider='$img' WHERE id_about='$id_about'");
                        return mysqli_affected_rows($conn);
                    }
                    function upload_logo_web($id_about){global $conn;
                        $namaFile=$_FILES["gambar"]["name"];
                        $ukuranFile=$_FILES["gambar"]["size"];
                        $error=$_FILES["gambar"]["error"];
                        $tmpName=$_FILES["gambar"]["tmp_name"];
                        if($error===4){
                            $_SESSION['message-danger']="Pilih gambar profil Anda!";
                            header("Location: ../views/about");
                            return false;
                        }
                        $ekstensiGambarValid=['jpg','jpeg','png'];
                        $ekstensiGambar=explode('.',$namaFile);
                        $ekstensiGambar=strtolower(end($ekstensiGambar));
                        if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
                            $_SESSION['message-danger']="Maaf, bukan gambar!";
                            header("Location: ../views/about");
                            return false;
                        }
                        if($ukuranFile>2000000){
                            $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2MB)";
                            header("Location: ../views/about");
                            return false;
                        }
                        $scripting=htmlspecialchars(addslashes(trim(mysqli_escape_string($conn, $namaFile))));
                        $hashPhoto=md5($scripting);
                        $verifyPhoto=$id_about.$hashPhoto.".png";
                        move_uploaded_file($tmpName,'../assets/img/img-web-server/'.$verifyPhoto);
                        return $verifyPhoto;
                    }
                    function edit_data_aboutweb($edit){global $conn;
                        $id_about=addslashes(trim($edit['id-about']));
                        $name_provider=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['name-provider']))));
                        $founder=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['founder']))));
                        $link_web=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['link-web']))));
                        $server=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['server']))));
                        $date_created=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['date-created']))));
                        mysqli_query($conn, "UPDATE snf_about SET name_provider='$name_provider', founder='$founder', link_web='$link_web', server='$server', date_created='$date_created' WHERE id_about='$id_about'");
                        return mysqli_affected_rows($conn);
                    }
                    function add_menu($add){global $conn,$time;
                        $menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['menu']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan menu management baru bernama ".$menu.".";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO menu(menu) VALUES('$menu')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_menu($edit){global $conn,$time;
                        $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-menu']))));
                        $menu_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['menu-old']))));
                        $menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['menu']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit menu management dari nama ".$menu_old." menjadi ".$menu.".";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE menu SET menu='$menu' WHERE id_menu='$id_menu'");
                        return mysqli_affected_rows($conn);
                    }
                    function del_menu($del){global $conn,$time;
                        $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-menu']))));
                        $menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['menu']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus menu management dengan nama ".$menu.".";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM menu WHERE id_menu='$id_menu'");
                        return mysqli_affected_rows($conn);
                    }
                    function add_sub_menu($add){global $conn,$time;
                        $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-menu']))));
                        $title=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['title']))));
                        $url=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['url']))));
                        $icon=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['icon']))));
                        $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['is_active']))));
                        $category=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['category']))));
                        $id_log=$_SESSION['id-log'];
                        $date=date('l, d M Y');
                        if($category==1){
                            $log="Menambahkan sub menu standart dengan nama ".$title.", url ".$url;
                            mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            mysqli_query($conn, "INSERT INTO menu_sub(id_menu,title,url,icon,is_active,category) VALUES('$id_menu','$title','$url','$icon','$is_active','$category')");
                            fopen($url.".php",'w');
                            return mysqli_affected_rows($conn);
                        }else if($category==2){
                            $log="Menambahkan sub menu modular dengan nama ".$title.", url ".$url;
                            mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            mysqli_query($conn, "INSERT INTO menu_sub(id_menu,title,url,icon,is_active,category) VALUES('$id_menu','$title','$url','$icon','$is_active','$category')");
                            fopen($url.".php",'w');
                            fopen("../application/template/".$url.".php",'w');
                            return mysqli_affected_rows($conn);
                        }
                    }
                    function edit_sub_menu($edit){global $conn,$time;
                        $id_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-sub-menu']))));
                        $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-menu']))));
                        $title=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['title']))));
                        $url=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['url']))));
                        $icon=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['icon']))));
                        $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['is_active']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit sub menu dengan nama ".$title.", url ".$url;
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE menu_sub SET id_menu='$id_menu', title='$title', url='$url', icon='$icon', is_active='$is_active' WHERE id_sub_menu='$id_sub_menu'");
                        return mysqli_affected_rows($conn);
                    }
                    function del_sub_menu($del){global $conn,$time;
                        $id_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-sub-menu']))));
                        $title=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['title']))));
                        $url=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['url']))));
                        $category=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['category']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus sub menu dengan nama ".$title;
                        $date=date('l, d M Y');
                        if($category==1){
                            mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            mysqli_query($conn, "DELETE FROM menu_sub WHERE id_sub_menu='$id_sub_menu'");
                            $files=glob($url.".php");
                            foreach ($files as $file) {
                                if (is_file($file))
                                unlink($file);
                            }
                            return mysqli_affected_rows($conn);
                        }else if($category==2){
                            mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            mysqli_query($conn, "DELETE FROM menu_sub WHERE id_sub_menu='$id_sub_menu'");
                            $files1=glob($url.".php");
                            foreach ($files1 as $file) {
                                if (is_file($file))
                                unlink($file);
                            }
                            $files2=glob("../application/template/".$url.".php");
                            foreach ($files2 as $file) {
                                if (is_file($file))
                                unlink($file);
                            }
                            return mysqli_affected_rows($conn);
                        }
                    }
                    function add_access_menu($add){global $conn,$time;
                        $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-role']))));
                        $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-menu']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan akses menu dengan id ".$id_menu." untuk role user dengan id ".$id_role;
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO menu_access(role_id, id_menu) VALUES('$id_role','$id_menu')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_access_menu($edit){global $conn,$time;
                        $id_access_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-access-menu']))));
                        $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-role']))));
                        $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-menu']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan akses menu dengan id ".$id_menu." untuk role user dengan id ".$id_role;
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE menu_access SET role_id='$id_role', id_menu='$id_menu' WHERE id_access_menu='$id_access_menu'");
                        return mysqli_affected_rows($conn);
                    }
                    function del_access_menu($del){global $conn,$time;
                        $id_access_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-access-menu']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus salah satu akses menu yang ada!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM menu_access WHERE id_access_menu='$id_access_menu'");
                        return mysqli_affected_rows($conn);
                    }
                    function add_controller($add){global $conn,$time;
                        $aturan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['aturan']))));
                        $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['is_active']))));
                        if($is_active==1){
                            $toggle="on";
                        }else if($is_active==2){
                            $toggle="off";
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan kontrol web dengan isi: ".$aturan."!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO controller(aturan, is_active,toggle) VALUES('$aturan','$is_active','$toggle')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_controller($edit){global $conn,$time;
                        $id_controller=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-controller']))));
                        $aturan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['aturan']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit kontrol web dengan isi: ".$aturan."!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE controller SET aturan='$aturan' WHERE id_controller='$id_controller'");
                        return mysqli_affected_rows($conn);
                    }
                    function aksi_controller($aksi){global $conn,$time;
                        $id_controller=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $aksi['id-controller']))));
                        $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $aksi['is-active']))));
                        $string=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $aksi['aturan']))));$num_char=50;
                        $aturan=substr($string, 0, $num_char).'...';
                        if($is_active==1){
                            $is_active=2;
                            $toggle="off";
                        }else if($is_active==2){
                            $is_active=1;
                            $toggle="on";
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Mengubah kontrol web ".$aturan." menjadi ".$toggle."!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE controller SET is_active='$is_active', toggle='$toggle' WHERE id_controller='$id_controller'");
                        $aksi="'".$aturan."' telah di ".$toggle;
                        $_SESSION['aksi']=$aksi;
                        return mysqli_affected_rows($conn);
                    }
                    function add_section($add){global $conn, $time;
                        $cek_id_script=mysqli_query($conn, "SELECT * FROM user_interface_section ORDER BY id_script DESC LIMIT 1");
                        $loop_id_script=mysqli_fetch_assoc($cek_id_script);
                        if(isset($loop_id_script['id_script'])){
                            $idscript=$loop_id_script['id_script'];
                            $id_script=$idscript+1;
                        }else if(!isset($loop_id_script['id_script'])){
                            $id_script=27;
                        }
                        $section=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['section']))));
                        $script="-";
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan User Interface ".$section.".";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO user_interface_section(section,id_script) VALUES('$section','$id_script')");
                        mysqli_query($conn, "INSERT INTO user_interface_script(id_script,script) VALUES('$id_script','$script')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_script($edit){global $conn, $time;
                        $id_script=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-script']))));
                        $script=addslashes($edit['script']);
                        $section=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['section']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit Script Section ".$section."!. Script sebagai berikut: ".$script;
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE user_interface_script SET script='$script' WHERE id_script='$id_script'");
                        $_SESSION['aksi']=$section;
                        return mysqli_affected_rows($conn);
                    }
                    function del_section($del){global $conn, $time;
                        $id_script=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-script']))));
                        $section=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['section']))));
                        $_SESSION['aksi']=$section;
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus Section ".$section."!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM user_interface_section WHERE id_script='$id_script'");
                        mysqli_query($conn, "DELETE FROM user_interface_script WHERE id_script='$id_script'");
                        return mysqli_affected_rows($conn);
                    }
                    function privacy_policy($pp){global $conn, $time;
                        $id_pp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $pp['id-pp']))));
                        $privacy_policy=$pp['privacy-policy'];
                        if(empty($privacy_policy)){
                            $privacy_policy="-";
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit Privacy Policy!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE privacy_policy SET privacy_policy='$privacy_policy' WHERE id_pp='$id_pp'");
                        return mysqli_affected_rows($conn);
                    }
                    function term_of_service($edit){global $conn, $time;
                        $id_term=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-term']))));
                        $term_of_service=$edit['term-of-service'];
                        if(empty($term_of_service)){
                            $term_of_service="-";
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit Term Of Service!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE term_of_service SET term_of_service='$term_of_service' WHERE id_term='$id_term'");
                        return mysqli_affected_rows($conn);
                    }
                    function add_faq($add){global $conn, $time;
                        $question=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['question']))));
                        $answer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['answer']))));
                        $date=date('l, d M Y');
                        $date_time=$date.$time;
                        $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['is_active']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan FAQ baru!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO faq(question,answer,date_time,is_active) VALUES('$question','$answer','$date_time','$is_active')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_faq($edit){global $conn, $time;
                        $id_faq=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-faq']))));
                        $question=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['question']))));
                        $answer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['answer']))));
                        $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['is_active']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit salah satu FAQ yang ada!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE faq SET question='$question', answer='$answer', is_active='$is_active' WHERE id_faq='$id_faq'");
                        return mysqli_affected_rows($conn);
                    }
                    function del_faq($del){global $conn, $time;
                        $id_faq=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-faq']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus salah satu FAQ yang ada!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM faq WHERE id_faq='$id_faq'");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_users($edit){global $conn, $time;
                        $id_user_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-user']))));
                        $role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['role']))));
                        $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['username']))));
                        if($role>12){
                            $id_log=$_SESSION['id-log'];
                            $log="Mengedit role ".$username;
                            $date=date('l, d M Y');
                            mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            mysqli_query($conn, "UPDATE users SET id_role='$role' WHERE id_user='$id_user_old'");
                            return mysqli_affected_rows($conn);
                        }else if($role<13){
                            $cek_id_employee=mysqli_query($conn, "SELECT * FROM employee ORDER BY id_employee DESC LIMIT 1");
                            $loop_id_employee=mysqli_fetch_assoc($cek_id_employee);
                            if(isset($loop_id_employee['id_employee'])){
                                $idemployee=$loop_id_employee['id_employee'];
                                $id_employee=$idemployee+1;
                            }else if(!isset($loop_id_employee['id_employee'])){
                                $id_employee=202027;
                            }
                            $users=mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user_old'");
                            $row1=mysqli_fetch_assoc($users);
                            $id_img=$row1['id_img'];
                            $users_img=mysqli_query($conn, "SELECT * FROM users_img WHERE id_img='$id_img'");
                            $row3=mysqli_fetch_assoc($users_img);
                            $img=$row3['img'];
                            $first_name=$row1['first_name'];
                            $last_name=$row1['last_name'];
                            $email=$row1['email'];
                            $password1=$row1['password'];
                            $id_security=$row1['id_security'];
                            $is_active=$row1['is_active'];
                            $date_created=$row1['date_created'];
                            $users_security=mysqli_query($conn, "SELECT * FROM users_security WHERE id_security='$id_security'");
                            $row2=mysqli_fetch_assoc($users_security);
                            $password2=$row2['password'];
                            $hostname=$row2['hostname'];
                            $agent=$row2['agent'];
                            $ip=$row2['ip'];
                            $ref=$row2['ref'];
                            $id_log=$_SESSION['id-log'];
                            $log="Mengedit role ".$first_name." ke fasilitas administrator UGD HP";
                            $date=date('l, d M Y');
                            mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            mysqli_query($conn, "INSERT INTO employee(id_employee,img,first_name,last_name,email,password,id_security,id_log,id_role,is_active,date_created) VALUES('$id_employee','$img','$first_name','$last_name','$email','$password1','$id_employee','$id_employee','$role','$is_active','$date_created')");
                            mysqli_query($conn, "INSERT INTO employee_security(id_security,password,hostname,agent,ip,ref) VALUES('$id_employee','$password2','$hostname','$agent','$ip','$ref')");
                            mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user_old'");
                            mysqli_query($conn, "DELETE FROM users_security WHERE id_security='$id_user_old'");
                            mysqli_query($conn, "DELETE FROM users_img WHERE id_img='$id_img'");
                            return mysqli_affected_rows($conn);
                        }
                    }
                    function block_users($block){global $conn, $time;
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $block['id-user']))));
                        $user=mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
                        $row=mysqli_fetch_assoc($user);
                        $is_active=$row['is_active'];
                        $username=$row['first_name'];
                        if($is_active==1){
                            $is_active=2;
                            $_SESSION['aksi']="Akun ".$username." telah diblokir!";
                            $log="Mengblokir akun ".$username."!";
                        }else if($is_active==2){
                            $is_active=1;
                            $_SESSION['aksi']="Akun ".$username." telah diaktifkan!";
                            $log="Mengaktifkan akun ".$username."!";
                        }
                        $id_log=$_SESSION['id-log'];
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE users SET is_active='$is_active' WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_employee($edit){global $conn, $time;
                        $id_employee_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-employee']))));
                        $role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['role']))));
                        $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['username']))));
                        if($role<13){
                            $id_log=$_SESSION['id-log'];
                            $log="Mengedit role ".$username;
                            $date=date('l, d M Y');
                            mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            mysqli_query($conn, "UPDATE employee SET id_role='$role' WHERE id_employee='$id_employee_old'");
                            return mysqli_affected_rows($conn);
                        }else if($role>12){
                            $cek_id_user=mysqli_query($conn, "SELECT * FROM users ORDER BY id_user DESC LIMIT 1");
                            $loop_id_user=mysqli_fetch_assoc($cek_id_user);
                            if(isset($loop_id_user['id_user'])){
                                $iduser=$loop_id_user['id_user'];
                                $id_user=$iduser+1;
                            }else if(!isset($loop_id_user['id_user'])){
                                $id_user=202027;
                            }
                            $employee=mysqli_query($conn, "SELECT * FROM employee WHERE id_employee='$id_employee_old'");
                            $row1=mysqli_fetch_assoc($employee);
                            $img=$row1['img'];
                            $first_name=$row1['first_name'];
                            $last_name=$row1['last_name'];
                            $email=$row1['email'];
                            $password1=$row1['password'];
                            $id_security=$row1['id_security'];
                            $is_active=$row1['is_active'];
                            $date_created=$row1['date_created'];
                            $employee_security=mysqli_query($conn, "SELECT * FROM employee_security WHERE id_security='$id_security'");
                            $row2=mysqli_fetch_assoc($employee_security);
                            $password2=$row2['password'];
                            $hostname=$row2['hostname'];
                            $agent=$row2['agent'];
                            $ip=$row2['ip'];
                            $ref=$row2['ref'];
                            $id_log=$_SESSION['id-log'];
                            $log="Mengedit role ".$first_name." ke luar fasilitas administrator UGD HP";
                            $date=date('l, d M Y');
                            mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            mysqli_query($conn, "INSERT INTO users(id_user,id_img,first_name,last_name,email,password,id_security,id_role,is_active,date_created) VALUES('$id_user','$id_user','$first_name','$last_name','$email','$password1','$id_user','$role','$is_active','$date_created')");
                            mysqli_query($conn, "INSERT INTO users_security(id_security,password,hostname,agent,ip,ref) VALUES('$id_user','$password2','$hostname','$agent','$ip','$ref')");
                            mysqli_query($conn, "INSERT INTO users_img(id_img,id_user,img) VALUES('$id_user','$id_user','$img')");
                            mysqli_query($conn, "DELETE FROM employee WHERE id_employee='$id_employee_old'");
                            mysqli_query($conn, "DELETE FROM employee_security WHERE id_security='$id_employee_old'");
                            return mysqli_affected_rows($conn);
                        }
                    }
                    function block_employee($block){global $conn, $time;
                        $id_employee=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $block['id-employee']))));
                        $employee=mysqli_query($conn, "SELECT * FROM employee WHERE id_employee='$id_employee'");
                        $row=mysqli_fetch_assoc($employee);
                        $is_active=$row['is_active'];
                        $username=$row['first_name'];
                        if($is_active==1){
                            $is_active=2;
                            $_SESSION['aksi']="Akun ".$username." telah diblokir!";
                            $log="Mengblokir akun ".$username."!";
                        }else if($is_active==2){
                            $is_active=1;
                            $_SESSION['aksi']="Akun ".$username." telah diaktifkan!";
                            $log="Mengaktifkan akun ".$username."!";
                        }
                        $id_log=$_SESSION['id-log'];
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE employee SET is_active='$is_active' WHERE id_employee='$id_employee'");
                        return mysqli_affected_rows($conn);
                    }
                    function add_error($add){global $conn, $time;
                        $error=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['error']))));
                        $small_text=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['small-text']))));
                        $description=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['description']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan Error Page : ".$error."!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO error_page(error,small_text,description) VALUES('$error','$small_text','$description')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_error($edit){global $conn, $time;
                        $id_error=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-error']))));
                        $error=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['error']))));
                        $small_text=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['small-text']))));
                        $description=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['description']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit Error Page : ".$error."!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE error_page SET error='$error', small_text='$small_text', description='$description' WHERE id_error='$id_error'");
                        return mysqli_affected_rows($conn);
                    }
                    function del_error($del){global $conn, $time;
                        $id_error=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-error']))));
                        $error=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['error']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus Error Page : ".$error."!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM error_page WHERE id_error='$id_error'");
                        return mysqli_affected_rows($conn);
                    }
                    function add_access_sub_menu($add){global $conn,$time;
                        $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-role']))));
                        $id_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-sub-menu']))));
                        // $menu_sub_check=mysqli_query($conn, "SELECT * FROM menu_sub_access WHERE id_sub_menu='$id_sub_menu'");
                        // if(mysqli_num_rows($menu_sub_check)>0){
                        //     $_SESSION['message-danger']="Maaf, sub menu yang anda ajukan sebagai akses baru sudah ada!";
                        //     header("Location: access-sub-menu");
                        //     return false;
                        // }
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan akses sub menu dengan id ".$id_sub_menu." untuk role user dengan id ".$id_role;
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO menu_sub_access(role_id, id_sub_menu) VALUES('$id_role','$id_sub_menu')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_access_sub_menu($edit){global $conn,$time;
                        $id_access_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-access-sub-menu']))));
                        $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-role']))));
                        $id_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-sub-menu']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan akses sub menu dengan id ".$id_sub_menu." untuk role user dengan id ".$id_role;
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "UPDATE menu_sub_access SET role_id='$id_role', id_sub_menu='$id_sub_menu' WHERE id_access_sub_menu='$id_access_sub_menu'");
                        return mysqli_affected_rows($conn);
                    }
                    function del_access_sub_menu($del){global $conn,$time;
                        $id_access_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-access-sub-menu']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus salah satu akses sub menu yang ada!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM menu_sub_access WHERE id_access_sub_menu='$id_access_sub_menu'");
                        return mysqli_affected_rows($conn);
                    }
                    function add_no_nota($add){global $conn, $time;
                        $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['name']))));
                        $name_cek=mysqli_query($conn, "SELECT * FROM setting_nota WHERE name LIKE '%$name%'");
                        if(mysqli_num_rows($name_cek)>0){
                            $_SESSION['message-danger']="Maaf, nama nota telah dimasukan dan sedang berjalan!";
                            header("Location: setting-nota");
                            exit;
                        }
                        $no_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['no-nota']))));
                        $date=date('l, d M Y');
                        $id_log=$_SESSION['id-log'];
                        $log="Memperbaharui nomor nota ".$name." dengan nomor ".$no_nota."!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "INSERT INTO setting_nota(name,no_nota,date) VALUES('$name','$no_nota','$date')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_no_nota($edit){global $conn, $time;
                        $id_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-nota']))));
                        $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['name']))));
                        $name_cek=mysqli_query($conn, "SELECT * FROM setting_nota WHERE name LIKE '%$name%'");
                        $no_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['no-nota']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit nomor nota dengan id nota ".$id_nota."!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        if(empty($name)){
                            mysqli_query($conn, "UPDATE setting_nota SET no_nota='$no_nota' WHERE id_nota='$id_nota'");
                            return mysqli_affected_rows($conn);
                        }else if(!empty($name)){
                            if(mysqli_num_rows($name_cek)>0){
                                $_SESSION['message-danger']="Maaf, nama nota telah dimasukan dan sedang berjalan!";
                                header("Location: setting-nota");
                                exit;
                            }
                            mysqli_query($conn, "UPDATE setting_nota SET name='$name', no_nota='$no_nota' WHERE id_nota='$id_nota'");
                            return mysqli_affected_rows($conn);
                        }
                    }
                    function del_no_nota($del){global $conn, $time;
                        $id_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-nota']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus nomor nota dengan id nota ".$id_nota."!";
                        $date=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        mysqli_query($conn, "DELETE FROM setting_nota WHERE id_nota='$id_nota'");
                        return mysqli_affected_rows($conn);
                    }
                    function nota_tinggal($add){global $conn, $time, $akses_hp, $akses_laptop;
                        require_once('../assets/vendor/autoload.php');
                        $auto_nota=mysqli_query($conn, "SELECT * FROM autorisasi_nomor_nota");
                        $row_auto=mysqli_fetch_assoc($auto_nota);
                        $id_auto=$row_auto['id_auto'];
                        $id_auto_status=$row_auto['id_status'];
                        // require_once('nota-auto.php');
                        require_once('nota-manual.php');
                        $id_nota_tinggal="T".$id_nota_tinggal;
                        $id_nota_dp="DP".$id_nota_dp;
                        $cek_idUser=mysqli_query($conn, "SELECT * FROM users_local ORDER BY id_user DESC LIMIT 1");
                        $loop_idUser=mysqli_fetch_assoc($cek_idUser);
                        if(isset($loop_idUser['id_user'])){
                            $idUser=$loop_idUser['id_user'];
                            $id_user=$idUser+1;
                        }else if(!isset($loop_idUser['id_user'])){
                            $id_user=202027;
                        }
                        $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['username']))));
                        $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['email']))));
                        $users_local=mysqli_query($conn, "SELECT * FROM users_local WHERE email_user='$email'");
                        $tlpn=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['tlpn']))));
                        $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['alamat']))));
                        $tgl_masuk=date('l, d M Y');
                        $tgl_cari=date('Y-m-d');
                        $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-layanan']))));
                        $kerusakan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['kerusakan']))));
                        $kondisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['kondisi']))));
                        $kelengkapan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['kelengkapan']))));
                        $id_teknisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-teknisi']))));
                        $id_status=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-status']))));
                        $tgl_status=date('l, d M Y');
                        $tgl_ambil=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['tgl-ambil']))));
                        $dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['dp']))));
                        $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['biaya']))));
                        $id_barang=$id_user;
                        if($id_layanan==1){
                            $type=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['type']))));
                            $seri_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['seri-hp']))));
                            $imei=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['imei']))));
                        }else if($id_layanan==2){
                            $merek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['merek']))));
                            $seri_laptop=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['seri-laptop']))));
                        }
                        $nota_tinggal=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_nota_tinggal='$id_nota_tinggal'");
                        if(mysqli_num_rows($nota_tinggal)>0){
                            $_SESSION['message-danger']="Maaf, nomor nota sudah ada!";
                            require_once("form-data.php");
                            $_SESSION['show']=3;
                            header("Location: nota-tinggal");return false;
                        }
                        if(!empty($email)){
                            if(mysqli_num_rows($users_local)>0){
                                $_SESSION['message-info']="Heii, Email User telah terpakai. Tetap akan mengirimkan pesan ke email: ".$email;
                            }
                        }
                        if(empty($id_layanan)){
                            $_SESSION['message-danger']="Maaf, anda belum memilih layanan!";
                            require_once("form-data.php");
                            $_SESSION['show']=3;
                            header("Location: nota-tinggal");return false;
                        }else if(!empty($id_layanan)){
                            if($id_layanan==1){
                                if(empty($type)){
                                    $_SESSION['message-danger']="Maaf, anda belum mengisi type handphone!";
                                    require_once("form-data.php");
                                    $_SESSION['show']=3;
                                    header("Location: nota-tinggal");return false;
                                }
                                if(empty($seri_hp)){
                                    $_SESSION['message-danger']="Maaf, anda belum mengisi seri handphone!";
                                    require_once("form-data.php");
                                    $_SESSION['show']=3;
                                    header("Location: nota-tinggal");return false;
                                }
                                if(empty($imei)){
                                    $_SESSION['message-warning']="Ingat untuk memasukan IMEI Handphone!";
                                    $_SESSION['show']=3;
                                }
                            }else if($id_layanan==2){
                                if(empty($merek)){
                                    $_SESSION['message-danger']="Maaf, anda belum mengisi merek laptop!";
                                    require_once("form-data.php");
                                    $_SESSION['show']=3;
                                    header("Location: nota-tinggal");return false;
                                }
                                if(empty($seri_laptop)){
                                    $_SESSION['message-danger']="Maaf, anda belum mengisi seri laptop!";
                                    require_once("form-data.php");
                                    $_SESSION['show']=3;
                                    header("Location: nota-tinggal");return false;
                                }
                            }
                        }
                        if(empty($id_teknisi)){
                            $_SESSION['message-danger']="Maaf, anda belum memilih teknisi!";
                            require_once("form-data.php");
                            $_SESSION['show']=3;
                            header("Location: nota-tinggal");return false;
                        }
                        if(empty($id_status)){
                            $_SESSION['message-danger']="Maaf, anda belum memilih status!";
                            require_once("form-data.php");
                            $_SESSION['show']=3;
                            header("Location: nota-tinggal");return false;
                        }
                        if($biaya<=10000){
                            $_SESSION['message-danger']="Maaf, pastikan anda memasukan biaya dengan benar!";
                            require_once("form-data.php");
                            $_SESSION['show']=3;
                            header("Location: nota-tinggal");return false;
                        }
                        if($id_auto==2){
                            if($id_auto_status==1){
                                if($dp>0){
                                    $check_nota_dp=count($add['check-nota-dp']);
                                    if($check_nota_dp==1){
                                        $_SESSION['message-danger']="Maaf, anda belum menceklist nota dp!";
                                        require_once("form-data.php");
                                        $_SESSION['show']=3;
                                        header("Location: nota-tinggal");return false;
                                    }
                                }
                            }else if($id_auto_status==2){
                                if($dp>0){
                                    if(empty($id_nota_dp)){
                                        $_SESSION['message-danger']="Maaf, anda belum mengisi nomor nota dp!";
                                        require_once("form-data.php");
                                        $_SESSION['show']=3;
                                        header("Location: nota-tinggal");return false;
                                    }
                                }
                            }
                        }
                        $barcode=barcode_nota_tinggal($id_user);
                        $barcode_hash=password_hash($barcode, PASSWORD_DEFAULT);
                        mysqli_query($conn, "INSERT INTO users_local VALUES('$id_user','$username','$email','$tlpn','$alamat')");
                        if($id_layanan==1){
                            mysqli_query($conn, "INSERT INTO handphone VALUES('$id_barang','$akses_hp','$type','$seri_hp','$imei')");
                        }else if($id_layanan==2){
                            mysqli_query($conn, "INSERT INTO laptop VALUES('$id_barang','$akses_laptop','$merek','$seri_laptop')");
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan nota tinggal dengan nomor nota ".$id_nota_tinggal." http://ugdhp.com/qr?ac=1&id=".$id_nota_tinggal;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        if(!empty($email)){
                            require "mail-send.php";
                            $to       = $email;
                            $subject  = 'QR Nota Tinggal';
                            $message  = '
                                <div style="margin: 0; padding: 0;">
                                    <p>Silakan scan QR berikut untuk melalukan pengecekan status barang:</p><br>
                                    <a href="https://www.ugdhp.com/qr?ac=1&id=".$id_nota_tinggal" style="font-weight: bold">'.$barcode_hash.'</a>
                                    <p>Kode ini bersifat rahasia jangan berikan kepada siapapun itu. Baca juga peraturan kebijakan layanan kami di
                                        <a href="https://www.ugdhp.com/terms-conditions" style="text-decoration: none;">disini</a>
                                    </p>
                                </div>';
                            smtp_mail($to, $subject, $message, '', '', 0, 0, true);
                        }
                        $Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
                        $qrbatang = $Bar->getBarcode($id_nota_tinggal, $Bar::TYPE_CODE_128);
                        if($dp>0){
                            mysqli_query($conn, "INSERT INTO laporan_dp(id_nota_tinggal,id_nota_dp,id_user,tgl_masuk,tgl_cari,id_layanan,id_barang,kerusakan,id_pegawai,dp,time) VALUES('$id_nota_tinggal','$id_nota_dp','$id_user','$tgl_masuk','$tgl_cari','$id_layanan','$id_barang','$kerusakan','$id_teknisi','$dp','$time')");
                            mysqli_query($conn, "INSERT INTO nota_tinggal(id_nota_tinggal,id_nota_dp,id_user,tgl_masuk,tgl_cari,id_layanan,id_barang,kerusakan,kondisi,kelengkapan,id_pegawai,id_status,tgl_status,tgl_ambil,dp,biaya,time,barcode,qrbatang) VALUES('$id_nota_tinggal','$id_nota_dp','$id_user','$tgl_masuk','$tgl_cari','$id_layanan','$id_barang','$kerusakan','$kondisi','$kelengkapan','$id_teknisi','$id_status','$tgl_status','$tgl_ambil','$dp','$biaya','$time','$barcode','$qrbatang')");
                        }else{
                            mysqli_query($conn, "INSERT INTO nota_tinggal(id_nota_tinggal,id_user,tgl_masuk,tgl_cari,id_layanan,id_barang,kerusakan,kondisi,kelengkapan,id_pegawai,id_status,tgl_status,tgl_ambil,biaya,time,barcode,qrbatang) VALUES('$id_nota_tinggal','$id_user','$tgl_masuk','$tgl_cari','$id_layanan','$id_barang','$kerusakan','$kondisi','$kelengkapan','$id_teknisi','$id_status','$tgl_status','$tgl_ambil','$biaya','$time','$barcode','$qrbatang')");
                        }
                        return mysqli_affected_rows($conn);
                    }
                    function barcode_nota_tinggal($id_user){
                        require_once('../assets/phpqrcode/qrlib.php');
                        $qrvalue = "https://www.ugdhp.com/qr?ac=".$id_user;
                        $tempDir = "../assets/img/img-barcode-modern/";
                        $codeContents = $qrvalue;
                        $fileName = $id_user.".png";
                        $pngAbsoluteFilePath = $tempDir.$fileName;
                        if(!file_exists($pngAbsoluteFilePath)){
                            QRcode::png($codeContents, $pngAbsoluteFilePath);
                        }
                        return $fileName;
                    }
                    function edit_status_nota($edit){global $conn, $time, $akses_hp, $akses_laptop;
                        $id_nota_tinggal=addslashes(trim(mysqli_real_escape_string($conn, $edit['id-nota-tinggal'])));
                        $id_nota_dp=addslashes(trim(mysqli_real_escape_string($conn, $edit['id-nota-dp'])));
                        $id_layanan=addslashes(trim(mysqli_real_escape_string($conn, $edit['id-layanan'])));
                        $id_status=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-status']))));
                        $tgl_status=date('l, d M Y');
                        $services_status_ugdhp=mysqli_query($conn, "SELECT * FROM services_status_ugdhp WHERE id_status='$id_status'");
                        $row=mysqli_fetch_assoc($services_status_ugdhp);
                        $status=$row['status'];;
                        if(empty($id_status)){
                            $_SESSION['message-warning']="Maaf, anda belum memilih status nota tinggal!";
                            $_SESSION['show']=2;
                            header("Location: nota-tinggal");
                            return false;
                        }else if($id_status==0){
                            $_SESSION['message-warning']="Maaf, anda belum memilih status nota tinggal!";
                            $_SESSION['show']=2;
                            header("Location: nota-tinggal");
                            return false;
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit status nota dengan nomor nota tinggal ".$id_nota_tinggal." dan nomor nota dp ".$id_nota_dp." dengan status ".$status.".";
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        if($id_status==2){
                            $nota_tinggal=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_nota_tinggal='$id_nota_tinggal'");
                            $row=mysqli_fetch_assoc($nota_tinggal);
                            $id_user=$row['id_user'];
                            $tgl_masuk=$row['tgl_masuk'];
                            $tgl_cari=$row['tgl_cari'];
                            $id_layanan=$row['id_layanan'];
                            $id_barang=$row['id_barang'];
                            $kerusakan=$row['kerusakan'];
                            $kondisi=$row['kondisi'];
                            $kelengkapan=$row['kelengkapan'];
                            $id_pegawai=$row['id_pegawai'];
                            $id_status=2;
                            $tgl_ambil=$row['tgl_ambil'];
                            $dp=$row['dp'];
                            $biaya=$row['biaya'];
                            $time=$row['time'];
                            $barcode=$row['barcode'];
                            $qrbatang=$row['qrbatang'];
                            mysqli_query($conn, "INSERT INTO nota_cancel(id_nota_tinggal,id_nota_dp,id_user,tgl_masuk,tgl_cari,id_layanan,id_barang,kerusakan,kondisi,kelengkapan,id_pegawai,id_status,tgl_status,tgl_ambil,dp,biaya,time,barcode,qrbatang) VALUES('$id_nota_tinggal','$id_nota_dp','$id_user','$tgl_masuk','$tgl_cari','$id_layanan','$id_barang','$kerusakan','$kondisi','$kelengkapan','$id_pegawai','$id_status','$tgl_status','$tgl_ambil','$dp','$biaya','$time','$barcode','$qrbatang')");
                            mysqli_query($conn, "DELETE FROM nota_tinggal WHERE id_nota_tinggal='$id_nota_tinggal'");
                            return mysqli_affected_rows($conn);
                        }else{
                            mysqli_query($conn, "UPDATE nota_tinggal SET id_status='$id_status', tgl_status='$tgl_status' WHERE id_nota_tinggal='$id_nota_tinggal'");
                            return mysqli_affected_rows($conn);
                        }
                    }
                    function edit_nota($edit){global $conn, $time, $link_log;
                        $id_nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-nota-tinggal']))));
                        $id_nota_dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-nota-dp']))));
                        $nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['nota-tinggal']))));
                        $nota_dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['nota-dp']))));
                        $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-layanan']))));
                        $id_barang=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-barang']))));
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-user']))));
                        if($nota_tinggal>0){
                            $cek_nota_tinggal=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_nota_tinggal='$nota_tinggal'");
                            if(mysqli_num_rows($cek_nota_tinggal)>0){
                                $_SESSION['message-danger']="Maaf, nomor nota tinggal sudah ada!";
                                $_SESSION['show']=2;
                                header("Location: nota-tinggal");
                                return false;
                            }
                        }if($nota_dp>0){
                            $cek_nota_dp=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_nota_dp='$nota_dp'");
                            if(mysqli_num_rows($cek_nota_dp)>0){
                                $_SESSION['message-danger']="Maaf, nomor nota dp sudah ada!";
                                $_SESSION['show']=2;
                                header("Location: nota-tinggal");
                                return false;
                            }
                        }
                        $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['username']))));
                        $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['email-user']))));
                        $users_local=mysqli_query($conn, "SELECT * FROM users_local WHERE email_user='$email'");
                        $tlpn=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['tlpn-user']))));
                        $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['alamat-user']))));
                        $kerusakan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['kerusakan']))));
                        $kondisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['kondisi']))));
                        $kelengkapan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['kelengkapan']))));
                        $id_pegawai=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-teknisi']))));
                        $tgl_ambil=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['tgl-ambil']))));
                        $dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['dp']))));
                        $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['biaya']))));
                        if($id_layanan==1){
                            $type=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['type']))));
                            $seri_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['seri-hp']))));
                            $imei=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['imei']))));
                        }else if($id_layanan==2){
                            $merek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['merek']))));
                            $seri_laptop=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['seri-laptop']))));
                        }
                        if(!empty($email)){
                            if(mysqli_num_rows($users_local)>0){
                                $_SESSION['message-danger']="Maaf, email user telah terpakai. Silakan isi ulang email user!";
                                $_SESSION['show']=2;
                                header("Location: nota-tinggal");
                                return false;
                            }
                        }
                        if($id_layanan==1){
                            if(empty($type)){
                                $_SESSION['message-danger']="Maaf, anda belum mengisi type handphone!";
                                $_SESSION['show']=2;
                                header("Location: nota-tinggal");
                                return false;
                            }
                            if(empty($seri_hp)){
                                $_SESSION['message-danger']="Maaf, anda belum mengisi seri handphone!";
                                $_SESSION['show']=2;
                                header("Location: nota-tinggal");
                                return false;
                            }
                            if(empty($imei)){
                                $_SESSION['message-warning']="Ingat untuk memasukan IMEI Handphone!";
                                $_SESSION['show']=2;
                            }
                        }else if($id_layanan==2){
                            if(empty($merek)){
                                $_SESSION['message-danger']="Maaf, anda belum mengisi merek laptop!";
                                $_SESSION['show']=2;
                                header("Location: nota-tinggal");
                                return false;
                            }
                            if(empty($seri_laptop)){
                                $_SESSION['message-danger']="Maaf, anda belum mengisi seri laptop!";
                                $_SESSION['show']=2;
                                header("Location: nota-tinggal");
                                return false;
                            }
                        }
                        if(empty($id_pegawai)){
                            $_SESSION['message-danger']="Maaf, anda belum memilih teknisi!";
                            $_SESSION['show']=2;
                            header("Location: nota-tinggal");
                            return false;
                        }
                        if($biaya<=10000){
                            $_SESSION['message-danger']="Maaf, pastikan anda memasukan biaya dengan benar!";
                            $_SESSION['show']=2;
                            header("Location: nota-tinggal");
                            return false;
                        }
                        if($dp>0){
                            if(empty($id_nota_dp)){
                                $_SESSION['message-danger']="Maaf, anda belum mengisi nomor nota dp!";
                                $_SESSION['show']=2;
                                header("Location: nota-tinggal");
                                return false;
                            }
                        }
                        if($id_layanan==1){
                            mysqli_query($conn, "UPDATE handphone SET type='$type', seri='$seri_hp', imei='$imei' WHERE id_hp='$id_barang'");
                        }else if($id_layanan==2){
                            mysqli_query($conn, "UPDATE laptop SET merek='$merek', seri='$seri_laptop' WHERE id_laptop='$id_barang'");
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit nota tinggal dengan nomor nota ".$id_nota_tinggal;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        if($nota_tinggal>0){
                            if($nota_dp>0){
                                mysqli_query($conn, "UPDATE nota_tinggal SET id_nota_tinggal='$nota_tinggal', id_nota_dp='$nota_dp', kerusakan='$kerusakan', kondisi='$kondisi', kelengkapan='$kelengkapan', id_pegawai='$id_pegawai', tgl_ambil='$tgl_ambil', dp='$dp', biaya='$biaya' WHERE id_nota_tinggal='$id_nota_tinggal'");
                                if(!empty($email)){
                                    mysqli_query($conn, "UPDATE users_local SET username='$username', email_user='$email', tlpn_user='$tlpn', alamat_user='$alamat' WHERE id_user='$id_user'");
                                    return mysqli_affected_rows($conn);
                                }else if(empty($email)){
                                    mysqli_query($conn, "UPDATE users_local SET username='$username', tlpn_user='$tlpn', alamat_user='$alamat' WHERE id_user='$id_user'");
                                    return mysqli_affected_rows($conn);
                                }
                            }else if($nota_dp==0){
                                mysqli_query($conn, "UPDATE nota_tinggal SET id_nota_tinggal='$nota_tinggal', kerusakan='$kerusakan', kondisi='$kondisi', kelengkapan='$kelengkapan', id_pegawai='$id_pegawai', tgl_ambil='$tgl_ambil', dp='$dp', biaya='$biaya' WHERE id_nota_tinggal='$id_nota_tinggal'");
                                if(!empty($email)){
                                    mysqli_query($conn, "UPDATE users_local SET username='$username', email_user='$email', tlpn_user='$tlpn', alamat_user='$alamat' WHERE id_user='$id_user'");
                                    return mysqli_affected_rows($conn);
                                }else if(empty($email)){
                                    mysqli_query($conn, "UPDATE users_local SET username='$username', tlpn_user='$tlpn', alamat_user='$alamat' WHERE id_user='$id_user'");
                                    return mysqli_affected_rows($conn);
                                }
                            }
                        }else if($nota_tinggal==0){
                            if($nota_dp>0){
                                mysqli_query($conn, "UPDATE nota_tinggal SET id_nota_dp='$nota_dp', kerusakan='$kerusakan', kondisi='$kondisi', kelengkapan='$kelengkapan', id_pegawai='$id_pegawai', tgl_ambil='$tgl_ambil', dp='$dp', biaya='$biaya' WHERE id_nota_tinggal='$id_nota_tinggal'");
                                if(!empty($email)){
                                    mysqli_query($conn, "UPDATE users_local SET username='$username', email_user='$email', tlpn_user='$tlpn', alamat_user='$alamat' WHERE id_user='$id_user'");
                                    return mysqli_affected_rows($conn);
                                }else if(empty($email)){
                                    mysqli_query($conn, "UPDATE users_local SET username='$username', tlpn_user='$tlpn', alamat_user='$alamat' WHERE id_user='$id_user'");
                                    return mysqli_affected_rows($conn);
                                }
                            }else if($nota_dp==0){
                                mysqli_query($conn, "UPDATE nota_tinggal SET kerusakan='$kerusakan', kondisi='$kondisi', kelengkapan='$kelengkapan', id_pegawai='$id_pegawai', tgl_ambil='$tgl_ambil', dp='$dp', biaya='$biaya' WHERE id_nota_tinggal='$id_nota_tinggal'");
                                if(!empty($email)){
                                    mysqli_query($conn, "UPDATE users_local SET username='$username', email_user='$email', tlpn_user='$tlpn', alamat_user='$alamat' WHERE id_user='$id_user'");
                                    return mysqli_affected_rows($conn);
                                }else if(empty($email)){
                                    mysqli_query($conn, "UPDATE users_local SET username='$username', tlpn_user='$tlpn', alamat_user='$alamat' WHERE id_user='$id_user'");
                                    return mysqli_affected_rows($conn);
                                }
                            }
                        }
                    }
                    function delete_nota($del){global $conn, $time, $link_log;
                        $id_nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-nota-tinggal']))));
                        $id_barang=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-barang']))));
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-user']))));
                        $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-layanan']))));
                        $barcode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['barcode']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus nota tinggal dengan nomor nota ".$id_nota_tinggal;
                        $date_log=date('l, d M Y');
                        $files2=glob("../assets/img/img-barcode-modern/".$barcode);
                        foreach($files2 as $file){
                            if(is_file($file)){
                                unlink($file);
                            }
                        }
                        if($id_layanan==1){
                            mysqli_query($conn, "DELETE FROM handphone WHERE id_hp='$id_barang'");
                        }else if($id_layanan==2){
                            mysqli_query($conn, "DELETE FROM laptop WHERE id_laptop='$id_barang'");
                        }
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "DELETE FROM nota_tinggal WHERE id_nota_tinggal='$id_nota_tinggal'");
                        mysqli_query($conn, "DELETE FROM users_local WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function recovery_nota($reco){global $conn, $time;
                        $id_nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $reco['id-nota-tinggal']))));
                        $nota_cancel=mysqli_query($conn, "SELECT * FROM nota_cancel WHERE id_nota_tinggal='$id_nota_tinggal'");
                        $row=mysqli_fetch_assoc($nota_cancel);
                        $id_nota_dp=$row['id_nota_dp'];
                        $id_user=$row['id_user'];
                        $tgl_masuk=$row['tgl_masuk'];
                        $tgl_cari=$row['tgl_cari'];
                        $id_layanan=$row['id_layanan'];
                        $id_barang=$row['id_barang'];
                        $kerusakan=$row['kerusakan'];
                        $kondisi=$row['kondisi'];
                        $kelengkapan=$row['kelengkapan'];
                        $id_pegawai=$row['id_pegawai'];
                        $id_status=1;
                        $tgl_status=date('l, d M Y');
                        $tgl_ambil=$row['tgl_ambil'];
                        $dp=$row['dp'];
                        $biaya=$row['biaya'];
                        $time=$row['time'];
                        $barcode=$row['barcode'];
                        $qrbatang=$row['qrbatang'];
                        $id_log=$_SESSION['id-log'];
                        $log="Re-covery nota cancel dengan nomor nota ".$id_nota_tinggal." ke nota tinggal atau dp.";
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "INSERT INTO nota_tinggal(id_nota_tinggal,id_nota_dp,id_user,tgl_masuk,tgl_cari,id_layanan,id_barang,kerusakan,kondisi,kelengkapan,id_pegawai,id_status,tgl_status,tgl_ambil,dp,biaya,time,barcode,qrbatang) VALUES('$id_nota_tinggal','$id_nota_dp','$id_user','$tgl_masuk','$tgl_cari','$id_layanan','$id_barang','$kerusakan','$kondisi','$kelengkapan','$id_pegawai','$id_status','$tgl_status','$tgl_ambil','$dp','$biaya','$time','$barcode','$qrbatang')");
                        mysqli_query($conn, "DELETE FROM nota_cancel WHERE id_nota_tinggal='$id_nota_tinggal'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_nota_cancel($del){global $conn, $time;
                        $id_nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-nota-tinggal']))));
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-user']))));
                        $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-layanan']))));
                        $barcode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['barcode']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus nota cancel dengan nomor nota ".$id_nota_tinggal;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        $files2=glob("../assets/img/img-barcode-modern/".$barcode);
                        foreach($files2 as $file){
                            if(is_file($file))
                            unlink($file);
                        }
                        if($id_layanan==1){
                            mysqli_query($conn, "DELETE FROM handphone WHERE id_hp='$id_nota_tinggal'");
                        }else if($id_layanan==2){
                            mysqli_query($conn, "DELETE FROM laptop WHERE id_laptop='$id_nota_tinggal'");
                        }
                        mysqli_query($conn, "DELETE FROM nota_cancel WHERE id_nota_tingal='$id_nota_tinggal'");
                        mysqli_query($conn, "DELETE FROM users_local WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function add_lunas_from_tinggal($add){global $conn, $time;
                        $id_nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-nota-lunas']))));
                        $nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_lunas='$id_nota_lunas'");
                        if(mysqli_num_rows($nota_lunas)>0){
                            $_SESSION['message-danger']="Maaf, nomor nota lunas yang anda masukan sudah ada!";
                            $_SESSION['show']=3;
                            header("Location: take-paid-off");return false;
                        }
                        $laporan_harian=mysqli_query($conn, "SELECT * FROM laporan_harian WHERE id_nota_lunas='$id_nota_lunas'");
                        if(mysqli_num_rows($laporan_harian)>0){
                            $_SESSION['message-danger']="Maaf, nomor nota lunas yang anda masukan sudah ada!";
                            $_SESSION['show']=3;
                            header("Location: take-paid-off");return false;
                        }
                        $id_nota_lunas="L".$id_nota_lunas;
                        $id_nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-nota-tinggal']))));
                        $nota_tinggal=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_nota_tinggal='$id_nota_tinggal'");
                        $row=mysqli_fetch_assoc($nota_tinggal);
                        $id_nota_dp=$row['id_nota_dp'];
                        $id_user=$row['id_user'];
                        $id_layanan=$row['id_layanan'];
                        $id_barang=$id_user;
                        $id_pegawai=$row['id_pegawai'];
                        $tgl_laporan=date('l, d M Y');
                        $tgl_cari=date('Y-m-d');
                        $tgl_masuk=$row['tgl_masuk'];
                        $tgl_ambil=$row['tgl_ambil'];
                        $kerusakan=$row['kerusakan'];
                        $dp=$row['dp'];
                        $biaya=$row['biaya'];
                        $pemasukan=$biaya-$dp;
                        $garansi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['garansi']))));
                        $ket_text=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['ket-text']))));
                        // image ket
                        if(!empty($ket_text)){
                            $ket_img=ket_img($id_user);
                            if(!$ket_img){
                                return false;
                            }
                        }
                        $barcode=$row['barcode'];
                        $id_log=$_SESSION['id-log'];
                        $log="Menambah data nota lunas dengan nomor nota ".$id_nota_lunas." http://ugdhp.com/qr?ac=2&id=".$id_nota_lunas;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "INSERT INTO nota_lunas(id_nota_lunas,id_nota_tinggal,id_nota_dp,id_user,id_layanan,id_barang,id_pegawai,tgl_laporan,tgl_cari,tgl_masuk,tgl_ambil,kerusakan,pemasukan,dp,biaya,garansi,ket_text,ket_img,time,barcode) VALUES('$id_nota_lunas','$id_nota_tinggal','$id_nota_dp','$id_user','$id_layanan','$id_barang','$id_pegawai','$tgl_laporan','$tgl_cari','$tgl_masuk','$tgl_ambil','$kerusakan','$pemasukan','$dp','$biaya','$garansi','$ket_text','$ket_img','$time','$barcode')");
                        mysqli_query($conn, "DELETE FROM nota_tinggal WHERE id_nota_tinggal='$id_nota_tinggal'");
                        return mysqli_affected_rows($conn);
                    }
                    function ket_img($id_user){
                        $namaFile=$_FILES["ket-img"]["name"];
                        $ukuranFile=$_FILES["ket-img"]["size"];
                        $error=$_FILES["ket-img"]["error"];
                        $tmpName=$_FILES["ket-img"]["tmp_name"];
                        $ekstensiGambarValid=['jpg','jpeg','png'];
                        $ekstensiGambar=explode('.',$namaFile);
                        $ekstensiGambar=strtolower(end($ekstensiGambar));
                        if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
                            $_SESSION['message-danger']="Maaf, bukan gambar!";
                            header("Location: ../views/nota-lunas");
                            return false;
                        }
                        if($ukuranFile>2000000){
                            $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2MB)";
                            header("Location: ../views/nota-lunas");
                            return false;
                        }
                        $verifyPhoto=$id_user.".jpg";
                        move_uploaded_file($tmpName,'../assets/img/img-nota-lunas/'.$verifyPhoto);
                        return $verifyPhoto;
                    }
                    function add_nota_lunas($add){global $conn, $time, $akses_hp, $akses_laptop;
                        $id_nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-nota-lunas']))));
                        $nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_lunas='$id_nota_lunas'");
                        if(mysqli_num_rows($nota_lunas)>0){
                            $_SESSION['message-danger']="Maaf, nomor nota lunas yang anda masukan sudah ada!";
                            $_SESSION['show']=3;
                            header("Location: nota-lunas");return false;
                        }
                        $id_nota_lunas="L".$id_nota_lunas;
                        $laporan_harian=mysqli_query($conn, "SELECT * FROM laporan_harian WHERE id_nota_lunas='$id_nota_lunas'");
                        if(mysqli_num_rows($laporan_harian)>0){
                            $_SESSION['message-danger']="Maaf, nomor nota lunas yang anda masukan sudah ada!";
                            $_SESSION['show']=3;
                            header("Location: nota-lunas");return false;
                        }
                        $nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_lunas='$id_nota_lunas'");
                        $cek_idUser=mysqli_query($conn, "SELECT * FROM users_local ORDER BY id_user DESC LIMIT 1");
                        $loop_idUser=mysqli_fetch_assoc($cek_idUser);
                        if(isset($loop_idUser['id_user'])){
                            $idUser=$loop_idUser['id_user'];
                            $id_user=$idUser+1;
                        }else if(!isset($loop_idUser['id_user'])){
                            $id_user=202027;
                        }
                        $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['username']))));
                        $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['email']))));
                        $users_local=mysqli_query($conn, "SELECT * FROM users_local WHERE email_user='$email'");
                        $tlpn=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['tlpn']))));
                        $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['alamat']))));
                        $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-layanan']))));
                        $id_barang=$id_user;
                        if($id_layanan==1){
                            $type=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['type']))));
                            $seri_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['seri-hp']))));
                            $imei=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['imei']))));
                        }else if($id_layanan==2){
                            $merek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['merek']))));
                            $seri_laptop=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['seri-laptop']))));
                        }
                        $id_teknisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['id-teknisi']))));
                        $tgl_laporan=date('l, d M Y');
                        $tgl_cari=date('Y-m-d');
                        $tgl_masuk=date('l, d M Y');
                        $tgl_ambil=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['tgl-ambil']))));
                        $kerusakan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['kerusakan']))));
                        $pemasukan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['pemasukan']))));
                        $garansi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['garansi']))));
                        $ket_text=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['ket-text']))));
                        $barcode=barcode_nota_lunas($id_user);
                        // image ket
                        if(!empty($ket_text)){
                            $ket_img=ket_img_duplid($id_user);
                            if(!$ket_img){
                                return false;
                            }
                        }
                        if(mysqli_num_rows($nota_lunas)>0){
                            $_SESSION['message-danger']="Maaf, nomor nota sudah ada!";
                            require_once("form-data.php");
                            $_SESSION['show']=1;
                            header("Location: nota-lunas");
                            return false;
                        }
                        if(!empty($email)){
                            if(mysqli_num_rows($users_local)>0){
                                $_SESSION['message-info']="Heii, Email User telah terpakai. Tetap akan mengirimkan pesan ke email: ".$email;
                            }
                        }
                        if(empty($id_layanan)){
                            $_SESSION['message-danger']="Maaf, anda belum memilih layanan!";
                            require_once("form-data.php");
                            $_SESSION['show']=1;
                            header("Location: nota-lunas");
                            return false;
                        }else if(!empty($id_layanan)){
                            if($id_layanan==1){
                                if(empty($type)){
                                    $_SESSION['message-danger']="Maaf, anda belum mengisi type handphone!";
                                    require_once("form-data.php");
                                    $_SESSION['show']=1;
                                    header("Location: nota-lunas");
                                    return false;
                                }
                                if(empty($seri_hp)){
                                    $_SESSION['message-danger']="Maaf, anda belum mengisi seri handphone!";
                                    require_once("form-data.php");
                                    $_SESSION['show']=1;
                                    header("Location: nota-lunas");
                                    return false;
                                }
                                if(empty($imei)){
                                    $_SESSION['message-warning']="Ingat untuk memasukan IMEI Handphone!";
                                }
                            }else if($id_layanan==2){
                                if(empty($merek)){
                                    $_SESSION['message-danger']="Maaf, anda belum mengisi merek laptop!";
                                    require_once("form-data.php");
                                    $_SESSION['show']=1;
                                    header("Location: nota-lunas");
                                    return false;
                                }
                                if(empty($seri_laptop)){
                                    $_SESSION['message-danger']="Maaf, anda belum mengisi seri laptop!";
                                    require_once("form-data.php");
                                    $_SESSION['show']=1;
                                    header("Location: nota-lunas");
                                    return false;
                                }
                            }
                        }
                        if(empty($id_teknisi) || $id_teknisi==0){
                            $_SESSION['message-danger']="Maaf, anda belum memilih teknisi!";
                            require_once("form-data.php");
                            $_SESSION['show']=1;
                            header("Location: nota-lunas");
                            return false;
                        }
                        if($pemasukan<=10000){
                            $_SESSION['message-danger']="Maaf, pastikan anda memasukan biaya dengan benar!";
                            require_once("form-data.php");
                            $_SESSION['show']=1;
                            header("Location: nota-lunas");
                            return false;
                        }
                        mysqli_query($conn, "INSERT INTO users_local VALUES('$id_user','$username','$email','$tlpn','$alamat')");
                        if($id_layanan==1){
                            mysqli_query($conn, "INSERT INTO handphone VALUES('$id_barang','$akses_hp','$type','$seri_hp','$imei')");
                        }else if($id_layanan==2){
                            mysqli_query($conn, "INSERT INTO laptop VALUES('$id_barang','$akses_laptop','$merek','$seri_laptop')");
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Menambahkan nota lunas dengan nomor nota ".$id_nota_lunas." https://ugdhp.com/qr?ac=2&id".$id_nota_lunas;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        if(!empty($email)){
                            require "mail-send.php";
                            $to       = $email;
                            $subject  = 'Pembayaran Sukses';
                            $message  = '
                                <div style="margin: 0; padding: 0;">
                                    <p>Terima kasih telah mempercayakan kami untuk mengatasi masalah kerusakan barang anda. Untuk info lengkap tentang kami anda bisa kunjungi situ kami di</p>
                                    <a href="https://www.ugdhp.com" style="font-weight: bold">UGD HP</a>
                                    <p>dan untuk mengecek garansi anda dapat melihatnya di barcode yang telah kami berikan. Baca juga peraturan kebijakan layanan kami di
                                        <a href="https://www.ugdhp.com/terms-conditions" style="text-decoration: none;">disini</a>
                                    </p>
                                </div>';
                            smtp_mail($to, $subject, $message, '', '', 0, 0, true);
                        }
                        mysqli_query($conn, "INSERT INTO nota_lunas(id_nota_lunas,id_user,id_layanan,id_barang,id_pegawai,tgl_laporan,tgl_cari,tgl_masuk,tgl_ambil,kerusakan,pemasukan,garansi,ket_text,ket_img,time,barcode) VALUES('$id_nota_lunas','$id_user','$id_layanan','$id_barang','$id_teknisi','$tgl_laporan','$tgl_cari','$tgl_masuk','$tgl_ambil','$kerusakan','$pemasukan','$garansi','$ket_text','$ket_img','$time','$barcode')");
                        return mysqli_affected_rows($conn);
                    }
                    function barcode_nota_lunas($id_user){
                        require_once('../assets/phpqrcode/qrlib.php');
                        // $nota_hash=password_hash($id_user, PASSWORD_DEFAULT);
                        $qrvalue = "https://www.ugdhp.com/qr?ac=".$id_user;
                        $tempDir = "../assets/img/img-barcode-modern/";
                        $codeContents = $qrvalue;
                        $fileName = $id_user.".png";
                        $pngAbsoluteFilePath = $tempDir.$fileName;
                        if(!file_exists($pngAbsoluteFilePath)){
                            QRcode::png($codeContents, $pngAbsoluteFilePath);
                        }
                        return $fileName;
                    }
                    function ket_img_duplid($id_user){
                        $namaFile=$_FILES["ket-img"]["name"];
                        $ukuranFile=$_FILES["ket-img"]["size"];
                        $error=$_FILES["ket-img"]["error"];
                        $tmpName=$_FILES["ket-img"]["tmp_name"];
                        $ekstensiGambarValid=['jpg','jpeg','png'];
                        $ekstensiGambar=explode('.',$namaFile);
                        $ekstensiGambar=strtolower(end($ekstensiGambar));
                        if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
                            $_SESSION['message-danger']="Maaf, bukan gambar!";
                            header("Location: ../views/nota-lunas");
                            return false;
                        }
                        if($ukuranFile>2000000){
                            $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2MB)";
                            header("Location: ../views/nota-lunas");
                            return false;
                        }
                        $verifyPhoto=$id_user.".jpg";
                        move_uploaded_file($tmpName,'../assets/img/img-nota-lunas/'.$verifyPhoto);
                        return $verifyPhoto;
                    }
                    function edit_nota_lunas($edit){global $conn, $time;
                        $nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-nota-lunas']))));
                        $id_nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['nota-lunas']))));
                        if(!empty($id_nota_lunas)){
                            if($nota_lunas==$id_nota_lunas){
                                $_SESSION['message-danger']="Maaf, nomor nota lunas anda sama dengan yang lama.";
                                header("Location: nota-lunas");
                                return false;
                            }
                            $nota_lunas_cek=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_lunas='$id_nota_lunas'");
                            if(mysqli_num_rows($nota_lunas_cek)>0){
                                $_SESSION['message-danger']="Maaf, nomor nota lunas sudah ada, silakan cek kembali.";
                                header("Location: nota-lunas");
                                return false;
                            }
                        }else if(empty($id_nota_lunas)){
                            $id_nota_lunas=$nota_lunas;
                        }
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-user']))));
                        $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['username']))));
                        $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['email-user']))));
                        $tlpn=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['tlpn-user']))));
                        $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['alamat-user']))));
                        $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-layanan']))));
                        $id_barang=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-barang']))));
                        if($id_layanan==1){
                            $type=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['type']))));
                            $seri_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['seri-hp']))));
                            $imei=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['imei']))));
                        }else if($id_layanan==2){
                            $merek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['merek']))));
                            $seri_laptop=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['seri-laptop']))));
                        }
                        $kerusakan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['kerusakan']))));
                        $id_teknisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-teknisi']))));
                        $pemasukan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['pemasukan']))));
                        $garansi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['garansi']))));
                        $ket_text=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['ket-text']))));
                        $ket_img_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['ket-text-old']))));
                        if(empty($id_teknisi)){
                            $_SESSION['message-danger']="Maaf, anda belum memilih teknisi!";
                            header("Location: nota-lunas");
                            return false;
                        }
                        // image ket
                        if(!empty($ket_img_old)){
                            $files2=glob("../assets/img/img-nota-lunas/".$ket_img_old);
                            foreach($files2 as $file){
                                if(is_file($file)){
                                    unlink($file);
                                }
                            }
                        }
                        if(!empty($ket_text)){
                            $ket_img=edit_ket_img($id_nota_lunas);
                            if(!$ket_img){
                                return false;
                            }
                        }
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit nota lunas dengan nomor nota ".$id_nota_lunas;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        if($id_layanan==1){
                            mysqli_query($conn, "UPDATE handphone SET type='$type', seri='$seri_hp', imei='$imei' WHERE id_hp='$id_barang'");
                        }else if($id_layanan==2){
                            mysqli_query($conn, "UPDATE laptop SET merek='$merek', seri='$seri_laptop' WHERE id_laptop='$id_barang'");
                        }
                        mysqli_query($conn, "UPDATE users_local SET username='$username', email_user='$email', tlpn_user='$tlpn', alamat_user='$alamat' WHERE id_user='$id_user'");
                        if(!empty($ket_text)){
                            mysqli_query($conn, "UPDATE nota_lunas SET id_nota_lunas='$id_nota_lunas', id_pegawai='$id_teknisi', kerusakan='$kerusakan', pemasukan='$pemasukan', garansi='$garansi', ket_text='$ket_text', ket_img='$ket_img' WHERE id_nota_lunas='$nota_lunas'");
                        }else if(empty($ket_text)){
                            mysqli_query($conn, "UPDATE nota_lunas SET id_nota_lunas='$id_nota_lunas', id_pegawai='$id_teknisi', kerusakan='$kerusakan', pemasukan='$pemasukan', garansi='$garansi' WHERE id_nota_lunas='$nota_lunas'");
                        }
                        return mysqli_affected_rows($conn);
                    }
                    function edit_ket_img($id_nota_lunas){
                        $namaFile=$_FILES["ket-img"]["name"];
                        $ukuranFile=$_FILES["ket-img"]["size"];
                        $error=$_FILES["ket-img"]["error"];
                        $tmpName=$_FILES["ket-img"]["tmp_name"];
                        $ekstensiGambarValid=['jpg','jpeg','png'];
                        $ekstensiGambar=explode('.',$namaFile);
                        $ekstensiGambar=strtolower(end($ekstensiGambar));
                        if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
                            $_SESSION['message-danger']="Maaf, bukan gambar!";
                            header("Location: ../views/nota-lunas");
                            return false;
                        }
                        if($ukuranFile>2000000){
                            $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2MB)";
                            header("Location: ../views/nota-lunas");
                            return false;
                        }
                        $verifyPhoto=$id_nota_lunas.".jpg";
                        move_uploaded_file($tmpName,'../assets/img/img-nota-lunas/'.$verifyPhoto);
                        return $verifyPhoto;
                    }
                    function delete_nota_lunas($del){global $conn, $time;
                        $id_nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-nota-lunas']))));
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-user']))));
                        $id_barang=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-barang']))));
                        $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-layanan']))));
                        $ket_img=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['ket-img']))));
                        $barcode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['barcode']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus nota lunas dengan nomor nota ".$id_nota_lunas;
                        $date_log=date('l, d M Y');
                        if(!empty($ket_img)){
                            $files2=glob("../assets/img/img-nota-lunas/".$ket_img);
                            foreach($files2 as $file){
                                if(is_file($file))
                                unlink($file);
                            }
                        }
                        $files2=glob("../assets/img/img-barcode-modern/".$barcode);
                        foreach($files2 as $file){
                            if(is_file($file))
                            unlink($file);
                        }
                        if($id_layanan==1){
                            mysqli_query($conn, "DELETE FROM handphone WHERE id_hp='$id_barang'");
                        }else if($id_layanan==2){
                            mysqli_query($conn, "DELETE FROM laptop WHERE id_laptop='$id_barang'");
                        }
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "DELETE FROM nota_lunas WHERE id_nota_lunas='$id_nota_lunas'");
                        mysqli_query($conn, "DELETE FROM users_local WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function report_lunas($report){global $conn,$time;
                        $id_nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $report['id-nota-lunas']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengajukan ke Client Service untuk laporan harian dari nomor lunas ".$id_nota_lunas;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "UPDATE nota_lunas SET lapor='1' WHERE id_nota_lunas='$id_nota_lunas'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_dp_report($del){global $conn,$time;
                        $id_data_dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-data-dp']))));
                        $id_nota_dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-nota-dp']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus laporan dp dengan laporan nomor dp ".$id_nota_dp;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "DELETE FROM laporan_dp WHERE id_data_dp='$id_data_dp'");
                        return mysqli_affected_rows($conn);
                    }
                    function approve_report_day($prove){global $conn, $time;
                        $id_nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $prove['id-nota-lunas']))));
                        $nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas WHERE id_nota_lunas='$id_nota_lunas'");
                        $row=mysqli_fetch_assoc($nota_lunas);
                        $id_nota_tinggal=$row['id_nota_tinggal'];
                        $id_nota_dp=$row['id_nota_dp'];
                        $id_user=$row['id_user'];
                        $id_layanan=$row['id_layanan'];
                        $id_barang=$row['id_barang'];
                        $id_pegawai=$row['id_pegawai'];
                        $tgl_laporan=date('l, d M Y');
                        $tgl_cari=date('Y-m-d');
                        $tgl_masuk=$row['tgl_masuk'];
                        $tgl_ambil=$row['tgl_ambil'];
                        $kerusakan=$row['kerusakan'];
                        $pemasukan=$row['pemasukan'];
                        $dp=$row['dp'];
                        $biaya=$row['biaya'];
                        $garansi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $prove['garansi']))));
                        $ket_text=$row['ket_text'];
                        $ket_img=$row['ket_img'];
                        $barcode=$row['barcode'];
                        $id_log=$_SESSION['id-log'];
                        $log="Nota Lunas dengan nomor ".$id_nota_lunas." telah di approve pada tanggal ".$tgl_laporan;
                        $date_log=date('l, d M Y');
                        $laporan_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts WHERE id_nota='$id_nota_tinggal' OR id_nota='$id_nota_dp' OR id_nota='$id_nota_lunas'");
                        if(mysqli_num_rows($laporan_spareparts)>0){
                            mysqli_query($conn, "UPDATE laporan_spareparts SET status_sparepart='3' WHERE id_nota='$id_nota_tinggal' OR id_nota='$id_nota_dp' OR id_nota='$id_nota_lunas'");
                        }
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "INSERT INTO laporan_harian(id_nota_lunas,id_nota_tinggal,id_nota_dp,id_user,id_layanan,id_barang,id_pegawai,tgl_laporan,tgl_cari,tgl_masuk,tgl_ambil,kerusakan,pemasukan,dp,biaya,garansi,ket_text,ket_img,barcode,time) VALUES('$id_nota_lunas','$id_nota_tinggal','$id_nota_dp','$id_user','$id_layanan','$id_barang','$id_pegawai','$tgl_laporan','$tgl_cari','$tgl_masuk','$tgl_ambil','$kerusakan','$pemasukan','$dp','$biaya','$garansi','$ket_text','$ket_img','$barcode','$time')");
                        mysqli_query($conn, "DELETE FROM nota_lunas WHERE id_nota_lunas='$id_nota_lunas'");
                        return mysqli_affected_rows($conn);
                    }
                    function fix_it_again_report_day($fix){global $conn, $time;
                        $id_nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $fix['id-nota-lunas']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Nota Lunas dengan nomor ".$id_nota_lunas." tidak dapat disetujui oleh Client Service!";
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "UPDATE nota_lunas SET lapor='2' WHERE id_nota_lunas='$id_nota_lunas'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_report_day($del){global $conn, $time;
                        $id_laporan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-laporan']))));
                        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-user']))));
                        $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-layanan']))));
                        $ket_img=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['ket-img']))));
                        $barcode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['barcode']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Laporan ber-ID ".$id_laporan." dihapus oleh Client Service!";
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        if($id_layanan==1){
                            mysqli_query($conn, "DELETE FROM handphone WHERE id_hp='$id_user'");
                        }else if($id_layanan==2){
                            mysqli_query($conn, "DELETE FROM laptop WHERE id_laptop='$id_user'");
                        }
                        if(!empty($ket_img)){
                            $files2=glob("../assets/img/img-nota-lunas/".$ket_img);
                            foreach($files2 as $file){
                                if(is_file($file))
                                unlink($file);
                            }
                        }
                        $files2=glob("../assets/img/img-barcode-modern/".$barcode);
                        foreach($files2 as $file){
                            if(is_file($file))
                            unlink($file);
                        }
                        mysqli_query($conn, "DELETE FROM laporan_harian WHERE id_laporan='$id_laporan'");
                        mysqli_query($conn, "DELETE FROM users_local WHERE id_user='$id_user'");
                        return mysqli_affected_rows($conn);
                    }
                    function add_expense_report($add){global $conn, $time;
                        $jenis=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['jenis']))));
                        $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['ket']))));
                        $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['biaya']))));
                        $tgl=date('l, d M Y');
                        $tgl_cari=date('Y-m-d');
                        $id_log=$_SESSION['id-log'];
                        $log="Insert data pengeluaran jenis: ".$jenis;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "INSERT INTO laporan_pengeluaran(jenis_pengeluaran,ket,biaya_pengeluaran,tgl_pengeluaran,tgl_cari,time) VALUES('$jenis','$ket','$biaya','$tgl','$tgl_cari','$time')");
                        return mysqli_affected_rows($conn);
                    }
                    function edit_expense_report($edit){global $conn, $time;
                        $id_pengeluaran=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['id-pengeluaran']))));
                        $jenis=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['jenis']))));
                        $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['ket']))));
                        $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $edit['biaya']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Mengedit data pengeluaran dengan id: ".$id_pengeluaran;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "UPDATE laporan_pengeluaran SET jenis_pengeluaran='$jenis', ket='$ket', biaya_pengeluaran='$biaya' WHERE id_pengeluaran='$id_pengeluaran'");
                        return mysqli_affected_rows($conn);
                    }
                    function delete_expense_report($del){global $conn, $time;
                        $id_pengeluaran=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $del['id-pengeluaran']))));
                        $id_log=$_SESSION['id-log'];
                        $log="Menghapus data pengeluaran dengan id: ".$id_pengeluaran;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "DELETE FROM laporan_pengeluaran WHERE id_pengeluaran='$id_pengeluaran'");
                        return mysqli_affected_rows($conn);
                    }
                    function add_report_sparepart($add){global $conn,$time;
                        $cek_idSparepart=mysqli_query($conn, "SELECT * FROM laporan_spareparts ORDER BY id_sparepart DESC LIMIT 1");
                        $loop_idSparepart=mysqli_fetch_assoc($cek_idSparepart);
                        if(isset($loop_idSparepart['id_sparepart'])){
                            $idSparepart=$loop_idSparepart['id_sparepart'];
                            $id_sparepart=$idSparepart+1;
                        }else if(!isset($loop_idSparepart['id_sparepart'])){
                            $id_sparepart=202027;
                        }
                        $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['ket']))));
                        $suplayer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['suplayer']))));
                        $jumlah_barang=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['jumlah-barang']))));
                        $harga=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['harga']))));
                        $total=$harga*$jumlah_barang;
                        $ket_plus=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $add['ket-plus']))));
                        $tgl_masuk=date('l, d M Y');
                        $tgl_cari=date('Y-m-d');
                        $barcode=barcode_sparepart($id_sparepart);
                        $id_log=$_SESSION['id-log'];
                        $log="Menambah data sparepart dengan ket ".$ket;
                        $date_log=date('l, d M Y');
                        mysqli_query($conn, "INSERT INTO employee_log(id_log,log,date,time) VALUES('$id_log','$log','$date_log','$time')");
                        mysqli_query($conn, "INSERT INTO laporan_spareparts(id_sparepart,tgl_masuk,tgl_cari,time,ket,suplayer,jmlh_barang,harga,total,ket_plus,barcode,status_sparepart) VALUES('$id_sparepart','$tgl_masuk','$tgl_cari','$time','$ket','$suplayer','$jumlah_barang','$harga','$total','$ket_plus','$barcode','1')");
                        return mysqli_affected_rows($conn);
                    }
                    function barcode_sparepart($id_sparepart){
                        require_once('../assets/phpqrcode/qrlib.php');
                        $qrvalue = "https://www.ugdhp.com/views/qr?ac=".$id_sparepart;
                        $tempDir = "../assets/img/img-barcode-sparepart/";
                        $codeContents = $qrvalue;
                        $fileName = $id_sparepart.".png";
                        $pngAbsoluteFilePath = $tempDir.$fileName;
                        if(!file_exists($pngAbsoluteFilePath)){
                            QRcode::png($codeContents, $pngAbsoluteFilePath);
                        }
                        return $fileName;
                    }
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