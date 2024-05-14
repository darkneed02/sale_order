<?php
    function add_user($conn,$firstname,$lastname,$idcard,$gender,$telephone,$address,$subdistrict,
    $district,$province,$zipcode,$uid){
        $query = "insert into tb_user (uid,firstname,lastname,gender,telephone,address,subdistrict,district,province,
        zipcode,is_deleted) values ('$uid','$firstname','$lastname','$gender','$telephone','$address','$subdistrict','$district',
        '$province','$zipcode',0)";

        return mysqli_query($conn, $query);
    }

    function check_user_duplicate($conn,$uid){
        $query = "select * from tb_user where uid = '$uid'";
        return mysqli_query($conn,$query);
    }
?>