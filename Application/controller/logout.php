<?php if(!isset($_SESSION)){session_start();}
require_once('connect.php');
if(isset($_SESSION['mobile'])){
    if(isset($_SESSION['id-employee'])){
        $id_employee=addslashes(trim($_SESSION['id-employee']));
        mysqli_query($conn, "UPDATE employee SET sesi='2' WHERE id_employee='$id_employee'");
        $_SESSION=[];session_unset();session_destroy();
        setcookie('mobileAR','',time()-3600);setcookie('keyAR','',time()-3600);
        header("Location: ../auth/login-mobile");exit;
    }
}else{
    if(isset($_SESSION['id-employee'])){
        $id_employee=addslashes(trim($_SESSION['id-employee']));
        mysqli_query($conn, "UPDATE employee SET sesi='2' WHERE id_employee='$id_employee'");
        $_SESSION=[];session_unset();session_destroy();header("Location: ../");exit;
    }
}
if(isset($_SESSION['id-user'])){
    $_SESSION=[];session_unset();session_destroy();header("Location: ../");exit;
}