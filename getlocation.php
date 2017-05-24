<?php
/**
 * Created by PhpStorm.
 * User: WHOAMI
 * Date: 2017/5/22
 * Time: 18:55
 */
session_start();
include("connectMySQL.php");
$con = mysqli_connect('au-cdbr-azure-east-a.cloudapp.net:3306', "b622a8e03ec7ba", "6e32c3d6", "sik");
echo "Welcome " . $_SESSION['username'];
$query = "SELECT random FROM uid WHERE username = '".$_SESSION['username']."'";
$result = mysqli_query($con,$query);

/*Show Welcome information with current username and UID.*/
while($row = mysqli_fetch_assoc($result)) {
    print_r(" with UID: ");    //call uid by using $_SESSION['uid']
    print_r($row["random"]);
}
echo "<a href='logout.php'> [logout]</a>";
echo ("<p></p>");

$uid = $_SESSION['uid'];

$username = $_SESSION['username'];
echo("<p></p>");

/*Display the UID and the location correspond to that UID.*/

$query = "SELECT location FROM uid WHERE random= $uid";
$uid_location = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($uid_location)) {
    print_r("Location is in: ");
    print_r($row["location"]);
}

/*Show maps by searching the location name.*/


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SiK</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div class="logo"><img src="img/SiKd.png" alt="Logo" width="70px" height="32px"></div>
<h6>Find Your Friends At Anytime</h6>
</body>
</html>