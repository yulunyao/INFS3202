<?php
/**
 * Created by PhpStorm.
 * User: WHOAMI
 * Date: 2017/5/23
 * Time: 20:55
 */
$con = mysqli_connect('au-cdbr-azure-east-a.cloudapp.net:3306', "b622a8e03ec7ba", "6e32c3d6", "sik");

$uid = $_REQUEST['uid'];

session_start();
$_SESSION['uid'] = $uid;

$query = "SELECT random FROM uid WHERE random = $uid";
$uid_get = mysqli_query($con, $query);



if(mysqli_num_rows($uid_get) > 0) {
    header("location: getlocation.php");
} else{
    header("Refresh: 0; url=send_uid.php"); //refresh page after alert msg.
    echo("<script>alert('The UID you have typed is not exist, please try again.');</script>");
}
?>