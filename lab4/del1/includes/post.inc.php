<?php
    if(isset($_POST["addPost"])) {
        include_once "../classes/post.class.php";
        
        //If either of the inputs were empty
        if(empty($_POST["name"]) || empty($_POST["message"])) {
            header("location: ../index.php?error=emptyField");
            exit();
        }
        
        $file = fopen("../../../../writeable/posts.csv", "a") or die("Unable to open file!");

        $post_data = [$_POST["name"], $_POST["message"], date("Y-m-d H:i:s")];
        
        fputcsv($file, $post_data);
        fclose($file);

        header("location: ../index.php");
        exit();
    }
    else {
        header("location: ../index.php");
        exit();
    }
?>