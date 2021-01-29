<?php if(!isset($_SESSION)){session_start();}
    require_once("../controller/script.php");require_once('sesi-batasan.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("../application/access/header.php")?>
        <title>User Online | <?= $_SESSION['name-web']?></title>
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
                            <h1 class="h2 mb-0 text-gray-800">User Online</h1>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            </div>
                            <div class="col-md-12">
                                <style>#scroll-x{overflow-x: auto}</style>
                                <div class="col-md-12 shadow rounded" id="scroll-x">
                                    <table class="table table-borderless table-sm text-center text-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th colspan="2">Aksi</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Last Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Hostname</th>
                                                <th scope="col">Agent</th>
                                                <th scope="col">IP</th>
                                                <th scope="col">Ref</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Postal</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1;if(mysqli_num_rows($users_online)==0){?>
                                            <tr><td colspan="16" class="text-dark font-weight-bold">Maaf data saat ini kosong!</td></tr>
                                            <?php }else if(mysqli_num_rows($users_online)>0){while($row=mysqli_fetch_assoc($users_online)){?>
                                            <tr>
                                                <th scope="row"><?= $no;?></th>
                                                <form action="" method="POST">
                                                    <td>
                                                        <div class="form-group">
                                                            <button class="btn btn-warning btn-sm" type="button" data-toggle="collapse" data-target="#collapse<?= $row['id_user']?>" aria-expanded="false" aria-controls="collapse<?= $row['id_user']?>"><i class="fas fa-pen"></i></button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                            <button type="submit" name="block-users" class="btn btn-<?php if($row['is_active']==1){echo "success";}else{echo "danger";}?> btn-sm"><?php if($row['is_active']==1){?><i class="fas fa-lock-open"></i><?php }else{?><i class="fas fa-lock"></i><?php }?></button>
                                                        </div>
                                                    </td>
                                                </form>
                                                <td>
                                                    <?php if($row['img']=="-"){?>
                                                    -
                                                    <?php }else{?>
                                                    <img src="../assets/img/img-users/<?= $row['img']?>" alt="" style="width: 50px">
                                                    <?php }?>
                                                </td>
                                                <td><?= $row['first_name']?></td>
                                                <td><?= $row['last_name']?></td>
                                                <td><?= $row['email']?></td>
                                                <td><?= $row['hostname']?></td>
                                                <td><?= $row['agent']?></td>
                                                <td><?= $row['ip']?></td>
                                                <td><?= $row['ref']?></td>
                                                <td><?= $row['phone']?></td>
                                                <td><?= $row['address']?></td>
                                                <td><?= $row['postal']?></td>
                                                <td><?= $row['role']?></td>
                                                <td><?php if($row['is_active']==1){echo"Active";}else{echo"Not active";}?></td>
                                                <td><?= $row['date_created']?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="8">
                                                    <div class="collapse" id="collapse<?= $row['id_user']?>">
                                                        <div class="card card-body">
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                                <input type="hidden" name="username" value="<?= $row['first_name']?>">
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
                                                                    <button type="submit" name="edit-users" class="btn btn-warning btn-sm">Apply</button>
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