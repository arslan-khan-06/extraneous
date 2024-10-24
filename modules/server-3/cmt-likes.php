<?php
echo('trg');
session_start();
require "db_con.php";
echo('trg2');
$cmt_id = $_GET['cmt_id'];
$user_ssn = $_SESSION['username'];
$query = "SELECT likes FROM comments WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $cmt_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $likes_obt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
echo('trg3');
$ectrl = "SELECT liked_by FROM cmt_likes WHERE cmt_id = ? AND liked_by = ?";
$estmt = mysqli_prepare($conn, $ectrl);
mysqli_stmt_bind_param($estmt, 'is', $cmt_id, $user_ssn);
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
        $like_qr = "UPDATE comments SET likes = ? WHERE id = ?";
        $stmt2 = mysqli_prepare($conn, $like_qr);
        mysqli_stmt_bind_param($stmt2, 'ii', $like_st, $cmt_id);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
        $likes_obt = $like_st;

        $like_val = "INSERT INTO cmt_likes (cmt_id, liked_by) VALUES (?, ?)";
        $lstmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($lstmt, $like_val)) {
            die(mysqli_error($conn));
        }

        mysqli_stmt_bind_param(
            $lstmt,
            "is",
            $cmt_id,
            $user_ssn,
        );
        mysqli_stmt_execute($lstmt);
        echo('liked');
        exit();
    } else if ($_GET['action'] == 'dislike') {
        if (!isset($liked_by)) {
            exit();
        }
        $like_st2 = $likes_obt - 1;
        $like_qr2 = "UPDATE comments SET likes = ? WHERE id = ?";
        $stmt3 = mysqli_prepare($conn, $like_qr2);
        mysqli_stmt_bind_param($stmt3, 'ii', $like_st2, $cmt_id);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_close($stmt3);
        $likes_obt = $like_st2;

        $like_rem = "DELETE FROM cmt_likes WHERE cmt_id = ? AND liked_by = ?";
        $stmt = mysqli_prepare($conn, $like_rem);
        mysqli_stmt_bind_param($stmt, 'is', $cmt_id, $user_ssn);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        echo('disliked');
        exit();
    }
}