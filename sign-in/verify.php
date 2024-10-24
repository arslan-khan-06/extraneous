<?php
session_start();

if (isset($_SESSION['signed_up']) || isset($_SESSION['changed_password'])) {
    if (isset($_SESSION['signed_up'])) {
        $signed_el = true;
    } else if (isset($_SESSION['changed_password'])) {
        $reset_el = true;
    }
} else {
    header('Location: ../sign-in/login');
}

if (isset($_SESSION['email_taken'])) {
    header('Location: sign-up');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify</title>
    <!-- styles -->
    <link rel="stylesheet" href="../styles/login.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <!-- icon -->
    <link rel="icon" href="../media/default/extraneous-logo-2-removed.png">
</head>

<body>
    <!-- loader -->
    <div id="load-id" class="load-strip">
        <div class="load-container">
            <div class="loaderRectangle">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- loader -->

    <div class="login-str-1">
        <div class="left-login-1">
            <div class="left-div-login-1">
                <div class="logo-div-1">
                    <img class="logo-login-1" src="../media/default/extraneous-logo-2-removed.png" alt="extraneous-logo-2-removed">
                    <h1 class="ex-logo-login-1">Extraneous</h1>
                </div>
                <div class="right-sub-1">
                    <a href="#"><img class="downloads" src="../media/login-f/downloads.svg" alt="downloads"></a>
                </div>
            </div>

            <!-- ###### -->

            <div class="login-str-2">
                <div class="login-form-1">
                    <div class="top-txt-1">
                        <h1>Verify</h1>
                        <p>Verification code sent on your email</p>
                        <p style="color: red;"><?php
                            if (isset($_SESSION['code_error'])) {
                                $code_error = $_SESSION['code_error'];
                                echo $code_error;
                                unset($_SESSION['code_error']);
                            }
                            ?></p>
                    </div>
                    <div class="form-div-1">
                        <form id="form-1" action="../modules/server-1/verify-server" method="get">
                            <label for="code">Verification code</label>

                            <input class="text-in-1" id="code" name="code" type="text" placeholder="4-digit code">

                            <button class="nvm btn-1" id="submit-1" type="submit">Verify</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ######## -->

            <div class="login-str-3">
                <div class="acc-ask-1">
                    <p>Already have an account?</p>
                    <a class="nvm sign-a-1" href="login">Login</a>
                </div>
            </div>
        </div>
        <div class="right-login-1">
            <div class="img-sl-1">

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="../js/sign-in/login.js"></script>
</body>

</html>

