<?php
    if(isset($_POST["addPost"])) {
        include_once "../classes/post.class.php";
        include_once "../classes/guestbook.class.php";
        
        //If either of the inputs were empty
        if(empty($_POST["name"]) || empty($_POST["message"])) {
            header("location: ../index.php?error=emptyfield");
            exit();
        }

        
        $name = $_POST["name"];
        $message = $_POST["message"];
        $post = new Post($name, $message);
        $post->setTime(date("Y-m-d H:i:s"));

        $database = new Guestbook("studentmysql.miun.se", "<username>", "<pwd>", "<db_name>");

        $database->add($post);

        header("location: ../index.php");
        exit();
    }
    else {
        header("location: ../index.php");
        exit();
    }
?>
