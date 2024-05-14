<?php
    include('../../class/class_connect_db.php');
    include('../../class/class_emp.php');
    include('generated_emp.php');

    // เรียกใช้ฟังก์ชันเพื่อสร้าง emp id ออกมา
    $new_id = generatedempID($conn);

    if(isset($_POST['insertEMPBtn'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $position = $_POST['position'];
        $department = $_POST['department'];


        if(add_emp($conn,$new_id,$username,$password,$firstname,$lastname,$position,$department,$new_id)){
            echo json_encode(['status' => 'success', 'message' => 'บันทึกข้อมูลสำเร็จ']);
        }else{
            echo json_encode(['status' => 'error', 'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
        }
    }else{
        echo json_encode(['status' => 'error', 'message' => 'มีข้อมูลของท่านอยู่ในระบบ']);
    }
?>