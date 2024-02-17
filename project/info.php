<?php
    include_once "header/header.php";
    
    if(!isset($_SESSION["userusername"])) {
        header("location: login.php");
        exit();
    }
?>

<div class="container">
    <div class="content_left" style="grid-column: 1 / span 3;">
        <?php
            include_once "function.php";
            print_content();
        ?>
    </div>
</div>

<?php include_once "footer/footer.php";?>