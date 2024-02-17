<?php
    session_start();

    //checks if the session has been idle for more than 30min

    if(isset($_SESSION["activity"]) && time() - $_SESSION["activity"] > 1800) {
        session_unset();
        session_destroy();
    }
    $_SESSION["activity"] = time();
?>

<header>
    <img class="logo" src="header/logo.svg" alt="logo" onclick="window.open('index.php', '_self')">
    <nav>
        <ul class="nav_links">
            <?php
                //Prints appropriate navigation links depending on if you're logged in or not
                if(isset($_SESSION["useruid"])) {
                    echo "<li><a href='info.php'>About</a></li>";
                    echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";
                }
                else {
                    echo "<li><a href='login.php'>Login</a></li>";
                }
            ?>
        </ul>
    </nav>
    <button onclick="location.href='mailto:sagr1908@student.miun.se'">Contact</button>
</header>