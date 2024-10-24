<?php

session_start();
if (isset($_COOKIE['logged'])) {
    header('Location: ../community/home');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
                        <h1>Sign Up</h1>
                        <p>One step away to explore</p>
                        <p style="color: red;"><?php
                                                if (isset($_SESSION['email_taken'])) {
                                                    $email_taken = $_SESSION['email_taken'];
                                                    echo $email_taken;
                                                }
                                                ?></p>
                    </div>
                    <div class="form-div-1">
                        <form id="form-1">
                            <label for="name-1">Name</label>

                            <input class="text-in-1" id="name-1" name="name" type="text" placeholder="Your name">

                            <label for="email-1">Email</label>

                            <input class="text-in-1" id="email-1" name="email" type="email" placeholder="example@gmail.com">

                            <label for="password-1">Password</label>

                            <input class="text-in-1" id="password-1" name="password" type="password" placeholder="Atleast 6 characters">

                            <label for="password-2">Confirm Password</label>

                            <input class="text-in-1" id="password-2" type="password" placeholder="Atleast 6 characters">

                            <button class="nvm btn-1" id="submit-1" type="submit">Sign Up</button>
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
    <script src="../js/sign-in/sign-up.js"></script>
</body>

</html>

<?php
unset($_SESSION['email_taken']);
?>