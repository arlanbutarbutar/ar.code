<?php if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['id-user'])) {
    if(!isset($_SESSION['auth'])){
        header("Location: Application/session/redirect-auth.php");
        exit;
    }else if(isset($_SESSION['auth'])){
        header("Location: ../Application/session/redirect-auth.php");
        exit;
    }
}
