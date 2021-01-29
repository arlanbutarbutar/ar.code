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
    if (isset($_SESSION['auth'])) {
        if (isset($_POST['daftar'])) {
            if (daftar($_POST) > 0) {
                header('Location: verification');exit;
            }
        }
    }
// == Private ==
