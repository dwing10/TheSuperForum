<?php 
session_start();
?>
<?php 
include 'connect.php';
doDB();

$displayBlock = "<h1>Deletion Confirmation</hr>";
$savedId = $_SESSION['topicId'];

$getListSql = "SELECT * FROM topics WHERE topicId = $savedId;";
$getListRes = mysqli_query($mysqli, $getListSql) or die(mysqli_error($mysqli));

if(mysqli_num_rows($getListRes) < 1){
    $displayBlock .= "<p><em>There was an error retrieving the topic!</em></p>";
}
else{
    $rec = mysqli_fetch_array($getListRes);
    $displayTitle = stripslashes($rec['topicTitle']);
    $displayBlock .= "<p>Topic title: ".$displayTitle."</p>";
    $displayBlock .= "<p><a id='confirm' href = 'doDelete.php'>Confirm Deletion</a></p>";
    $displayBlock .= "<p><a id='cancel' href= 'theSuperForumMenu.html'>Cancel Deletion</a></p>";
}

//free results
mysqli_free_result($getListRes);
?>
<!DOCTYPE html>
<html>
<head>
<title>Delete Posting</title>
<link href="theSuperForum.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php echo $displayBlock; ?>
</body>
</html>