<?php
    include('../../class/class_connect_db.php');
    include('../../class/class_user.php');

    if(isset($_POST['btn_save'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $idcard = $_POST['idcard'];
        $gender = $_POST['gender'];
        $telephone = $_POST['telephone'];
        $address = $_POST['address'];
        $subdistrict = $_POST['subdistrict'];
        $district = $_POST['district'];
        $province = $_POST['province'];
        $zipcode = $_POST['zipcode'];
        $uid = $_POST['uid'];

        if($obj_user_dup = check_user_duplicate($conn,$uid)) {
            if(!mysqli_num_rows($obj_user_dup) > 0) {
                if(add_user($conn,$firstname,$lastname,$idcard,$gender,$telephone,$address,$subdistrict,
                $district,$province,$zipcode,$uid)){
                    echo json_encode(['status' => 'success', 'message' => 'บันทึกข้อมูลสำเร็จ']);
                }else{
                    echo json_encode(['status' => 'error', 'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
                }
            }else{
                echo json_encode(['status' => 'error', 'message' => 'มีข้อมูลของท่านอยู่ในระบบ']);
            }
        }
    }
?>