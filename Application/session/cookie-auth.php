<?php if (!isset($_SESSION)) {
    session_start();
}
if (isset($_COOKIE['mobileAR']) && isset($_COOKIE['keyAR'])) {
    $id = addslashes(trim($_COOKIE['mobileAR']));
    $key = addslashes(trim($_COOKIE['keyAR']));
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id'");
    $row = mysqli_fetch_assoc($result);
    if ($key == hash('sha256', $row['email'])) {
        if (isset($_SESSION['message-danger'])) {
            unset($_SESSION['message-danger']);
        }
        $_SESSION['id-user'] = $row['id_user'];
        $_SESSION['id-log'] = $row['id_log'];
        $_SESSION['is-active'] = $row['is_active'];
        $_SESSION['id-access'] = $row['id_access'];
        $_SESSION['id-role'] = $row['id_role'];
        $_SESSION['username'] = $row['first_name'];
        if (isset($_SESSION['auth'])) {
            header("Location: ../Application/session/redirect-auth.php");
            unset($_SESSION['auth']);
            exit;
        } else if (!isset($_SESSION['auth'])) {
            header("Location: Application/session/redirect-auth.php");
            unset($_SESSION['auth']);
            exit;
        }
    }
}
