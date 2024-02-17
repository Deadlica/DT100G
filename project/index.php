<?php
    include_once "header/header.php";
    //Checks if the user is logged in
    if(!isset($_SESSION["userusername"])) {
        header("location: login.php");
        exit();
    }
?>

<div class="container">
    <section class="welcome_page" id="welcome_page">
        <h1 class="welcome">Welcome!</h1>
        <p>This is a website with a mixture of features, where you get your own profile page, a youtube media player, a typing test game!</p>
    </section>
</div>

<?php include_once "footer/footer.php";?>