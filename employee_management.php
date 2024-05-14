<?php
    include('./include/header.php');
    include('./include/navbar.php');
    include('./class/class_connect_db.php');
    include('./class/class_emp.php');
?>
    <div class="container-fluid">
        <div class="row">
            <div class="card mb-4 col-md-12">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-6">
                            จัดการข้อมูลพนังงาน
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addusermodal">
                                <i class="fas fa-user-plus"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#importuser">
                                <i class="fas fa-file-upload"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>ตำแหน่ง</th>
                                    <th>หน่วยงาน</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($emp_data = data_emp($conn)){
                                        $count = 1;
                                        while($rsEmp = mysqli_fetch_assoc($emp_data)){
                                            if($rsEmp['is_deleted'] != 1){
                                ?>
                                    <tr>
                                        <td><?php echo $count++ ?></td>
                                        <td><?php echo $rsEmp['firstname']. '-' . $rsEmp['lastname']; ?></td>
                                        <td><?php echo $rsEmp['username']; ?></td>
                                        <td><?php echo $rsEmp['password']; ?></td>
                                        <td><?php echo $rsEmp['position']; ?></td>
                                        <td><?php echo $rsEmp['department']; ?></td>
                                        <td>
                                            <a href="edit-emp.php?emp_id=<?php echo $rsEmp['uid_emp']; ?>">
                                                <button type="button" class="btn btn-circle btn-sm btn-info" name="btn_save_emp" id="btn_save_emp">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-circle btn-sm btn-danger btn_deleted" name="btn_deleted" id="btn_deleted" data-emp_id="<?php echo $rsEmp['uid_emp']; ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php                                             
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal add user -->
    <div class="modal fade" id="addusermodal" tabindex="-1" role="dialog" aria-labelledby="viewdata" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewdata" style="color: rgb(3, 3, 3);">บันทึกข้อมูลผู้ใช้งาน</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="#" id="insertFormEmp" class="user">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Username">
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent">
                                            <i class="fas fa-eye-slash" id="togglePasswordIcon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="firstname" id="firstname" placeholder="ชื่อ">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" name="lastname" id="lastname" placeholder="นามสกุล">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="position" id="position" placeholder="ตำแหน่ง">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" name="department" id="department" placeholder="หน่วยงาน">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <div class="btn btn-group mr-2">
                            <button type="submit" class="btn btn-outline-success" name="insertEMPBtn" id="insertEMPBtn" value="insertemp">บันทึกข้อมูล</button>
                            <button class="btn btn-outline-danger" type="button" data-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- import user -->
    <div class="modal fade" id="importuser" tabindex="-1" role="dialog" aria-labelledby="viewdata" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewdata" style="color: rgb(3, 3, 3);">นำข้อมูลเข้า</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="#" id="insertImportForm" class="user" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="file" name="file_excel" id="file_excel" class="form-control">
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <div class="btn btn-group mr-2">
                            <button type="submit" class="btn btn-outline-success" name="insertBtnImport" id="insertBtnImport" value="insert">บันทึกข้อมูล</button>
                            <button class="btn btn-outline-danger" type="button" data-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
    include('./include/script.php');
    include('./include/footer.php');
?>