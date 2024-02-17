<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/styles.css">
    
</head>
<body>
    <div class="container">
        <?php
            include_once "header/header.php";

            if(!isset($_SESSION["useruid"])) {
                header("location: login.php");
                exit();
            }
            include_once "footer/footer.php";
        ?>
        <div class="content_left" id="content_left">
            <ul>
                <li>
                    <h3>Har du tidigare erfarenhhet av utveckling med PHP?</h3>
                    <p>Läste en webb kurs under gymnasiet som gick mer på djupet om Javascript, PHP. Har dock inte hållt på med webbutveckling sedan dess, är väldigt rostig.</p>
                </li>
                <li>
                    <hr />
                    <h3>Hur har du valt att strukturera upp dina filer och kataloger?</h3>
                    <p>Har delat upp html, css, js var för sig. Sedan har jag placerat återanvändbara komponenter i underkataloger.</p>
                </li>
                <li>
                    <hr />
                    <h3>Har du följt guiden, eller skapat på egen hand?</h3>
                    <p>Skapat på egen hand, med lite inspiration från internet.</p>
                </li>
                <li>
                    <hr />
                    <h3>Har du gjort några förbättringar eller vidareutvecklingar av guiden (om du följt denna)?</h3>
                    <p>Inte kollat på guiden.</p>
                </li>
                <li>
                    <hr />
                    <h3>Vilken utvecklingsmiljö har du använt för uppgiften (Editor, webbserver etcetera)?</h3>
                    <p>Jag sitter främst i Visual Studio Code, samt VIM.</p>
                </li>
                <li>
                    <hr />
                    <h3>Har något varit svårt med denna uppgift?</h3>
                    <p>Hittils har det varit lite struligt att få all css att funka snyggt, att 'byggblocken' blir bra gjorda.</p>
                </li>
            </ul>
        </div>
        <div class="content_right_1">Content 2</div>
        <div class="content_right_2">Content 3</div>
    </div>

</body>
</html>