<?php if(!isset($_SESSION)){session_start();}
    require_once("connect.php");require_once("functions.php");

    // class alert{
        if(isset($_SESSION['message-success'])){
            $message_success="<div class='alert alert-success alert-dismissible fade show' role='alert'>
            ".$_SESSION['message-success']."
                <form action='' method='POST'>
                    <button type='submit' name='message-success' class='close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </form>
            </div>";
        }
        if(isset($_SESSION['message-warning'])){
            $message_warning="<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            ".$_SESSION['message-warning']."
                <form action='' method='POST'>
                    <button type='submit' name='message-warning' class='close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </form>
            </div>";
        }
        if(isset($_SESSION['message-danger'])){
            $message_danger="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            ".$_SESSION['message-danger']."
                <form action='' method='POST'>
                    <button type='submit' name='message-danger' class='close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </form>
            </div>";
        }
        if(isset($_SESSION['message-info'])){
            $message_info="<div class='alert alert-info alert-dismissible fade show' role='alert'>
            ".$_SESSION['message-info']."
                <form action='' method='POST'>
                    <button type='submit' name='message-info' class='close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </form>
            </div>";
        }
        if(isset($_SESSION['message-dark'])){
            $message_dark="<div class='alert alert-dark alert-dismissible fade show' role='alert'>
            ".$_SESSION['message-dark']."
                <form action='' method='POST'>
                    <button type='submit' name='message-dark' class='close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </form>
            </div>";
        }
        if(isset($_POST['message-success'])){
            unset($_SESSION['message-success']);
        }
        if(isset($_POST['message-warning'])){
            unset($_SESSION['message-warning']);
        }
        if(isset($_POST['message-danger'])){
            unset($_SESSION['message-danger']);
        }
        if(isset($_POST['message-info'])){
            unset($_SESSION['message-info']);
        }
        if(isset($_POST['message-dark'])){
            unset($_SESSION['message-dark']);
        }
    // }

    // class global{
        if(isset($_SESSION['visitor'])){
            $service_product=mysqli_query($conn, "SELECT * FROM services_product");
            $testimonial=mysqli_query($conn, "SELECT * FROM testimonial JOIN users ON testimonial.id_testi=users.id_testi");
            $employee=mysqli_query($conn, "SELECT * FROM employee JOIN users_role ON employee.id_role=users_role.id_role");
            $user_interface_view=mysqli_query($conn, "SELECT * FROM user_interface_section JOIN user_interface_script ON user_interface_section.id_script=user_interface_script.id_script");
            if(isset($_POST['send-msg-visitor'])){
                if(send_msg_visitor($_POST)>0){
                    $_SESSION['message-success']="Pesan anda telah terkirim dan kami akan balas secepatnya.";
                    header("Location: #contact");exit;
                }
            }
        }
        if(isset($_SESSION['auth'])){
            if(isset($_POST['daftar'])){
                if(daftar($_POST)>0){
                    header('Location: verification');exit;
                }
            }
        }
        $error_page=mysqli_query($conn, "SELECT * FROM error_page");
    // }

    // class private{
        if(isset($_SESSION['id-employee'])){
            $logout="../controller/logout";
            $color_primary='style="color: #EAEAEA;"';
            $style_btn='style="background-color: #EAEAEA;color: black"';
            $link_barcode="http://localhost/ar.code/qr?ac=";
            $id_employee=addslashes(trim($_SESSION['id-employee']));
            $employee_active=mysqli_query($conn, "SELECT * FROM employee WHERE id_employee='$id_employee'");
            $row_data_active=mysqli_fetch_assoc($employee_active);
            $is_active=$row_data_active;
            $users_role=mysqli_query($conn, "SELECT * FROM users_role");
            $employee_icon=mysqli_query($conn, "SELECT * FROM employee WHERE id_employee='$id_employee'");
            $employee_chat=mysqli_query($conn, "SELECT * FROM employee JOIN users_role ON employee.id_role=users_role.id_role ORDER BY employee.id_employee ASC LIMIT 7");
            if(isset($_SESSION['id-role'])){
                if($_SESSION['id-role']<13){
                    if($_SESSION['id-role']==5){ 
    
                        // class menu_management{
                            $menus=mysqli_query($conn, "SELECT * FROM menu");
                            $menus1=mysqli_query($conn, "SELECT * FROM menu");
                            if(isset($_POST['add-menu'])){
                                if(add_menu($_POST)>0){
                                    $_SESSION['message-success']="Menu baru telah ditambahkan!";
                                    header("Location: menu");exit;
                                }
                            }
                            if(isset($_POST['edit-menu'])){
                                if(edit_menu($_POST)>0){
                                    $_SESSION['message-success']="Menu telah diedit!";
                                    header("Location: menu");exit;
                                }
                            }
                            if(isset($_POST['delete-menu'])){
                                if(del_menu($_POST)>0){
                                    $_SESSION['message-success']="Yah menunya baru saja dihapus!";
                                    header("Location: menu");exit;
                                }
                            }
                            $menu_sub=mysqli_query($conn, "SELECT * FROM menu_sub WHERE id_sub_menu>3");
                            if(isset($_POST['add-sub-menu'])){
                                if(add_sub_menu($_POST)>0){
                                    $_SESSION['message-success']="Sub menu baru telah ditambahkan!";
                                    header("Location: sub-menu");exit;
                                }
                            }
                            if(isset($_POST['edit-sub-menu'])){
                                if(edit_sub_menu($_POST)>0){
                                    $_SESSION['message-success']="Sub menu telah diedit, segera ubah/perbaiki file sub menu!";
                                    header("Location: sub-menu");exit;
                                }
                            }
                            if(isset($_POST['delete-sub-menu'])){
                                if(del_sub_menu($_POST)>0){
                                    $_SESSION['message-success']="Yah sub menunya baru saja dihapus!";
                                    header("Location: sub-menu");exit;
                                }
                            }
                            $menu_access=mysqli_query($conn, "SELECT * FROM menu_access JOIN users_role ON menu_access.role_id=users_role.id_role JOIN menu ON menu_access.id_menu=menu.id_menu WHERE id_access_menu>1");
                            if(isset($_POST['add-access-menu'])){
                                if(add_access_menu($_POST)>0){
                                    $_SESSION['message-success']="Akses menu telah diperbaharui dan di tambah!";
                                    header("Location: access-menu");exit;
                                }
                            }
                            if(isset($_POST['edit-access-menu'])){
                                if(edit_access_menu($_POST)>0){
                                    $_SESSION['message-success']="Access menu telah diedit!";
                                    header("Location: access-menu");exit;
                                }
                            }
                            if(isset($_POST['delete-access-menu'])){
                                if(del_access_menu($_POST)>0){
                                    $_SESSION['message-success']="Yah access menunya dihapus!";
                                    header("Location: access-menu");exit;
                                }
                            }
                            $users_role_access=mysqli_query($conn, "SELECT * FROM users_role WHERE id_role<13");
                            $menu_sub_choise=mysqli_query($conn, "SELECT * FROM menu_sub");
                            $menu_sub_access=mysqli_query($conn, "SELECT * FROM menu_sub_access JOIN users_role ON menu_sub_access.role_id=users_role.id_role JOIN menu_sub ON menu_sub_access.id_sub_menu=menu_sub.id_sub_menu");
                            if(isset($_POST['add-access-sub-menu'])){
                                if(add_access_sub_menu($_POST)>0){
                                    $_SESSION['message-success']="Akses sub menu telah ditambah!";
                                    header("Location: access-sub-menu");exit;
                                }
                            }
                            if(isset($_POST['edit-access-sub-menu'])){
                                if(edit_access_sub_menu($_POST)>0){
                                    $_SESSION['message-success']="Access sub menu telah diedit!";
                                    header("Location: access-sub-menu");exit;
                                }
                            }
                            if(isset($_POST['delete-access-sub-menu'])){
                                if(del_access_sub_menu($_POST)>0){
                                    $_SESSION['message-success']="Yah access sub menunya dihapus!";
                                    header("Location: access-sub-menu");exit;
                                }
                            }
                        // }
    
                        // class administrator{
                            $controller=mysqli_query($conn, "SELECT * FROM controller");
                            $vcontroller=mysqli_query($conn, "SELECT * FROM controller");
                            $row_con=mysqli_fetch_assoc($vcontroller);
                            // fitur controller
                            $system_login=$row_con['id_controller'];
                            $system_login_status=$row_con['is_active'];
                            $fasilitas=$row_con['id_controller'];
                            $fasilitas_status=$row_con['is_active'];
                            $alert=$row_con['id_controller'];
                            $alert_status=$row_con['is_active'];
                            $backup_data=$row_con['id_controller'];
                            $backup_data_status=$row_con['is_active'];
                            $design=$row_con['id_controller'];
                            $design_status=$row_con['is_active'];
                            if(isset($_POST['add-control'])){
                                if(add_controller($_POST)>0){
                                    $_SESSION['message-success']="Kontrol web telah ditambahkan dan akan dibuatkan oleh developer aplikasi ini!";
                                    header("Location: controller");exit;
                                }
                            }
                            if(isset($_POST['edit-control'])){
                                if(edit_controller($_POST)>0){
                                    $_SESSION['message-success']="Kontrol web telah diedit dan segera di revisi developer!";
                                    header("Location: controller");exit;
                                }
                            }
                            if(isset($_POST['aksi-control'])){
                                if(aksi_controller($_POST)>0){
                                    $_SESSION['message-success']=$_SESSION['aksi']."!";
                                    header("Location: controller");exit;
                                }
                            }
                            $user_interface_section=mysqli_query($conn, "SELECT * FROM user_interface_section");
                            $user_interface=mysqli_query($conn, "SELECT * FROM user_interface_section JOIN user_interface_script ON user_interface_section.id_script=user_interface_script.id_script");
                            if(isset($_POST['add-section'])){
                                if(add_section($_POST)>0){
                                    $_SESSION['message-success']="Telah menambahkan Section UI baru dan akan dibuatkan oleh Developer!";
                                    header("Location: ui");exit;
                                }
                            }
                            if(isset($_POST['edit-script'])){
                                if(edit_script($_POST)>0){
                                    $_SESSION['message-success']="Telah mengedit ".$_SESSION['aksi']."!";
                                    header("Location: ui");exit;
                                }
                            }
                            if(isset($_POST['del-section'])){
                                if(del_section($_POST)>0){
                                    $_SESSION['message-success']="Data section ".$_SESSION['aksi']." telah dihapus!";
                                    header("Location: ui");exit;
                                }
                            }
                            $privacy_policy=mysqli_query($conn, "SELECT * FROM privacy_policy");
                            if(isset($_POST['edit-privacy-policy'])){
                                if(privacy_policy($_POST)>0){
                                    $_SESSION['message-success']="Data Privacy Policy telah di edit!";
                                    header("Location: privacy-policy");exit;
                                }
                            }
                            $term_of_service=mysqli_query($conn, "SELECT * FROM term_of_service");
                            if(isset($_POST['edit-term'])){
                                if(term_of_service($_POST)>0){
                                    $_SESSION['message-success']="Data Term Of Service telah di edit!";
                                    header("Location: term-of-service");exit;
                                }
                            }
                            $faq=mysqli_query($conn, "SELECT * FROM faq");
                            if(isset($_POST['add-faq'])){
                                if(add_faq($_POST)>0){
                                    $_SESSION["message-success"]="FAQ baru berhasil ditambahkan!";
                                    header("Location: faq");exit;
                                }
                            }
                            if(isset($_POST['edit-faq'])){
                                if(edit_faq($_POST)>0){
                                    $_SESSION["message-success"]="Salah satu FAQ telah diedit!";
                                    header("Location: faq");exit;
                                }
                            }
                            if(isset($_POST['del-faq'])){
                                if(del_faq($_POST)>0){
                                    $_SESSION["message-success"]="Salah satu FAQ telah dihapus!";
                                    header("Location: faq");exit;
                                }
                            }
                        // }
    
                        // class utilities{
                            $error_page=mysqli_query($conn, "SELECT * FROM error_page");
                            if(isset($_POST['add-error'])){
                                if(add_error($_POST)>0){
                                    $_SESSION['message-success']="Error Page berhasil ditambahkan!";
                                    header("Location: error-page");exit;
                                }
                            }
                            if(isset($_POST['edit-data-error'])){
                                if(edit_error($_POST)>0){
                                    $_SESSION['message-success']="Error Page berhasil diedit!";
                                    header("Location: error-page");exit;
                                }
                            }
                            if(isset($_POST['del-data-error'])){
                                if(del_error($_POST)>0){
                                    $_SESSION['message-success']="Error Page berhasil dihapus!";
                                    header("Location: error-page");exit;
                                }
                            }
                        // }

                        // class calculation{
                            $cal_laporanDays=mysqli_query($conn, "SELECT SUM(pemasukan) AS total FROM laporan_harian");
                            $row_days=mysqli_fetch_assoc($cal_laporanDays);
                            $pemasukan=$row_days['total'];
                            $cal_laporanDP=mysqli_query($conn, "SELECT SUM(dp) AS total FROM laporan_dp");
                            $row_dp=mysqli_fetch_assoc($cal_laporanDP);
                            $dp=$row_dp['total'];
                            $total_income=$pemasukan+$dp;
                            $cal_laporanExpense=mysqli_query($conn, "SELECT SUM(biaya_pengeluaran) AS total FROM laporan_pengeluaran");
                            $row_expense=mysqli_fetch_assoc($cal_laporanExpense);
                            $expense=$row_expense['total'];
                            $cal_laporanSpareparts=mysqli_query($conn, "SELECT SUM(total) AS total FROM laporan_spareparts");
                            $row_sparepart=mysqli_fetch_assoc($cal_laporanSpareparts);
                            $sparepart=$row_sparepart['total'];
                            $total_expense=$expense+$sparepart;
                            $cal_days=mysqli_query($conn, "SELECT * FROM cal_days ORDER BY tgl_cari DESC");
                            if(isset($_POST['search-tgl-calculation'])){
                                $keyword=addslashes(trim($_POST['keyword-tgl-calculation']));
                                $cal_days=mysqli_query($conn, "SELECT * FROM cal_days WHERE tgl_cari='$keyword' ORDER BY tgl_cari DESC");
                            }
                            if(isset($_POST['delete-days'])){
                                if(delete_cal_days($_POST)>0){
                                    $_SESSION['message-success']="Data kalkulasi harian berhasil dihapus.";
                                    header("Location: cal-daily");exit;
                                }
                            }
                            $cal_month=mysqli_query($conn, "SELECT * FROM cal_month ORDER BY tgl_cari DESC");
                            if(isset($_POST['delete-month'])){
                                if(delete_cal_month($_POST)>0){
                                    $_SESSION['message-success']="Data kalkulasi bulanan berhasil dihapus.";
                                    header("Location: cal-monthly");exit;
                                }
                            }
                        // }
    
                    }if($_SESSION['id-role']==4 || $_SESSION['id-role']==5 || $_SESSION['id-role']==6){
    
                        // class dashboard{
                            $count_users=mysqli_query($conn, "SELECT * FROM users");
                            $counts_users=mysqli_num_rows($count_users);
                            $count_users_local=mysqli_query($conn, "SELECT * FROM users_local");
                            $counts_users_local=mysqli_num_rows($count_users_local);
                            $total_users=$counts_users+$counts_users_local;
                            $count_repair=mysqli_query($conn, "SELECT * FROM nota_tinggal");
                            $total_repair=mysqli_num_rows($count_repair);
                            $pending=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_status=1");
                            $total_pending=mysqli_num_rows($pending);
                            $cancel=mysqli_query($conn, "SELECT * FROM nota_cancel WHERE id_status=2");
                            $total_cancel=mysqli_num_rows($cancel);
                            $on_progress=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_status=3");
                            $total_on_progress=mysqli_num_rows($on_progress);
                            $waiting=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_status=4");
                            $total_waiting=mysqli_num_rows($waiting);
                            $waiting=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_status=5");
                            $total_waiting=mysqli_num_rows($waiting);
                            $finish=mysqli_query($conn, "SELECT * FROM nota_tinggal WHERE id_status=6");
                            $total_finish=mysqli_num_rows($finish);

                            // report 
                            $date=date('Y-m-d');
                            $count_days=mysqli_query($conn, "SELECT SUM(pemasukan) as total FROM laporan_harian WHERE tgl_cari='$date'");
                            $view_days=mysqli_fetch_assoc($count_days);
                            $total_days=$view_days['total'];
                            $date=date('Y-m-d');
                            $count_dp=mysqli_query($conn, "SELECT SUM(dp) as total FROM laporan_dp WHERE tgl_cari='$date'");
                            $view_dp=mysqli_fetch_assoc($count_dp);
                            $total_dp=$view_dp['total'];
                            $date=date('Y-m-d');
                            $count_spareparts=mysqli_query($conn, "SELECT SUM(total) as total FROM laporan_spareparts WHERE tgl_cari='$date' AND status_sparepart=3");
                            $view_spareparts=mysqli_fetch_assoc($count_spareparts);
                            $total_spareparts=$view_spareparts['total'];
                            $date=date('Y-m-d');
                            $month=date('m');
                            $day=date('d');
                            $count_expense=mysqli_query($conn, "SELECT SUM(biaya_pengeluaran) as total FROM laporan_pengeluaran WHERE tgl_cari='$date'");
                            $view_expense=mysqli_fetch_assoc($count_expense);
                            $total_expenses=$view_expense['total'];

                            // log
                            $count_employee_log=mysqli_query($conn, "SELECT * FROM employee_log");
                            $employee_logs=mysqli_num_rows($count_employee_log);
                            $count_users_log=mysqli_query($conn, "SELECT * FROM users_log");
                            $users_logs=mysqli_num_rows($count_users_log);
                            $total_logs=$employee_logs+$users_logs;
                            $count_admin_log=mysqli_query($conn, "SELECT * FROM employee JOIN employee_log ON employee.id_log=employee_log.id_log WHERE employee.id_role=5");
                            $admin_logs=mysqli_num_rows($count_admin_log);
                            $count_em_log=mysqli_query($conn, "SELECT * FROM employee JOIN employee_log ON employee.id_log=employee_log.id_log WHERE employee.id_role=6 OR employee.id_role=7 OR employee.id_role=8 OR employee.id_role=9 OR employee.id_role=10");
                            $em_logs=mysqli_num_rows($count_em_log);
                            $activity_log=mysqli_query($conn, "SELECT * FROM employee JOIN employee_log ON employee.id_log=employee_log.id_log ORDER BY id DESC LIMIT 3");
                        // }

                        // class users{
                            $users_online=mysqli_query($conn, "SELECT * FROM users JOIN users_security ON users.id_security=users_security.id_security JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_role>12");
                            if(isset($_POST['edit-users'])){
                                if(edit_users($_POST)>0){
                                    $_SESSION['message-success']="User telah diedit!";
                                    header("Location: user-online");exit;
                                }
                            }
                            if(isset($_POST['block-users'])){
                                if(block_users($_POST)>0){
                                    $_SESSION['message-success']=$_SESSION['aksi'];
                                    header("Location: user-online");exit;
                                }
                            }
                            $users_local=mysqli_query($conn, "SELECT * FROM users_local");
                            if(isset($_POST['search-users-local'])){
                                $keyword=addslashes(trim($_POST['keyword']));
                                $users_local=mysqli_query($conn, "SELECT * FROM users_local WHERE username LIKE '%$keyword%' OR email_user LIKE '%$keyword%' OR tlpn_user LIKE '%$keyword%' OR alamat_user LIKE '%$keyword%'");
                            }else{
                                $data1=25;
                                $result1=mysqli_query($conn, "SELECT * FROM users_local");
                                $total1=mysqli_num_rows($result1);
                                $total_page1=ceil($total1/$data1);
                                $page1=(isset($_GET['page']))?$_GET['page']:1;
                                $awal_data1=($data1*$page1)-$data1;
                                $users_local=mysqli_query($conn, "SELECT * FROM users_local LIMIT $awal_data1, $data1");
                            }
                            $employee_data=mysqli_query($conn, "SELECT * FROM employee 
                                JOIN employee_security ON employee.id_security=employee_security.id_security 
                                JOIN users_role ON employee.id_role=users_role.id_role 
                                WHERE employee.id_role='1' 
                                OR employee.id_role='2' 
                                OR employee.id_role='3' 
                                OR employee.id_role='4' 
                                OR employee.id_role='6'
                            ");
                            $technicians_data=mysqli_query($conn, "SELECT * FROM employee 
                                JOIN employee_security ON employee.id_security=employee_security.id_security 
                                JOIN users_role ON employee.id_role=users_role.id_role 
                                WHERE employee.id_role=7 
                                OR employee.id_role=8
                            ");
                            $developer_data=mysqli_query($conn, "SELECT * FROM employee 
                                JOIN employee_security ON employee.id_security=employee_security.id_security 
                                JOIN users_role ON employee.id_role=users_role.id_role 
                                WHERE employee.id_role='9' 
                                OR employee.id_role='10' 
                                OR employee.id_role='11'
                            ");
                            if(isset($_POST['edit-employee'])){
                                if(edit_employee($_POST)>0){
                                    $_SESSION['message-success']="Role employee telah diedit!";
                                    if($_POST['akses']==1){
                                        header("Location: employee");exit;
                                    }else if($_POST['akses']==2){
                                        header("Location: technicians");exit;
                                    }else if($_POST['akses']==3){
                                        header("Location: developer");exit;
                                    }
                                }
                            }
                            if(isset($_POST['block-employee'])){
                                if(block_employee($_POST)>0){
                                    $_SESSION['message-success']=$_SESSION['aksi'];
                                    if($_POST['akses']==1){
                                        header("Location: employee");exit;
                                    }else if($_POST['akses']==2){
                                        header("Location: technicians");exit;
                                    }else if($_POST['akses']==3){
                                        header("Location: developer");exit;
                                    }
                                }
                            }
                        // }
                        
                        // class nota{
                            $setting_nota_view=mysqli_query($conn, "SELECT * FROM setting_nota");
                            $setting_nota_data=mysqli_query($conn, "SELECT * FROM setting_nota");
                            if(isset($_POST['add-no-nota'])){
                                if(add_no_nota($_POST)>0){
                                    $_SESSION['message-success']="Nomor nota berhasil di perbarui!";
                                    header("Location: setting-nota");exit;
                                }
                            }
                            if(isset($_POST['edit-no-nota'])){
                                if(edit_no_nota($_POST)>0){
                                    $_SESSION['message-success']="Nomor nota berhasil di ubah!";
                                    header("Location: setting-nota");exit;
                                }
                            }
                            if(isset($_POST['del-no-nota'])){
                                if(del_no_nota($_POST)>0){
                                    $_SESSION['message-success']="Nomor nota berhasil di hapus!";
                                    header("Location: setting-nota");exit;
                                }
                            }
                            $data2=25;
                            $result2=mysqli_query($conn, "SELECT * FROM nota_tinggal");
                            $total2=mysqli_num_rows($result2);
                            $total_page2=ceil($total2/$data2);
                            $page2=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data2=($data2*$page2)-$data2;
                            $nota_tinggalOffline=mysqli_query($conn, "SELECT * FROM nota_tinggal 
                                JOIN users_local ON nota_tinggal.id_user=users_local.id_user
                                JOIN employee ON nota_tinggal.id_pegawai=employee.id_employee
                                JOIN services_status_ugdhp ON nota_tinggal.id_status=services_status_ugdhp.id_status
                                LIMIT $awal_data2, $data2
                            ");
                            if(isset($_POST['search-tgl-nota-tinggal'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-tgl-nota-tinggal'])));
                                $nota_tinggalOffline=mysqli_query($conn, "SELECT * FROM nota_tinggal 
                                    JOIN users_local ON nota_tinggal.id_user=users_local.id_user
                                    JOIN employee ON nota_tinggal.id_pegawai=employee.id_employee
                                    JOIN services_status_ugdhp ON nota_tinggal.id_status=services_status_ugdhp.id_status
                                    WHERE nota_tinggal.tgl_cari='$keyword' 
                                    LIMIT $awal_data2, $data2
                                ");
                                $_SESSION['show']=2;
                            }
                            if(isset($_POST['search-status-nota-tinggal'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-status-nota-tinggal'])));
                                $nota_tinggalOffline=mysqli_query($conn, "SELECT * FROM nota_tinggal 
                                    JOIN users_local ON nota_tinggal.id_user=users_local.id_user
                                    JOIN employee ON nota_tinggal.id_pegawai=employee.id_employee
                                    JOIN services_status_ugdhp ON nota_tinggal.id_status=services_status_ugdhp.id_status
                                    WHERE nota_tinggal.id_status='$keyword' 
                                    LIMIT $awal_data2, $data2
                                ");
                                $_SESSION['show']=2;
                            }
                            if(isset($_POST['search-teknisi-nota-tinggal'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-teknisi-nota-tinggal'])));
                                $nota_tinggalOffline=mysqli_query($conn, "SELECT * FROM nota_tinggal
                                    JOIN users_local ON nota_tinggal.id_user=users_local.id_user
                                    JOIN employee ON nota_tinggal.id_pegawai=employee.id_employee
                                    JOIN services_status_ugdhp ON nota_tinggal.id_status=services_status_ugdhp.id_status
                                    WHERE nota_tinggal.id_pegawai='$keyword' 
                                    LIMIT $awal_data2, $data2
                                ");
                                $_SESSION['show']=2;
                            }
                            $nota_tinggal_auto=mysqli_query($conn, "SELECT * FROM autorisasi_nomor_nota WHERE id_auto='1'");
                            $row_nt=mysqli_fetch_assoc($nota_tinggal_auto);
                            $nota_dp_auto=mysqli_query($conn, "SELECT * FROM autorisasi_nomor_nota WHERE id_auto='2'");
                            $row_dp=mysqli_fetch_assoc($nota_dp_auto);
                            $nota_nl_auto=mysqli_query($conn, "SELECT * FROM autorisasi_nomor_nota WHERE id_auto='3'");
                            $row_nl=mysqli_fetch_assoc($nota_nl_auto);
                            $services_status_ugdhp=mysqli_query($conn, "SELECT * FROM services_status_ugdhp WHERE id_status<6");
                            if(isset($_POST['repair-now'])){
                                if(nota_tinggal($_POST)>0){
                                    require_once("unform-data.php");
                                    $_SESSION['message-success']="Data nota tinggal berhasil diinsert! silakan ajukan barang ke teknisi.";
                                    $_SESSION['show']=2;
                                    header("Location: nota-tinggal");exit;
                                }
                            }
                            if(isset($_POST['edit-status-nota'])){
                                if(edit_status_nota($_POST)>0){
                                    $_SESSION['message-success']="Perubahan status nota berhasil dibuat.";
                                    $_SESSION['show']=2;
                                    header("Location: nota-tinggal");exit;
                                }
                            }
                            if(isset($_POST['edit-nota'])){
                                if(edit_nota($_POST)>0){
                                    require_once("unform-data.php");
                                    $_SESSION['message-success']="Perubahan pada nota berhasil dibuat.";
                                    $_SESSION['show']=2;
                                    header("Location: nota-tinggal");exit;
                                }
                            }
                            if(isset($_POST['delete-nota'])){
                                if(delete_nota($_POST)>0){
                                    $_SESSION['message-success']="Data nota tinggal atau dp berhasil di hapus!";
                                    $_SESSION['show']=2;
                                    header("Location: nota-tinggal");exit;
                                }
                            }
                            $data3=25;
                            $result3=mysqli_query($conn, "SELECT * FROM nota_cancel");
                            $total3=mysqli_num_rows($result3);
                            $total_page3=ceil($total3/$data3);
                            $page3=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data3=($data3*$page3)-$data3;
                            $nota_cancel=mysqli_query($conn, "SELECT * FROM nota_cancel 
                                JOIN users_local ON nota_cancel.id_user=users_local.id_user
                                JOIN employee ON nota_cancel.id_pegawai=employee.id_employee
                                JOIN services_status_ugdhp ON nota_cancel.id_status=services_status_ugdhp.id_status
                                LIMIT $awal_data3, $data3
                            ");
                            if(isset($_POST['search-tgl-nota-cancel'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-tgl-nota-cancel'])));
                                $nota_cancel=mysqli_query($conn, "SELECT * FROM nota_cancel 
                                    JOIN users_local ON nota_cancel.id_user=users_local.id_user
                                    JOIN employee ON nota_cancel.id_pegawai=employee.id_employee
                                    JOIN services_status_ugdhp ON nota_cancel.id_status=services_status_ugdhp.id_status
                                    WHERE nota_cancel.tgl_cari='$keyword' 
                                    LIMIT $awal_data3, $data3
                                ");
                            }
                            if(isset($_POST['search-teknisi-nota-cancel'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-teknisi-nota-cancel'])));
                                $nota_cancel=mysqli_query($conn, "SELECT * FROM nota_cancel
                                    JOIN users_local ON nota_cancel.id_user=users_local.id_user
                                    JOIN employee ON nota_cancel.id_pegawai=employee.id_employee
                                    JOIN services_status_ugdhp ON nota_cancel.id_status=services_status_ugdhp.id_status
                                    WHERE nota_cancel.id_pegawai='$keyword' 
                                    LIMIT $awal_data3, $data3
                                ");
                            }
                            $status_block=mysqli_query($conn, "SELECT * FROM services_status_ugdhp WHERE id_status=6");
                            if(isset($_POST['recovery-nota'])){
                                if(recovery_nota($_POST)>0){
                                    $_SESSION['message-success']="Berhasil terecover ke nota tinggal, silakan cek kembali di nota tinggal untuk memastikan!";
                                    header("Location: nota-cancel");exit;
                                }
                            }
                            if(isset($_POST['delete-nota-cancel'])){
                                if(delete_nota_cancel($_POST)>0){
                                    $_SESSION['message-success']="Berhasil menghapus salah satu data nota yang di cancel!";
                                    header("Location: nota-cancel");exit;
                                }
                            }
                            if(isset($_POST['take-lunas'])){
                                $_SESSION['id-nota-tinggal']=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-nota-tinggal']))));
                                header("Location: take-paid-off");exit;
                            }
                            if(isset($_POST['apply-take'])){
                                if(add_lunas_from_tinggal($_POST)>0){
                                    $_SESSION['message-success']="Data nomor ".$_SESSION['message']." telah lunas dan akan diproses admin untuk laporan harian.";
                                    header("Location: nota-tinggal");exit;
                                }
                            }
                            $data4=25;
                            $result4=mysqli_query($conn, "SELECT * FROM nota_lunas");
                            $total4=mysqli_num_rows($result4);
                            $total_page4=ceil($total4/$data4);
                            $page4=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data4=($data4*$page4)-$data4;
                            $nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas 
                                JOIN users_local ON nota_lunas.id_user=users_local.id_user
                                JOIN employee ON nota_lunas.id_pegawai=employee.id_employee
                                LIMIT $awal_data4, $data4
                            ");
                            $nota_lunasToReport=mysqli_query($conn, "SELECT * FROM nota_lunas 
                                JOIN users_local ON nota_lunas.id_user=users_local.id_user
                                JOIN employee ON nota_lunas.id_pegawai=employee.id_employee
                                WHERE nota_lunas.lapor=1
                            ");
                            if(isset($_POST['search-tgl-nota-lunas'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-tgl-nota-lunas'])));
                                $nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas 
                                    JOIN users_local ON nota_lunas.id_user=users_local.id_user
                                    JOIN employee ON nota_lunas.id_pegawai=employee.id_employee
                                    WHERE nota_lunas.tgl_cari='$keyword' 
                                    LIMIT $awal_data4, $data4
                                ");
                            }
                            if(isset($_POST['search-teknisi-nota-lunas'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-teknisi-nota-lunas'])));
                                $nota_lunas=mysqli_query($conn, "SELECT * FROM nota_lunas
                                    JOIN users_local ON nota_lunas.id_user=users_local.id_user
                                    JOIN employee ON nota_lunas.id_pegawai=employee.id_employee
                                    WHERE nota_lunas.id_pegawai='$keyword' 
                                    LIMIT $awal_data4, $data4
                                ");
                            }
                            if(isset($_POST['edit-nota-lunas'])){
                                if(edit_nota_lunas($_POST)>0){
                                    $_SESSION['message-success']="Nota lunas yang anda edit berhasil diubah.";
                                    header("Location: nota-lunas");exit;
                                }
                            }
                            if(isset($_POST['delete-nota-lunas'])){
                                if(delete_nota_lunas($_POST)>0){
                                    $_SESSION['message-success']="Nota lunas yang anda pilih berhasil dihapus.";
                                    header("Location: nota-lunas");exit;
                                }
                            }
                            if(isset($_POST['add-nota-lunas'])){
                                if(add_nota_lunas($_POST)>0){
                                    require_once("unform-data.php");
                                    if(isset($_SESSION['show'])){
                                        unset($_SESSION['show']);
                                    }
                                    $_SESSION['message-success']="Nota lunas berhasil dimasukan.";
                                    header("Location: nota-lunas");exit;
                                }
                            }
                        // }
    
                        // class laporan{
                            $data11=25;
                            $result11=mysqli_query($conn, "SELECT * FROM laporan_dp");
                            $total11=mysqli_num_rows($result11);
                            $total_page11=ceil($total11/$data11);
                            $page11=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data11=($data11*$page11)-$data11;
                            $laporan_dp=mysqli_query($conn, "SELECT * FROM laporan_dp
                                JOIN users_local ON laporan_dp.id_user=users_local.id_user
                                JOIN employee ON laporan_dp.id_pegawai=employee.id_employee
                                LIMIT $awal_data11, $data11
                            ");
                            if(isset($_POST['search-tgl-nota-dp'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-tgl-nota-dp'])));
                                $laporan_dp=mysqli_query($conn, "SELECT * FROM laporan_dp
                                    JOIN users_local ON laporan_dp.id_user=users_local.id_user
                                    JOIN employee ON laporan_dp.id_pegawai=employee.id_employee
                                    WHERE laporan_dp.tgl_cari='$keyword' 
                                    LIMIT $awal_data11, $data11
                                ");
                            }
                            if(isset($_POST['search-teknisi-nota-dp'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-teknisi-nota-dp'])));
                                $laporan_dp=mysqli_query($conn, "SELECT * FROM laporan_dp
                                    JOIN users_local ON laporan_dp.id_user=users_local.id_user
                                    JOIN employee ON laporan_dp.id_pegawai=employee.id_employee
                                    WHERE laporan_dp.id_pegawai='$keyword' 
                                    LIMIT $awal_data11, $data11
                                ");
                            }
                            if(isset($_POST['delete-laporan-dp'])){
                                if(delete_dp_report($_POST)>0){
                                    $_SESSION['message-success']="Data yang anda pilih telah berhasil dihapus.";
                                    header("Location: report-dp");exit;
                                }
                            }
                            if(isset($_POST['report-lunas'])){
                                if(report_lunas($_POST)>0){
                                    $_SESSION['message-success']="Berhasil diajukan ke Client Service, menunggu pengecekan untuk di approve.";
                                    header("Location: nota-lunas");exit;
                                }
                            }
                            if(isset($_POST['approve-report-day'])){
                                if(approve_report_day($_POST)>0){
                                    $_SESSION['message-success']="Nota Lunas berhasil di approve!";
                                    header("Location: report-day");exit;
                                }
                            }
                            if(isset($_POST['fix-it-again'])){
                                if(fix_it_again_report_day($_POST)>0){
                                    $_SESSION['message-success']="Nota Lunas tidak disetujui, dan dikembalikan ke administrasi.";
                                    header("Location: report-day");exit;
                                }
                            }
                            $data12=25;
                            $result12=mysqli_query($conn, "SELECT * FROM laporan_harian");
                            $total12=mysqli_num_rows($result12);
                            $total_page12=ceil($total12/$data12);
                            $page12=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data12=($data12*$page12)-$data12;
                            $laporan_harian=mysqli_query($conn, "SELECT * FROM laporan_harian
                                JOIN users_local ON laporan_harian.id_user=users_local.id_user
                                JOIN employee ON laporan_harian.id_pegawai=employee.id_employee
                                LIMIT $awal_data12, $data12
                            ");
                            if(isset($_POST['search-tgl-nota'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-tgl-nota'])));
                                $laporan_harian=mysqli_query($conn, "SELECT * FROM laporan_harian
                                    JOIN users_local ON laporan_harian.id_user=users_local.id_user
                                    JOIN employee ON laporan_harian.id_pegawai=employee.id_employee
                                    WHERE laporan_harian.tgl_cari='$keyword' 
                                    LIMIT $awal_data12, $data12
                                ");
                            }
                            if(isset($_POST['search-teknisi-nota'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-teknisi-nota'])));
                                $laporan_harian=mysqli_query($conn, "SELECT * FROM laporan_harian
                                    JOIN users_local ON laporan_harian.id_user=users_local.id_user
                                    JOIN employee ON laporan_harian.id_pegawai=employee.id_employee
                                    WHERE laporan_harian.id_pegawai='$keyword' 
                                    LIMIT $awal_data12, $data12
                                ");
                            }
                            if(isset($_POST['delete-report-day'])){
                                if(delete_report_day($_POST)>0){
                                    $_SESSION['message-success']="Data yang anda pilih berhasil dihapus.";
                                    header("Location: report-day");exit;
                                }
                            }
                            $data13=25;
                            $result13=mysqli_query($conn, "SELECT * FROM laporan_pengeluaran");
                            $total13=mysqli_num_rows($result13);
                            $total_page13=ceil($total13/$data13);
                            $page13=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data13=($data13*$page13)-$data13;
                            $laporan_pengeluaran=mysqli_query($conn, "SELECT * FROM laporan_pengeluaran LIMIT $awal_data13, $data13");
                            if(isset($_POST['search-tgl-laporan-pengeluaran'])){
                                $keyword=addslashes(trim($_POST['keyword-tgl-laporan-pengeluaran']));
                                $laporan_pengeluaran=mysqli_query($conn, "SELECT * FROM laporan_pengeluaran WHERE tgl_cari='$keyword' LIMIT $awal_data13, $data13");
                            }
                            if(isset($_POST['expense-report'])){
                                if(add_expense_report($_POST)>0){
                                    $_SESSION['message-success']="Pengeluaran berhasil dimasukan.";
                                    header("Location: report-expense");exit;
                                }
                            }
                            if(isset($_POST['edit-pengeluaran'])){
                                if(edit_expense_report($_POST)>0){
                                    $_SESSION['message-success']="Data yang anda edit berhasil diubah.";
                                    header("Location: report-expense");exit;
                                }
                            }
                            if(isset($_POST['hapus-pengeluaran'])){
                                if(delete_expense_report($_POST)>0){
                                    $_SESSION['message-success']="Data yang anda pilih berhasil dihapus.";
                                    header("Location: report-expense");exit;
                                }
                            }
                            $data14=25;
                            $result14=mysqli_query($conn, "SELECT * FROM laporan_spareparts WHERE laporan_spareparts.status_sparepart=1");
                            $total14=mysqli_num_rows($result14);
                            $total_page14=ceil($total14/$data14);
                            $page14=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data14=($data14*$page14)-$data14;
                            $laporan_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts WHERE status_sparepart=1 LIMIT $awal_data14, $data14");
                            if(isset($_POST['search-tgl-sparepart'])){
                                $keyword=addslashes(trim($_POST['keyword-tgl-sparepart']));
                                $laporan_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts WHERE laporan_spareparts.tgl_cari='$keyword' AND status_sparepart=1");
                            }
                            if(isset($_POST['insert-sparepart'])){
                                if(add_report_sparepart($_POST)>0){
                                    $_SESSION['message-success']="Data berhasil ditambahkan di stok sparepart.";
                                    header("Location: report-spareparts");exit;
                                }
                            }
                            if(isset($_POST['edit-sparepart'])){
                                if(edit_report_sparepart($_POST)>0){
                                    $_SESSION['message-success']="Data berhasil diedit.";
                                    header("Location: report-spareparts");exit;
                                }
                            }
                            if(isset($_POST['delete-sparepart'])){
                                if(delete_report_sparepart($_POST)>0){
                                    if($_POST['status']==1){
                                        $_SESSION['message-success']="Data berhasil dihapus.";
                                        header("Location: report-spareparts");exit;
                                    }else if($_POST['status']==2){
                                        $_SESSION['message-success']="Data berhasil dihapus.";
                                        header("Location: report-spareparts-pickup");exit;
                                    }
                                }
                            }
                            if(isset($_POST['ambil-sparepart'])){
                                $_SESSION['id-sparepart']=addslashes(trim($_POST['id-sparepart']));
                                header("Location: pickup-sparepart");exit;
                            }
                            if(isset($_SESSION['id-sparepart'])){
                                $id_sparepart=addslashes(trim($_SESSION['id-sparepart']));
                                $pickup_sparepart=mysqli_query($conn, "SELECT * FROM laporan_spareparts WHERE id_sparepart='$id_sparepart'");
                            }
                            if(isset($_POST['pickup-sparepart'])){
                                if(add_pickup_sparepart($_POST)>0){
                                    if(isset($_SESSION['id-sparepart'])){unset($_SESSION['id-sparepart']);}
                                    $_SESSION['message-success']="Data berhasil diinput ke laporan sparepart.";
                                    header("Location: report-spareparts-pickup");exit;
                                }
                            }
                            $data15=25;
                            $result15=mysqli_query($conn, "SELECT * FROM laporan_spareparts WHERE laporan_spareparts.status_sparepart=2");
                            $total15=mysqli_num_rows($result15);
                            $total_page15=ceil($total15/$data15);
                            $page15=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data15=($data15*$page15)-$data15;
                            $pickup_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN employee ON laporan_spareparts.id_pegawai=employee.id_employee WHERE laporan_spareparts.status_sparepart=2 LIMIT $awal_data15, $data15");
                            if(isset($_POST['search-tgl-sparepart-pickup'])){
                                $keyword=addslashes(trim($_POST['keyword-tgl-sparepart-pickup']));
                                $pickup_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN employee ON laporan_spareparts.id_pegawai=employee.id_employee WHERE laporan_spareparts.tgl_cari='$keyword' AND laporan_spareparts.status_sparepart=2");
                            }
                            if(isset($_POST['search-teknisi-sparepart-pickup'])){
                                $keyword=addslashes(trim($_POST['keyword-teknisi-sparepart-pickup']));
                                $pickup_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN employee ON laporan_spareparts.id_pegawai=employee.id_employee WHERE laporan_spareparts.id_pegawai='$keyword' AND laporan_spareparts.status_sparepart=2");
                            }
                            $data_notaTinggal_pickup=mysqli_query($conn, "SELECT * FROM nota_tinggal");
                            $data_notaLunas_pickup=mysqli_query($conn, "SELECT * FROM nota_lunas");
                            $data16=25;
                            $result16=mysqli_query($conn, "SELECT * FROM laporan_spareparts WHERE laporan_spareparts.status_sparepart=3");
                            $total16=mysqli_num_rows($result16);
                            $total_page16=ceil($total16/$data16);
                            $page16=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data16=($data16*$page16)-$data16;
                            $out_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN employee ON laporan_spareparts.id_pegawai=employee.id_employee WHERE laporan_spareparts.status_sparepart=3 LIMIT $awal_data16, $data16");
                            if(isset($_POST['search-tgl-sparepart-out'])){
                                $keyword=addslashes(trim($_POST['keyword-tgl-sparepart-out']));
                                $out_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN employee ON laporan_spareparts.id_pegawai=employee.id_employee WHERE laporan_spareparts.tgl_cari='$keyword' AND laporan_spareparts.status_sparepart=3");
                            }
                            if(isset($_POST['search-teknisi-sparepart-out'])){
                                $keyword=addslashes(trim($_POST['keyword-teknisi-sparepart-out']));
                                $out_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN employee ON laporan_spareparts.id_pegawai=employee.id_employee WHERE laporan_spareparts.id_pegawai='$keyword' AND laporan_spareparts.status_sparepart=3");
                            }
                            $data17=25;
                            $result17=mysqli_query($conn, "SELECT * FROM laporan_spareparts");
                            $total17=mysqli_num_rows($result17);
                            $total_page17=ceil($total17/$data17);
                            $page17=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data17=($data17*$page17)-$data17;
                            $all_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status LIMIT $awal_data17, $data17");
                            // if(isset($_POST['search-tgl-sparepart-out'])){
                            //     $keyword=addslashes(trim($_POST['keyword-tgl-sparepart-out']));
                            //     $out_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN employee ON laporan_spareparts.id_pegawai=employee.id_employee WHERE laporan_spareparts.tgl_cari='$keyword' AND laporan_spareparts.status_sparepart=3");
                            // }
                            // if(isset($_POST['search-teknisi-sparepart-out'])){
                            //     $keyword=addslashes(trim($_POST['keyword-teknisi-sparepart-out']));
                            //     $out_spareparts=mysqli_query($conn, "SELECT * FROM laporan_spareparts JOIN employee ON laporan_spareparts.id_pegawai=employee.id_employee WHERE laporan_spareparts.id_pegawai='$keyword' AND laporan_spareparts.status_sparepart=3");
                            // }
                        // }

                        // class archives{
                            $data20=25;
                            $result20=mysqli_query($conn_arc, "SELECT * FROM mdata_nota_tinggal");
                            $total20=mysqli_num_rows($result20);
                            $total_page20=ceil($total20/$data20);
                            $page20=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data20=($data20*$page20)-$data20;
                            $mdata_nota_tinggal=mysqli_query($conn_arc, "SELECT * FROM mdata_nota_tinggal 
                                JOIN musers ON mdata_nota_tinggal.id_user=musers.id_user 
                                JOIN zlayanan ON mdata_nota_tinggal.id_layanan=zlayanan.id_layanan 
                                JOIN coders ON mdata_nota_tinggal.id_pegawai=coders.id_coder
                                JOIN zdata_status ON mdata_nota_tinggal.id_status=zdata_status.id_status
                                LIMIT $awal_data20, $data20
                            ");
                            if(isset($_POST['search-arc-nota-tinggal'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-arc-nota-tinggal'])));
                                $mdata_nota_tinggal=mysqli_query($conn_arc, "SELECT * FROM mdata_nota_tinggal 
                                    JOIN musers ON mdata_nota_tinggal.id_user=musers.id_user 
                                    JOIN zlayanan ON mdata_nota_tinggal.id_layanan=zlayanan.id_layanan 
                                    JOIN coders ON mdata_nota_tinggal.id_pegawai=coders.id_coder
                                    JOIN zdata_status ON mdata_nota_tinggal.id_status=zdata_status.id_status
                                    WHERE mdata_nota_tinggal.id_nota_tinggal LIKE '%$keyword%'
                                    OR mdata_nota_tinggal.id_nota_dp LIKE '%$keyword%'
                                    OR mdata_nota_tinggal.kerusakan LIKE '%$keyword%'
                                    OR mdata_nota_tinggal.tgl_cari LIKE '%$keyword%'
                                ");
                            }
                            $data21=25;
                            $result21=mysqli_query($conn_arc, "SELECT * FROM mdata_nota_dp");
                            $total21=mysqli_num_rows($result21);
                            $total_page21=ceil($total21/$data21);
                            $page21=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data21=($data21*$page21)-$data21;
                            $mdata_nota_dp=mysqli_query($conn_arc, "SELECT * FROM mdata_nota_dp
                                JOIN musers ON mdata_nota_dp.id_user=musers.id_user 
                                JOIN zlayanan ON mdata_nota_dp.id_layanan=zlayanan.id_layanan 
                                JOIN coders ON mdata_nota_dp.id_pegawai=coders.id_coder
                                JOIN zdata_status ON mdata_nota_dp.id_status=zdata_status.id_status
                                LIMIT $awal_data21, $data21
                            ");
                            if(isset($_POST['search-arc-nota-dp'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-arc-nota-dp'])));
                                $mdata_nota_dp=mysqli_query($conn_arc, "SELECT * FROM mdata_nota_dp
                                    JOIN musers ON mdata_nota_dp.id_user=musers.id_user 
                                    JOIN zlayanan ON mdata_nota_dp.id_layanan=zlayanan.id_layanan 
                                    JOIN coders ON mdata_nota_dp.id_pegawai=coders.id_coder
                                    JOIN zdata_status ON mdata_nota_dp.id_status=zdata_status.id_status
                                    WHERE mdata_nota_dp.id_nota_tinggal LIKE '%$keyword%'
                                    OR mdata_nota_dp.id_nota_dp LIKE '%$keyword%'
                                    OR mdata_nota_dp.kerusakan LIKE '%$keyword%'
                                    OR mdata_nota_dp.tgl_cari LIKE '%$keyword%'
                                ");
                            }
                            $data22=25;
                            $result22=mysqli_query($conn_arc, "SELECT * FROM mdata_nota_lunas");
                            $total22=mysqli_num_rows($result22);
                            $total_page22=ceil($total22/$data22);
                            $page22=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data22=($data22*$page22)-$data22;
                            $mdata_nota_lunas=mysqli_query($conn_arc, "SELECT * FROM mdata_nota_lunas
                                JOIN musers ON mdata_nota_lunas.id_user=musers.id_user 
                                JOIN zlayanan ON mdata_nota_lunas.id_layanan=zlayanan.id_layanan 
                                JOIN coders ON mdata_nota_lunas.id_pegawai=coders.id_coder
                                LIMIT $awal_data22, $data22
                            ");
                            if(isset($_POST['search-arc-nota-lunas'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-arc-nota-lunas'])));
                                $mdata_nota_lunas=mysqli_query($conn_arc, "SELECT * FROM mdata_nota_lunas
                                    JOIN musers ON mdata_nota_lunas.id_user=musers.id_user 
                                    JOIN zlayanan ON mdata_nota_lunas.id_layanan=zlayanan.id_layanan 
                                    JOIN coders ON mdata_nota_lunas.id_pegawai=coders.id_coder
                                    WHERE mdata_nota_lunas.id_nota_lunas LIKE '%$keyword%'
                                    OR mdata_nota_lunas.kerusakan LIKE '%$keyword%'
                                    OR mdata_nota_lunas.tgl_cari LIKE '%$keyword%'
                                ");
                            }
                            $data23=25;
                            $result23=mysqli_query($conn_arc, "SELECT * FROM mdata_nota_harian");
                            $total23=mysqli_num_rows($result23);
                            $total_page23=ceil($total23/$data23);
                            $page23=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data23=($data23*$page23)-$data23;
                            $mdata_nota_harian=mysqli_query($conn_arc, "SELECT * FROM mdata_nota_harian
                                JOIN musers ON mdata_nota_harian.id_user=musers.id_user 
                                JOIN zlayanan ON mdata_nota_harian.id_layanan=zlayanan.id_layanan 
                                JOIN coders ON mdata_nota_harian.id_pegawai=coders.id_coder
                                LIMIT $awal_data23, $data23
                            ");
                            if(isset($_POST['search-arc-laporan-harian'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-arc-laporan-harian'])));
                                $mdata_nota_harian=mysqli_query($conn_arc, "SELECT * FROM mdata_nota_harian
                                    JOIN musers ON mdata_nota_harian.id_user=musers.id_user 
                                    JOIN zlayanan ON mdata_nota_harian.id_layanan=zlayanan.id_layanan 
                                    JOIN coders ON mdata_nota_harian.id_pegawai=coders.id_coder
                                    WHERE mdata_nota_harian.id_nota_lunas LIKE '%$keyword%'
                                    OR mdata_nota_harian.kerusakan LIKE '%$keyword%'
                                    OR mdata_nota_harian.tgl_cari LIKE '%$keyword%'
                                ");
                            }
                            $data24=25;
                            $result24=mysqli_query($conn_arc, "SELECT * FROM mdata_pengeluaran");
                            $total24=mysqli_num_rows($result24);
                            $total_page24=ceil($total24/$data24);
                            $page24=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data24=($data24*$page24)-$data24;
                            $mdata_pengeluaran=mysqli_query($conn_arc, "SELECT * FROM mdata_pengeluaran
                                LIMIT $awal_data24, $data24
                            ");
                            if(isset($_POST['search-arc-pengeluaran'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-arc-pengeluaran'])));
                                $mdata_pengeluaran=mysqli_query($conn_arc, "SELECT * FROM mdata_pengeluaran
                                    WHERE mdata_pengeluaran.jenis_pengeluaran LIKE '%$keyword%'
                                    OR mdata_pengeluaran.ket LIKE '%$keyword%'
                                    OR mdata_pengeluaran.tgl_cari LIKE '%$keyword%'
                                ");
                            }
                            $data25=25;
                            $result25=mysqli_query($conn_arc, "SELECT * FROM mdata_spareparts");
                            $total25=mysqli_num_rows($result25);
                            $total_page25=ceil($total25/$data25);
                            $page25=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data25=($data25*$page25)-$data25;
                            $mdata_spareparts=mysqli_query($conn_arc, "SELECT * FROM mdata_spareparts
                                JOIN coders ON mdata_spareparts.id_pegawai=coders.id_coder
                                LIMIT $awal_data25, $data25
                            ");
                            if(isset($_POST['search-arc-sparepart'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-arc-sparepart'])));
                                $mdata_spareparts=mysqli_query($conn_arc, "SELECT * FROM mdata_spareparts
                                    JOIN coders ON mdata_spareparts.id_pegawai=coders.id_coder
                                    WHERE mdata_spareparts.ket LIKE '%$keyword%'
                                    OR mdata_spareparts.suplayer LIKE '%$keyword%'
                                    OR mdata_spareparts.tgl_cari LIKE '%$keyword%'
                                ");
                            }
                            $data26=25;
                            $result26=mysqli_query($conn_arc, "SELECT * FROM mdata_spareparts_lama");
                            $total26=mysqli_num_rows($result26);
                            $total_page26=ceil($total26/$data26);
                            $page26=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data26=($data26*$page26)-$data26;
                            $mdata_spareparts_lama=mysqli_query($conn_arc, "SELECT * FROM mdata_spareparts_lama
                                LIMIT $awal_data26, $data26
                            ");
                            $data27=25;
                            $result27=mysqli_query($conn_arc, "SELECT * FROM mdata_laporan_dp");
                            $total27=mysqli_num_rows($result27);
                            $total_page27=ceil($total27/$data27);
                            $page27=(isset($_GET['page']))?$_GET['page']:1;
                            $awal_data27=($data27*$page27)-$data27;
                            $mdata_laporan_dp=mysqli_query($conn_arc, "SELECT * FROM mdata_laporan_dp
                                JOIN musers ON mdata_laporan_dp.id_user=musers.id_user 
                                JOIN zlayanan ON mdata_laporan_dp.id_layanan=zlayanan.id_layanan 
                                JOIN coders ON mdata_laporan_dp.id_pegawai=coders.id_coder
                                LIMIT $awal_data27, $data27
                            ");
                            if(isset($_POST['search-arc-laporan-dp'])){
                                $keyword=addslashes(trim(mysqli_real_escape_string($conn, $_POST['keyword-arc-laporan-dp'])));
                                $mdata_laporan_dp=mysqli_query($conn_arc, "SELECT * FROM mdata_laporan_dp
                                    JOIN musers ON mdata_laporan_dp.id_user=musers.id_user 
                                    JOIN zlayanan ON mdata_laporan_dp.id_layanan=zlayanan.id_layanan 
                                    JOIN coders ON mdata_laporan_dp.id_pegawai=coders.id_coder
                                    WHERE mdata_nota_dp.id_nota_tinggal LIKE '%$keyword%'
                                    OR mdata_nota_dp.id_nota_dp LIKE '%$keyword%'
                                    OR mdata_nota_dp.kerusakan LIKE '%$keyword%'
                                    OR mdata_nota_dp.tgl_cari LIKE '%$keyword%'
                                ");
                            }
                        // }

                    }
                    
                    // class private{
                        $halodoc_question=mysqli_query($conn, "SELECT * FROM covid_question");
                        $employee=mysqli_query($conn, "SELECT * FROM employee 
                            JOIN employee_security ON `employee`.`id_security`=`employee_security`.`id_security`
                            JOIN users_role ON `employee`.`id_role`=`users_role`.`id_role` 
                            WHERE id_employee='$id_employee'
                        ");
                        if(isset($_POST['edit-profile-employee'])){
                            if(edit_profile_employee($_POST)>0){
                                $_SESSION['message-success']="Foto profile anda berhasil diubah!";
                                header("Location: profile");
                                exit;
                            }
                        }
                        if(isset($_POST['edit-email-employee'])){
                            if(edit_email_employee($_POST)>0){
                                unset($_SESSION['message-danger']);
                                header("Location: verification");
                                exit;
                            }
                        }
                        if(isset($_POST['edit-data-employee'])){
                            if(edit_data_employee($_POST)>0){
                                $_SESSION['message-success']="Data pribadi anda berhasil diubah!";
                                header("Location: profile");
                                exit;
                            }
                        }
                        $user_terpercaya=mysqli_query($conn, "SELECT * FROM employee");
                        $id_security=$_SESSION['id-security'];
                        $employee_security=mysqli_query($conn, "SELECT * FROM employee_security WHERE id_security='$id_security'");
                        if(isset($_POST['tambah-user-terpercaya'])){
                            if(($_POST)>0){
                                $_SESSION['message-success']="";
                                header("Location: ");
                                exit;
                            }
                        }
                        if(isset($_POST['hapus-user-dipercaya'])){
                            if(($_POST)>0){
                                $_SESSION['message-success']="";
                                header("Location: ");
                                exit;
                            }
                        }
                        if(isset($_POST['ubah-sandi-employee'])){
                            if(ubah_sandi_employee($_POST)>0){
                                if(isset($_SESSION['message-danger'])){
                                    unset($_SESSION['message-danger']);
                                }
                                $_SESSION['message-success']="Sandi anda telah diubah!";
                                header("Location: settings");
                                exit;
                            }
                        }
                        $employee_log=mysqli_query($conn, "SELECT * FROM employee_log");
                        $snf_about=mysqli_query($conn, "SELECT * FROM snf_about");
                        if(isset($_POST['edit-img-about'])){
                            if(edit_logo_web($_POST)>0){
                                $_SESSION['message-success']="Gambar Website berhasil di upload!";
                                header("Location: about");
                                exit;
                            }
                        }
                        if(isset($_POST['edit-data-about'])){
                            if(edit_data_aboutweb($_POST)>0){
                                $_SESSION['message-success']="Data tentang website berhasil di ubah!";
                                header("Location: about");
                                exit;
                            }
                        }
                        $row_users=mysqli_query($conn, "SELECT * FROM users");
                        $rows_user=mysqli_num_rows($row_users);
                        $row_employee=mysqli_query($conn, "SELECT * FROM employee WHERE id_role=2 AND id_role=6");
                        $rows_employee=mysqli_num_rows($row_employee);
                        $row_teknisi=mysqli_query($conn, "SELECT * FROM employee WHERE id_role=7 AND id_role=8");
                        $rows_teknisi=mysqli_num_rows($row_teknisi);
                        $row_coder=mysqli_query($conn, "SELECT * FROM employee WHERE id_role=9 AND id_role=10 AND id_role=11");
                        $rows_coder=mysqli_num_rows($row_coder);
                    // }

                    // hallodoc{
                        $halodoc_question=mysqli_query($conn, "SELECT * FROM covid_question WHERE is_active=1");
                        if(isset($_POST['uji-dokter'])){
                            header("Location: halodoc");
                            exit;
                        }
                        if(isset($_POST['ya-halodoc'])){
                            if(ya_halodoc($_POST)>0){
                                header("Location: halodoc");
                                exit;
                            }
                        }
                        if(isset($_POST['tidak-halodoc'])){
                            if(tidak_halodoc($_POST)>0){
                                header("Location: halodoc");
                                exit;
                            }
                        }
                        if(isset($_POST['retest-halodoc'])){
                            unset($_SESSION['test-halodoc']);
                            unset($_SESSION['count-ques']);
                            unset($_SESSION['count-cate-no']);
                            unset($_SESSION['count-cate-yes']);
                            unset($_SESSION['cate']);
                            unset($_SESSION['retest-halodoc']);
                            header("Location: halodoc");
                            exit;
                        }
                    // }

                }else if($_SESSION['id-role']>12){
                    // code
                }
            }
        }
    // }

    // class public user{
        if(isset($_SESSION['id-user'])){
            if(isset($_POST['logout'])){
                header("Location: controller/logout.php");exit;
            }
        }
    // }