<?php
//connect to server 
//$mysqli = mysqli_connect("localhost", "root", "", "theSuperForum");
$mysqli = mysqli_connect("localhost", "lisabalbach_wingd", "CIT19020022", "lisabalbach_wingd");

if(mysqli_connect_error()){
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
}

$get_topic_sql = "SELECT * FROM topics";
$get_topic_res = mysqli_query($mysqli, $get_topic_sql) or die(mysqli_error($mysqli));

$xml = "<forum>";
while($r = mysqli_fetch_array($get_topic_res)){
    $xml .= "<topic>";
    $xml .= "<id>".$r['topicId']."</id>";
    $xml .= "<title>".$r['topicTitle']."</title>";
    $xml .= "<time>".$r['timeCreated']."</time>";
    $xml .= "<owner>".$r['topicOwner']."</owner>";
    $xml .= "</topic>";
}
$xml .= "</forum>";
$sxe = new SimpleXMLElement($xml);
$sxe->asXML("forumTopics.xml");
echo "<h2>forumTopics.xml has been created</h2>";
echo "<p><a href='retrieveXML.php'>View Topics</a>;"
?>