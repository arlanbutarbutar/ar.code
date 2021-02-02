<nav class="navbar navbar-expand-lg bg-transparent rounded static ml-3 mr-3" data-aos="fade-down" data-aos-delay="100">
    <a class="navbar-brand navbar-brand-ar overflow-hidden" href="#page-top"><img src="https://i.ibb.co/yd3kkKw/logo-ugdhp.png" alt="logo-ugdhp" border="0" width="60"></a>
    <button class="navbar-toggler navbar-toggler-ar border-0 shadow" type="button" data-toggle="collapse" data-target="#navbar-toggle-ar" aria-controls="navbar-toggle-ar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-stream text-light fa-1x p-2"></i>
    </button>
    <div class="collapse navbar-collapse collapse-ar rounded" id="navbar-toggle-ar">
        <div class="mr-auto mt-2 mt-lg-0"></div>
        <div class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav m-auto">
                <li class="nav-item overflow-hidden">
                    <a class="nav-link text-light nav-link-ar text-center" href="<?php if(isset($_SESSION['auth'])){echo "../";}?>./">Home</a>
                </li>
                <li class="nav-item overflow-hidden">
                    <a class="nav-link text-light nav-link-ar text-center" href="<?php if(isset($_SESSION['auth'])){echo "../";}?>news">News</a>
                </li>
                <li class="nav-item overflow-hidden">
                    <a class="nav-link text-light nav-link-ar text-center" href="<?php if(isset($_SESSION['auth'])){echo "../";}?>services">Services</a>
                </li>
                <li class="nav-item overflow-hidden">
                    <a class="nav-link text-light nav-link-ar text-center" href="<?php if(isset($_SESSION['auth'])){echo "../";}?>contact">Contact</a>
                </li>
                <?php if(!isset($_SESSION['id-user'])){?>
                    <li class="nav-item overflow-hidden bg-transparent rounded">
                        <a href="<?php if(!isset($_SESSION['auth'])){echo "Auth/";}?>signin" class="btn btn-primary-ar my-2 my-sm-0 font-weight-bold">Sign In</a>
                    </li>
                <?php }if(isset($_SESSION['id-user'])){?>
                    <li class="nav-item overflow-hidden bg-transparent rounded">
                        <form action="" method="POST" class="overflow-hidden">
                            <button type="submit" name="logout-user" class="btn btn-primary-ar my-2 my-sm-0 font-weight-bold">Logout</button>
                        </form>
                    </li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>