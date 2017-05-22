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
echo "<a href='logout.php'> [logout]</a>";

$query = "SELECT location FROM signup WHERE username= '".$_SESSION['username']."'";
$result = mysqli_query($con, $query);
?>