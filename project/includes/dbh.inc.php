<?php
    include "../classes/user.class.php";
    //Checks the ip adress, to either connect to the local XAMPP database or the remote one
    //Then creates a new User() to setup a database connection
    if($_SERVER['REMOTE_ADDR'] == "::1"){
        $user = new User("localhost", "root", "", "login_users");
    }
    else {
        $user = new User("studentmysql.miun.se", "<username>", "<pwd>", "<db_name>");
    }
?>
