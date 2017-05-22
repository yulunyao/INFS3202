<?php
    session_start();
    $con = mysqli_connect('au-cdbr-azure-east-a.cloudapp.net:3306', "b622a8e03ec7ba", "6e32c3d6", "sik");
    echo "Welcome " . $_SESSION['username'];
    $query = "SELECT random FROM signup WHERE username = '".$_SESSION['username']."'";
    $result = mysqli_query($con,$query);

    while($row = mysqli_fetch_assoc($result)) {
        print_r(" with UID: ");
        print_r($row["random"]);
    }
    echo "<a href='logout.php'> [logout]</a>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SiK</title>
    <link rel="stylesheet" type="text/css" href="css/styleTask.css">
</head>

<body>

<div id="wrapper">
    <div class="logo"><img src="img/SiKd.png" alt="Logo" width="70px" height="32px"></div>
    <h6>Find Your Friends At Anytime</h6>

    <div class="mainArea">
        <div style="width: 100%;">
            <div style="float:left;">
                <img src="img/red.png"></img>
                <h2><a href="send_uid.php"> Find Friends</a></h2>
            </div>
            <div style="float:right;">
                <img src="img/blue.png"></img>
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