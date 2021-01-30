<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>🩺 Hallodoc | <?= $_SESSION['name-web']?></title>
    </head>
    <body id="page-top" class="sidebar-toggled">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php require_once('../application/access/side-navbar.php');?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php require_once('../application/access/top-navbar.php');?>
                    <div class="container-fluid" style="margin-top: 100px">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h2 mb-0 text-gray-800">🩺 Hallodoc</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12 mb-5">
                                <div class="row">
                                    <div class="col-md-12 mb-n3">
                                        <h5 class="text-dark">Silakan jawab pertanyaan yang diuji dan liat hasilnya!</h5>
                                    </div>
                                    <div class="col-lg-8 mt-3">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <?php if(!isset($_SESSION['retest-halodoc'])){?>
                                                    <?php if(!isset($_SESSION['test-halodoc'])){?>
                                                        <?php foreach($halodoc_question as $hq):?>
                                                            <?php $id_ques=$hq['id_ques']?>
                                                            <div class="col-md-12 text-center">
                                                                <p class="text-dark font-weight-bold"><?php if($id_ques==1){echo $hq['question'];}?></p>
                                                            </div>
                                                        <?php endforeach;?>
                                                        <form action="" method="POST">
                                                            <div class="col-md-12 d-sm-flex justify-content-center text-center">
                                                                <input type="hidden" name="count_ques" value="1">
                                                                <input type="hidden" name="count_cate_yes" value="1">
                                                                <input type="hidden" name="count_cate_no" value="1">
                                                                <button type="submit" name="ya-halodoc" class="btn btn-outline-primary btn-sm mr-2">Ya</button>
                                                                <button type="submit" name="tidak-halodoc" class="btn btn-outline-primary btn-sm">Tidak</button>
                                                            </div>
                                                        </form>
                                                    <?php }else if(isset($_SESSION['test-halodoc'])){?>
                                                        <div class="col-md-12 text-center">
                                                            <p class="text-dark font-weight-bold"><?= $_SESSION['test-halodoc'];?></p>
                                                        </div>
                                                        <form action="" method="POST">
                                                            <div class="col-md-12 d-sm-flex justify-content-center text-center">
                                                                <input type="hidden" name="count_ques" value="<?= $_SESSION['count-ques'];?>">
                                                                <input type="hidden" name="count_cate_yes" value="<?= $_SESSION['count-cate-yes']?>">
                                                                <input type="hidden" name="count_cate_no" value="<?= $_SESSION['count-cate-no']?>">
                                                                <button type="submit" name="ya-halodoc" class="btn btn-outline-primary btn-sm mr-2">Ya</button>
                                                                <button type="submit" name="tidak-halodoc" class="btn btn-outline-primary btn-sm">Tidak</button>
                                                            </div>
                                                        </form>
                                                    <?php }?>
                                                <?php }else if(isset($_SESSION['retest-halodoc'])){?>
                                                    <div class="col-md-12 text-center">
                                                        <p class="text-dark font-weight-bold">Apakah anda ingin ulangi tes ini?</p>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="col-md-12 d-sm-flex justify-content-center text-center">
                                                            <button type="submit" name="retest-halodoc" class="btn btn-outline-primary btn-sm mr-2">Ya</button>
                                                        </div>
                                                    </form>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <h5 class="text-dark text-center font-weight-bold">Hasil Uji Klinis Anda</h5><hr>
                                                <?php if(!isset($_SESSION['cate'])){?>
                                                <p class="text-center text-dark">Belum ada hasil. Silakan tes kesehatan anda terlebih dahulu!</p>
                                                <?php }else if(isset($_SESSION['cate'])){?>
                                                    
                                                    <?php if($_SESSION['cate']==1){
                                                        $cate=$_SESSION['cate'];
                                                        $zhallodoc=mysqli_query($conn, "SELECT * FROM covid_question WHERE category=$cate");
                                                        foreach($zhallodoc as $row):
                                                    ?>
                                                        <p class="text-center text-dark"><?= $row['question']?></p>
                                                    <?php endforeach;
                                                        }else if($_SESSION['cate']==2){
                                                            $cate=$_SESSION['cate'];
                                                            $zhallodoc=mysqli_query($conn, "SELECT * FROM covid_question WHERE category=$cate");
                                                            foreach($zhallodoc as $row):
                                                    ?>
                                                        <p class="text-center text-dark"><?= $row['question']?></p>
                                                    <?php endforeach;}?>

                                                <?php }?>
                                            </div>
                                        </div>
                                        
                                        <div class="card shadow mt-3">
                                            <div class="card-body text-center">
                                                <a href="https://play.google.com/store/apps/details?id=com.linkdokter.halodoc.android&hl=in" class="nav-link text-decoration-none font-weight-bold" style="color: #DE154B" target="blank"><i class="fab fa-app-store" style="font-size: 50px"></i><br>Unduh Halodoc</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('../application/access/footer.php');?>
            </div>
        </div>
    </body>
</html>