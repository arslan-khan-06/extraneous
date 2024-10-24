<?php

use Carbon\Carbon;

session_start();
if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['verified']);
    unset($_SESSION['signed_up_prep']);
    unset($_SESSION['signed_up']);
    unset($_SESSION['changed_password']);
    unset($_SESSION['email_taken']);
    unset($_SESSION['username_taken']);
    unset($_SESSION['invalid_un']);
    unset($_SESSION['key_su']);
} else {
    session_destroy();
    header('Location: ../sign-in/login');
}
require "../modules/server-3/feed-main-res.php";
require "../modules/server-3/load-cmt.php";
require "../modules/carbon/vendor/autoload.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <!-- icon -->
    <link rel="icon" href="../media/default/extraneous-logo-2-removed.png">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="../styles/com-styles/default1.css">
    <link rel="stylesheet" href="../styles/com-styles/feed-main.css">
</head>

<body>
    <div class="overlay-f">

    </div>

    <!-- ######## Header ####### -->
    <?php
    if (isset($_SESSION['post_data'])) {
        $post_data = $_SESSION['post_data'];
        foreach ($post_data as $post) {
            $uploadedTime = $post['dops'];
            $uploadedDateTime = Carbon::parse($uploadedTime);
            $currentDateTime = Carbon::now();
            $interval = $currentDateTime->diff($uploadedDateTime);

            $yearDiff = $interval->y;
            $monthDiff = $interval->m;
            $dayDiff = $interval->d;
            $hourDiff = $interval->h;
            $minuteDiff = $interval->i;

            $timeAgo = '';

            if ($yearDiff > 0) {
                $timeAgo = $yearDiff . ' year' . ($yearDiff > 1 ? 's' : '') . ' ago';
            } elseif ($monthDiff > 0) {
                $timeAgo = $monthDiff . ' month' . ($monthDiff > 1 ? 's' : '') . ' ago';
            } elseif ($dayDiff > 0) {
                $timeAgo = $dayDiff . ' day' . ($dayDiff > 1 ? 's' : '') . ' ago';
            } elseif ($hourDiff > 0) {
                $timeAgo = $hourDiff . ' hour' . ($hourDiff > 1 ? 's' : '') . ' ago';
            } elseif ($minuteDiff > 0) {
                $timeAgo = $minuteDiff . ' minute' . ($minuteDiff > 1 ? 's' : '') . ' ago';
            } else {
                $timeAgo = 'a moment ago';
            }
            echo '
                    <header>
        <div class="str-header">
            <div class="container-header-1">
                <div class="col-header-1">
                    <img class="back-btn" src="../media/com-media/back.svg" style="width: 25px; margin-right: 10px;">
                    <h1 class="ex-logo-login-1" style="text-align: center;">' . $post['title'] . '</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- ######## Header ####### -->

    <div class="main-feedm">
        <div class="feedm-center">
            <div class="fm-header">
                <div class="fm-pfp">
                <img class="fm-pic" src="../media/profiles/' . $post['profile'] . '" alt="profiles">

                    <div>
                        <h5 class="val-1">' . $post['username'] . '</h5>
                        <p class="fm-time">' . $timeAgo . '</p>
                    </div>
                </div>

                <div class="feed-action">
                    <img class="feed-action-i" src="../media/com-media/more.svg" alt="more" width="20px">
                    <div class="f-more-box">
                        <div class="report-f">
                            <h4>Report</h4>
                        </div>
                        <div>
                            <h4>Delete</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fm-body">
                <p class="fm-text">' . $post['tract'] . '</p>
            </div>

            <div class="fm-react-likes">
                    <form class="finder" method="get">
                        <input class="user_id" type="hidden" name="' . $post['user_id'] . '" value="' . $post['user_id'] . '">
                        <input class="post_id" type="hidden" name="' . $post['id'] . '" value="' . $post['id'] . '">
                            <button type="submit" class="likes react-same">
                            <h5 class="feed-like">' . $post['likes'] . '</h5>
                            <img style="display: ' . ($post['liked_by_user'] ? 'none' : 'block') . ';" class="react-f-img likes-f-img" src="../media/com-media/like.svg" alt="likes">
                            <img style="display: ' . ($post['liked_by_user'] ? 'block' : 'none') . ';" class="react-f-img2 likes-f-img2" src="../media/com-media/like-color.svg" alt="likes">
                            </button>
                    </form>

                <div class="feed-coin">
                    <form action="">
                        <input type="hidden" value="#">
                        <button class="f-coin-inf" type="submit"><img src="../media/com-media/coins.svg" alt="coins" width="25px">
                            <p class="don-coins-f">Give Coins</p>
                        </button>
                    </form>
                </div>
            </div>
            <h4 class="fm-c-txt">Comments ' . $post['comment_count'] . '</h4>
                    ';
        }
    }
    ?>
    <!-- section all c -->


    <div class="fm-comment-sec">
        <?php
        if (!empty($cmt_data)) {
            foreach ($cmt_data as $cmt) {
                $uploadedTime = $cmt['docs'];
                $uploadedDateTime = Carbon::parse($uploadedTime);
                $currentDateTime = Carbon::now();
                $interval = $currentDateTime->diff($uploadedDateTime);

                $yearDiff = $interval->y;
                $monthDiff = $interval->m;
                $dayDiff = $interval->d;
                $hourDiff = $interval->h;
                $minuteDiff = $interval->i;

                $timeAgo = '';

                if ($yearDiff > 0) {
                    $timeAgo = $yearDiff . 'Y';
                } elseif ($monthDiff > 0) {
                    $timeAgo = $monthDiff . 'M';
                } elseif ($dayDiff > 0) {
                    $timeAgo = $dayDiff . 'd';
                } elseif ($hourDiff > 0) {
                    $timeAgo = $hourDiff . 'h';
                } elseif ($minuteDiff > 0) {
                    $timeAgo = $minuteDiff . 'm';
                } else {
                    $timeAgo = 'now';
                }
                echo '
                    <div class="cmn-major">
                    <!-- actual -->
                    <div class="comment-act">
                        <div class="cmt-img-user">
                            <img class="cmt-act-img" src="../media/profiles/' . $cmt['profile'] . '">
        
                        </div>
        
                        <form class="cmt-dat cmt-dat-main">
                            <div class="dat-ct">
                                <input type="hidden" class="cmt-id cmt-id-main" name="cmt-id" value="'.$cmt['id'].'">
                                <input type="hidden" class="cmt_username" name="cmt_username" value="'.$cmt['username'].'">
                                <h5 class="dat-un">' . $cmt['cmt_by'] . '</h5>
                                <h5 class="time">'.$timeAgo.'</h5>
                                
                            </div>
                            <p class="cmt-txt">' . $cmt['comment'] . '</p>
                            <div class="cm-rep">
                                <p class="rep-all view-replies" style="display: ' . ($cmt['has_thread'] == 'yes' ? 'block' : 'none') . ';">View all replies</p>
                            </div>
                        </form>
        
                        <div class="cmt-react">
                            <img style="display: ' . ($cmt['liked_by'] ? 'none' : 'block') . ';" class="heart-f" src="../media/com-media/heart-f.svg" alt="Heart">
                            <img style="display: ' . ($cmt['liked_by'] ? 'block' : 'none') . ';" class="heart-t" src="../media/com-media/heart-t.svg" alt="Heart">
                            <p class="cl-counts">'. $cmt['likes'] .'</p>
                        </div>
                    </div>
        
                    <!-- reply -->
                    <div class="more-reps">
                        
                    </div>
                    <!-- reply -->
                </div>
                    ';
            }
        } else {
            echo '<h4 class="no-cmt">- No comments -</h4>';
        }
        ?>

        <div class="white-space">

        </div>
    </div>
    <!-- section all c -->
    </div>
    </div>

    <!-- ######## Footer ####### -->
    <footer>
        <div class="str-footer sf-1">
            <div class="comment-type">
                <form class="cmt-form">
                    <div class="cmt-txts">
                        <div>
                            <input class="alias-inp" type="hidden" value="" name="cmnt-alias">
                            <input class="status" type="hidden" name="cmt-status" value="">
                            <input class="fork" type="hidden" name="fork" value="">
                            <input class="reply-to" name="reply-to" type="hidden" value="">
                            <input class="replying-to" name="replying-to" type="hidden" value="">
                            <input class="thread-to" name="thread-to" type="hidden" value="">
                            <p class="cmt-inp cmnt-alias" contenteditable="true">
                            </p>
                        </div>

                        <input type="text" name="cmnt-main" class="cmt-inp cmnt-main cM-1" placeholder="'Write your comment'">
                    </div>
                    <div>
                        <button type="submit" class="cmt-btn">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </footer>
    <!-- ######## Footer ####### -->

    <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="../js/community/default.js"></script>
    <script src="../js/community/feed-main.js"></script>
</body>

</html>