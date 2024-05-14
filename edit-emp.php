<?php
    include('./include/header.php');
    include('./include/navbar.php');
    include('./class/class_connect_db.php');

    $emp_id = $_GET['emp_id'];
    include('./class/class_emp.php');
    include('./php/emp_modal/get_emp.php');
?>

    <div class="container-fluid">
        <div class="row">
            <div class="card mb-4 col-md-12">
                <div class="card-header">
                    <div class="col-md-6">
                        <i class="fas fa-user-alt"></i> จัดการข้อมูลส่วนตัว
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    รูปโปรไฟล์
                                </div>
                                <div class="card-body text-center">
                                    <img class="img-fluid" src="https://sb-admin-pro.startbootstrap.com/assets/img/illustrations/profiles/profile-1.png" alt="">
                                    <span class="text-xl">รูปไม่เกินขนาด 5 MB.</span>
                                    <button type="button" class="btn btn-block btn-primary">อัพโหลดไฟล์</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 pt-1">
                            <div class="card">
                                <div class="card-header">
                                    รายละเอียดข้อมูล
                                </div>
                                <form id="form_edit_user" class="user">
                                    <input type="hidden" class="form-control" name="emp_id" id="emp_id" value="<?php echo $emp_id; ?>">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-md-6 mb-sm-0">
                                                <label  class="small mb-1">Username</label>
                                                <input type="text" class="form-control" names="username" id="username" value="<?php echo $emp_username ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label  class="small mb-1">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $emp_password ?>">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-transparent">
                                                            <i class="fas fa-eye-slash" id="togglePasswordIcon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 mb-sm-0">
                                                <label  class="small mb-1">ชื่อ</label>
                                                <input type="text" class="form-control" names="firstname" id="firstname" value="<?php echo $emp_firstname ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label  class="small mb-1">นามสกุล</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $emp_lastname ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 mb-sm-0">
                                                <label  class="small mb-1">ตำแหน่ง</label>
                                                <input type="text" class="form-control" names="position" id="position" value="<?php echo $emp_position ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label  class="small mb-1">หน่วยงาน</label>
                                                <input type="text" class="form-control" id="department" name="department" value="<?php echo $emp_department ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        <div class="btn btn-group mr-2">
                                            <button type="submit" class="btn btn-outline-success" name="insertEMPBtnEdit" id="insertEMPBtnEdit" value="insertemp">บันทึกข้อมูล</button>
                                            <button class="btn btn-outline-danger" type="button" data-dismiss="modal">ยกเลิก</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    include('./include/script.php');
    include('./include/footer.php');
?>