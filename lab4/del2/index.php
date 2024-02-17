<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <?php
            include_once "header/header.php";
            include_once "footer/footer.php";
        ?>
        <div class="content_left" id="content_left">
            <h1>Guestbook</h1>
            <form class="forum_post" action="includes/post.inc.php" method="post">
                <p>Name:
                    <br />
                    <input type="text" name="name">
                </p>
                <p>Message:
                    <br />
                    <textarea cols="40" rows="2" name="message"></textarea>
                </p>
                <button type="submit" name="addPost">Create Post</button>
            </form>

            <?php

                if(isset($_GET["error"])) {
                    if($_GET["error"] == "emptyfield") {
                        echo "<p>Please fill in all the text Fields</p>";
                    }
                    if($_GET["error"] == "stmtfail") {
                        echo "<p>Something went wrong, try again!</p>";
                    }
                    if($_GET["error"] == "queryfail") {
                        echo "<p>Failed to delete post, try again!</p>";
                    }
                }

            ?>

        </div>
        <div class="content_right">
            <h2 style="color: #24252A">Guestbook posts</h2>
            <?php
                require_once "classes/post.class.php";
                require_once "classes/guestbook.class.php";

                $database = new Guestbook("studentmysql.miun.se", "<username>", "<pwd>", "<db_name>");
                
                $table = $database->getTable("guestbooktable");
                $table_rows = $database->getRowNumber($table);
                $rows = [];

                for($i = 0; $i < $table_rows; $i++) {
                    $rows[$i] = $database->getRow($table);
                }
                for($i = count($rows) - 1; $i >= 0; $i--) {
                    echo "<div>";
                        echo "<p>" . $rows[$i][2] . "</p>";
                        echo "<p>Written by " . $rows[$i][1];
                        echo "<br />";
                        echo "Published ". $rows[$i][3] . "</p>";
                        echo "<a class='delete_btn' href='includes/deletepost.inc.php?deletepost=" . $rows[$i][0] . "'>Delete Post</a>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>

</body>
</html>
