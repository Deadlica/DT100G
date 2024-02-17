<?php
    session_start();

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
            <li><a href="info.php">About</a></li>
        </ul>
    </nav>
    <button onclick="location.href='mailto:sagr1908@student.miun.se'">Contact</button>
</header>