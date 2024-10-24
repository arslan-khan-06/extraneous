<?php

session_start();
require "db_con.php";

$liked_by = $_SESSION['username'];

$vr_id = $_GET['vr_id'];

$vrm_id = $_GET['vr_id'];

$on_feed = $_SESSION['req_post'];
$sql = "SELECT act.id AS user_id, act.username, act.profile, pst.id AS post_id, pst.user_id AS post_user_id, cmt.*, clk.liked_by
FROM comments cmt
INNER JOIN posts pst ON cmt.cmt_to = pst.id
INNER JOIN user_accounts act ON cmt.by_id = act.id
LEFT JOIN cmt_likes clk ON cmt.id = clk.cmt_id AND clk.liked_by = ?
WHERE cmt.cmt_status = 'reply' AND cmt.thread_to = ? OR cmt.thread_to = ?
ORDER BY cmt.docs ASC;
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'sii', $liked_by, $vr_id, $vrm_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

$cmt_reply = mysqli_fetch_all($res, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);
mysqli_close($conn);

foreach ($cmt_reply as $reply) {
    echo '
    <div class="comment-act more-cmnt">
        <div class="cmt-img-user">
            <img class="cmt-act-img" src="../media/profiles/' . $reply['profile'] . '">
        </div>

        <form class="cmt-dat">
            <div class="dat-un-div">
                <input type="hidden" class="cmt-id" name="cmt-id" value="' . $reply['id'] . '">
                <input type="hidden" class="thread-id" name="thread-id" value="' . $reply['thread_to'] . '">
                <input type="hidden" class="cmt_username" name="cmt_username" value="' . $reply['username'] . '">
                <h5 class="dat-un">' . $reply['username'] . '</h5>
                <h5 class="dat-un-to">@' . $reply['reply_to'] . '</h5>
            </div>
            <p class="cmt-txt">' . $reply['comment'] . '</p>
            <div class="cm-rep cm-ret-reps">
                
            </div>
        </form>

        <div class="cr2">
            <img style="display: ' . ($reply['liked_by'] ? 'none' : 'block') . ';" class="h2f" src="../media/com-media/heart-f.svg" alt="Heart">
            <img style="display: ' . ($reply['liked_by'] ? 'block' : 'none') . ';" class="h2t" src="../media/com-media/heart-t.svg" alt="Heart">
            <p class="cc2">' . $reply['likes'] . '</p>
        </div>
    </div>
    ';
}

echo '
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="../js/community/default.js"></script>
<script src="../js/community/feed-main-2.js"></script>
';

?>
