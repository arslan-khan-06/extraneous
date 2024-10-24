<?php
require "db_con.php";
$sql = "SELECT * FROM user_accounts WHERE username = ? OR email = ?";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $_COOKIE['username'], $_COOKIE['username']);
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
    $profile_ret = $ret_dat['profile'];
    $setup_ret = $ret_dat['setup'];
    $membership_ret = $ret_dat['membership'];
    $dom_ret = $ret_dat['dom'];
    $bio_ret = $ret_dat['bio'];
    $age_ret = $ret_dat['age'];
}

$logged_in = true;
$_SESSION['logged_in'] = $logged_in;
$_SESSION['username'] = $user_ret;
$_SESSION['name'] = $name_ret;
$_SESSION['bio'] = $bio_ret;
$_SESSION['email'] = $email_ret;
$_SESSION['password'] = $pass_ret;
$_SESSION['profile'] = $profile_ret;
$_SESSION['setup'] = $setup_ret;
$_SESSION['membership'] = $membership_ret;
$_SESSION['dom'] = $dom_ret;
$_SESSION['coins'] = $coins_ret;
$_SESSION['age'] = $age_ret;
?>