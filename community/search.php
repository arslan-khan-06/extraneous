<?php
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

require "../modules/server-2/pfp-load.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <!-- icon -->
    <link rel="icon" href="../media/default/extraneous-logo-2-removed.png">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="../styles/com-styles/default1.css">
    <link rel="stylesheet" href="../styles/com-styles/search.css">
</head>

<body>
    <!-- ######## Header ####### -->
    <header>
        <div class="str-header">
            <form class="container-header-1">
                    <div class="col-header-1">
                        <input type="text" class="srch-inp" placeholder="Search Users">
                    </div>
                    <button type="submit" class="notification-div srch-btn">
                        <img id="search" class="search-img" src="../media/com-media/srch-2.svg" alt="search">
                        <!-- <img id="notifications" class="not-img" src="../media/com-media/notification.svg" alt="notifications"> -->
                    </button>
                </form>
        </div>
    </header>
    <!-- ######## Header ####### -->

    <div class="srch-main">
        <div class="srch-center">
            <div class="srch-nav">
                <div class="users-srch-div s-nav-all s-n-active">
                    <h5>Users</h5>
                </div>

                <div class="posts-srch-div s-nav-all">
                    <h5>#tags</h5>
                </div>
            </div>

            <div class="s-user-info">
                <h5>No users found</h5>
            </div>

            <div class="s-user-details">
                <div class="s-pfp" style="background: url(../media/com-media/journey.jpg); background-size: cover;">

                </div>

                <div class="s-pfname">
                    <h4>Roman</h4>
                    <h5>roman_123</h5>
                </div>
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
</body>

</html>