<?php
session_start();
$con = mysqli_connect('au-cdbr-azure-east-a.cloudapp.net:3306', "b622a8e03ec7ba", "6e32c3d6", "sik");
$username = $_SESSION['username']
echo "Welcome " . $username;

//Unprotected SQL
//$query = "SELECT random FROM signup WHERE username = '".$_SESSION['username']."'";
//$result = mysqli_query($con,$query);

//Protected SQL
$stmt = $con->link->prepare("SELECT random FROM signup WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
//Get variables from query
$stmt->bind_result($result);
//Fetch data
$stmt->fetch();
//Close prepared statement
$stmt->close();

while($row = mysqli_fetch_assoc($result)) {
    print_r(" with UID: ");
    print_r($row["random"]);
}
echo "<a href='logout.php'> [logout]</a>";
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