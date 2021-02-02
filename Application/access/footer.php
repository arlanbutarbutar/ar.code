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
    <?php }if(isset($_SESSION['id-user'])){if($_SESSION['id-role']==7){?>
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
    <?php }else if($_SESSION['id-role']<=6){?>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto color-black">
                            <span>Copyright &copy; UGD HP <?= date('Y') ?></span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <a class="scroll-to-top rounded-circle" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title color-black" id="exampleModalLabel">Are you sure you want to leave?</h5>
                        <button class="close color-black" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body color-black">Select "Logout" if you are sure you want to end this session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-light btn-sm shadow card-scale color-black mr-2" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn black-jack btn-sm shadow text-light card-scale" href="../Application/controller/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="email-coder" tabindex="-1" role="dialog" aria-labelledby="email-coderLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="email-coderLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="../Assets/vendor/jquery/jquery.min.js"></script>
        <script src="../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../Assets/vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="../Assets/js/sb-admin-2.min.js"></script>
        <script src="../Assets/vendor/chart.js/Chart.min.js"></script>
        <script>
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#262626';
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Developer", "Designer", "Code Reviewer"],
                    datasets: [{
                        data: [75, 50, 65],
                        backgroundColor: ['#E50909', '#E3DF0A', '#0A8BE2', ],
                        hoverBackgroundColor: ['#D10707', '#C2BF0B', '#0978C3'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(38,38,38)",
                        bodyFontColor: "#262626",
                        borderColor: '#232323',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        </script>
    <?php }}?>
<!-- == other == -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            offset: 30,
            duration: 1000,
            throttleDelay: 99
        });
    </script>