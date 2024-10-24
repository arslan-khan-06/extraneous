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
    header('Location: home');
}

require '../modules/server-2/pfp-load.php';
?> -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <!-- icon -->
    <link rel="icon" href="../media/default/extraneous-logo-2-removed.png">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="../styles/com-styles/default1.css">
    <link rel="stylesheet" href="../styles/com-styles/user.css">
</head>

<body>
    <!-- ######## Header ####### -->


    <!-- ######## Header ####### -->
    <div class="main-profile-1">
        <div id="center-div" class="center-profile-1">
            <div class="profile-section">
                <!-- ##### settings #### -->
                <div class="settings-corner">
                    <div class="settings">
                        <div class="settings-img">

                        </div>
                    </div>
                </div>

                <!-- ##### settings #### -->

                <!-- ###### -->
                <!-- ###### -->
                <!-- ###### -->
                <!-- ###### -->

                <!-- ##### profile #### -->

                <div class="profile-pic">
                    <div class="pfp-container">
                        <?php
                        if (isset($imagePath)) {
                            if (!empty($imageFilename)) {
                                echo '<img class="pfp-ret-img" src="' . $imagePath . '" alt="User Profile Image">';
                            }
                        }
                        ?>
                    </div>

                    <div class="frame"></div>
                </div>

                <!-- ##### profile #### -->

                <!-- ###### -->
                <!-- ###### -->
                <!-- ###### -->
                <!-- ###### -->

                <!-- ##### name #### -->

                <div class="desc-pfp">
                    <div class="row-1-desc">
                        <h3 class="pfp-name">SOS</h3>
                        <!-- <div class="verified"></div> -->
                        <div class="premium-e"></div>
                    </div>

                    <!-- ##### name #### -->

                    <!-- ###### -->
                    <!-- ###### -->
                    <!-- ###### -->
                    <!-- ###### -->

                    <!-- ##### username #### -->

                    <div class="row-2-desc">
                        <h5 class="pfp-username">@Shroud_Of_Secrecy</h5>
                    </div>

                    <!-- ##### username #### -->

                    <!-- ##### title #### -->

                    <div class="row-2-desc">
                        <div class="tile-main">
                            <h5 style="font-weight: 900; color: white; text-align: center;">Dandelions</h5>
                        </div>
                    </div>

                    <!-- ##### title #### -->

                    <!-- ##### edit #### -->

                    <div class="row-3-desc">
                        <div class="f-m">
                            <button class="edit-pfp-btn">Follow</button>
                            <button class="edit-pfp-btn2" disabled>Message</button>
                        </div>
                    </div>

                    <!-- ##### edit #### -->

                </div>

                <!-- bio -->
                <div class="bio-div">
                    <div class="bio">
                        <p>
                            I live out a day
                            <br>
                            Likes: Chocolate
                            <br>
                            Dislikes: Nothing
                            <br>
                            <br>
                            Today is just another reason to live.
                        </p>
                    </div>
                </div>

                <div class="bottom-1">
                    <div class="aria-followers">
                        <div class="follow followers">
                            <h4>Followers</h4>
                            <h5>1500</h5>
                        </div>

                        <div class="horizontal"></div>

                        <div class="follow following">
                            <h4>Following</h4>
                            <h5>1200</h5>
                        </div>

                        <div class="horizontal"></div>

                        <div class="follow reputation">
                            <h4>Reputation</h4>
                            <h5>1200</h5>
                        </div>
                    </div>
                </div>
            </div>


            <!-- gossips -->
            <div class="gossip-div">
                <h4 class="activity" style="text-align: center; padding: 10px 0px;">Activities & Posts</h4>

                <!-- <div class="gossip">
                    <h4>Lost Here</h4>
                    <p>Absurd Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. </p>
                    <div class="react-div">
                        <div class="react like">
                            <h6>1775</h6>
                            <img class="react-img" src="../media/com-media/like.svg" alt="like">
                        </div>

                        <div class="react comment">
                            <h6>30</h6>
                            <img class="react-img" src="../media/com-media/comments.svg" alt="comments">
                        </div>
                    </div>
                </div> -->


                <div class="hidden">
                    <img class="hidden-img" src="../media/com-media/hidden.svg" alt="hidden">
                    <h3>Activity hidden</h3>
                    <p style="font-weight: 700;">Follow to see this users activity</p>
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
    <script src="../js/community/profile.js"></script>
</body>

</html>