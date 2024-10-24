<?php
session_start();
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    require '../modules/server-1/db_con.php';
    require '../modules/server-2/cookie_val.php';
    require '../modules/server-2/ret-data.php';
} else {
    session_destroy();
    header('Location: ../sign-in/login');
}

require "../modules/server-2/pfp-load.php";
require "../modules/server-2/db_con.php";
require "../modules/server-2/ret-data.php";
require "../modules/server-2/pdo.php";

$stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
$stmt->bind_param('s', $user_ret);
$stmt->execute();
$user_b = $stmt->get_result();
$user = mysqli_fetch_all($user_b, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- icon -->
    <link rel="icon" href="../media/default/extraneous-logo-2-removed.png">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="../styles/com-styles/default1.css">
    <link rel="stylesheet" href="../styles/com-styles/home.css">
</head>

<body>
    <!-- ######## Header ####### -->
    <header>
        <div class="str-header">
            <div class="container-header-1">
                <div class="col-header-1">
                    <img class="logo-login-1" src="../media/default/extraneous-logo-2-removed.png" alt="Extraneous logo">
                    <h1 class="ex-logo-login-1">Extraneous</h1>
                </div>
                <div class="notification-div">
                    <img id="search" class="search-img" src="../media/com-media/search.svg" alt="search">
                    <img id="notifications" class="not-img" src="../media/com-media/notification.svg" alt="notifications">
                </div>
            </div>
            <div class="pinned-div-home">
                <div id="pin-1" class="pins pin-1">Announcements</div>

                <div id="pin-2" class="pins pin-2">Featured</div>

                <div id="pin-3" class="pins pin-3">Events</div>
            </div>
        </div>
    </header>
    <!-- ######## Header ####### -->

    <?php
    if (isset($setup_ret)) {
        if ($setup_ret != 'done') {
            echo '<div class="g-strt">
                <div class="start-dlg">
                    <h2>Finish setting up your profile</h1>
                        <p class="strt-des">
                            Last thing to do! Let your friends and others recognise you by setting up your profile.
                        </p>
                        <a href="edit-profile" style="text-decoration: none;">
                            <button class="start">Get Started</button>
                        </a>
                </div>
            </div>';
        }
    }
    date_default_timezone_set('UTC');
    if ($user) {
        foreach ($user as $user_ach) {
            $lastClaim = strtotime($user_ach['bonus']);

            $currentTime = time();

            $elapsedTime = $currentTime - $lastClaim;
            if ($elapsedTime >= 28800 + (24*60*60)) {
                echo '
                <div class="g-strt">
                <div class="start-dlg">
                    <h2>CLaim Bonus</h1>
                        <p class="strt-des">
                            Recieve 5 coins as your daily login reward.
                        </p>
                        <form action="../modules/server-2/daily-bonus" method="get">
                            <input type="hidden" name="claiming">
                            <button class="start">
                                <p style="width: unset;">Claim</p><img src="../media/com-media/coins.svg" style="width: 20px;" alt="coins">
                                <p style="width: unset;">5</p>
                            </button>
                        </form>
                </div>
            </div>
                ';
            }
        }
    }
    if (isset($_SESSION['claimed'])) {
        echo '<div class="claimed-div">
                <div class="start-dlg">
                    <h2>Recieved 5 coins</h1>
                        <p class="strt-des">
                            Login back tomorrow to claim your bonus!
                        </p>
                            <button class="start close-btn">
                                <p style="width: unset;">Close</p>
                            </button>
                        </form>
                </div>
            </div>';
    }

    ?>


    <div class="main-home-1">
        <div class="center-home-1">
            <div id="title-shop" class="event-link event-box-blue">
                <div class="event-container-blue">
                    <h3>Title Shop is here</h3>
                    <p>Get your own customised title...</p>
                </div>
            </div>

            <div id="discount" class="event-link event-box-red">
                <div class="event-container-red">
                    <h3>Premium Discount</h3>
                    <p>Get discount on memberships...</p>
                </div>
            </div>


            <div id="new-journey" class="event-link event-box-green">
                <div class="event-container-green">
                    <h3>A New Journey</h3>
                    <p>Read what's up here...</p>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>

    <!-- ######## Footer ####### -->
    <footer>
        <div class="str-footer">
            <div class="container-footer-1">
                <div id="home" class="active nav-bottom-div div-container-footer-1">
                    <img src="../media/com-media/home.svg" alt="home">
                </div>
                <div id="posts" class="nav-bottom-div div-container-footer-2">
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
    <script src="../js/community/home.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $(".g-strt").css('display', 'flex');
                $(".g-strt").css('opacity', '1');
                $(".g-strt").css('animation-play-state', 'running');
            }, 1000);
        })
    </script>
</body>

</html>