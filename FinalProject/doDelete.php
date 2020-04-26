<?php 
session_start();
?>
<?php 
include 'connect.php';
doDB();
$savedId = $_SESSION['topicId'];

//deletes topic
$delTopicSql = "DELETE FROM topics WHERE topicId = $savedId;";
$delTopicRes = mysqli_query($mysqli, $delTopicSql) or die(mysqli_error($mysqli));

//deletes post
$delPostSql = "DELETE FROM posts WHERE topicId = $savedId;";
$delPostRes = mysqli_query($mysqli, $delTopicSql) or die(mysqli_error($mysqli));

$displayBlock = "<hr><h2><em>Your topic has been deleted.</em></h2>";
$displayBlock .= "<p><a href='theSuperForumMenu.html'>Return to Menu</a></p><hr>";

//close connection
mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html>
<head>
<title>Deletion Confirmation</title>
<link href="theSuperForum.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php echo $displayBlock; ?>
</body>
</html>