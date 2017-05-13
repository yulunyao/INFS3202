<?php
    include("connectMySQL.php");
    $myemail = "s4380253";
    $mypass = "test";

/*    include('connectMySQL.php'); //make sure the path is correct.
    $db = new MySQLDatabase(); //create a Database object
    $db->connect("root", "", "sik");
    $db->disconnect(); //always disconnect when finished.*/

    if(isset($_REQUEST['login'])) {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        if ($username == $myemail and $password == $mypass) {
            if(isset($_REQUEST['rem'])) {
                setcookie('username', $username, time()+60*60*7);
                setcookie('password', $password, time()+60*60*7);
            }
            session_start();
            $_SESSION['username'] = $username;
            header("location: task.php");
        } else {
            echo "Invalid Email/Password";
        }
    } else {
        header("location: loginform.php");
    }
?>
