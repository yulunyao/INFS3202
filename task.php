<?php
    session_start();
    echo "Welcome " . $_SESSION['username'];
    echo "<a href='logout.php'> logout</a>";
?>

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

    <div class="mainArea">
        <div style="width: 100%;">
            <div style="float:left;">
                <img src="img/blue.png"></img>
                <h2><a href="home.php"> Find Friends</a></h2>
            </div>
            <div style="float:right;">
                <img src="img/red.png"></img>
                <h2><a href="location.php"> Send Your Location</a></h2>
            </div>
        </div>
        <div style="clear:both"></div>
    </div>

    <div id="footer">
        Designed By Team.
    </div>
</div>
</body>
</html>