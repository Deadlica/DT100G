<?php

    $removeIndex = $_GET["deletepost"];
    $file = fopen("../../../../writeable/posts.csv", "r");
    $posts = [];

    //Writes all data, except the deleted one to an array
    for($i = 0; !feof($file); $i++) {
        if($i == $removeIndex) {
            fgetcsv($file);
        }

        if(feof($file)) {break;}
        $posts[$i] = fgetcsv($file);
    }

    fclose($file);
    $file = fopen("../../../../writeable/posts.csv", "w");

    //Write all the content in the array to the file
    for($i = 0; $i + 1 < count($posts); $i++) {
        fputcsv($file, $posts[$i]);
    }

    fclose($file);

    header("location: ../index.php");
    exit();

?>