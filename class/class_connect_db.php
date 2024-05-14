<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "smart_report";

    // connect to database
    $conn = mysqli_connect($servername,$username,$password,$db);
    $conn->set_charset('utf8');

    // time zone
    date_default_timezone_set('Asia/Bangkok');

    if(!$conn){
        die('Connnect Failed:' . mysqli_connect_error());
    }
?>