<?php if (!isset($_SESSION)) {session_start();}
require_once("connect.php");require_once("functions.php");
// == Alert ==
    if (isset($_SESSION['message-success'])) {
        $message_success = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                " . $_SESSION['message-success'] . "
                    <form action='' method='POST'>
                        <button type='submit' name='message-success' class='close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </form>
                </div>";
    }
    if (isset($_SESSION['message-warning'])) {
        $message_warning = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                " . $_SESSION['message-warning'] . "
                    <form action='' method='POST'>
                        <button type='submit' name='message-warning' class='close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </form>
                </div>";
    }
    if (isset($_SESSION['message-danger'])) {
        $message_danger = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                " . $_SESSION['message-danger'] . "
                    <form action='' method='POST'>
                        <button type='submit' name='message-danger' class='close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </form>
                </div>";
    }
    if (isset($_SESSION['message-info'])) {
        $message_info = "<div class='alert alert-info alert-dismissible fade show' role='alert'>
                " . $_SESSION['message-info'] . "
                    <form action='' method='POST'>
                        <button type='submit' name='message-info' class='close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </form>
                </div>";
    }
    if (isset($_SESSION['message-dark'])) {
        $message_dark = "<div class='alert alert-dark alert-dismissible fade show' role='alert'>
                " . $_SESSION['message-dark'] . "
                    <form action='' method='POST'>
                        <button type='submit' name='message-dark' class='close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </form>
                </div>";
    }
    if (isset($_POST['message-success'])) {
        unset($_SESSION['message-success']);
    }
    if (isset($_POST['message-warning'])) {
        unset($_SESSION['message-warning']);
    }
    if (isset($_POST['message-danger'])) {
        unset($_SESSION['message-danger']);
    }
    if (isset($_POST['message-info'])) {
        unset($_SESSION['message-info']);
    }
    if (isset($_POST['message-dark'])) {
        unset($_SESSION['message-dark']);
    }
// == Public ==
    if(isset($_POST['view-location'])){
        $_SESSION['view-location']=1;
        header("Location: ./");exit;
    }
    if(isset($_POST['close-view-location'])){
        unset($_SESSION['view-location']);
        header("Location: ./");exit;
    }
    if(isset($_POST['mail-visitor'])){
        if(contact($_POST)>0){
            if(isset($_SESSION['message-danger'])){unset($_SESSION['message-danger']);}
            $_SESSION['message-success']="Your message has been sent successfully, we will reply as soon as possible.";
            header("Location: contact");exit;
        }
    }
    if(isset($_POST['signin'])){
        if(signin($_POST)>0){
            header("Location: ../Application/session/redirect-auth.php");exit;
        }
    }
    if(isset($_POST['signup'])){
        if(signup($_POST)>0){
            if(isset($_SESSION['mail-access'])||isset($_SESSION['mail-access'])){unset($_SESSION['mail-access']);unset($_SESSION['message-danger']);}
            $encrypt_email=password_hash($_POST['email'], PASSWORD_DEFAULT);
            header("Location: verification?auth=$encrypt_email");exit;
        }
    }
    if(isset($_POST['forgot-password'])){
        if(forgot_password($_POST)>0){
            if(isset($_SESSION['message-danger'])){unset($_SESSION['message-danger']);}
            header("Location: new-password");exit;
        }
    }
    if(isset($_POST['new-password'])){
        if(new_password($_POST)>0){
            if(isset($_SESSION['message-danger'])){unset($_SESSION['message-danger']);}
            header("Location: signin");exit;
        }
    }
// == Private ==
    if(isset($_SESSION['id-user'])){
        // => all roles
            $color_black = 'style="color: #000"';
            $bg_black = 'style="background: #000;color: #fff;"';
            $logout='../Application/controller/logout';
            $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['id-user']))));
        // => role selection
            if($_SESSION['id-role']<=6){ // => all administrator | == Dashboard
                $user_views_profile=mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
                $many_users=mysqli_query($conn, "SELECT * FROM users WHERE id_role>1");
                $row_many_users=mysqli_num_rows($many_users);
                $many_notes=mysqli_query($conn, "SELECT * FROM notes WHERE id_nota<5");
                $row_many_notes=mysqli_num_rows($many_notes);
                $many_report=mysqli_query($conn, "SELECT * FROM notes WHERE id_nota>4");
                $row_many_report=mysqli_num_rows($many_report);
                $many_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts");
                $row_many_spareparts=mysqli_num_rows($many_spareparts);
                $today=date('Y-m-d');
                $news_reviews=mysqli_query($conn, "SELECT * FROM notes 
                    JOIN notes_type ON notes.id_nota=notes_type.id_nota 
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category 
                    JOIN notes_status ON notes.id_status=notes_status.id_status 
                    WHERE tg_cari='$today'
                ");
                $cal_handphone=mysqli_query($conn, "SELECT * FROM notes WHERE id_layanan=1");
                $row_cal_handphone=mysqli_num_rows($cal_handphone);
                $cal_laptop=mysqli_query($conn, "SELECT * FROM notes WHERE id_layanan=2");
                $row_cal_laptop=mysqli_num_rows($cal_laptop);
                $cal_website=mysqli_query($conn, "SELECT * FROM notes WHERE id_layanan=3");
                $row_cal_website=mysqli_num_rows($cal_website);
                $cal_available=mysqli_query($conn, "SELECT * FROM notes WHERE id_layanan=4");
                $row_cal_available=mysqli_num_rows($cal_available);
                $users_activity=mysqli_query($conn, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE id_user!='$id_user'");
                $my_profile=mysqli_query($conn, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE id_user='$id_user'");
                if(isset($_POST['edit-profile-employee'])){
                    if(photo_profile($_POST)>0){
                        $_SESSION['message-success']="Foto profile kamu berhasil diubah.";
                        header("Location: profile");exit;
                    }
                }
                if(isset($_POST['edit-email-user'])){
                    if(email_profile($_POST)>0){
                        $_SESSION['message-success']="Email kamu berhasil diubah.";
                        header("Location: ../Application/controller/logout");exit;
                    }
                }
                if(isset($_POST['edit-biodata-user'])){
                    if(biodata_profile($_POST)>0){
                        $_SESSION['message-success']="Biodata kamu berhasil diubah.";
                        header("Location: profile");exit;
                    }
                }
                $activity=mysqli_query($conn, "SELECT * FROM users_log WHERE id_log='$id_user' ORDER BY id DESC");
                $settings=mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
                if(isset($_POST['ubah-sandi-user'])){
                    if(password_profile($_POST)>0){
                        $_SESSION['message-success']="Password kamu berhasil diubah.";
                        header("Location: ../Application/controller/logout");exit;
                    }
                }
                $help_message=mysqli_query($conn, "SELECT * FROM users_help WHERE id_user='$id_user' ORDER BY id_help DESC");
                if(isset($_POST['submit-help'])){
                    if(help_message($_POST)>0){
                        $_SESSION['message-success']="Pesan bantuan kamu berhasil dikirim.";
                        header("Location: help");exit;
                    }
                }
                $report_problem=mysqli_query($conn, "SELECT * FROM report_problem");
            }
            if($_SESSION['id-role']<=2){ // => founder & developer app
                $help_message_admin=mysqli_query($conn, "SELECT * FROM users_help ORDER BY id_help DESC");
                if(isset($_POST['help-admin'])){
                    if(help_answer_message($_POST)>0){
                        $_SESSION['message-success']="Pesan berhasil di balas.";
                        header("Location: help");exit;
                    }
                }
                if(isset($_POST['submit-report-problem'])){
                    if(report_problem($_POST)>0){
                        $_SESSION['message-success']="Report telah di tambahkan.";
                        header("Location: report-problem");exit;
                    }
                }
                $data1=25;
                $result1=mysqli_query($conn, "SELECT * FROM menu");
                $total1=mysqli_num_rows($result1);
                $total_page1=ceil($total1/$data1);
                $page1=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data1=($data1*$page1)-$data1;
                $menus=mysqli_query($conn, "SELECT * FROM menu");
                $menus_edit=mysqli_query($conn, "SELECT * FROM menu LIMIT $awal_data1, $data1");
                if(isset($_POST['submit-menu'])){
                    if(menu($_POST)>0){
                        $_SESSION['message-success']="Menu baru telah ditambahkan.";
                        header("Location: menu");exit;
                    }
                }
                if(isset($_POST['ubah-menu'])){
                    if(edit_menu($_POST)>0){
                        $_SESSION['message-success']="Menu telah berhasil diubah.";
                        header("Location: menu");exit;
                    }
                }
                if(isset($_POST['hapus-menu'])){
                    if(delete_menu($_POST)>0){
                        $_SESSION['message-success']="Yah menunya udah dihapus, semoga ada menu yang lebih baik :).";
                        header("Location: menu");exit;
                    }
                }
                $menu_status_insert=mysqli_query($conn, "SELECT * FROM menu_status");
                $menu_status_edit=mysqli_query($conn, "SELECT * FROM menu_status");
                $data2=25;
                $result2=mysqli_query($conn, "SELECT * FROM menu_sub");
                $total2=mysqli_num_rows($result2);
                $total_page2=ceil($total2/$data2);
                $page2=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data2=($data2*$page2)-$data2;
                $menu_sub=mysqli_query($conn, "SELECT * FROM menu_sub JOIN menu ON menu_sub.id_menu=menu.id_menu JOIN menu_status ON menu_sub.is_active=menu_status.id_status LIMIT $awal_data2, $data2");
                if(isset($_POST['submit-sub-menu'])){
                    if(sub_menu($_POST)>0){
                        $_SESSION['message-success']="Sub Menu baru telah ditambahkan.";
                        header("Location: sub-menu");exit;
                    }
                }
                if(isset($_POST['edit-sub-menu'])){
                    if(edit_sub_menu($_POST)>0){
                        $_SESSION['message-success']="Sub Menu berhasil diubah.";
                        header("Location: sub-menu");exit;
                    }
                }
                if(isset($_POST['delete-sub-menu'])){
                    if(delete_sub_menu($_POST)>0){
                        $_SESSION['message-success']="Yah sub menunya hilang, mungkin ada sub menu yang lebih menarik lainnya :).";
                        header("Location: sub-menu");exit;
                    }
                }
                $data3=25;
                $result3=mysqli_query($conn, "SELECT * FROM menu_access");
                $total3=mysqli_num_rows($result3);
                $total_page3=ceil($total3/$data3);
                $page3=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data3=($data3*$page3)-$data3;
                $menu_access=mysqli_query($conn, "SELECT * FROM menu_access JOIN users_role ON menu_access.role_id=users_role.id_role JOIN menu ON menu_access.id_menu=menu.id_menu LIMIT $awal_data3, $data3");
                $users_roles=mysqli_query($conn, "SELECT * FROM users_role WHERE id_role<=6");
                if(isset($_POST['submit-access-menu'])){
                    if(access_menu($_POST)>0){
                        $_SESSION['message-success']="Berhasil menambahkan hak akses menu.";
                        header("Location: access-menu");exit;
                    }
                }
                if(isset($_POST['hapus-access-menu'])){
                    if(delete_access_menu($_POST)>0){
                        $_SESSION['message-success']="Yah hak akses menunya hilang, mungkin ada kesempatan hak akses untuk role lainnya :).";
                        header("Location: access-menu");exit;
                    }
                }
                $data4=25;
                $result4=mysqli_query($conn, "SELECT * FROM menu_sub_access");
                $total4=mysqli_num_rows($result4);
                $total_page4=ceil($total4/$data4);
                $page4=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data4=($data4*$page4)-$data4;
                $menu_sub_access=mysqli_query($conn, "SELECT * FROM menu_sub_access JOIN users_role ON menu_sub_access.role_id=users_role.id_role JOIN menu_sub ON menu_sub_access.id_sub_menu=menu_sub.id_sub_menu LIMIT $awal_data4, $data4");
                if(isset($_POST['submit-access-sub-menu'])){
                    if(access_sub_menu($_POST)>0){
                        $_SESSION['message-success']="Berhasil menambahkan hak akses sub menu.";
                        header("Location: access-sub-menu");exit;
                    }
                }
                if(isset($_POST['hapus-access-sub-menu'])){
                    if(delete_access_sub_menu($_POST)>0){
                        $_SESSION['message-success']="Yah hak akses sub menunya hilang, mungkin ada kesempatan hak akses untuk role lainnya :).";
                        header("Location: access-sub-menu");exit;
                    }
                }
                $privacy_policy=mysqli_query($conn, "SELECT * FROM privacy_policy");
                if(isset($_POST['submit-privacy'])){
                    if(privacy_policy($_POST)>0){
                        $_SESSION['message-success']="Kebikajan privasi telah anda tambahkan.";
                        header("Location: privacy-policy");exit;
                    }
                }
                if(isset($_POST['edit-privacy'])){
                    if(edit_privacy_policy($_POST)>0){
                        $_SESSION['message-success']="Kebikajan privasi telah anda edit.";
                        header("Location: privacy-policy");exit;
                    }
                }
                if(isset($_POST['delete-privacy'])){
                    if(delete_privacy_policy($_POST)>0){
                        $_SESSION['message-success']="Yah... kebikajan privasi sudah dihapus, silakan masukan kebijakan yang baru ya :).";
                        header("Location: privacy-policy");exit;
                    }
                }
                $term_of_service=mysqli_query($conn, "SELECT * FROM term_of_service");
                if(isset($_POST['submit-term'])){
                    if(term_of_service($_POST)>0){
                        $_SESSION['message-success']="Persyaratan layanan telah anda tambahkan.";
                        header("Location: term-of-service");exit;
                    }
                }
                if(isset($_POST['edit-term'])){
                    if(edit_term_of_service($_POST)>0){
                        $_SESSION['message-success']="Persyaratan layanan telah anda edit.";
                        header("Location: term-of-service");exit;
                    }
                }
                if(isset($_POST['delete-term'])){
                    if(delete_term_of_service($_POST)>0){
                        $_SESSION['message-success']="Yah... persyaratan layanan sudah dihapus, silakan masukan kebijakan yang baru ya :).";
                        header("Location: term-of-service");exit;
                    }
                }
            }
            if($_SESSION['id-role']<=3){ // => administrasi
                $data5=25;
                $result5=mysqli_query($conn, "SELECT * FROM users");
                $total5=mysqli_num_rows($result5);
                $total_page5=ceil($total5/$data5);
                $page5=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data5=($data5*$page5)-$data5;
                if($_SESSION['id-role']==1){
                    $users_data=mysqli_query($conn, "SELECT * FROM users 
                        JOIN category_services ON users.id_category=category_services.id_category 
                        JOIN users_role ON users.id_role=users_role.id_role
                        JOIN users_status ON users.is_active=users_status.is_active
                        JOIN users_access ON users.id_access=users_access.id_access 
                        WHERE users.id_user!='$id_user' LIMIT $awal_data5, $data5
                    ");
                }else{
                    $users_data=mysqli_query($conn, "SELECT * FROM users 
                        JOIN category_services ON users.id_category=category_services.id_category 
                        JOIN users_role ON users.id_role=users_role.id_role
                        JOIN users_status ON users.is_active=users_status.is_active
                        JOIN users_access ON users.id_access=users_access.id_access 
                        WHERE users.id_role>=3 AND users.id_user!='$id_user' LIMIT $awal_data5, $data5
                    ");
                }
                $users_data_role=mysqli_query($conn, "SELECT * FROM users_role");
                $users_data_status=mysqli_query($conn, "SELECT * FROM users_status");
                $users_data_access=mysqli_query($conn, "SELECT * FROM users_access");
                if(isset($_POST['edit-role-user'])){
                    if(users_role($_POST)>0){
                        $_SESSION['message-success']="Role users berhasil diubah.";
                        header("Location: users");exit;
                    }
                }
                if(isset($_POST['edit-status-user'])){
                    if(users_status($_POST)>0){
                        $_SESSION['message-success']="Status users berhasil diubah.";
                        header("Location: users");exit;
                    }
                }
                if(isset($_POST['edit-access-user'])){
                    if(users_access($_POST)>0){
                        $_SESSION['message-success']="Akses users berhasil diubah.";
                        header("Location: users");exit;
                    }
                }
                if(isset($_POST['delete-user'])){
                    if(delete_users($_POST)>0){
                        $_SESSION['message-success']="Akun users berhasil dihapus.";
                        header("Location: users");exit;
                    }
                }
            }
            if($_SESSION['id-role']<=4 || $_SESSION['id-role']==5){ // => teknisi & web dev/des
            }
            if($_SESSION['id-role']<=6){ // => web client services
            }
            if($_SESSION['id-role']==7){ // => users
                if(isset($_POST['view-location'])){
                    $_SESSION['view-location']=1;
                    header("Location: ./");exit;
                }
                if(isset($_POST['close-view-location'])){
                    unset($_SESSION['view-location']);
                    header("Location: ./");exit;
                }
                if(isset($_POST['mail-user'])){
                    if(contact_user($_POST)>0){
                        if(isset($_SESSION['message-danger'])){unset($_SESSION['message-danger']);}
                        $_SESSION['message-success']="Your message has been sent successfully, we will reply as soon as possible.";
                        header("Location: contact");exit;
                    }
                }
                if(isset($_POST['logout-user'])){
                    header("Location: ../Application/controller/logout");exit;
                }
            }
    }