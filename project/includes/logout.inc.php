<?php
    session_start();
    //Unsets all $_SESSION variables
    session_unset();
    //Destroys the session
    session_destroy();
    header("location: ../login.php");
    exit();
?>