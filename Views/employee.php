<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan-ar.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>Employee | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">Employee</h1>
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
                                        <button class="btn btn-sm" name="search-employee" <?= $style_btn?> type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <!-- <div class="col-lg-6">
                                <nav class="small" aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        <?php if(isset($page2)){if(isset($total_page2)){if($page2>1):?>
                                        <li class="page-item">
                                            <a class="page-link" href="employee?page=<?= $page2-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>
                                        <?php endif;?>
                                        <?php for($i=1; $i<=$total_page2; $i++):?>
                                            <?php if($i<=5):?>
                                                <?php if($i==$page2):?>
                                                    <li class="page-item"><a class="page-link font-weight-bold" href="employee?page=<?= $i;?>"><?= $i;?></a></li>
                                                <?php else :?>
                                                    <li class="page-item"><a class="page-link" href="employee?page=<?= $i;?>"><?= $i;?></a></li>
                                                <?php endif;?>
                                            <?php endif;?>
                                        <?php endfor;?>
                                        <?php if($page2<$total_page2):?>
                                        <li class="page-item">
                                            <a class="page-link" href="employee?page=<?= $page2+1;?>">Next</a>
                                        </li>
                                        <?php endif;}}?>
                                    </ul>
                                </nav>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <style>#scroll-x{overflow-x: auto}</style>
                                <div class="col-md-12 shadow rounded" id="scroll-x">
                                    <table class="table table-borderless table-sm text-center text-dark mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th colspan="2">Aksi</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Last Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Postal</th>
                                                <th scope="col">User Terpercaya</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date Created</th>
                                                <th scope="col">|</th>
                                                <th scope="col">Password</th>
                                                <th scope="col">Hostname</th>
                                                <th scope="col">Agent</th>
                                                <th scope="col">IP</th>
                                                <th scope="col">Ref</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1;if(mysqli_num_rows($employee_data)==0){?>
                                            <tr><td colspan="19" class="text-dark font-weight-bold">Maaf data saat ini kosong!</td></tr>
                                            <?php }else if(mysqli_num_rows($employee_data)>0){while($row=mysqli_fetch_assoc($employee_data)){?>
                                            <tr>
                                                <th scope="row"><?= $no;?></th>
                                                <form action="" method="POST">
                                                    <td>
                                                        <div class="form-group">
                                                            <button class="btn btn-warning btn-sm" type="button" data-toggle="collapse" data-target="#collapse<?= $row['id_employee']?>" aria-expanded="false" aria-controls="collapse<?= $row['id_employee']?>"><i class="fas fa-pen"></i></button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="hidden" name="id-employee" value="<?= $row['id_employee']?>">
                                                            <input type="hidden" name="akses" value="1">
                                                            <button type="submit" name="block-employee" class="btn btn-<?php if($row['is_active']==1){echo "success";}else{echo "danger";}?> btn-sm"><?php if($row['is_active']==1){?><i class="fas fa-lock-open"></i><?php }else{?><i class="fas fa-lock"></i><?php }?></button>
                                                        </div>
                                                    </td>
                                                </form>
                                                <td>
                                                    <?php if($row['img']=="-"){?>
                                                    -
                                                    <?php }else{?>
                                                    <img src="../assets/img/img-employee/<?= $row['img']?>" alt="" style="width: 50px">
                                                    <?php }?>
                                                </td>
                                                <td><?= $row['first_name']?></td>
                                                <td><?= $row['last_name']?></td>
                                                <td><?= $row['email']?></td>
                                                <td><?= $row['phone']?></td>
                                                <td><?= $row['address']?></td>
                                                <td><?= $row['postal']?></td>
                                                <td><?php $id_user_dipercaya=$row['id_user_dipercaya'];if($id_user_dipercaya==0){echo "Belum ada users yg dipercayai.";}else if($id_user_dipercaya>0){$users_dipercaya=mysqli_query($conn, "SELECT * FROM employee WHERE id_employee='$id_user_dipercaya'");$row1=mysqli_fetch_assoc($users_dipercaya);echo $row1['first_name'];}?></td>
                                                <td><?= $row['role']?></td>
                                                <td><?php if($row['is_active']==1){echo"Active";}else{echo"Not active";}?></td>
                                                <td><?= $row['date_created']?></td>
                                                <td>|</td>
                                                <td><?= $row['password']?></td>
                                                <td><?= $row['hostname']?></td>
                                                <td><?= $row['agent']?></td>
                                                <td><?= $row['ip']?></td>
                                                <td><?= $row['ref']?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="8">
                                                    <div class="collapse" id="collapse<?= $row['id_employee']?>">
                                                        <div class="card card-body">
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id-employee" value="<?= $row['id_employee']?>">
                                                                <input type="hidden" name="username" value="<?= $row['first_name']?>">
                                                                <input type="hidden" name="akses" value="1">
                                                                <div class="form-group">
                                                                    <label for="role">Role <?= $row['first_name']?></label>
                                                                    <select name="role" id="role" class="form-control" required>
                                                                        <option>Pilih Role</option>
                                                                        <?php foreach($users_role as $row_role):?>
                                                                        <option value="<?= $row_role['id_role']?>"><?= $row_role['role']?></option>
                                                                        <?php endforeach;?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" name="edit-employee" class="btn btn-warning btn-sm">Apply</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
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