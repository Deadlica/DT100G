<?php
    include_once "header/header.php";
    //Checks if the user is logged in
    if(!isset($_SESSION["userusername"])) {
        header("location: login.php");
        exit();
    }
?>

<div class="container">
    <section class="profile" id="profile">
        <h2>Profile picture</h2>
        <?php
            //Fetches the filepath for the profile picture
            include "classes/user.class.php";
            $user = new User("studentmysql.miun.se", "sagr1908", "5wnahplk", "sagr1908");
            //Creates the profile picture
            echo "<img class ='profile_picture' id='profile_picture' src='" . $user->getImagePath() . "' alt='profile_picture.jpg' width='300' height='300'>";
        ?>
        <form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
            <label>Update Picture: <input type="file" id="filename" name="filename" accept="image/jpg, image/jpeg, image/png"></label>
            <br />
            <button type="submit" name="submit">Upload</button>
        </form>
        <?php
            //Checks all the file uploading errors
            if(isset($_GET["error"])) {
                $error = $_GET["error"];
                if($error == "error") {
                    echo "<h3>There was an error uploading your file!</h3>";
                }
                else if($error == "filetype") {
                    echo "<h3>You cannot upload files of this type!</h3>";
                }
            }
        ?>
    </section>
    <div class="profile_info">
        <?php
            //Prints out information about the logged in user
            echo "<h3>Full Name: " . $_SESSION["username"] . "</h3>";
            echo "<h3>Username: " . $_SESSION["userusername"] . "</h3>";
            echo "<h3>Email: " . $_SESSION["useremail"] . "</h3>";
            //Checks if the user has typing test score
            if($_SESSION["userwpm"]) {
                echo "<h3>WPM: " . $_SESSION["userwpm"] . "</h3>";
            }
            else {
                echo "<h3>WPM: -</h3>";
            }
        ?>
    </div>
</div>

<?php include_once "footer/footer.php";?>