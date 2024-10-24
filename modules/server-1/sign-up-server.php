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

if(isset($_POST['name'])) {
    $name = $_POST['name'];
    $_SESSION['name'] = $name;
  } else {
    $error_name = 'Invalid name!';
    $_SESSION['error_name'] = $error_name;
  }

  if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $_SESSION['email'] = $email;
  } else {
    $error_email = 'Invalid email!';
    $_SESSION['error_email'] = $error_email;
  }

  if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $_SESSION['password'] = $password;
  } else {
    $error_passowrd = 'Invalid password!';
    $_SESSION['error_passowrd'] = $error_passowrd;
  }


// ################ Database-Find #############
  
$check_email = "SELECT email FROM user_accounts";
$res = mysqli_query($conn, $check_email);

$email_burst = mysqli_fetch_all($res, MYSQLI_ASSOC);
mysqli_free_result($res);

foreach ($email_burst as $email_found) {
  if ($email == $email_found['email']) {
      $email_taken = 'Email is already taken';
      $_SESSION['email_taken'] = $email_taken;
      echo $email_taken;
      exit();
  } else {
    unset($_SESSION['email_taken']);
  }
}

// ################ Database-Find #############

  $signed_up = true;
  $_SESSION['signed_up'] = $signed_up;

  $key_su = rand(1000, 9999);
  $_SESSION['key_su'] = $key_su;



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
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Verification Code [' . $key_su . ']';
    $mail->Body = 'Hi ' . $name . '.  Your verification code is: <b>' . $key_su . '</b>. Please do not share it with anyone. This code is valid for 30 minutes.';
    $mail->AltBody = '';

    $mail->send();
} catch (Exception $e) {
    echo 'error';
}
