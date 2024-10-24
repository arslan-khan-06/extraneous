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
require '../modules/server-2/pfp-load.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- icon -->
    <link rel="icon" href="../media/default/extraneous-logo-2-removed.png">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="../styles/com-styles/default1.css">
    <link rel="stylesheet" href="../styles/com-styles/profile.css">

    <style>
        .royalty {
            width: 95%;
            height: 100px;
            background-image: <?php
                                if ($membership_ret == 'active') {
                                    echo 'background-image: linear-gradient(145deg, #353535 0%, #7c7c7c 74%)';
                                } else {
                                    echo 'linear-gradient(145deg, #181818 0%, #6d6d6d 74%)';
                                }
                                ?>;
            margin: 15px 0;
            border-radius: 5px;
            color: white;
            display: flex;
            flex-direction: row;
        }

        .membership-act {
            padding: 3px 10px;
            background-color: <?php
                                if ($membership_ret == 'active') {
                                    echo 'rgb(149, 37, 2)';
                                } else {
                                    echo 'rgb(63, 61, 60)';
                                }
                                ?>;
            border-radius: 15px;
        }
    </style>
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
                        <h3 class="pfp-name">
                            <?php echo $name_ret ?>
                        </h3>
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
                        <h5 class="pfp-username">
                            <?php echo $user_ret ?>
                        </h5>
                    </div>

                    <!-- ##### username #### -->




                    <!-- ##### title #### -->

                    <div class="row-2-desc">
                        <div class="tile-main">
                            <h5 style="font-weight: 900; color: white; text-align: center;">Dandelions</h5>
                        </div>
                    </div>

                    <!-- ##### title #### -->


                    <!-- ###### -->
                    <!-- ###### -->
                    <!-- ###### -->
                    <!-- ###### -->

                    <!-- ##### edit #### -->

                    <div class="row-3-desc">
                        <button class="edit-pfp-btn">Edit <img class="edit-pen" src="../media/com-media/edit-pen.svg" alt="edit"></button>
                    </div>

                </div>

                <!-- off -->
                <div class="overlay"></div>

                <!-- off -->

                <!-- bio -->
                <div class="bio-div">
                    <div class="bio">
                        <p class="white-bio">
                            <?php
                            echo $bio_ret;
                            ?>
                        </p>
                    </div>
                </div>

                <div class="bottom-1">
                    <div class="aria-followers">
                        <div class="follow followers">
                            <h4>Followers</h4>
                            <h5><?php if (isset($_SESSION['followers']) &&  isset($_SESSION['following'])) {
                                    echo $_SESSION['followers'];
                                } ?></h5>
                        </div>

                        <div class="horizontal"></div>

                        <div class="follow following">
                            <h4>Following</h4>
                            <h5><?php if (isset($_SESSION['followers']) &&  isset($_SESSION['following'])) {
                                    echo $_SESSION['following'];
                                } ?></h5>
                        </div>

                        <div class="horizontal"></div>

                        <div class="follow reputation">
                            <h4>Posts</h4>
                            <h5>0</h5>
                        </div>
                    </div>
                </div>
            </div>


            <!-- royalty -->
            <div class="royalty-div">
                <div class="royalty">
                    <div class="popularity royalty-half-div">
                        <h4>Coins</h4>
                        <div class="cih">
                            <h6>
                                <?php
                                if ($coins_ret < 1) {
                                    echo '0';
                                } else {
                                    echo $coins_ret;
                                }
                                ?>
                            </h6>
                            <img src="../media/com-media/coins.svg" alt="coins">
                            <h4>+</h4>
                        </div>

                    </div>

                    <div class="membership royalty-half-div">
                        <h4>Membership</h4>
                        <div class="membership-act">
                            <h5>
                                <?php
                                if ($membership_ret == 'active') {
                                    echo 'Active';
                                } else {
                                    echo 'Inactive';
                                }
                                ?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- gossips -->
            <div class="gossip-div">
                <h4 class="activity" style="text-align: center; padding: 10px 0px;">Activities & Posts</h4>

                <div class="gossip">
                    <h4>Lost Here</h4>
                    <p>Absurd Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
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
                </div>


                <!-- <h5>No gossips yet !
                    <br>
                    Create one
                </h5> -->
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
                <div id="profile" class="active nav-bottom-div div-container-footer-5">
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