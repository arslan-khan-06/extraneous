<?php

session_start();

if (isset($_SESSION['signed_up']) || isset($_SESSION['changed_password'])) {
    if (isset($_SESSION['signed_up'])) {
        $signed_up_prep = true;
        $_SESSION['signed_up_prep'] = $signed_up_prep;
    } else if (isset($_SESSION['changed_password'])) {
        $changed_password_prep = true;
        $_SESSION['changed_password_prep'] = $changed_password_prep;
    }
} else {
    header('Location: ../../sign-in/login');
}

if (isset($_SESSION['key_su'])) {
    $key_su = $_SESSION['key_su'];
} elseif (isset($_SESSION['key_rs'])) {
    $key_rs = $_SESSION['key_rs'];
}

$code = $_GET['code'];

if (!isset($code)) {
    header('Location: ../../sign-in/verify');
} else if (strlen($code) > 4 || strlen($code) < 4) {
    $code_error = 'Invalid code!';
    $_SESSION['code_error'] = $code_error;
    header('Location: ../../sign-in/verify');
} else if (isset($key_su)) {
    if ($key_su != $code) {
        $code_error = 'Invalid code!';
        $_SESSION['code_error'] = $code_error;
        header('Location: ../../sign-in/verify');
    } else {
        $verified = true;
        $_SESSION['verified'] = $verified;
        header('Location: ../../sign-in/user');
    }
} elseif (isset($key_rs)) {
    if ($key_rs != $code) {
        $code_error = 'Invalid code!';
        $_SESSION['code_error'] = $code_error;
        header('Location: ../../sign-in/verify');
    } else {
        $verified_rs = true;
        $_SESSION['verified_rs'] = $verified_rs;
        header('Location: ../../sign-in/reset');
    }
} 

?>