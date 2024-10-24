<?php
session_start();

if (!isset($_POST['password'])) {
    header('Location: ../../sign-in/login');
}

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

if (isset($_POST['password']) && isset($_POST['password'])) {
    $username = $_SESSION['un_ret'];
    $name = $_SESSION['name_ret'];
    $password = $_POST['password'];
    $email = $_SESSION['email_ret'];
    $pass = $_POST['pass-2'];
} else {
    $_SESSION['invalid_pwd_cred'] = "Invalid input!"; 
    header('Location: ../../sign-in/reset');
    exit();
}

if ($username) {
    # code...
}

$sql = "UPDATE user_accounts SET password = ? WHERE username = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $password, $username);
$stmt->execute();

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
    $mail->Subject = 'Password Changed';
    $mail->Body = 'Hi ' . $name . '! Your password has been changed successfully. You can now login back with your new password. Enjoy your stay.';
    $mail->AltBody = '';

    $mail->send();
} catch (Exception $e) {
    echo 'Something Went wrong!';
    exit();
}
header('Location: ../../sign-in/login');

session_destroy();

?>
