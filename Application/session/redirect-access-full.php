<?php if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['id-access'])) {
    if ($_SESSION['id-access'] == 1) {
        header("Location: ../Application/session/redirect-auth");
        exit;
    }
}
