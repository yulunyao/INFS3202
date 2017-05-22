<?php
session_start();

$query = "SELECT random FROM signup WHERE username = '".$_SESSION['username']."'";
$address = $_GET["address"];
echo("$address");
include("connectMySQL.php");

$query = "UPDATE signup SET location='$address' WHERE username = '".$_SESSION['username']."'";
?>