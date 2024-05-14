<?php
    function activeity_log($conn,$emp_id,$activity){
        $query = "insert into tb_activity_log(emp_id,activity) values ('$emp_id','$activity')";
        
        return mysqli_query($conn,$query);
    }

    function data_activeity_log($conn){
        $query = "select u.firstname,u.lastname,a.* from tb_activity_log a
            join tb_emp u on u.uid_emp = a.emp_id";
        
        return mysqli_query($conn,$query); 
    }
?>