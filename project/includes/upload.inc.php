<?php

    if(isset($_POST["submit"])) {
        //Gets all the file information
        $file = $_FILES["filename"];

        $fileName = $file["name"];
        $fileTmpName = $file["tmp_name"];
        $fileSize = $file["size"];
        $fileError = $file["error"];
        $fileType = $file["type"];

        //Separates string at the '.'
        $fileExt = explode(".", $fileName);
        //Makes the file extension lower case
        $fileExt = strtolower(end($fileExt));

        $allowedExt = array("jpg", "jpeg", "png");

        if(in_array($fileExt, $allowedExt)) { //Checks if uploaded file is an acceptable file type
            if($fileError === 0) { //No file errors
                $newFileName = uniqid("", true) . "." . $fileExt; //Gives the picture a unique name
                $filePath = "../../writeable/" . $newFileName;
                move_uploaded_file($fileTmpName, "../" . $filePath); //Uploads the file to the writeable folder
                include "dbh.inc.php";

                $user->updateProfileImage($filePath); //Adds the filepath to the database

                header("location: ../profile.php?uploadsuccess");
                exit();
            }
            //error handling
            else {
                header("location: ../profile.php?error=error");
                exit();
            }
        }
        else {
            header("location: ../profile.php?error=filetype");
            exit();
        }
    }

?>