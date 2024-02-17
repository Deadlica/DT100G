<?php
    include_once "header/header.php";
    //Checks is the user is logged in
    if(!isset($_SESSION["userusername"])) {
        header("location: login.php");
        exit();
    }
?>

<section class="gameBody">
    <div class="timer" id="timer"></div>
    <div class="text_box" id="text_box">
        <div class="text" id="text"></div>
        <br />
        <label for="text_input">Enter text here:</label>
        <textarea id="text_input" class="text_input" spellcheck="false" autofocus></textarea>
    </div>
</section>

<script src="js/typeracer.js" defer></script>

<?php include_once "footer/footer.php";?>