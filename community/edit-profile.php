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

require "../modules/server-2/db_con.php";
require "../modules/server-2/ret-data.php";

require "../modules/server-2/pdo.php";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the image filename from the database
    $stmt = $pdo->prepare("SELECT profile FROM user_accounts WHERE username = ?");
    $stmt->execute([$user_ret]);
    $row = $stmt->fetch();
    if ($row) {
        $imageFilename = $row['profile'];
        // Specify the path of the image
        $imagePath = '../media/profiles/' . $imageFilename;
    }
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- icon -->
    <link rel="icon" href="../media/default/extraneous-logo-2-removed.png">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="../styles/com-styles/default1.css">
    <link rel="stylesheet" href="../styles/com-styles/edit-profile.css">
</head>

<body>
    <div class="edit-main">
        <div class="eidt-center">
            <?php
            if (isset($_SESSION['user_taken'])) {
                echo '<p class="error">' . $_SESSION['user_taken'] . '</p>';
            } elseif (isset($_SESSION['shortage'])) {
                echo '<p class="error">' . $_SESSION['shortage'] . '</p>';
            } elseif (isset($_SESSION['error_details'])) {
                echo '<p class="error">' . $_SESSION['error_details'] . '</p>';
            } 
            ?>
            <div class="add-pic">
                <div class="add-pic-1">
                    <?php
                    if (isset($imagePath)) {
                        if (!empty($imageFilename)) {
                            echo '<img class="pfp-ret-img" src="' . $imagePath . '" alt="" style="background-color: rgba(78, 28, 170, 0.226); border-radius: 50%;">';
                        }
                    }
                    ?>
                </div>

                <img src="../media/com-media/add-plus.svg" alt="add" class="add-plus">
                <p class="txt-1">Change Profile Picture</p>
            </div>

            <form class="edit-user" action="../modules/server-2/update-profile.php" method="post">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="e-txt-all name-txt" value="<?php
                                                                                            if (isset($name_ret)) {
                                                                                                echo $name_ret;
                                                                                            }
                                                                                            ?>">

                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="e-txt-all un-txt" value="<?php
                                                                                                    if (isset($user_ret)) {
                                                                                                        echo $user_ret;
                                                                                                    }
                                                                                                    ?>" placeholder="alpha-numeric(small), underscore, 25 characters">

                <label for="age">Age</label>
                <input type="number" id="age" name="age" class="e-txt-all age-txt" value="<?php
                                                                                            if (isset($age_ret)) {
                                                                                                if ($age_ret > 0) {
                                                                                                    echo $age_ret;
                                                                                                }
                                                                                            }
                                                                                            ?>">

                <label for="gen">Gender</label>
                <select name="gender" id="gen" class="e-txt-all gen-txt">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="none">Prefer not to say</option>
                </select>

                <label for="bio">Bio</label>
                <textarea class="e-txt-all bio-txt" name="bio" id="bio"><?php if (isset($bio_ret)){ echo $bio_ret;}?></textarea>
                <p class="words" style="text-align: right; font-size: 12px; font-weight: 700;">100</p>

                <button class="save-edit" type="submit">
                    <p class="save-txt">Save</p>
                    <?php
                    if (isset($setup_ret)) {
                        if ($setup_ret == 'done') {
                            echo '<img src="../media/com-media/coins.svg" alt="coins" class="save-coins">';
                            echo '<p class="e-cost">100</p>';
                        }
                    }
                    ?>
                </button>

                <a href="home" class="home-edit">Cancel</a>
            </form>
        </div>
    </div>

    <!-- ######## Footer ####### -->
    <footer>
        <?php
        if (isset($_SESSION['user_taken'])) {
            unset($_SESSION['user_taken']);
        }

        if (isset($_SESSION['shortage'])) {
            unset($_SESSION['shortage']);
        }

        if (isset($_SESSION['error_details'])) {
            unset($_SESSION['error_details']);
        }
        ?>
    </footer>
    <!-- ######## Footer ####### -->

    <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="../js/community/default.js"></script>
    <script src="../js/community/edit-profile.js"></script>
</body>

</html>