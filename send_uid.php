<?php
session_start();
//$con = mysqli_connect('au-cdbr-azure-east-a.cloudapp.net:3306', "b622a8e03ec7ba", "6e32c3d6", "sik");
$db = new MySQLDatabase(); //create a Database object
$con = $db->connect("root", "", "sik");
$username = $_SESSION['username'];
echo "Welcome " . $username;
var_dump($username);

//Unprotected SQL
//$query = "SELECT random FROM signup WHERE username = '".$_SESSION['username']."'";
//$result = mysqli_query($con,$query);

//Protected SQL
$stmt = $con->prepare("SELECT random FROM uid WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
//Get variables from query
//$stmt->bind_result($random);
$result = $stmt->get_result();
//$json = array();
//Fetch data
//$stmt->fetch();
//Close prepared statement


while($row = $result->fetch_assoc()) {
	//$json = array('uid'=>$random):
	//print_r(json_encode($json));
    print_r(" with UID: ");
    print_r($row["random"]);
}
$stmt->close();
echo "<a href='logout.php'> [logout]</a>";
$db->disconnect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SiK</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div class="logo"><img src="img/SiKd.png" alt="Logo" width="70px" height="32px"></div>
<h6>Find Your Friends At Anytime</h6>
<div id="uid_img">
    <img src="img/red.PNG" alt="Plane Image">
</div>

<div id="uid_container">
    <h2>ENTER UID:</h2>
    <form method="$_POST" action="uid_check.php">
        <input required="required" type="number" name="uid">
        <p></p>
        <input type="submit" value="Go And Find">
    </form>
</div>


    <div id="footer">
        Designed By Team.
    </div>

</body>
</html>