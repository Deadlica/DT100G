<?php

if(isset($_POST["submit"])) { //Makes sure the login button was pressed
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once "functions.inc.php";

    if(emptyInputLogin($username, $pwd)) { //Check for empty inputs
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    if(!($username == "admin" && $pwd == "admin")) { //Checks for correct login
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    userLogin($username, $pwd); //login
}
else {
    header("location: ../login.php");
    exit();
}

?>