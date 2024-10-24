<?php
use Carbon\Carbon;
require "db_con.php";
$session_username = $_SESSION['username'];

$sql = "SELECT act.username, act.profile, pst.*, 
               (SELECT COUNT(*) FROM likes l WHERE l.post_id = pst.id AND l.liked_by = ?) AS liked_by_user,
               (SELECT COUNT(*) FROM comments c WHERE c.cmt_to = pst.id) AS comment_count
        FROM user_accounts act
        INNER JOIN posts pst ON act.username = pst.user_id
        ORDER BY pst.id DESC";


$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $session_username);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

$post_data = mysqli_fetch_all($res, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
