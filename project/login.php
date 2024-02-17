<?php
    include_once "header/header.php";
    //Checks if the user is already logged in
    if(isset($_SESSION["userusername"])) {
        header("location: index.php");
        exit();
    }
?>

<div class="container">
    <section class="signup_form">
        <form action="includes/login.inc.php" method="post">
            <h2>Login</h2>
            <br />
            <label>Username/Email<input type="text" name="uid" placeholder="Username/Email..."></label>
            <br />
            <label>Password<input type="password" name="pwd" placeholder="Password..."></label>
            <button type="submit" name="submit">Login</button>
        </form>
    </section>
    <section class="sign_up_error_message">
        <?php
            //Checks all the login errors
            if(isset($_GET["error"])) {
                if($_GET["error"] == "emptyinput") {
                    echo "<h3>Please make sure that all the fields are filled in.</h3>";
                }
                else if($_GET["error"] == "wronglogin") {
                    echo "<h3>Incorrect login information!</h3>";
                }
            }
        ?>
    </section>
</div>

<?php include_once "footer/footer.php";?>