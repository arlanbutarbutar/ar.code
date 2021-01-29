<?php if (!isset($_SESSION)) {
    session_start();
    require_once("Application/session/redirect-user.php");
    require_once("Application/controller/script.php");
    $_SESSION['page-name']=" - News";
} ?>

<!-- == News page == -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("Application/access/header.php") ?>
    </head>
    <body>
        <?php require_once("Application/access/navbar.php") ?>
        <!-- == landing section == -->
            <div class="container-fluid">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="col-lg-5 mx-5 my-5 col-one-section overflow-hidden">
                        <h1 class="d-flex montserrat font-weight-bold">News</h1>
                        <div class="col-11 p-0">
                            <p class="comfortaa">The latest news every day here, stay tuned!</p>
                        </div>
                    </div>
                    <div class="col-lg-6 my-auto"></div>
                </div>
            </div>
        <?php require_once("Application/access/footer.php") ?>
    </body>
</html>