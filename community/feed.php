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

require "../modules/server-3/feed-req.php";
require "../modules/server-2/pfp-load.php";
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
    <link rel="stylesheet" href="../styles/com-styles/feed.css">
</head>

<body>

    <!-- #####  confirmation  ##### -->

    <div class="cnfrm-container">
        <div class="cnfrm-box">
            <div class="cnfrm-true box-align">
                <h2 style="margin-bottom: 5px;">Delete post</h2>
                <p style="margin-bottom: 15px; text-align: center;">Do you want to delete your post?<br>This feed will be permanently deleted.</p>
                <div class="cnfrm-btn-div">
                    <p class="cnfrm-btn cnfrm-cancel">Cancel</p>
                    <button class="cnfrm-btn cnfrm-delete" type="submit"><p class="del-text">Delete</p> <div class="loader"></div> </button>
                </div>
            </div>

            <div class="del-true-box box-align">
                <h2 style="color: #6732d2; margin-bottom: 5px;">Success</h2>
                <p style="margin-bottom: 15px; text-align: center;">Your post has been removed!</p>
                <p class="cnfrm-btn dismiss-btn">Dismiss</p>
            </div>
            

            <div class="rep-true box-align">
                <h3 style="margin-bottom: 5px;">Report this post</h3>
                <textarea class="rep-msg" style="margin-bottom: 15px;" placeholder="Tell us what's wrong..."></textarea>
                <div class="cnfrm-btn-div">
                    <p class="cnfrm-btn cnfrm-cancel">Cancel</p>
                    <button class="cnfrm-btn cnfrm-rep" type="submit"><p class="del-text-2">Submit</p> <div class="loader loader-2"></div> </button>
                </div>
            </div>

            <div class="rep-true-box box-align">
                <h2 style="color: #6732d2; margin-bottom: 5px;">Success</h2>
                <p style="margin-bottom: 15px; text-align: center;">Thank you for submitting your query!</p>
                <p class="cnfrm-btn dismiss-btn">Dismiss</p>
            </div>

        </div>


    </div>

    <!-- #####  confirmation  ##### -->

    <!-- ######## Header ####### -->
    <header>
        <div class="str-header">
            <div class="container-header-1">
                <div class="col-header-1">
                    <h1 class="ex-logo-login-1">Feed</h1>
                </div>
                <div class="notification-div">
                    <img id="search" class="search-img" src="../media/com-media/search.svg" alt="search">
                </div>
            </div>

            <div class="feed-nav">
                <div class="f-nav-contain">
                    <div class="f-nav-bars feed-nav-main">
                        <form class="f-nav-all" action="">
                            <p>Featured</p>
                            <input type="hidden" value="featured" readonly>
                        </form>
                    </div>

                    <div class="f-nav-bars">
                        <form class="f-nav-all" action="">
                            <p>Latest</p>
                            <input type="hidden" value="latest" readonly>
                        </form>
                    </div>

                    <div class="f-nav-bars">
                        <form class="f-nav-all" action="">
                            <p>Following</p>
                            <input type="hidden" value="following" readonly>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ######## Header ####### -->

    <div class="overlay-f">

    </div>

    <div class="feed-main">
        <div class="feed-center">

            <?php
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
                <div class="feed-box">
                    <div class="feed-header">
                        <div class="feed-pfp">
                        <img class="feed-profile" src="../media/profiles/' . $post['profile'] . '" alt="profiles">
    
                            <form class="feed-user" method="get">
                                <input type="text" class="uname-inp" readonly value="' . $post['username'] . '">
                                <p class="feed-time">' . $timeAgo . '</p>
                            </form>
                        </div>
    
                        <div class="feed-action">
                            <img class="feed-action-i" src="../media/com-media/more.svg" alt="more" width="20px">
                            <div class="f-more-box">
                                <div class="report-f">
                                    <h4 class="toggle-cnfrm toggle-cnfrm-rep">Report</h4>
                                </div>
                                
                                <div>
                                    <h4 style="display: ' . ($post['username'] === $session_username ? 'block' : 'none') . ';" class="toggle-cnfrm toggle-cnfrm-del">Delete</h4>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="feed-data">
                        <form class="feed-form" method="GET" action="../modules/server-3/feed-main-req.php">
                         <input class="req_post" type="hidden" name="req_post" value="' . $post['id'] . '">
                        </form>
                        <input type="text" class="f-data-title" value="' . $post['title'] . '" readonly>
    
                        <p class="feed-text">' . $post['tract'] . '</p>
                    </div>
    
                    <div class="feed-btm">
                        <div class="feed-react">
                            <div class="react-comb">
                                <form class="finder" method="get">
                                    <input class="user_id" type="hidden" name="' . $post['user_id'] . '" value="' . $post['user_id'] . '">
                                    <input class="post_id" type="hidden" name="' . $post['id'] . '" value="' . $post['id'] . '">
                                    <button type="submit" class="likes react-same">
                                        <h5 class="feed-like">' . $post['likes'] . '</h5>
                                        <img style="display: ' . ($post['liked_by_user'] ? 'none' : 'block') . ';" class="react-f-img likes-f-img" src="../media/com-media/like.svg" alt="likes">
                                        <img style="display: ' . ($post['liked_by_user'] ? 'block' : 'none') . ';" class="react-f-img2 likes-f-img2" src="../media/com-media/like-color.svg" alt="likes">
                                    </button>
                                </form>
                                <div class="comment react-same">
                                    <h5>' . $post['comment_count'] . '</h5>
                                    <img class="react-f-img cmt-img" src="../media/com-media/comments.svg" alt="comments">
                                </div>
                            </div>
                        </div>

                        <div class="feed-coin">
                            <form method="get">
                                <input type="hidden" value="#">
                                <button class="f-coin-inf" type="submit"><img src="../media/com-media/coins.svg" alt="coins" width="25px">
                                    <p class="don-coins-f">Cheer up</p>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                    ';
            }
            ?>

            <div style="margin-top: 100px;">

            </div>
        </div>
    </div>




    <!-- ######## Footer ####### -->
    <footer>
        <div class="str-footer">
            <div class="container-footer-1">
                <div id="home" class="nav-bottom-div div-container-footer-1">
                    <img src="../media/com-media/home.svg" alt="home">
                </div>
                <div id="posts" class="active nav-bottom-div div-container-footer-2">
                    <img class="post-img" src="../media/com-media/post.svg" alt="posts">
                </div>
                <div id="create" class="nav-bottom-div div-container-footer-3">
                    <img src="../media/com-media/create.svg" alt="create">
                </div>
                <div id="chat" class="nav-bottom-div div-container-footer-4">
                    <img src="../media/com-media/chat.svg" alt="chat">
                </div>
                <div id="profile" class="nav-bottom-div div-container-footer-5">
                    <div class="pfp-container">
                        <?php
                        if (isset($imagePath)) {
                            if (!empty($imageFilename)) {
                                echo '<img class="pfp-ret-img" src="' . $imagePath . '" alt="User Profile Image">';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ######## Footer ####### -->

    <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="../js/community/default.js"></script>
    <script src="../js/community/feed.js"></script>
    <script src="../js/community/confirm.js"></script>
</body>

</html>