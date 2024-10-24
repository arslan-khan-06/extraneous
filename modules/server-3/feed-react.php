<?php
session_start();
require "db_con.php";

$user_id = $_GET['user_id'];
$post_id = $_GET['post_id'];
$user_ssn = $_SESSION['username'];
$dols = date("Y-m-d H:i:s");

$query = "SELECT likes FROM posts WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $post_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $likes_obt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$ectrl = "SELECT liked_by FROM likes WHERE post_id = ? AND liked_by = ?";
$estmt = mysqli_prepare($conn, $ectrl);
mysqli_stmt_bind_param($estmt, 'is', $post_id, $user_ssn);
mysqli_stmt_execute($estmt);
mysqli_stmt_bind_result($estmt, $liked_by);
mysqli_stmt_fetch($estmt);
mysqli_stmt_close($estmt);

if (isset($liked_by) && $_GET['action'] == 'like') {
    echo 'ok';
    exit();
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'like') {
        $like_st = $likes_obt + 1;
        $like_qr = "UPDATE posts SET likes = ? WHERE id = ?";
        $stmt2 = mysqli_prepare($conn, $like_qr);
        mysqli_stmt_bind_param($stmt2, 'is', $like_st, $post_id);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
        $likes_obt = $like_st;

        $like_val = "INSERT INTO likes (post_id, liked_by, dols) VALUES (?, ?, ?)";
        $lstmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($lstmt, $like_val)) {
            die(mysqli_error($conn));
        }

        mysqli_stmt_bind_param(
            $lstmt,
            "iss",
            $post_id,
            $user_ssn,
            $dols
        );
        mysqli_stmt_execute($lstmt);
        exit();
    } else if ($_GET['action'] == 'dislike') {
        if (!isset($liked_by)) {
            exit();
        }
        $like_st2 = $likes_obt - 1;
        $like_qr2 = "UPDATE posts SET likes = ? WHERE id = ?";
        $stmt3 = mysqli_prepare($conn, $like_qr2);
        mysqli_stmt_bind_param($stmt3, 'is', $like_st2, $post_id);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_close($stmt3);
        $likes_obt = $like_st2;

        $like_rem = "DELETE FROM likes WHERE post_id = ? AND liked_by = ?";
        $stmt = mysqli_prepare($conn, $like_rem);
        mysqli_stmt_bind_param($stmt, 'ss', $post_id, $user_ssn);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    }
}
