<?php
    include_once "header/header.php";
    //Checks if the user is logged in
    if(!isset($_SESSION["userusername"])) {
        header("location: login.php");
        exit();
    }
?>

<div class="container1" id="container">
    <section class="videos" id="videos">
        
    </section>
    <section class="result_list">
        <div class="searchBar">
            <label for="search">Search</label>
            <input type="text" placeholder="Search.." id="search" autofocus>
            <button class="searchButton" id="searchButton"><em class="fa fa-search"></em></button>
        </div>
        <div class="video_links" id="video_links">
            
        </div>
    </section>
</div>

<script src="js/youtube.js"></script>

<?php include_once "footer/footer.php";?>