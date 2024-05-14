<?php
    function generatedempID($conn){
        if($obj_row = check_max_uid($conn)){ 
            if(mysqli_num_rows($obj_row) > 0){
                $row = mysqli_fetch_assoc($obj_row);
                $max_uid = $row['max_uid'];

                // ตรวจสอบว่ามี id ล่าสุดหรือไม่
                if($max_uid){
                    // แยกเลข emp id และเพื่มขึ้นที่ละ1
                    $uid_num = (int)substr($max_uid,1);
                    $next_uid = "E" . str_pad($uid_num + 1, 4, "0", STR_PAD_LEFT);
                }else{
                    // ถ้ายังไม่มีเลข emp id ในฐานข้อมูล ให้เริ่มต้นที่  U0001
                    $next_uid = "E0001";
                }
            }else{
                $next_uid = "Error";
            }
        }
        return $next_uid;
    }
?>