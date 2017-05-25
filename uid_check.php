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

//Unprotected SQL
//$query = "SELECT random FROM signup WHERE random = $uid";
//$uid_get = mysqli_query($con, $query);


//Protected SQL
$stmt = $con->link->prepare("SELECT random FROM uid WHERE random = ?");
$stmt->bind_param($result, "s", $uid);
$stmt->execute($result);



// You may need this too...
$stmt->store_result( $result );

//$row_cnt = mysqli_stmt_num_rows( $result );


//Get variables from query
//$stmt->bind_result($uid_get);
//Fetch data
//$stmt->fetch();
//Close prepared statement



if(stmt->num_rows($result ) > 0) {
    header("location: getlocation.php");
} else{
    header("Refresh: 0; url=send_uid.php"); //refresh page after alert msg.
    echo("<script>alert('The UID you have typed is not exist, please try again.');</script>");
}

$stmt->close();
?>