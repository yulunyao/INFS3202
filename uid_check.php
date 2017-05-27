<?php
/**
 * Created by PhpStorm.
 * User: WHOAMI
 * Date: 2017/5/23
 * Time: 20:55
 */

include('connectMySQL.php'); //make sure the path is correct.
//$con = mysqli_connect('au-cdbr-azure-east-a.cloudapp.net:3306', "b622a8e03ec7ba", "6e32c3d6", "sik");
$db = new MySQLDatabase(); //create a Database object
$con = $db->connect("root", "", "sik");
$uid = $_GET['uid'];
session_start();
$_SESSION['uid'] = $uid;
//Unprotected SQL
//$query = "SELECT random FROM signup WHERE random = $uid";
//$uid_get = mysqli_query($con, $query);
//Protected SQL
$stmt = $db->link->prepare("SELECT random FROM uid WHERE random = ?");
$stmt->bind_param("s", $uid);
$stmt->execute();
$stmt->store_result();
// You may need this too...
//$stmt->store_result( $result );
//$row_cnt = mysqli_stmt_num_rows( $result );
//Get variables from query
//$stmt->bind_result($uid_get);
//Fetch data
//$stmt->fetch();
//Close prepared statement
if($stmt->num_rows() > 0) {
    echo('getlocation.php');
} else {
    echo('The UID is not exist, please try another one');
}
$stmt->close();
$db->disconnect();
?>