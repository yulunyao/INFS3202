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

    /*$conn = new mysqli($servername, $dbuser, $dbpass, $db);
    if ($conn -> connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }*/
	include('connectMySQL.php'); //make sure the path is correct.
	$dbO = new MySQLDatabase(); //create a Database object
	$dbO->connect("root", "", "sik");
	
    $sql = "SELECT * FROM signup WHERE username = '".$username."'";
	$result = mysqli_query($dbO->link, $sql);
    //$result = $conn->query($sql);
	if (!$result){
		die('Could not query:' . mysql_error());
	}
	$hash = mysql_result($result, 0);
	debug_to_console($hash);
	debug_to_console($result);
	
    /*if ($result -> num_rows > 0 && hash_equals($hash, crypt($password, $hash)) ) {
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
    }*/
} else {
    header("location: loginform.php");
}

$dbO->disconnect();

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
?>