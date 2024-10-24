<?php
session_start();
if (isset($_SESSION['verified']) && isset($_SESSION['signed_up_prep'])) {
    $logged_in = true;
} else {
    header('Location: login');
    exit();
}

$username = $_GET['username'];

$name = $_SESSION['name'];

$email = $_SESSION['email'];

$password = $_SESSION['password'];

$coins = 100;

$host = 'localhost';
$username_db = 'root';
$passowrd_db = '';
$db_name = 'extraneous';

$conn = mysqli_connect($host, $username_db, $passowrd_db, $db_name);

if (mysqli_connect_errno()) {
    die("Connection Failed!" . mysqli_connect_error());
}

if (!preg_match('/^[a-z0-9_]{1,25}$/', $username)) {
    $invalid_un = 'Invalid Username';
    $_SESSION['invalid_un'] = $invalid_un;
    header('Location: ../../sign-in/user');
    exit();
}

// ################ Database-Find #############
  
$check_username = "SELECT username FROM user_accounts";
$res = mysqli_query($conn, $check_username);

$username_burst = mysqli_fetch_all($res, MYSQLI_ASSOC);
mysqli_free_result($res);

foreach ($username_burst as $username_found) {
  if ($username == $username_found['username']) {
      $username_taken = 'Username is already taken';
      $_SESSION['username_taken'] = $username_taken;
      header('Location: ../../sign-in/user');
      exit();
  } else {
    unset($_SESSION['username_taken']);
  }
}

// ################ Database-Find #############

$sql = "INSERT INTO user_accounts (username, name, email, password, coins) 
VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt, "ssssi",
    $username,
    $name,
    $email,
    $password,
    $coins
);

mysqli_stmt_execute($stmt);
$_SESSION['logged_in'] = $logged_in;

if (isset($_SESSION['logged_in'])) {
    header('Location: ../../community/home');
} else {
    echo 'something went wrong!';
}

?>