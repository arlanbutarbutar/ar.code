<?php if(!isset($_SESSION)){session_start();}
    require_once('connect.php');
    $setting_nota=mysqli_query($conn, "SELECT * FROM setting_nota");
    $row=mysqli_fetch_assoc($setting_nota);
    $name=$row['name'];
    if($name=='Nota Tinggal'){
        // code
    }else if($name=='Nota DP'){
        // code
    }else if($name=='Nota Lunas'){
        // code
    }else if($name=='Nota Cancel'){
        // code
    }