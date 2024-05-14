<?php
    session_start();
    include('class/class_connect_db.php');
    include('class/class_activity.php');

    if(activeity_log($conn,$_SESSION['emp_id'],'logout')){
        echo "สำเร็จ";
    }
    mysqli_close($conn);

    session_destroy();
    echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=login.html">';
    exit;
?>