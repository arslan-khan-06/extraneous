<?php

$host = 'localhost';
$username_db = 'root';
$passowrd_db = '';
$db_name = 'extraneous';

$conn = mysqli_connect($host, $username_db, $passowrd_db, $db_name);

if (mysqli_connect_errno()) {
    die("Connection Failed!" . mysqli_connect_error());
}
?>