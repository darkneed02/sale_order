<?php
session_start();
include('../../class/class_connect_db.php');
include('../../class/class_emp.php');

if(isset($_POST['emp_id'])){
    
    $emp_id = $_POST['emp_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];
    $department = $_POST['department'];


    // อัปเดตข้อมูล
    if(update_emp($conn,$emp_id,$username,$password,$firstname,$lastname,$position,$department)){
        echo json_encode(['status' => 'success', 'message' => 'ทำการอัปเดตเสร็จสิ้น']);
    } else{
            echo json_encode(['status' => 'error', 'message' => 'ทำการอัปเดตผิดพลาด']);
        }
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);
?>
