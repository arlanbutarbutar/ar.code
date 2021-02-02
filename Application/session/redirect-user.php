<?php if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id-user'])) {
    header("Location: ../Application/session/redirect-auth.php");
    exit;
}
