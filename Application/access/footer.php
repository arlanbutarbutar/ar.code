<!-- == footer !isset id-user == -->
    <?php if(!isset($_SESSION['id-user'])){?>
        <footer class="footer col-md-12" style="bottom: 0px; position: absolute" data-aos="fade-up" data-aos-delay="0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-col copyright">
                            <p class="small comfortaa <?php if(empty($_SESSION['page-name'])){?>text-light<?php }?>">Create with <span style="color: #e25555;">&#9829;</span> by Arlan Butar Butar</p>
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
                            <p class="small comfortaa text-light">Create with <span style="color: #e25555;">&#9829;</span> by Arlan Butar Butar</p>
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
                <footer class="sticky-footer bg-white mt-5">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto color-black">
                            <span <?= $color_black?>>Create with <span style="color: #e25555;">&#9829;</span> by Arlan Butar Butar</span>
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
                        <h5 class="modal-title" <?= $color_black?> id="exampleModalLabel">Are you sure you want to leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" <?= $color_black?>>×</span>
                        </button>
                    </div>
                    <div class="modal-body" <?= $color_black?>>Select "Logout" if you are sure you want to end this session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-light btn-sm shadow card-scale mr-2" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn black-jack btn-sm shadow card-scale" <?= $bg_black?> href="../Application/controller/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="../Assets/vendor/jquery/jquery.min.js"></script>
        <script src="../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../Assets/vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="../Assets/js/sb-admin-2.min.js"></script>
        <script src="../Assets/js/register.js"></script>
        <script src="../Assets/vendor/chart.js/Chart.min.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.1.0.js"></script> -->
        <script>
            // ==> chart kalkulasi data pengguna
                Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                Chart.defaults.global.defaultFontColor = '#262626';
                var ctx = document.getElementById("myPieChart");
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Handphone", "Laptop", "Website", "Not Available"],
                        datasets: [{
                            data: [<?= $row_cal_handphone?>, <?= $row_cal_laptop?>, <?= $row_cal_website?>, <?= $row_cal_available?>],
                            backgroundColor: ['#55CE12', '#12CE8B', '#1255CE', '#A3C813'],
                            hoverBackgroundColor: ['#48AE10', '#09AB71', '#0A3A91', '#85A40C'],
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            backgroundColor: "#323232",
                            bodyFontColor: "#FFFFFF",
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
            // ==> thead fixed top
                // var $th = $('.tableFixHead').find('thead th')
                // $('.tableFixHead').on('scroll', function() {
                // $th.css('transform', 'translateY('+ this.scrollTop +'px)');
                // });
            // ==> alert timeout
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove();
                    });
                }, 15000)
            // ==> file photo up
                $('.custom-file-input').on('change', function(){
                    let fileName = $(this).val().split('\\').pop();
                    $(this).next('.custom-file-label').addClass("selected").html(fileName);
                });
            // ==> animated delay form AOS
                AOS.init({
                    // offset: 100,
                    duration: 1000,
                    throttleDelay: 99
                });
            // ==> resize scrollWidth
                $(window).on("load resize ", function() {
                    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
                    $('.tbl-header').css({'padding-right':scrollWidth});
                }).resize();
            // ==> toggle tooltip
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            // ==> modals
                $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var recipient = button.data('whatever')
                var modal = $(this)
                modal.find('.modal-title').text('New message to ' + recipient)
                modal.find('.modal-body input').val(recipient)
                })
            // ==> print file
                // function printDiv(elementId) {
                //     var a = document.getElementById('printing-css').value;
                //     var b = document.getElementById(elementId).innerHTML;
                //     window.frames["print_frame"].document.title = document.title;
                //     window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
                //     window.frames["print_frame"].window.focus();
                //     window.frames["print_frame"].window.print();
                // }
            // ==> search data
                // $(document).ready(function(){
                //     $('#keyword-nota-tinggal').on('keyup',function(){
                //         $.get('search/nota-tinggal.php?keyword-nota-tinggal='+$('#keyword-nota-tinggal').val(),function(data){
                //             $('#container-nota-tinggal').html(data);
                //         });
                //     });
                // });

                // $(document).ready(function(){
                //     $('#keyword-nota-cancel').on('keyup',function(){
                //         $.get('search/nota-cancel.php?keyword-nota-cancel='+$('#keyword-nota-cancel').val(),function(data){
                //             $('#container-nota-cancel').html(data);
                //         });
                //     });
                // });

                // $(document).ready(function(){
                //     $('#keyword-nota-lunas').on('keyup',function(){
                //         $.get('search/nota-lunas.php?keyword-nota-lunas='+$('#keyword-nota-lunas').val(),function(data){
                //             $('#container-nota-lunas').html(data);
                //         });
                //     });
                // });
                
                // $(document).ready(function(){
                //     $('#keyword-nota-dp').on('keyup',function(){
                //         $.get('search/report-dp.php?keyword-nota-dp='+$('#keyword-nota-dp').val(),function(data){
                //             $('#container-nota-dp').html(data);
                //         });
                //     });
                // });

                // $(document).ready(function(){
                //     $('#keyword-nota').on('keyup',function(){
                //         $.get('search/report-day.php?keyword-nota='+$('#keyword-nota').val(),function(data){
                //             $('#container-nota').html(data);
                //         });
                //     });
                // });
            
                // $(document).ready(function(){
                //     $('#keyword-laporan-pengeluaran').on('keyup',function(){
                //         $.get('search/report-expense.php?keyword-laporan-pengeluaran='+$('#keyword-laporan-pengeluaran').val(),function(data){
                //             $('#container-laporan-pengeluaran').html(data);
                //         });
                //     });
                // });

                // $(document).ready(function(){
                //     $('#keyword-sparepart').on('keyup',function(){
                //         $.get('search/report-spareparts.php?keyword-sparepart='+$('#keyword-sparepart').val(),function(data){
                //             $('#container-sparepart').html(data);
                //         });
                //     });
                // });
            // ==> voice SpeechRecognition
                // const searchForm = document.querySelector('#search-app');
                // const searchFormInput = searchForm.querySelector('input');
                // const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                // if(SpeechRecognition) {
                //     console.log("Your browser supports speech Recognition");
                //     searchForm.insertAdjacentHTML("beforeend", "<input class='form-control col-11 mr-2 text-center' type='text' name='q' id='search-engine' placeholder='Cari Provinsi...' aria-label='Search'><button class='btn btn-outline-success border-0 my-2 my-sm-0' id='talk' type='button'><i class='fas fa-microphone'></i></button>");
                //     const micBtn = searchForm.querySelector('button');
                //     const micIcon = micBtn.querySelector('i');

                //     const recognition = new SpeechRecognition();
                //     recognition.continuous = true;
                //     recognition.lang = "id"; // lang
                //     micBtn.addEventListener("click", micBtnClick);
                //     function micBtnClick() {
                //         if(micIcon.classList.contains("fa-microphone")){
                //             recognition.start();
                //         }else{
                //             recognition.stop();
                //         }
                //     }
                //     recognition.addEventListener("start", startSpeechRecognition);
                //     function startSpeechRecognition(){
                //         micIcon.classList.remove("fa-microphone");
                //         micIcon.classList.add("fa-microphone-slash");
                //         searchFormInput.focus();
                //         console.log("Speech Recognition Active");
                //     }
                //     recognition.addEventListener("end", endSpeechRecognition);
                //     function endSpeechRecognition(){
                //         micIcon.classList.remove("fa-microphone-slash");
                //         micIcon.classList.add("fa-microphone");
                //         searchFormInput.focus();
                //         console.log("Speech Recognition Disconnected");
                //     }
                //     recognition.addEventListener("result", resultOfSpeechRecognition);
                //     function resultOfSpeechRecognition(event){
                //         const currentResultIndex = event.resultIndex;
                //         const transcript = event.results[currentResultIndex][0].transcript;
                //         if(transcript.toLowerCase().trim()==="stop"){
                //             recognition.stop();
                //         }else if(!searchFormInput.value){
                //             searchFormInput.value = transcript;
                //         }else{ 
                //             if(transcript.toLowerCase().trim()==="go"){
                //                 searchForm.submit();
                //             }else if(transcript.toLowerCase().trim()==="reset"){
                //                 searchFormInput.value = "";
                //             }else{
                //                 searchFormInput.value = transcript;
                //             }
                //         }
                        // aksi beda
                        // setTimeout(() => {
                        //     searchForm.submit();
                        // }, 750);
                        // ===========
                //     }
                // }else{
                //     console.log("Your browser does not supports speech Recognition");
                //     searchForm.insertAdjacentHTML("beforeend", "<input class='form-control col-12 text-center' type='text' name='q' id='search-engine' placeholder='Cari Provinsi...' aria-label='Search'>");
                // }
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