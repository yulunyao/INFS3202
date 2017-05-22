<?php
$alert_message = "Invalid username/password";
$servername = 'au-cdbr-azure-east-a.cloudapp.net:3306';
$dbuser = "b622a8e03ec7ba";
$dbpass = "6e32c3d6";
$db = "sik";
?>

<?php

session_start();

if(isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $conn = new mysqli($servername, $dbuser, $dbpass, $db);
    if ($conn -> connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM signup WHERE (username = '$username')";
    $result = $conn->query($sql);
	//$hash = mysql_result($result, 0);
    if ($result -> num_rows > 0 && hash_equals($result, crypt($password, $result))) {
        if(isset($_REQUEST['rem'])) {
            setcookie('username', $username, time()+60*60*7);
            setcookie('password', $password, time()+60*60*7);
        }
        session_start();
        $_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
        header("location: task.php");
    } else {
        header("Refresh: 0; url=loginform.php"); //refresh page after alert msg.
        echo "<script>alert('$alert_message');</script>";
    }
} else {
    header("location: loginform.php");
}
?>