<?php
class MySQLDatabase
{
    var $link;

    function connect($user, $password, $database)
    {
        $this->link = mysqli_connect('au-cdbr-azure-east-a.cloudapp.net:3306', "b622a8e03ec7ba", "6e32c3d6");
        if (!$this->link) {
            die('Not connected : ' . mysqli_error());
        }
        $db = mysqli_select_db($this->link, $database);
        if (!$db) {
            die ('Cannot use : ' . mysqli_error());
        }
        return $this->link;
    }

    function disconnect()
    {
        mysqli_close($this->link);
    }
}

?>