<?php
require "db_con.php";

$on_feed = $_SESSION['req_post'];
$liked_by = $_SESSION['username']; // Assuming you want to use the username instead of ID

$sql = "SELECT act.username, act.profile, pst.id, pst.user_id, cmt.*, clk.liked_by
FROM comments cmt
INNER JOIN posts pst ON cmt.cmt_to = pst.id
INNER JOIN user_accounts act ON cmt.by_id = act.id
LEFT JOIN cmt_likes clk ON cmt.id = clk.cmt_id AND clk.liked_by = ?
WHERE cmt.cmt_to = ? AND cmt.cmt_status = 'main'
ORDER BY cmt.id DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $liked_by, $on_feed);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

$cmt_data = mysqli_fetch_all($res, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);
mysqli_close($conn);


?>
