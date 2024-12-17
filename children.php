<?php
require "Database.php";

$config = require("config.php");

$db = new Database($config["database"]);
$children = $db->query("SELECT * FROM children")->fetchAll();

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Christmas Letters</title>
    <link rel='stylesheet' href='christmas.css'> <!-- Link to external CSS -->
</head>
<body>
    <h1>🎄 Christmas Letters 🎅</h1>
    <div class='snowflakes'>
        <!-- Random snowflakes -->
        <div class='snowflake' style='left: 10%; animation-delay: 0s;'>❄️</div>
        <div class='snowflake' style='left: 20%; animation-delay: 2s;'>❄️</div>
        <div class='snowflake' style='left: 30%; animation-delay: 4s;'>❄️</div>
        <div class='snowflake' style='left: 50%; animation-delay: 1s;'>❄️</div>
        <div class='snowflake' style='left: 70%; animation-delay: 3s;'>❄️</div>
        <div class='snowflake' style='left: 90%; animation-delay: 5s;'>❄️</div>
    </div>";

foreach ($children as $worker) {
    $i = $worker["id"];
    $letter_text = $db->query("SELECT letter_text FROM letters WHERE id = $i")->fetchColumn();
    echo "<div class='card'>";
    echo "<h2>" . htmlspecialchars($worker["firstname"]) . " " . htmlspecialchars($worker["surname"]) . ", Age: " . htmlspecialchars($worker["age"]) . "</h2>";
    echo "<p>" . htmlspecialchars($letter_text) . "</p>";
    echo "</div>";
}

echo "</body></html>";
?>
