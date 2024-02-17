<?php
function print_content() {
    echo "<h2>Information</h2>";
    echo "<ul>";
        echo "<li><b>Datum/klockslag: </b>" . date("Y-m-d H:i:s") . " - " . translate_day(date("l")) . "</li>";
        echo "<li><b>Din IP-adress: </b>" . $_SERVER["REMOTE_ADDR"] . "</li>";
        echo "<li><b>Sökväg/filnamn: </b>" . $_SERVER["PHP_SELF"] . "</li>";
        echo "<li><b>User agent-sträng: </b>" . $_SERVER["HTTP_USER_AGENT"] . "</li>";
    echo "</ul>";
}

function translate_day($str) {
    if($str == "Monday")
        return "Måndag";
    if($str == "Tuesday")
        return "Tisdag";
    if($str == "Wednesday")
        return "Onsdag";
    if($str == "Thursday")
        return "Torsdag";
    if($str == "Friday")
        return "Äntligen fredag!";
    if($str == "Saturday")
        return "Lördag";
    if($str == "Sunday")
        return "Söndag";
}

?>