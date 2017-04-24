<?php
include('connectMySQL.php'); //make sure the path is correct.

$username = 'Admin';
$password = 'gf45_gdf#4hg';

$db = new MySQLDatabase(); //create a Database object
$db->connect("root", "", "sik");

$query = "SELECT password FROM signup WHERE username = '$username'";
$result = mysqli_query($db->link,$query);
if(!$result){
    die(mysqli_error());
}
$hash = mysql_result($result, 0);

// Hashing the password with its hash as the salt returns the same hash
if ( hash_equals($hash, crypt($password, $hash)) ) {
  // Ok!
}


$db->disconnect(); //always disconnect when finished.
/**
 * Created by PhpStorm.
 * User: WHOAMI
 * Date: 4/23/2017
 * Time: 3:54 PM
 */
if($_REQUEST['username'] == "infs" && $_REQUEST["password"] == "3202") {
    header("Location: task.php");
}
else{
    header("Location: loginform.php");
}
?>