<?php
$alert_message_1 = "The username or password is too short";
$alert_message_2 = "The user already exist, please create a different username";
include('connectMySQL.php'); //make sure the path is correct.
$db = new MySQLDatabase(); //create a Database object
$db->connect("root", "", "sik");


$username = $_REQUEST['username'];


//Added hashing for password

+$cost = 5;
 +
 +// Create a random salt
 +$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
 +
 +// Prefix information about the hash so PHP knows how to verify it later.
 +// "$2a$" means we're using the Blowfish algorithm. The following two digits are the cost parameter.
 +$salt = sprintf("$2a$%02d$", $cost) . $salt;
 +
 +// Value:
 +// $2a$10$eImiTXuWVxfM37uY4JANjQ==
 +
 +// Hash the password with the salt
 +$password = crypt($$_REQUEST['password'], $salt);

$query_ck = mysqli_query($db->link, "SELECT username FROM signup WHERE username = '$username'");

if((strlen($username) < 3) AND (strlen($password) < 5)) {
/*    $query = "INSERT INTO signup (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($db->link, $query);

    if (!$result) {
        die(mysqli_error());
    }*/
    echo"<script type='text/javascript'>alert('$alert_message_1')</script>";
    header("Refresh: 0; url=loginform.php"); //refresh page after alert msg.

} elseif (mysqli_num_rows($query_ck) != 0) {

    echo"<script type= 'text/javascript'>alert('$alert_message_2')</script>";
    header("Refresh: 0; url=loginform.php"); //refresh page after alert msg.

} else {
    $query = "INSERT INTO signup (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($db->link, $query);

    $value = rand(10000000,99999999); // generate 8-digit random number
    $query = "INSERT INTO signup (username, password, random) VALUES ('$username', '$password', '$value')";

    $result = mysqli_query($db->link, $query);
    header("Refresh: 0; url=loginform.php");
}
$db->disconnect();
?>