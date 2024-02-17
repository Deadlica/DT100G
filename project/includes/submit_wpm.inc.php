<?php    
    
    $json = file_get_contents("php://input");
    if($json) { //Makes sure json data was sent
        include "dbh.inc.php";
        $data = json_decode($json, true); //Decodes the data
        $user->submitWPM($data); //Adds the wpm to the database
    }
    else {
        header("location: ../typeracer.php");
        exit();
    }

?>