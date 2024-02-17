<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <?php
            include_once "header/header.php";
            if(isset($_SESSION["useruid"])) {
                header("location: index.php");
                exit();
            }
            include_once "footer/footer.php";
        ?>

        <div class="signup_form">
            <form action="includes/login.inc.php" method="post">
                <h2>Login</h2>
                <input type="text" name="uid" placeholder="Username/Email...">
                <input type="password" name="pwd" placeholder="Password...">
                <button type="submit" name="submit">Login</button>
            </form>
        </div>
        <div class="sign_up_error_message">
            <?php //Checks for error messages
                if(isset($_GET["error"])) {
                    if($_GET["error"] == "emptyinput") {
                        echo "<p>Please make sure that all the fields are filled in.</p>";
                    }
                    else if($_GET["error"] == "wronglogin") {
                        echo "<p>Incorrect login information!</p>";
                    }
                }
            ?>
        </div>
    </div>

</body>
</html>