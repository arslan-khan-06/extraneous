<?php

session_start();

// ################ Database-connection #############

$host = 'localhost';
$username_db = 'root';
$passowrd_db = '';
$db_name = 'extraneous';

$conn = mysqli_connect($host, $username_db, $passowrd_db, $db_name);

if (mysqli_connect_errno()) {
  die("Connection Failed!" . mysqli_connect_error());
}

// ################ Database-connection #############

$username = $_POST['username'];

$sql = "SELECT * FROM user_accounts WHERE email = ? OR username = ?";



$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username, $username);
$stmt->execute();

$res = $stmt->get_result();
$ret = mysqli_fetch_all($res, MYSQLI_ASSOC);


mysqli_free_result($res);

foreach ($ret as $ret_dat) {
    $name_ret = $ret_dat['name'];
    $un_ret = $ret_dat['username'];
    $email_ret = $ret_dat['email'];
    $pwd_ret = $ret_dat['password'];
}

if (!isset($email_ret)) {
    $not_found = "User not found!";
    $_SESSION['not_found'] = $not_found;
    header('Location: ../../sign-in/recovery');
    exit();
}

$changed_password = true;
$_SESSION['changed_password'] = $changed_password;

$key_rs = rand(1000, 9999);
$_SESSION['key_rs'] = $key_rs;


$_SESSION['name_ret'] = $name_ret;
$_SESSION['un_ret'] = $un_ret;
$_SESSION['email_ret'] = $email_ret;
$_SESSION['pwd_ret'] = $pwd_ret;
$_SESSION['recovery'] = true;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'official.extraneous@gmail.com';
    $mail->Password = 'vqazllrjfijwhkvv';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;


    $mail->setFrom('from@example.com', 'Extraneous');
    $mail->addAddress($email_ret);

    $mail->isHTML(true);
    $mail->Subject = 'Verification Code [' . $key_rs . ']';
    $mail->Body = 'Hi ' . $name_ret . '! Your verification code to reset password is: <b>' . $key_rs . '</b>. Please do not share it with anyone. This code is valid for 30 minutes.';
    $mail->AltBody = '';

    $mail->send();
} catch (Exception $e) {
    echo 'Something Went wrong!';
    exit();
}


header('Location: ../../sign-in/verify');

?>