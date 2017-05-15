<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SiK</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div id="wrapper">
    <div class="logo"><img src="img/SiKd.png" alt="Logo" width="70px" height="32px"></div>
    <h6>Find Your Friends At Anytime</h6>
    <div id="home_container">
        <div class="loginform">
            <div class="login-wrap">
                <div class="login-html">
                    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign
                        In</label>
                    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign
                        Up</label>
                    <div class="login-form">
                        <form method="$_POST" action="login.php">
                            <div class="sign-in-htm">
                                <div class="group">
                                    <label for="user" class="label">Email</label>
                                    <input id="email" type="text" class="input" name="username">
                                </div>
                                <div class="group">
                                    <label for="pass" class="label">Password</label>
                                    <input id="pass" type="password" class="input" data-type="password" name="password">
                                </div>
                                <div class="group">
                                    <input id="check" type="checkbox" class="check" checked name="rem">
                                    <label for="check"><span class="icon"></span> Keep me Signed in</label>
                                </div>
                                <div class="group">
                                    <input type="submit" class="button" value="Sign In" name="login">
                                </div>
                                <div class="hr"></div>
                                <div class="foot-lnk">
                                    <a href="#forgot">Forgot Password?</a>
                                </div>
                            </div>
                        </form>
                        <div class="sign-up-htm">
                            <form method="$_POST" action="signup.php">
                                <div class="group">
                                    <label for="user" class="label">Email</label>
                                    <input id="user" type="text" class="input" name="username">
                                </div>
                                <div class="group">
                                    <label for="pass" class="label">Password</label>
                                    <input id="pass" type="password" class="input" data-type="password" name="password">
                                </div>
                                <div class="group">
                                    <label for="pass" class="label">Repeat Password</label>
                                    <input id="pass" type="password" class="input" data-type="password">
                                </div>
                                <!--<div class="group">
                                    <label for="pass" class="label">Email Address</label>
                                    <input id="pass" type="text" class="input">
                                </div>-->
                                <div class="group">
                                    <input type="submit" class="button" value="Sign Up">
                                </div>
                            </form>
                            <div class="hr"></div>
                            <div class="foot-lnk">
                                <label for="tab-1">Already Member?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        Designed By Team.
    </div>
</div>

<?php
include("connectMySQL.php");

if (isset($_COOKIE['username']) and isset($_COOKIE['password'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    echo " <script>
             document.getElementById('email').value = '$username';
             document.getElementById('pass').value = '$password';
    </script>";
}

$db = new MySQLDatabase(); //create a Database object
$db->connect("b622a8e03ec7ba", "6e32c3d6", "sik");

?>
</body>
</html>