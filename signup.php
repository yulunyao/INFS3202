<?php
$alert_message_1 = "The username or password is too short";
$alert_message_2 = "The user already exist, please create a different username";
include('connectMySQL.php'); //make sure the path is correct.
$db = new MySQLDatabase(); //create a Database object
$db->connect("root", "", "sik");
$username = $_REQUEST['username'];
//Added hashing for password
$cost = 5;
// Create a random salt
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
// Prefix information about the hash so PHP knows how to verify it later.
// "$2a$" means we're using the Blowfish algorithm. The following two digits are the cost parameter.
$salt = sprintf("$2a$%02d$", $cost) . $salt;
// Value:
// $2a$10$eImiTXuWVxfM37uY4JANjQ==
// Hash the password with the salt
$password = crypt($_REQUEST['password'], $salt);
//SQL Unprotected
//$query_ck = mysqli_query($db->link, "SELECT username FROM signup WHERE username = '$username'");
//Protected SQL
$stmt = $db->link->prepare("SELECT username FROM signup WHERE username = ?");
$stmt->bind_param("s", $username); //Binds variables to a prepared statement as parameters
$stmt->execute();
//Get variables from query
$stmt->bind_result($query_ck);

mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
//Close prepared statement
$stmt->fetch();


if (mysqli_stmt_num_rows($stmt) != 0) {
    echo "<script type= 'text/javascript'>alert('$alert_message_2')</script>";
    header("Refresh: 0; url=loginform.php"); //refresh page after alert msg.
    $stmt->close();
} else {

    //SQL Unprotected
    //$query = "INSERT INTO signup (username, password) VALUES ('$username', '$password')";
    //$result = mysqli_query($db->link, $query);

    //Protected SQL
    $stmt = $db->link->prepare("INSERT INTO signup (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    //Close prepared statement
    $stmt->close();
    $value = rand(10000000, 99999999); // generate 8-digit random number

    //Unprotected SQL
    //$query = "INSERT INTO signup (username, password, random) VALUES ('$username', '$password', '$value')";
    //$result = mysqli_query($db->link, $query);

    //Protected SQL
    $stmt = $db->link->prepare("INSERT INTO uid (username, random, location) VALUES (?,?,'')");
    $stmt->bind_param("ss", $username, $value);
    $stmt->execute();
    //Close prepared statement
    $stmt->close();
    header("Refresh: 0; url=loginform.php"); //refresh page after alert msg.
}
$db->disconnect();
?>