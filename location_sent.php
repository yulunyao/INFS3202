<?php
session_start();
include("connectMySQL.php");
$con = mysqli_connect('au-cdbr-azure-east-a.cloudapp.net:3306', "b622a8e03ec7ba", "6e32c3d6", "sik");
echo "The location from ". $_SESSION['username']." have been sent to server.";
echo "<a href='logout.php'> [logout]</a>";

$address = $_GET["address"];

$query = "UPDATE signup SET location='$address' WHERE username = '".$_SESSION['username']."'";
$result=mysqli_query($con, $query);

?>