<!DOCTYPE html>
<html>
<head>
    <title>About</title>
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
        <div class="content_left" style="grid-column: 1 / span 3;">
            <?php
                include_once "function.php";
                print_content();
            ?>
        </div>
    </div>

</body>
</html>