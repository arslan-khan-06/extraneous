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
    header('Location: home');
}

require "../modules/server-2/pfp-load.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chats</title>
    <!-- icon -->
    <link rel="icon" href="../media/default/extraneous-logo-2-removed.png">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="../styles/com-styles/default1.css">
    <link rel="stylesheet" href="../styles/com-styles/chats.css">
</head>

<body>
    <!-- ######## Header ####### -->
    <header>
        <div class="str-header">
            <div class="container-header-1">
                <div class="col-header-1">
                    <h3 style="color: #6831D2;">Chats & Chatrooms</h3>
                </div>
                <div class="notification-div">
                    <img id="search" class="search-img" src="../media/com-media/search.svg" alt="search">
                    <div class="create-cr">
                        <p>create +</p>
                    </div>
                    <!-- <img id="notifications" class="not-img" src="../media/com-media/notification.svg" alt="notifications"> -->
                </div>
            </div>
        </div>
    </header>
    <!-- ######## Header ####### -->

    <div class="chats-main">
        <div class="chats-center-div">
            <div class="chats c-each-1">
                <div class="chat-icon"
                    style="background: url(../media/com-media/journey.jpg); background-position: center;  background-size: cover;">

                </div>
                <form class="chat-det" action="">
                    <h5>Roman</h5>
                    <input class="c-username" type="text" readonly value="roman_123">
                    <div class="message-info">
                        <h4>new message</h4>
                        <div class="message-dot"></div>
                    </div>
                </form>
            </div>

            <div class="chats c-each-2">
                <div class="chat-icon"
                    style="background: url(../media/com-media/shop-open.jpg); background-position: center;  background-size: cover;">

                </div>
                <form class="chat-det" action="">
                    <h5>Sakura</h5>
                    <input class="c-username" type="text" readonly value="roman_123">
                    <div class="message-info">
                        <h4>new message</h4>
                        <div class="message-dot"></div>
                    </div>
                </form>
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
                <div id="chat" class="active nav-bottom-div div-container-footer-4">
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
    <script src="../js/community/chats.js"></script>

</body>

</html>