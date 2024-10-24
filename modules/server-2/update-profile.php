<?php
require "db_con.php";
require "cookie_val.php";
session_start();
$name = $_POST['name'];
$username = $_POST['username'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$bio = $_POST['bio'];

if (empty($username)) {
    header('Location: ../../community/edit-profile');
    exit();
}

if (!preg_match('/^[a-z0-9_]{1,25}$/', $username)) {
    $user_error = 'Username is not valid';
    $_SESSION['error_details'] = $user_error;
    header('Location: ../../community/edit-profile');
    exit();
}

$check_username = "SELECT username FROM user_accounts";
$res = mysqli_query($conn, $check_username);

$user_burst = mysqli_fetch_all($res, MYSQLI_ASSOC);
mysqli_free_result($res);

foreach ($user_burst as $user_found) {
    if ($username == $user_found['username'] && $username != $user_ret) {
        $username_taken = 'Username is already taken';
        $_SESSION['user_taken'] = $username_taken;
        header('Location: ../../community/edit-profile');
        exit();
    } else {
        // unset($_SESSION['user_taken']);
        if (isset($setup_ret)) {
            if ($setup_ret == 'done') {
                if ($coins_ret >= 100) {
                    $sql = "UPDATE user_accounts SET name = ?, username = ?, age = ?, gender = ?, bio = ?, setup = ?, coins = ? WHERE username = ?";
                    $done = 'done';
                    $coins = $coins_ret - 100;
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ssisssis', $name, $username, $age, $gender, $bio, $done, $coins, $user_ret);
                    $stmt->execute();
                    header('Location: ../../community/profile');
                } else {
                    $shortage = 'Not enough coins';
                    $_SESSION['shortage'] = $shortage;
                    header('Location: ../../community/edit-profile');
                }
            } else {
                $sql = "UPDATE user_accounts SET name = ?, username = ?, age = ?, gender = ?, bio = ?, setup = ? WHERE username = ?";
                $done = 'done';
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ssissss', $name, $username, $age, $gender, $bio, $done, $user_ret);
                $stmt->execute();
                header('Location: ../../community/profile');
            }
        }
    }
}
