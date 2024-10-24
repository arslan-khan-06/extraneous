<?php
session_start();
require "db_con.php";

$cmt_to = $_GET['cmt_to'];
$thread_to = $_GET['thread_to'];
$replying_to = $_GET['replying_to'];
$by_id = $_SESSION['id'];
$cmt_by = $_SESSION['username'];
$cmt_status = $_GET['cmt_status'];
$comment = $_GET['comment'];
$docs = date("Y-m-d H:i:s");
$fork = $_GET['fork']; 

if (empty($comment)) {
    echo("something went wrong!");
    exit();
}

if ($cmt_status === 'main') {
    $sql = "INSERT INTO comments(cmt_to, by_id, cmt_by, cmt_status, comment, docs) VALUES(?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'iissss', $cmt_to, $by_id, $cmt_by, $cmt_status, $comment, $docs);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
} elseif ($fork === 'thread' && !empty($thread_to)) {
    $sql = "INSERT INTO comments(cmt_to, by_id, cmt_by, cmt_status, thread_to, reply_to, comment, docs) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'iississs', $cmt_to, $by_id, $cmt_by, $cmt_status, $thread_to, $replying_to, $comment, $docs);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql2 = "UPDATE comments SET has_thread = 'yes' WHERE id = ?";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, 'i', $thread_to);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
} elseif ($cmt_status === 'reply' && !empty($thread_to)) {
    $sql = "INSERT INTO comments(cmt_to, by_id, cmt_by, cmt_status, thread_to, reply_to, comment, docs) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'iississs', $cmt_to, $by_id, $cmt_by, $cmt_status, $thread_to, $replying_to, $comment, $docs);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

?>
