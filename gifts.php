<?php
require "Database.php";

$config=require("config.php");

$db = new Database($config["database"]);
$gift = $db->query("SELECT * FROM gifts")->fetchAll();;


//dd($posts[0]["content"]);
echo"<ul>";
foreach($gift as $item){
        echo "<li>" . $item ["id"].".  ".$item["name"]." ".$item["count_available"]."</;i>";

    }
    ?>