<?php if(empty($_SESSION['page-name'])){?>
<nav class="navbar navbar-expand-lg bg-transparent rounded static ml-3 mr-3">
<?php }else if(!empty($_SESSION['page-name'])){?>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow rounded sticky-top m-3">
<?php }?>
    <a class="navbar-brand navbar-brand-ar overflow-hidden" href="#page-top"><img src="https://i.ibb.co/yd3kkKw/logo-ugdhp.png" alt="logo-ugdhp" border="0" width="60"></a>
    <button class="navbar-toggler navbar-toggler-ar border-0 shadow" type="button" data-toggle="collapse" data-target="#navbar-toggle-ar" aria-controls="navbar-toggle-ar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-stream text-light fa-1x p-2"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbar-toggle-ar">
        <div class="mr-auto mt-2 mt-lg-0"></div>
        <div class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav m-auto">
                <li class="nav-item overflow-hidden">
                    <a class="nav-link <?php if(empty($_SESSION['page-name'])){?>text-light<?php }?> nav-link-ar text-center" href="./">Home</a>
                </li>
                <li class="nav-item overflow-hidden">
                    <a class="nav-link <?php if(empty($_SESSION['page-name'])){?>text-light<?php }?> nav-link-ar text-center" href="news">News</a>
                </li>
                <li class="nav-item overflow-hidden">
                    <a class="nav-link <?php if(empty($_SESSION['page-name'])){?>text-light<?php }?> nav-link-ar text-center" href="services">Services</a>
                </li>
                <li class="nav-item overflow-hidden">
                    <a class="nav-link <?php if(empty($_SESSION['page-name'])){?>text-light<?php }?> nav-link-ar text-center" href="contact">Contact</a>
                </li>
                <li class="nav-item overflow-hidden bg-transparent rounded">
                    <button class="btn btn-primary-ar my-2 my-sm-0 font-weight-bold" type="submit">Sign In</button>
                </li>
            </ul>
        </div>
    </div>
</nav>