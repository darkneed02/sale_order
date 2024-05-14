<?php
    function check_user_login($conn,$username,$password){
        $query = "select * from tb_emp where username = '$username' and password = '$password' ";
        return mysqli_query($conn,$query);
    }
?>