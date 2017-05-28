<?php
session_start();
include('connectMySQL.php'); //make sure the path is correct.
//$con = mysqli_connect('au-cdbr-azure-east-a.cloudapp.net:3306', "b622a8e03ec7ba", "6e32c3d6", "sik");
$db = new MySQLDatabase(); //create a Database object
$con = $db->connect("root", "", "sik");
$username = $_SESSION['username'];
echo "Welcome " . $username;
//Unprotected SQL
//$query = "SELECT random FROM signup WHERE username = '".$_SESSION['username']."'";
//$result = mysqli_query($con,$query);
//Protected SQL
$stmt = $db->link->prepare("SELECT random FROM uid WHERE username = ?");
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
    <script src="js/jquery-3.2.1.min.js"></script>
</head>

<body>
<div class="logo"><img src="img/SiKd.png" alt="Logo" width="70px" height="32px"></div>
<h6>Find Your Friends At Anytime</h6>
<div id="uid_img">
    <img src="img/red.PNG" alt="Plane Image">
</div>

<div id="uid_container">
    <h2>ENTER UID:</h2>
    <form id="submit_form" onsubmit="return false">
        <input required="required" id="uid" type="number" name="uid" placeholder="Enter 8-digit number">
        <p></p>
        <span id="success_message" class="text-success"></span>
        <span id="error_message" class="text-danger"></span>
        <p></p>
        <input type="button" id='submit_uid' value="Go And Find" onsubmit="false">
    </form>
</div>


<div id="footer">
    Designed By Team.
</div>

</body>

<script>
    $(document).ready(function () {
        $('#submit_uid').click(function () {
            var uid = $('#uid').val();
            console.log(uid);
            if(uid == '')
            {
                $('#error_message').html("UID Required, please enter.");
            }
            else
                {
                    $('#error_message').html("");
                    $.ajax({
                        url:'uid_check.php',
                        method:"GET",
                        data:{uid:uid},
                        success:function(data){
                            if(data === 'getlocation.php') { //check if tee
                                window.location = data;
                            } else {
                                $("form").trigger("reset");
                                $('#success_message').fadeIn().html(data);
                                setTimeout(function () {
                                    $('#success_message').fadeOut('slow');
                                },1000);
                            }

                    }
                    })
                }
        })
    })
</script>
</html>