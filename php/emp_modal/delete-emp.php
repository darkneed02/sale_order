<?php  
    session_start();
    include('../../class/class_connect_db.php');
    include('../../class/class_emp.php');
    include('../../class/class_activity.php');

    if(isset($_POST['emp_id'])){
        $emp_id = $_POST['emp_id'];

        if(deleted_emp($conn,1,$emp_id)){

            if(activeity_log($conn,$_SESSION['emp_id'],'delete employess')){
                //
            }

            echo "สำเร็จ";
        }
    }
?>