<?php if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['id-user'])) {
    if ($_SESSION['id-role'] == 1) {
        header("Location: ../../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 2) {
        header("Location: ../../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 3) {
        header("Location: ../../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 4) {
        header("Location: ../../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 5) {
        header("Location: ../../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 6) {
        header("Location: ../../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 7) {
        header("Location: ../../Views/");
        exit;
    }
} else if (!isset($_SESSION['id-user'])) {
    header("Location: ../../");
    exit;
}
