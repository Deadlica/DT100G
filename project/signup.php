<?php
    include_once "header/header.php";
    //Checks if the user is logged in
    if(isset($_SESSION["userusername"])) {
        header("location: index.php");
        exit();
    }
?>

<div class="container">
    <section class="signup_form">
        <form action="includes/signup.inc.php" method="post">
            <h2>Sign Up</h2>
            <br />
            <label>Name<input type="text" name="name" placeholder="Full name..."></label>
            <br />
            <label>Email<input type="text" name="email" placeholder="Email..."></label>
            <br />
            <label>Username<input type="text" name="uid" placeholder="Username..."></label>
            <br />
            <label>Password<input type="password" name="pwd" placeholder="Password..."></label>
            <br />
            <label>Repeat Password<input type="password" name="pwdrepeat" placeholder="Repeat password..."></label>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </section>
    <section class="sign_up_error_message">
        <?php
            //Checks all the signup errors
            if(isset($_GET["error"])) {
                if($_GET["error"] == "emptyinput") {
                    echo "<p>Please make sure that all the fields are filled in.</p>";
                }
                else if($_GET["error"] == "invaliduid") {
                    echo "<p>Invalid username was given!</p>";
                }
                else if($_GET["error"] == "invalidemail") {
                    echo "<p>Invalid email was given!</p>";
                }
                else if($_GET["error"] == "notmatchingpasswords") {
                    echo "<p>The given passwords doesn't match!</p>";
                }
                else if($_GET["error"] == "usernametaken") {
                    echo "<p>The given username is already taken!</p>";
                }
                else if($_GET["error"] == "stmtfail") {
                    echo "<p>Something went wrong! Please try again.</p>";
                }
                else if($_GET["error"] == "none") {
                    echo "<p>The account was successfully created!</p>";
                }
            }
        ?>
    </section>
</div>

<?php include_once "footer/footer.php";?>