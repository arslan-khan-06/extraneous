<!-- <?php
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
        ?> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <!-- icon -->
    <link rel="icon" href="../media/default/extraneous-logo-2-removed.png">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="../styles/com-styles/default1.css">
    <link rel="stylesheet" href="../styles/com-styles/notification.css">
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
        </div>
    </header>
    <!-- ######## Header ####### -->

    <!-- ######## Body ####### -->
    <div class="not-main">
        <div class="not-center">

            <div class="not-by-div unread">
                <div class="img-container-not">
                    <div class="not-pfp-div" style="background: url(../media/com-media/journey.jpg); background-size: cover;">
                        <!-- <img class="notification-img" src="../media/com-media/profile-demo.jpg" alt="profile"> -->
                    </div>
                </div>


                <div class="not-section">
                    <div class="notis-data">
                        <div class="user-noti">
                            <p class="notis-name">Team Extraneous</p>
                            <img class="verified" src="../media/com-media/verified.svg" alt="verified">
                        </div>
                        <div class="notis-time">
                            <p class="time-stamp">9 hours ago</p>
                        </div>
                    </div>

                    <div class="noti-txt">
                        <p class="src-noti">A warm welcome to our community. Before you start we would like to give you a quick guide so that you will experience an easy result. A warm welcome to our community. Before you start we would like to give you a quick guide so that you will experience an easy result. A warm welcome to our community. Before you start we would like to give you a quick guide so that you will experience an easy result.</p>
                    </div>
                </div>
            </div>

            <div class="not-by-div">
                <div class="not-pfp-div" style="background: url(../media/com-media/profile-demo.jpg); background-size: cover;">
                    <!-- <img class="notification-img" src="../media/com-media/profile-demo.jpg" alt="profile"> -->
                </div>

                <div class="not-section">
                    <div class="notis-data">
                        <div class="user-noti">
                            <p class="notis-name">Arslan Khan</p>
                            <!-- badge -->
                        </div>
                        <div class="notis-time">
                            <p class="time-stamp">9 hours ago</p>
                        </div>
                    </div>

                    <div class="noti-txt">
                        <p class="src-noti">Has liked your post.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ######## Body ####### -->

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