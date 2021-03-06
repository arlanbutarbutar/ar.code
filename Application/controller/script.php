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
            $today=date('Y-m-d');
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
                    WHERE tgl_cari='$today'
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
                $data10=25;
                $result10=mysqli_query($conn, "SELECT * FROM notes");
                $total10=mysqli_num_rows($result10);
                $total_page10=ceil($total10/$data10);
                $page10=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data10=($data10*$page10)-$data10;
                $notes_all=mysqli_query($conn, "SELECT * FROM notes 
                    JOIN notes_type ON notes.id_nota=notes_type.id_nota
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category
                    JOIN notes_status ON notes.id_status=notes_status.id_status
                    LIMIT $awal_data10, $data10 ORDER BY notes.id_data DESC
                ");
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
                $data6=25;
                $result6=mysqli_query($conn, "SELECT * FROM notes_type");
                $total6=mysqli_num_rows($result6);
                $total_page6=ceil($total6/$data6);
                $page6=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data6=($data6*$page6)-$data6;
                $notes_type=mysqli_query($conn, "SELECT * FROM notes_type LIMIT $awal_data6, $data6");
                if(isset($_POST['submit-notes-type'])){
                    if(notes_type($_POST)>0){
                        $_SESSION['message-success']="Berhasil menambahkan nota baru.";
                        header("Location: setting-nota");exit;
                    }
                }
                if(isset($_POST['edit-notes-type'])){
                    if(edit_notes_type($_POST)>0){
                        $_SESSION['message-success']="Berhasil mengubah nota.".$_POST['name'].".";
                        header("Location: setting-nota");exit;
                    }
                }
                if(isset($_POST['delete-notes-type'])){
                    if(delete_notes_type($_POST)>0){
                        $_SESSION['message-success']="Berhasil menghapus nota ".$_POST['name'].".";
                        header("Location: setting-nota");exit;
                    }
                }
                $notes_views_today=mysqli_query($conn, "SELECT * FROM notes
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category
                    JOIN notes_status ON notes.id_status=notes_status.id_status 
                    WHERE notes.tgl_cari='$today' AND notes.id_nota=1 OR notes.id_nota=2 ORDER BY notes.id_data DESC
                ");
                $data7=25;
                $result7=mysqli_query($conn, "SELECT * FROM notes");
                $total7=mysqli_num_rows($result7);
                $total_page7=ceil($total7/$data7);
                $page7=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data7=($data7*$page7)-$data7;
                $notes_views_all=mysqli_query($conn, "SELECT * FROM notes 
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category
                    JOIN notes_status ON notes.id_status=notes_status.id_status 
                    WHERE notes.id_nota=1 OR notes.id_nota=2 ORDER BY notes.id_data DESC
                    LIMIT $awal_data7, $data7
                ");
                $category_services=mysqli_query($conn, "SELECT * FROM category_services WHERE id_category<=2");
                $users_teknisi=mysqli_query($conn, "SELECT * FROM users WHERE id_role=4");
                if(isset($_POST['submit-notes'])){
                    if(notes($_POST)>0){
                        $_SESSION['message-success']="Berhasil memasukan nota";
                        header("Location: nota-tinggal");exit;
                    }
                }
                if(isset($_POST['remake-barcode'])){
                    if(remake_barcode($_POST)>0){
                        $_SESSION['message-success']="Berhasil membuat ulang barcode";
                        header("Location: qr?auth=".$_POST['id-user']);exit;
                    }
                }
                if(isset($_POST['cancel-notes'])){
                    if(notes_cancel($_POST)>0){
                        $_SESSION['message-success']="Nota telah dibatalkan untuk perbaikan";
                        header("Location: qr-aksi?auth=".$_POST['data-encrypt']);exit;
                    }
                }
                if(isset($_POST['ubah-status-pending'])){
                    if(notes_pending($_POST)>0){
                        $_SESSION['message-success']="Nota berhasil masukan ke antrian perbaikan";
                        header("Location: qr-aksi?auth=".$_POST['data-encrypt']);exit;
                    }
                }
                if(isset($_POST['edit-notes'])){
                    if(edit_notes($_POST)>0){
                        $_SESSION['message-success']="Berhasil mengubah nota";
                        header("Location: qr-aksi?auth=".$_POST['data-encrypt']);exit;
                    }
                }
                if(isset($_POST['delete-notes'])){
                    if(delete_notes($_POST)>0){
                        $_SESSION['message-success']="Berhasil menghapus nota";
                        header("Location: nota-tinggal");exit;
                    }
                }
                if(isset($_POST['submit-report'])){
                    if(notes_report($_POST)>0){
                        $_SESSION['message-success']="Nota berhasil dimasukan ke laporan harian";
                        header("Location: qr-aksi?auth=".$_POST['data-encrypt']);exit;
                    }
                }
                if(isset($_POST['submit-garansi'])){
                    if(notes_garansi($_POST)>0){
                        $_SESSION['message-success']="Garansi berhasil dipakai untuk perbaikan ulang.";
                        header("Location: qr-aksi?auth=".$_POST['data-encrypt']);exit;
                    }
                }
                $data8=25;
                $result8=mysqli_query($conn, "SELECT * FROM notes");
                $total8=mysqli_num_rows($result8);
                $total_page8=ceil($total8/$data8);
                $page8=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data8=($data8*$page8)-$data8;
                $notes_lunas_views_all=mysqli_query($conn, "SELECT * FROM notes 
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category
                    JOIN notes_status ON notes.id_status=notes_status.id_status 
                    WHERE notes.id_nota=3 ORDER BY notes.id_data DESC
                    LIMIT $awal_data8, $data8
                ");
                if(isset($_POST['submit-notes-lunas'])){
                    if(notes_lunas($_POST)>0){
                        $_SESSION['message-success']="Berhasil memasukan nota lunas, data langsung ke laporan harian";
                        header("Location: nota-lunas");exit;
                    }
                }
                $data9=25;
                $result9=mysqli_query($conn, "SELECT * FROM notes");
                $total9=mysqli_num_rows($result9);
                $total_page9=ceil($total9/$data9);
                $page9=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data9=($data9*$page9)-$data9;
                $notes_cancel=mysqli_query($conn, "SELECT * FROM notes 
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category
                    JOIN notes_status ON notes.id_status=notes_status.id_status 
                    WHERE notes.id_nota=4 ORDER BY notes.id_data DESC
                    LIMIT $awal_data9, $data9
                ");
                $data12=25;
                $result12=mysqli_query($conn, "SELECT * FROM notes");
                $total12=mysqli_num_rows($result12);
                $total_page12=ceil($total12/$data12);
                $page12=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data12=($data12*$page12)-$data12;
                $report_days=mysqli_query($conn, "SELECT * FROM notes 
                    JOIN notes_type ON notes.id_nota=notes_type.id_nota
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category
                    JOIN notes_status ON notes.id_status=notes_status.id_status 
                    WHERE notes.id_nota=5 ORDER BY notes.id_data DESC
                    LIMIT $awal_data12, $data12
                ");
                $data13=25;
                $result13=mysqli_query($conn, "SELECT * FROM notes");
                $total13=mysqli_num_rows($result13);
                $total_page13=ceil($total13/$data13);
                $page13=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data13=($data13*$page13)-$data13;
                $report_dp=mysqli_query($conn, "SELECT * FROM notes 
                    JOIN notes_type ON notes.id_nota=notes_type.id_nota
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category
                    JOIN notes_status ON notes.id_status=notes_status.id_status 
                    WHERE notes.id_nota=5 AND notes.id_nota_dp>0 ORDER BY notes.id_data DESC
                    LIMIT $awal_data13, $data13
                ");
                $data14=25;
                $result14=mysqli_query($conn, "SELECT * FROM laporan_pengeluaran");
                $total14=mysqli_num_rows($result14);
                $total_page14=ceil($total14/$data14);
                $page14=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data14=($data14*$page14)-$data14;
                $report_expense=mysqli_query($conn, "SELECT * FROM laporan_pengeluaran ORDER BY id_pengeluaran DESC LIMIT $awal_data14, $data14");
                if(isset($_POST['submit-expense'])){
                    if(report_expense($_POST)>0){
                        $_SESSION['message-success']="Berhasil memasukan pengeluaran";
                        header("Location: report-expense");exit;
                    }
                }
                if(isset($_POST['edit-expense'])){
                    if(edit_report_expense($_POST)>0){
                        $_SESSION['message-success']="Berhasil mengedit pengeluaran";
                        header("Location: report-expense");exit;
                    }
                }
                if(isset($_POST['delete-expense'])){
                    if(delete_report_expense($_POST)>0){
                        $_SESSION['message-success']="Berhasil menghapus pengeluaran";
                        header("Location: report-expense");exit;
                    }
                }
                $data15=25;
                $result15=mysqli_query($conn, "SELECT * FROM laporan_spareparts");
                $total15=mysqli_num_rows($result15);
                $total_page15=ceil($total15/$data15);
                $page15=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data15=($data15*$page15)-$data15;
                $report_spareparts_in=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN supplier ON laporan_spareparts.suplayer=supplier.id_supplier WHERE status_sparepart=1 ORDER BY laporan_spareparts.id_sparepart DESC LIMIT $awal_data15, $data15");
                $supplier=mysqli_query($conn, "SELECT * FROM supplier");
                if(isset($_POST['submit-sparepart-qr'])){
                    if(report_sparepart_qr($_POST)>0){
                        $_SESSION['message-success']="Berhasil memasukan sparepart";
                        header("Location: qr-aksi?auth=".$_POST['data-encrypt']);exit;
                    }
                }
                if(isset($_POST['edit-sparepart-qr'])){
                    if(edit_report_sparepart_qr($_POST)>0){
                        $_SESSION['message-success']="Berhasil memasukan sparepart";
                        header("Location: qr-aksi?auth=".$_POST['data-encrypt']);exit;
                    }
                }
                if(isset($_POST['delete-sparepart-qr'])){
                    if(delete_report_sparepart_qr($_POST)>0){
                        $_SESSION['message-success']="Berhasil menghapus sparepart";
                        header("Location: qr-aksi?auth=".$_POST['data-encrypt']);exit;
                    }
                }
                if(isset($_POST['submit-sparepart'])){
                    if(report_sparepart($_POST)>0){
                        $_SESSION['message-success']="Berhasil memasukan sparepart";
                        header("Location: report-spareparts");exit;
                    }
                }
                if(isset($_POST['edit-sparepart'])){
                    if(edit_report_sparepart($_POST)>0){
                        $_SESSION['message-success']="Berhasil mengedit sparepart";
                        if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Masuk'){
                            header("Location: report-spareparts");exit;
                        }else if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Dipakai'){
                            header("Location: report-spareparts-pickup");exit;
                        }else if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Diambil'){
                            header("Location: report-spareparts-out");exit;
                        }else if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Semua'){
                            header("Location: report-spareparts-all");exit;
                        }
                    }
                }
                if(isset($_POST['delete-sparepart'])){
                    if(delete_report_sparepart($_POST)>0){
                        $_SESSION['message-success']="Berhasil menghapus sparepart";
                        if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Masuk'){
                            header("Location: report-spareparts");exit;
                        }else if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Dipakai'){
                            header("Location: report-spareparts-pickup");exit;
                        }else if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Diambil'){
                            header("Location: report-spareparts-out");exit;
                        }else if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Semua'){
                            header("Location: report-spareparts-all");exit;
                        }
                    }
                }
                if(isset($_POST['remake-qrcode-sparepart'])){
                    if(remake_qrcode_sparepart($_POST)>0){
                        $_SESSION['message-success']="Berhasil membuat ulang qrcode sparepart";
                        if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Masuk'){
                            header("Location: report-spareparts");exit;
                        }else if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Dipakai'){
                            header("Location: report-spareparts-pickup");exit;
                        }else if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Diambil'){
                            header("Location: report-spareparts-out");exit;
                        }else if(isset($_SESSION['page-name']) && $_SESSION['page-name']=='Sparepart Semua'){
                            header("Location: report-spareparts-all");exit;
                        }
                    }
                }
                $notes_for_spareparts=mysqli_query($conn, "SELECT * FROM notes WHERE notes.id_status<=5");
                if(isset($_POST['notes-sparepart'])){
                    if(notes_sparepart($_POST)>0){
                        $_SESSION['message-success']="Berhasil menambahkan nota tinggal/lunas";
                        header("Location: qr-spareparts?auth=".$_POST['data-encrypt']);exit;
                    }
                }
                $data16=25;
                $result16=mysqli_query($conn, "SELECT * FROM laporan_spareparts");
                $total16=mysqli_num_rows($result16);
                $total_page16=ceil($total16/$data16);
                $page16=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data16=($data16*$page16)-$data16;
                $report_spareparts_take=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN supplier ON laporan_spareparts.suplayer=supplier.id_supplier WHERE status_sparepart=2 ORDER BY laporan_spareparts.id_sparepart DESC LIMIT $awal_data16, $data16");
                $data17=25;
                $result17=mysqli_query($conn, "SELECT * FROM laporan_spareparts");
                $total17=mysqli_num_rows($result17);
                $total_page17=ceil($total17/$data17);
                $page17=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data17=($data17*$page17)-$data17;
                $report_spareparts_out=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN supplier ON laporan_spareparts.suplayer=supplier.id_supplier WHERE status_sparepart=3 ORDER BY laporan_spareparts.id_sparepart DESC LIMIT $awal_data17, $data17");
                $data18=25;
                $result18=mysqli_query($conn, "SELECT * FROM laporan_spareparts");
                $total18=mysqli_num_rows($result18);
                $total_page18=ceil($total18/$data18);
                $page18=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data18=($data18*$page18)-$data18;
                $report_spareparts_all=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status ORDER BY laporan_spareparts.id_sparepart DESC LIMIT $awal_data18, $data18");
            }
            if($_SESSION['id-role']<=5){ // => lebih kecil sama dengan teknisi & web dev/des
                $data11=25;
                $result11=mysqli_query($conn, "SELECT * FROM notes");
                $total11=mysqli_num_rows($result11);
                $total_page11=ceil($total11/$data11);
                $page11=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data11=($data11*$page11)-$data11;
                $notes_garansi_views_all=mysqli_query($conn, "SELECT * FROM notes 
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category
                    JOIN notes_status ON notes.id_status=notes_status.id_status
                    WHERE notes.id_nota=5 AND notes.id_status<6 ORDER BY notes.id_data DESC
                    LIMIT $awal_data11, $data11
                ");
                if(isset($_POST['ubah-status-progress'])){
                    if(notes_progress($_POST)>0){
                        $_SESSION['message-success']="Status nota telah On Progress";
                        header("Location: qr-aksi?auth=".$_POST['data-encrypt']);exit;
                    }
                }
                if(isset($_POST['ubah-status-waiting'])){
                    if(notes_waiting($_POST)>0){
                        $_SESSION['message-success']="Status nota menunggu pengambilan client";
                        header("Location: qr-aksi?auth=".$_POST['data-encrypt']);exit;
                    }
                }
                if(isset($_POST['ubah-status-success'])){
                    if(notes_success($_POST)>0){
                        $_SESSION['message-success']="Status nota telah success atau selesai diperbaiki";
                        header("Location: qr-aksi?auth=".$_POST['data-encrypt']);exit;
                    }
                }
            }
            if($_SESSION['id-role']==5){ // => teknisi & web dev/des
                $notes_views_today=mysqli_query($conn, "SELECT * FROM notes
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category
                    JOIN notes_status ON notes.id_status=notes_status.id_status 
                    WHERE notes.tgl_cari='$today' AND notes.id_pegawai='$id_user' AND notes.id_nota=1 OR notes.id_nota=2
                    ORDER BY notes.id_data DESC
                ");
                $data7=25;
                $result7=mysqli_query($conn, "SELECT * FROM notes");
                $total7=mysqli_num_rows($result7);
                $total_page7=ceil($total7/$data7);
                $page7=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data7=($data7*$page7)-$data7;
                $notes_views_all=mysqli_query($conn, "SELECT * FROM notes 
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category
                    JOIN notes_status ON notes.id_status=notes_status.id_status 
                    WHERE notes.id_pegawai='$id_user' AND notes.id_nota=1 OR notes.id_nota=2 ORDER BY notes.id_data DESC
                    LIMIT $awal_data7, $data7
                ");
                $data8=25;
                $result8=mysqli_query($conn, "SELECT * FROM notes");
                $total8=mysqli_num_rows($result8);
                $total_page8=ceil($total8/$data8);
                $page8=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data8=($data8*$page8)-$data8;
                $notes_lunas_views_all=mysqli_query($conn, "SELECT * FROM notes 
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category
                    JOIN notes_status ON notes.id_status=notes_status.id_status 
                    WHERE notes.id_pegawai='$id_user' AND notes.id_nota=3 ORDER BY notes.id_data DESC
                    LIMIT $awal_data8, $data8
                ");
                $data9=25;
                $result9=mysqli_query($conn, "SELECT * FROM notes");
                $total9=mysqli_num_rows($result9);
                $total_page9=ceil($total9/$data9);
                $page9=(isset($_GET['page']))?$_GET['page']:1;
                $awal_data9=($data9*$page9)-$data9;
                $notes_cancel=mysqli_query($conn, "SELECT * FROM notes 
                    JOIN users ON notes.id_user=users.id_user 
                    JOIN category_services ON notes.id_layanan=category_services.id_category
                    JOIN notes_status ON notes.id_status=notes_status.id_status 
                    WHERE notes.id_pegawai='$id_user' AND notes.id_nota=4 ORDER BY notes.id_data DESC
                    LIMIT $awal_data9, $data9
                ");
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