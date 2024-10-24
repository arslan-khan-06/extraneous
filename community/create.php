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

require "../modules/server-2/pfp-load.php"
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <!-- icon -->
    <link rel="icon" href="../media/default/extraneous-logo-2-removed.png">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="../styles/com-styles/default1.css">
    <link rel="stylesheet" href="../styles/com-styles/create.css">
</head>

<body>
    <!-- ######## Header ####### -->
    <header>
        <div class="str-header">
            <div class="container-header-1">
                <div class="col-header-1">
                    <h1 class="ex-logo-login-1" style="font-style: italic;">What's in your mind?</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- ######## Header ####### -->

    <div class="create-main-1">
        <div class="create-section-1">
            <div class="form-create" style="margin-top: 10px;">
                <form action="../modules/server-3/create-module.php" method="post">
                    <Label><h2 class="title-tag">Title</h2></Label>
                    <input type="text" class="c-title" name="title" id="title-create">

                    <textarea name="tract" id="post-text"></textarea>
                    <div class="post-area">
                        <div class="word-count">
                            <p class="words"></p>
                        </div>
                        
                        <button class="post-btn" type="submit">Post</button>
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
                <div id="create" class="active nav-bottom-div div-container-footer-3">
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
    <script src="../js/community/create.js"></script>
</body>

</html>

