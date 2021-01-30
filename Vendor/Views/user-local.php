<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>User Local | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">User Local</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="" method="POST">
                                    <div class="form-inline">
                                        <input class="form-control form-control-sm mr-sm-2" type="text" name="keyword" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-sm" name="search-users-local" <?= $style_btn?> type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <nav class="small" aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        <?php if(isset($page1)){if(isset($total_page1)){if($page1>1):?>
                                        <li class="page-item">
                                            <a class="page-link" href="user-local?page=<?= $page1-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>
                                        <?php endif;?>
                                        <?php for($i=1; $i<=$total_page1; $i++):?>
                                            <?php if($i<=5):?>
                                                <?php if($i==$page1):?>
                                                    <li class="page-item"><a class="page-link font-weight-bold" href="user-local?page=<?= $i;?>"><?= $i;?></a></li>
                                                <?php else :?>
                                                    <li class="page-item"><a class="page-link" href="user-local?page=<?= $i;?>"><?= $i;?></a></li>
                                                <?php endif;?>
                                            <?php endif;?>
                                        <?php endfor;?>
                                        <?php if($page1<$total_page1):?>
                                        <li class="page-item">
                                            <a class="page-link" href="user-local?page=<?= $page1+1;?>">Next</a>
                                        </li>
                                        <?php endif;}}?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <style>#scroll-x{overflow-x: auto}</style>
                                <div class="col-md-12 shadow rounded" id="scroll-x">
                                    <table class="table table-borderless table-sm text-center text-dark mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1;if(mysqli_num_rows($users_local)==0){?>
                                            <tr><td colspan="5" class="text-dark font-weight-bold">Maaf data saat ini kosong!</td></tr>
                                            <?php }else if(mysqli_num_rows($users_local)>0){while($row=mysqli_fetch_assoc($users_local)){?>
                                            <tr>
                                                <th scope="row"><?= $no;?></th>
                                                <td><?= $row['username']?></td>
                                                <td><?php if(empty($row['email_user'])){echo "@gmail.com";}else if(!empty($row['email_user'])){echo $row['email_user'];}?></td>
                                                <td><?php if(empty($row['tlpn_user'])){echo "-";}else if(!empty($row['tlpn_user'])){echo $row['tlpn_user'];}?></td>
                                                <td><?php if(empty($row['alamat_user'])){echo "-";}else if(!empty($row['alamat_user'])){echo $row['alamat_user'];}?></td>
                                            </tr>
                                            <?php $no++;}}?>
                                        </tbody>
                                    </table>
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