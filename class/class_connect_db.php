<?php
$dbhost = '203.151.66.18';
$dbname = 'Ebudget';
$dbusername = 'postgres';
$dbpassword = 'dbpgvTA@2023';

function db_connect() {
    global $dbhost, $dbname, $dbusername, $dbpassword;
    $conn = pg_connect("host=$dbhost dbname=$dbname user=$dbusername password=$dbpassword");

    if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }

    return $conn;
}

?>