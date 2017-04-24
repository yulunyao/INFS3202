<?php
include('connectMySQL.php'); //make sure the path is correct.
$db = new MySQLDatabase(); //create a Database object
$db->connect("root", "", "sik");

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

/*$key = md5('apple');
$salt = md5('apple');

function encrypt($string, $key){
    $string = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_ECB)));
    return $string;
}*/

$query = "INSERT INTO signup (username, password) VALUES ('$username', '$password')";
$result = mysqli_query($db->link,$query);
if(!$result){
    die(mysqli_error());
}

$db->disconnect(); //always disconnect when finished.

?>