<?php

if(isset($_POST["submit"])) { //Checks that the user was sent to this script through the button click
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    //Checks if input fields are empty
    if(emptyInputLogin($username, $pwd)) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    //Attempts to login and returns a bool
    $loginResult = $user->login($username, $pwd);

    //Checks if the login failed
    if($loginResult === "wronglogin") {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    header("location: ../index.php");
}
else {
    header("location: ../login.php");
    exit();
}

?>