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
            if($_SESSION['id-role']==1 || $_SESSION['id-role']==2){ // => founder & developer app
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
                $menus=mysqli_query($conn, "SELECT * FROM menu");
                if(isset($_POST['submit-menu'])){
                    if(menu($_POST)>0){
                        $_SESSION['message-success']="Menu baru telah ditambahkan.";
                        header("Location: menu");exit;
                    }
                }
            }
            if($_SESSION['id-role']==3){ // => administrasi
            }
            if($_SESSION['id-role']==4 || $_SESSION['id-role']==5){ // => teknisi & web dev/des
            }
            if($_SESSION['id-role']==6){ // => web client services
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