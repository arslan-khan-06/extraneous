<?php
session_start();
$typed_log = true;
$_SESSION['typed_log'] = $typed_log;

if (isset($_SESSION['logged_in'])) {
    header('Location: ../community/home');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>login</title>
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
                    <a class="nvm" href="#" title="Download"><img class="downloads" src="../media/login-f/downloads.svg" alt="downloads"></a>
                </div>
            </div>

            <!-- ###### -->

            <div class="login-str-2">
                <div class="login-form-1">
                    <div class="top-txt-1">
                        <h1>Login</h1>
                        <p>One step away to explore</p>
                        <p style="color: red;">
                            <?php
                            if (isset($_SESSION['invalid_cred'])) {
                                $invalid_cred = $_SESSION['invalid_cred'];
                                echo $invalid_cred;
                            } else if (isset($_SESSION['no_user'])) {
                                $no_user = $_SESSION['no_user'];
                                echo $no_user;
                            }
                            ?>
                        </p>
                    </div>
                    <div class="form-div-1">
                        <form action="../modules/server-1/login-server" method="post">
                            <label for="username-1">Username or Email</label>

                            <input class="text-in-1" id="username-1" type="text" name="username" placeholder="example@gmail.com">

                            <label for="password-1">Password</label>

                            <input class="text-in-1" name="password" id="password-1" type="password" placeholder="Atleast 6 characters">

                            <div class="c-anc">
                                <div class="checkbox-1">
                                    <label class="cont">
                                        <input type="checkbox" checked="">
                                        <span></span>
                                    </label>
                                    <p>Remember me</p>
                                </div>

                                <div class="forgot-1">
                                    <a class="nvm forgot-class-1" id="forgot-id-1" href="recovery">Forgot password</a>
                                </div>
                            </div>

                            <button class="nvm btn-1" id="submit-1" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ######## -->

            <div class="login-str-3">
                <div class="acc-ask-1">
                    <p>Don't have an account?</p>
                    <a class="nvm sign-a-1" href="sign-up">Sign Up</a>
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

<?php

unset($_SESSION['invalid_cred']);
unset($_SESSION['no_user']);

?>