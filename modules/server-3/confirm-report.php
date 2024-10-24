<?php
require 'db_con.php';

if (isset($_GET['message']) && !empty(trim($_GET['message']))) {
    $message = $_GET['message'];
} else {
    echo "empty";
    exit();
}

if (isset($_GET['feed_id'])) {
    $feed_id = $_GET['feed_id'];
} else {
    exit();
}

$dors = date("Y-m-d H:i:s");

$sql = "INSERT INTO report (by_id, message, dors) VALUES (?, ?, ?)";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "iss",
    $feed_id,
    $message,
    $dors
);

mysqli_stmt_execute($stmt);

echo "success";
exit();
