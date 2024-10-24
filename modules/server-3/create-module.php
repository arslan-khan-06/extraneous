<?php

require 'db_con.php';
require '../server-1/cookie_val.php';

if (isset($_SESSION['username'])) {
    $user_id = $_SESSION['username'];
} else {
    header('Location: ../../community/create');
    exit();
}

if (isset($_POST['title'])) {
    $title = $_POST['title'];
} else {
    header('Location: ../../community/create');
    exit();
}

if (isset($_POST['tract'])) {
    $tract = $_POST['tract'];
} else {
    header('Location: ../../community/create');
    exit();
}

$dops = date("Y-m-d H:i:s");

$sql = "INSERT INTO posts (user_id, title, tract, dops) 
VALUES (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt, "ssss",
    $user_id,
    $title,
    $tract,
    $dops
);

mysqli_stmt_execute($stmt);

header('Location: ../../community/feed');


?>