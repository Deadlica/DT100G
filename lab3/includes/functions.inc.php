<?php

//Checks if any of the input fields were empty
function emptyInputLogin($username, $pwd) {
    if(empty($username) || empty($pwd)) {
        return true;
    }
    return false;
}

function userLogin($username, $pwd) { //Starts a session, a session timer
        session_start();
        $_SESSION["useruid"] = "admin";
        $_SESSION["activity"] = time();
        header("location: ../index.php");
        exit();
}

?>