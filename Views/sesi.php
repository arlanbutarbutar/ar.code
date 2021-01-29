<?php if(!isset($_SESSION)){session_start();}
    if(!isset($_SESSION['id-employee'])){header("Location: ../auth/toUser");exit;}
    else if(isset($_SESSION['id-employee'])){
        if($_SESSION['id-role']>12){header("Location: ../auth/toUser");exit;}
        if($is_active==2){header("Location: verification");exit;}
    }