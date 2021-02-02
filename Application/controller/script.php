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
            $logout='../Application/controller/logout';
            $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['id-user']))));
            $users_view_profile=mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
        // => role selection
            if($_SESSION['id-role']<=6){ // => all administrator | == Dashboard
            }
            if($_SESSION['id-role']==1 || $_SESSION['id-role']==2){ // => founder & developer app
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