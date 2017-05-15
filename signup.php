<?php
include('connectMySQL.php'); //make sure the path is correct.
$db = new MySQLDatabase(); //create a Database object
$db->connect("root", "", "sik");

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$cost = 5;

// Create a random salt
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

// Prefix information about the hash so PHP knows how to verify it later.
// "$2a$" means we're using the Blowfish algorithm. The following two digits are the cost parameter.
$salt = sprintf("$2a$%02d$", $cost) . $salt;

// Value:
// $2a$10$eImiTXuWVxfM37uY4JANjQ==

// Hash the password with the salt
$hash = crypt($password, $salt);


/*$key = md5('apple');
$salt = md5('apple');

function encrypt($string, $key){
    $string = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_ECB)));
    return $string;
}*/

$query = "INSERT INTO signup (username, password) VALUES ('$username', '$hash')";
$result = mysqli_query($db->link,$query);
if(!$result){
    die(mysqli_error());
}

$db->disconnect(); //always disconnect when finished.

header("Location: loginform.php");


?>