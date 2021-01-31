<?php if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['id-user'])) {
    if ($_SESSION['id-role'] == 1) {
        header("Location: ../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 2) {
        header("Location: ../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 3) {
        header("Location: ../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 4) {
        header("Location: ../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 5) {
        header("Location: ../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 6) {
        header("Location: ../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 7) {
        header("Location: ../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 8) {
        header("Location: ../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 9) {
        header("Location: ../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 10) {
        header("Location: ../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 11) {
        header("Location: ../Views/dashboard");
        exit;
    }
    if ($_SESSION['id-role'] == 12) {
        header("Location: ../Views/");
        exit;
    }
    if ($_SESSION['id-role'] == 13) {
        header("Location: ../../Views/");
        exit;
    }
    if ($_SESSION['id-role'] == 14) {
        header("Location: ../");
        exit;
    }
    if ($_SESSION['id-role'] == 15) {
        header("Location: ../");
        exit;
    }
}
if (!isset($_SESSION['id-user']) ) {
    header("Location: http://localhost/ar.code/");
    exit;
}
