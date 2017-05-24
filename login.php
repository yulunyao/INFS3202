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
	
	//Unprotected SQL
    //$sql = "SELECT password FROM signup WHERE username = '".$username."'";
	//$result = mysqli_query($dbO->link, $sql)->fetch_object()->password;
	
	//Protected SQL
	$stmt = $dbO->prepare( "SELECT password FROM signup WHERE username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	//Get variables from query
	$stmt->bind_result($result);
	//Fetch data
	$stmt->fetch();
	//Close prepared statement
	$stmt->close();
    //$result = $conn->query($sql);
	if (!$result){
		die('Could not query:' . mysqli_error());
	}
	//$hash = mysqli_result($result, 0);
	//var_dump($hash);
	//var_dump($result);
	
    if (hash_equals($result, crypt($password, $result)) ) {
        if(isset($_REQUEST['rem'])) {
            setcookie('username', $username, time()+60*60*7);
        }
        session_start();
        $_SESSION['username'] = $username;
        header("location: task.php");
    } else {
        header("Refresh: 0; url=loginform.php"); //refresh page after alert msg.
        echo "<script>alert('$alert_message');</script>";
    }
} else {
    header("location: loginform.php");
}

$dbO->disconnect();

?>