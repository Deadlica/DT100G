<?php
    if(isset($_GET["deletepost"])) {
        require_once "../classes/guestbook.class.php";
        $removeID = $_GET["deletepost"];

        $database = new Guestbook("studentmysql.miun.se", "<username>", "<pwd>", "<db_name>");

        $database->delete($removeID, "guestbooktable");

        header("location: ../index.php");
        exit();
    }
    else {
        header("location: ../index.php");
        exit();
    }

?>
