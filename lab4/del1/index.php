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
        </div>
        <div class="content_right">
            <h2 style="color: #24252A">Guestbook posts</h2>
            <?php
                require_once "classes/post.class.php";
                $file = fopen("../../../writeable/posts.csv", "r") or die("Unable to open file!");
                $counter = 0;
                $array = [];
                for($i = 0; !feof($file); $i++) {
                    $post = new Post(fgetcsv($file));
                    if(feof($file)) {
                        break;
                    }
                    $array[$i] = $post;
                }
                fclose($file);
                for($i = count($array) - 1; $i >= 0; $i--) {
                    echo "<div>";
                        echo "<p>" . $array[$i]->getMessage() . "</p>";
                        echo "<p>Written by " . $array[$i]->getName();
                        echo "<br />";
                        echo "Published ". $array[$i]->GetTime() . "</p>";
                        echo "<a class='delete_btn' href='includes/deletepost.inc.php?deletepost=" . $i . "'>Delete Post</a>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>

</body>
</html>