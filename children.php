<?php
require "Database.php";

$config = require("config.php");

$db = new Database($config["database"]);
$children = $db->query("SELECT * FROM children")->fetchAll();
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>  
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Christmas Letters</title>
    <link rel='stylesheet' href='christmas.css'> <!-- Link to external CSS -->
    <style>
/* customizable snowflake styling */
.snowflake {
  color: #fff;
  font-size: 1em;
  font-family: Arial, sans-serif;
  text-shadow: 0 0 5px #000;
}
 
.snowflake,.snowflake .inner{animation-iteration-count:infinite;animation-play-state:running}@keyframes snowflakes-fall{0%{transform:translateY(0)}100%{transform:translateY(110vh)}}@keyframes snowflakes-shake{0%,100%{transform:translateX(0)}50%{transform:translateX(80px)}}.snowflake{position:fixed;top:-10%;z-index:9999;-webkit-user-select:none;user-select:none;cursor:default;animation-name:snowflakes-shake;animation-duration:3s;animation-timing-function:ease-in-out}.snowflake .inner{animation-duration:10s;animation-name:snowflakes-fall;animation-timing-function:linear}.snowflake:nth-of-type(0){left:1%;animation-delay:0s}.snowflake:nth-of-type(0) .inner{animation-delay:0s}.snowflake:first-of-type{left:10%;animation-delay:1s}.snowflake:first-of-type .inner,.snowflake:nth-of-type(8) .inner{animation-delay:1s}.snowflake:nth-of-type(2){left:20%;animation-delay:.5s}.snowflake:nth-of-type(2) .inner,.snowflake:nth-of-type(6) .inner{animation-delay:6s}.snowflake:nth-of-type(3){left:30%;animation-delay:2s}.snowflake:nth-of-type(11) .inner,.snowflake:nth-of-type(3) .inner{animation-delay:4s}.snowflake:nth-of-type(4){left:40%;animation-delay:2s}.snowflake:nth-of-type(10) .inner,.snowflake:nth-of-type(4) .inner{animation-delay:2s}.snowflake:nth-of-type(5){left:50%;animation-delay:3s}.snowflake:nth-of-type(5) .inner{animation-delay:8s}.snowflake:nth-of-type(6){left:60%;animation-delay:2s}.snowflake:nth-of-type(7){left:70%;animation-delay:1s}.snowflake:nth-of-type(7) .inner{animation-delay:2.5s}.snowflake:nth-of-type(8){left:80%;animation-delay:0s}.snowflake:nth-of-type(9){left:90%;animation-delay:1.5s}.snowflake:nth-of-type(9) .inner{animation-delay:3s}.snowflake:nth-of-type(10){left:25%;animation-delay:0s}.snowflake:nth-of-type(11){left:65%;animation-delay:2.5s}
</style>
</head>
<body>
    <h1>🎄 Christmas Letters 🎅</h1>
    <div class="snowflakes" aria-hidden="true">
        <div class="snowflake"><div class="inner">❅</div></div>
        <div class="snowflake"><div class="inner">❅</div></div>
        <div class="snowflake"><div class="inner">❅</div></div>
        <div class="snowflake"><div class="inner">❅</div></div>
        <div class="snowflake"><div class="inner">❅</div></div>
        <div class="snowflake"><div class="inner">❅</div></div>
        <div class="snowflake"><div class="inner">❅</div></div>
        <div class="snowflake"><div class="inner">❅</div></div>
        <div class="snowflake"><div class="inner">❅</div></div>
        <div class="snowflake"><div class="inner">❅</div></div>
        <div class="snowflake"><div class="inner">❅</div></div>
        <div class="snowflake"><div class="inner">❅</div></div>
    </div>

    <?php
    foreach ($children as $worker) {
        $i = $worker["id"];
        $letter_text = $db->query("SELECT letter_text FROM letters WHERE id = $i")->fetchColumn();
        echo "<div class='card'>";
        echo "<h2>" . htmlspecialchars($worker["firstname"]) . " " . htmlspecialchars($worker["surname"]) . ", Age: " . htmlspecialchars($worker["age"]) . "</h2>";

        $gifts = explode(":", $letter_text);
        $gifts = explode(",", $gifts[sizeof($gifts) - 1]);

        foreach ($gifts as $gift) {
            $trimmedGift = trim($gift);
            $letter_text = str_replace($trimmedGift, "<strong>$trimmedGift</strong>", $letter_text);
        }

        echo "<p>" . $letter_text . "</p>";
        echo "<p>Gift list:</p>";
        echo "<ul>";
        foreach ($gifts as $gift) {
            echo "<li>" . htmlspecialchars($gift) . "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
    ?>
</body>
</html>
