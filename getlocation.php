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
$query = "SELECT random FROM signup WHERE username = '".$_SESSION['username']."'";
$result = mysqli_query($con,$query);

while($row = mysqli_fetch_assoc($result)) {
    print_r(" with UID: ");
    print_r($row["random"]);
}
echo "<a href='logout.php'> [logout]</a>";

$username = $_SESSION['username'];
$uid = $_REQUEST['uid'];
//Check if the uid already exist in database, if not return a meaningful message and direct user back to previous page.

$query = "SELECT location FROM signup WHERE random=$uid";
$uid_location = mysqli_query($con, $query);

if (!$query || mysqli_num_rows($query) == 0) {
    echo("The UID is not exist!");
} else {
    while ($row = mysqli_fetch_assoc($uid_location)) {
        print_r("Location is in: ");
        print_r($row["location"]);
    }
}
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