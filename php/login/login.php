<?php

    session_start();

    include('../../class/class_connect_db.php');
    include('../../class/class_login.php');
    include('../../class/class_activity.php');

    if(!empty($_POST['username']) && !empty($_POST['password'])){
         $username = $_POST['username'];
         $password = $_POST['password'];

         $result = check_user_login($conn,$username,$password);

         if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $delted = $row['is_deleted'];

            if($delted == 1){
                echo json_encode(['status' => 'error', 'message' => 'ข้อมูลของท่านได้ทำการยกเลิก กรุณาแจ้งผู้ดูแลระแบบ']);
            }else{
                $_SESSION['fullname'] = $row['firstname'].' '. $row['lastname'];
                $_SESSION['emp_id'] = $row['uid_emp'];

                if(activeity_log($conn,$_SESSION['emp_id'],'login')){
                    // 
                }

                echo json_encode(['status' => 'success', 'message' => 'เข้าสู่ระบบสำเร็จ']);
            }
         }

    }else{
        echo json_encode(['status' => 'error', 'message' => 'กรุณากรอก username และ password ของท่าน']);
    }
    mysqli_close($conn);
?>