<?php
    function add_emp($conn,$uid_emp,$username,$password,$firstname,$lastname,$position,$department,$create_by){
        $query = "insert into tb_emp(uid_emp,username,password,firstname,lastname,position,department,is_deleted,create_by) 
        values ('$uid_emp','$username','$password','$firstname','$lastname','$position','$department','0','$create_by')";

        return mysqli_query($conn,$query);
    }

    function check_max_uid($conn){
        $query = "select max(uid_emp) as max_uid from tb_emp";
        
        return mysqli_query($conn,$query);
    }

    function data_emp($conn){
        $query = "select * from tb_emp";

        return mysqli_query($conn,$query);
    }

    function data_emp_id($conn,$emp_id){
        $query = "select * from tb_emp where uid_emp='$emp_id'";

        return mysqli_query($conn,$query);
    }

    function update_emp($conn,$emp_id,$username,$password,$firstname,$lastname,$position,$department){
        $query = "update tb_emp set username='$username',password='$password',firstname='$firstname',lastname='$lastname',position='$position',
        department='$department' where uid_emp='$emp_id'";

        return mysqli_query($conn,$query);
    }

    function deleted_emp($conn,$status,$emp_id){
        $query = "update tb_emp set is_deleted='$status' where uid_emp='$emp_id' ";
        
        return mysqli_query($conn,$query);
    }

?>