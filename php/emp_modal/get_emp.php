<?php
    $emp_username = '';
    $emp_password = '';
    $emp_firstname = '';
    $emp_lastname = '';
    $emp_position = '';
    $emp_department = '';
    
    if($rsdata = data_emp_id($conn,$emp_id)){
        if($row = mysqli_fetch_array($rsdata,MYSQLI_ASSOC)){
            $emp_id = $row['uid_emp'];
            $emp_username = $row['username'];
            $emp_password = $row['password'];
            $emp_firstname = $row['firstname'];
            $emp_lastname = $row['lastname'];
            $emp_position = $row['position'];
            $emp_department = $row['department'];
        }
    }
?>