<?php

session_start();

// ################ Database-connection #############

require 'db_con.php';

// ################ Database-connection #############


$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user_accounts WHERE username = ? OR email = ?";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username, $username);
$stmt->execute();

$res = $stmt->get_result();
$ret = mysqli_fetch_all($res, MYSQLI_ASSOC);

mysqli_free_result($res);

foreach ($ret as $ret_dat) {
    $user_ret = $ret_dat['username'];
    $pass_ret = $ret_dat['password'];
    $email_ret = $ret_dat['email'];
    $coins_ret = $ret_dat['coins'];
    $name_ret = $ret_dat['name'];
    $name_ret = $ret_dat['name'];
    $profile_ret = $ret_dat['profile'];
    $background_ret = $ret_dat['background'];
    $membership_ret = $ret_dat['membership'];
    $dom_ret = $ret_dat['dom'];
    $bio_ret = $ret_dat['bio'];
    $age_ret = $ret_dat['age'];
}

if (isset($user_ret) && isset($pass_ret)) {
    if ($username == $user_ret && $password == $pass_ret) {
        require 'cookie_val.php';
        $u_ret = setcookie('username', $username, time() + (10 * 365 * 24 * 60 * 60), '/');
        $p_ret = setcookie('password', $password, time() + (10 * 365 * 24 * 60 * 60), '/');


        header('Location: ../../community/home');
    } else if ($username == $email_ret && $password == $pass_ret) {
        require 'cookie_val.php';
        $u_ret = setcookie('username', $username, time() + (10 * 365 * 24 * 60 * 60), '/');
        $p_ret = setcookie('password', $password, time() + (10 * 365 * 24 * 60 * 60), '/');


        header('Location: ../../community/home');
    } else {
        $invalid_cred = 'Incorrect username or password!';
        $_SESSION['invalid_cred'] = $invalid_cred;
        header('Location: ../../sign-in/login');
    }
} else {
    $no_user = 'User not found';
    $_SESSION['no_user'] = $no_user;
    header('Location: ../../sign-in/login');
}
