<?php
include('connectMySQL.php'); //make sure the path is correct.
$db = new MySQLDatabase(); //create a Database object
$db->connect("root", "", "sik");

$db->disconnect(); //always disconnect when finished.
/**
 * Created by PhpStorm.
 * User: WHOAMI
 * Date: 4/23/2017
 * Time: 3:54 PM
 */
if($_REQUEST['username'] == "infs" && $_REQUEST["password"] == "3202") {
    header("Location: task.php");
}
else{
    header("Location: loginform.php");
}
?>