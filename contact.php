<?php if (!isset($_SESSION)) {
    session_start();
    require_once("Application/session/redirect-user.php");
    require_once("Application/controller/script.php");
    $_SESSION['page-name']=" - Contact";
} ?>

<!-- == Contact page == -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("Application/access/header.php") ?>
</head>

<body>
    <?php require_once("Application/access/navbar.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 mx-5 my-5 col-one-section">
                <img src="" alt="contact image">
            </div>
            <div class="col-lg-6">
                <form action="" method="POST"></form>
            </div>
        </div>
    </div>
    <?php require_once("Application/access/footer.php") ?>
</body>

</html>