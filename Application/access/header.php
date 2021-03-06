<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- == icon & name == -->
    <link rel="shortcut icon" href="https://i.ibb.co/yd3kkKw/logo-ugdhp.png">
    <script type='text/javascript'>
        msg = " UGD HP <?php if (isset($_SESSION['page-name'])) {echo " " . $_SESSION['page-name'];} ?>";
        msg = " " + msg;
        pos = 0;

        function scrollMSG() {
            document.title = msg.substring(pos, msg.length) + msg.substring(0, pos);
            pos++;
            if (pos > msg.length) pos = 0
            window.setTimeout("scrollMSG()", 400);
        }
        scrollMSG();
    </script>
<!-- == google fonts == -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sedgwick+Ave&family=Zilla+Slab+Highlight&display=swap" rel="stylesheet">
<!-- == style css == -->
    <link href="<?php if(isset($_SESSION['id-user']) || isset($_SESSION['auth'])){echo "../";}?>Assets/css/scrollx.css" rel="stylesheet">
    <?php if(!isset($_SESSION['id-user'])){?>
        <style>
            *{overflow-x: hidden;}
            /* == fonts == */
            .montserrat{font-family: 'Montserrat', sans-serif;}
            .comfortaa{font-family: 'Comfortaa', cursive;}
            .sedgwick{font-family: 'Sedgwick Ave', cursive;}
            .zilla{font-family: 'Zilla Slab Highlight', cursive;}
            /* == end font == */
            .icon-scale{transform: none;transition: 0.25s;}
            .icon-scale:hover{transform: scale(1.2);}
            .navbar-brand-ar img{transform: none;transition: 0.3s ease-in-out;}
            .navbar-brand-ar img:hover{transform: scale(1.2) rotate(10deg);}
            .nav-link-ar{color: #000;transform: none;font-weight: 600;transition: 0.25s ease-in-out;}
            .nav-link-ar:hover{font-weight: bold;transform: scale(1.1);}
            .col-one-section h1{margin-top: 100px}
            .montserrat button{font-size: 36px;transform: none;transition: 0.25s ease-in-out;cursor: pointer;outline: hidden;}
            .montserrat button:hover{transform: scale(1.2);letter-spacing: 3px;}
            .video-container{position: absolute;width: 100%;height: 100vh;overflow: hidden;}
            video{object-fit: cover;width: 100vw;height: 100vh;position: absolute;top: 0;left: 0;}
            .video-container::after{content: "";position: absolute;top: 0;left: 0;width: 100%;height: 100vh;background: #1b1b1b;opacity: 0.8;}
            .video-news{position: absolute;width: 100%;height: 100vh;overflow: hidden;}
            .video-news{object-fit: cover;width: 100vw;height: 100vh;position: absolute;top: 0;left: 0;}
            .video-news::after{content: "";position: absolute;top: 0;left: 0;width: 100%;height: 100vh;background: linear-gradient(to right, #fff, #1b1b1b);opacity: 0.8;}
            .location-ar{width: 1200px;height: 550px;}
            .landing-image{display: block;}
            .news .card{margin-right: 50px;}
            .content-news{margin-top: 80px;}
            .btn-primary-ar{color: #fff;background: #7BB402;transform: none;transition: 0.25s ease-in-out;border-radius: 40px;}
            .btn-primary-ar:hover{color: #1D1D1D;background: #5F8C01;transform: scale(1.1);border-radius: 5px;}
            .services h1{margin-top: 100px;}
            .contact .card{margin-top: 120px;}
            .contact .col-one-section{margin: 50px}
            .animated-ar img{width: 450px}
            .forgot-password .card{margin-top: 0;}
            .forgot-password img{width: 300px;margin-left: 80px;margin-top: 50px;}
            .verification img{width: 450px;margin-top: 100px;}
            .verification-success img{width: 400px;margin-top: 50px;}
            .color-black{color: #000;}
            .black-jack{background: #000;}
            .card-scale{transform: none;transition: 0.25s ease-in-out;}
            .card-scale:hover{transform: scale(1.1);}
            .font-lato{font-family: 'Lato', sans-serif;}
            .font-caveat{font-family: 'Caveat', cursive;}
            @media screen and (max-width: 640px){
                .landing-image{display: none;}
                .copyright{text-align: center;color: #fff;}
                .sosmed{display: none;}
                .col-one-section{width: 100%;}
                .video-news::after{background: linear-gradient(to bottom, #fff, #1b1b1b);}
                .news{margin-top: -50px;}
                .news .card{margin-right: 0;}
                .content-news{margin-top: 0;}
                .services h1{margin-top: -5px;}
                .contact h1{margin-top: -5px;}
                .contact .card{margin-top: 0;}
                .collapse-ar{background: #1D1D1D;}
                .animated-ar img{display: none;}
                .forgot-password img{display: none;}
                .forgot-password .card{margin-top: 100px;}
                .verification h1{margin-left: -10px;width: 110%;margin-top: -5px;}
                .verification img{width: 250px;margin-top: 0;margin-left: 50px;}
                .verification-success h1{margin-left: -10px;width: 110%;margin-top: -5px;}
                .verification-success img{width: 250px;margin-top: 0;margin-left: 50px;}
            }
        </style>
    <?php }if(isset($_SESSION['id-user'])){if($_SESSION['id-role']<=6){?>
            <link href="../Assets/css/registers.css" rel="stylesheet">
            <style>
                .card-scale{transform: none;transition: 0.25s ease-in-out;}
                .card-scale:hover{transform: scale(1.1);}
                /* .tableFixHead { overflow-y: auto; height: 100px; }
                table  { border-collapse: collapse; width: 100%; }
                th, td { padding: 8px 16px; }
                th     { background:#eee; } */
            </style>
        <?php }else if($_SESSION['id-role']==7){?>
            <style>
                .navbar-brand-ar img{transform: none;transition: 0.3s ease-in-out;}
                .navbar-brand-ar img:hover{transform: scale(1.2) rotate(10deg);}
                .nav-link-ar{color: #000;transform: none;font-weight: 600;transition: 0.25s ease-in-out;}
                .nav-link-ar:hover{font-weight: bold;transform: scale(1.1);}
                .btn-primary-ar{color: #fff;background: #7BB402;transform: none;transition: 0.25s ease-in-out;border-radius: 40px;}
                .btn-primary-ar:hover{color: #1D1D1D;background: #5F8C01;transform: scale(1.1);border-radius: 5px;}
                .navbar-toggler-ar{color: #fff;background: #9BDA15;transform: none;transition: 0.25s ease-in-out;}
                .navbar-toggler-ar:hover{color: #1D1D1D;background: #89C30D;transform: scale(1.1);}
                .navbar-toggler-ar span{color: #fff;}
            </style>
    <?php }}?>
<!-- == framework bootstrap == -->
    <?php if (!isset($_SESSION['id-user'])) { ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php } if(isset($_SESSION['id-user'])){if($_SESSION['id-role']==7){?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php }if($_SESSION['id-role']<=6){?>
        <link href="../Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital@1&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">
        <link href="../Assets/css/sb-admin-2.min.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <?php }}?>
<!-- == icons fontawesome == -->
    <link href="<?php if(isset($_SESSION['id-user']) || isset($_SESSION['auth'])){echo "../";}?>Assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<!-- == other == -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />