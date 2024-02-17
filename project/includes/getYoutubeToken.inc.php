<?php

$json = file_get_contents("php://input");
if($json) { //Checks that some sort of data was sent to get the API key sent back
    $API_KEY = "<API KEY>";
    var_dump($API_KEY); //Sends the API key back as a response
}
else {
    header("location: ../videos.php");
    exit();
}

?>
