<?php
    session_start();

    if(isset($_SESSION["activity"]) && time() - $_SESSION["activity"] > 1800) { //Logs the user out if they've been inactive for more than 30min
        session_unset();
        session_destroy();
    }
    $_SESSION["activity"] = time();

    $filename = basename($_SERVER["PHP_SELF"]);

    switch($filename) { //Checks the current page filename to set an appropriate title
        case "login.php":
            $title = "Login";
            break;
        case "signup.php":
            $title = "Sign Up";
            break;
        case "index.php":
            $title = "Home";
            break;
        case "profile.php":
            $title = "Profile";
            break;
        case "videos.php":
            $title = "Videos";
            break;
        case "typeracer.php":
            $title = "Typing Test";
            break;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php /*Sets the title*/ echo $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
<header>
    <img class="logo" src="images/logo.png" alt="logo" onclick="window.open('index.php', '_self')">
    <nav>
        <ul class="nav_links">
            <?php
                if(isset($_SESSION["userusername"])) { //Sets the navigation link for logged in users
                    echo "<li><a href='profile.php'>Profile</a></li>";
                    echo "<li><a href='videos.php'>Videos</a></li>";
                    echo "<li><a href='typeracer.php'>Typing Test</a></li>";
                    echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";
                }
                else {//Sets navigation links if no user is logged in
                    echo "<li><a href='signup.php'>Sign Up</a></li>";
                    echo "<li><a href='login.php'>Login</a></li>";
                }
            ?>
        </ul>
    </nav>
    <button onclick="location.href='mailto:sagr1908@student.miun.se'">Contact</button>
</header>