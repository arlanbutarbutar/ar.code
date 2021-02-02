<!-- == footer !isset id-user == -->
    <?php if(!isset($_SESSION['id-user'])){?>
        <footer class="footer col-md-12" style="bottom: 0px; position: absolute" data-aos="fade-up" data-aos-delay="0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-col copyright">
                            <p class="small comfortaa <?php if(empty($_SESSION['page-name'])){?>text-light<?php }?>">Copyright © <?= date('Y');?> UGD HP - All rights reserved</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-col last text-right sosmed">
                            <span class="fa-stack">
                                <a href="https://www.facebook.com/ar.code27/" target="blank">
                                    <i class="fab fa-facebook-f small fa-stack-1x text-light"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="https://www.instagram.com/ar.code_/" target="blank">
                                    <i class="fab fa-instagram small fa-stack-1x text-light"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="https://www.youtube.com/channel/UC7mxNSfWUOgVgH05YynkCoA?view_as=subscriber" target="blank">
                                    <i class="fab fa-youtube small fa-stack-1x text-light"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="https://github.com/arlanbutarbutar" target="blank">
                                    <i class="fab fa-github small fa-stack-1x text-light"></i>
                                </a>
                            </span>
                        </div> 
                    </div>
                </div>
            </div>
        </footer>
    <?php }if(isset($_SESSION['id-user'])){?>
        <footer class="footer col-md-12" style="bottom: 0px; position: absolute" data-aos="fade-up" data-aos-delay="0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-col copyright">
                            <p class="small comfortaa text-light">Copyright © <?= date('Y');?> UGD HP - All rights reserved</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-col last text-right sosmed">
                            <span class="fa-stack">
                                <a href="https://www.facebook.com/ar.code27/" target="blank">
                                    <i class="fab fa-facebook-f small fa-stack-1x text-light"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="https://www.instagram.com/ar.code_/" target="blank">
                                    <i class="fab fa-instagram small fa-stack-1x text-light"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="https://www.youtube.com/channel/UC7mxNSfWUOgVgH05YynkCoA?view_as=subscriber" target="blank">
                                    <i class="fab fa-youtube small fa-stack-1x text-light"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="https://github.com/arlanbutarbutar" target="blank">
                                    <i class="fab fa-github small fa-stack-1x text-light"></i>
                                </a>
                            </span>
                        </div> 
                    </div>
                </div>
            </div>
        </footer>
    <?php }?>
<!-- == other == -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            offset: 30,
            duration: 1000,
            throttleDelay: 99
        });
    </script>