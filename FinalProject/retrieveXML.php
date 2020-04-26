<?php 
$xmlTopics = simplexml_load_file("forumTopics.xml") or die("Error: Cannot create object");
foreach($xmlTopics->topic as $topic)
{
    $id = $topic->id;
    $title = $topic->title;
    $time = $topic->time;
    $owner = $topic->owner;

    echo "<div style='width:30%'><p style='color:blue;border-bottom:2px black solid;font-weight:bold;'>ID: " .$id. "<br>" .
    "<span style='background-color:white;color:black;'>Name: " .$title. "<br>" .
    "Time: " .$time. "<br>" .
    "Owner: " .$owner. "</span></p></div>";
}
?>