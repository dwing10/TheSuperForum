<?php 
session_start();
?>
<?php 
include 'connect.php';
doDB();

if ((!$_POST['topicOwner']) || (!$_POST['topicTitle']) || (!$_POST['postText'])){
    header("Location: addTopic.php");
    exit;
}

$cleanTopicOwner = mysqli_real_escape_string($mysqli, $_POST['topicOwner']);
$cleanTopicTitle = mysqli_real_escape_string($mysqli, $_POST['topicTitle']);
$cleanPostText = mysqli_real_escape_string($mysqli, $_POST['postText']);

$addTopicSql = "INSERT INTO topics (topicTitle, timeCreated, topicOwner) VALUES ('".$cleanTopicTitle."', now(), '".$cleanTopicOwner."')";

$addTopicRes = mysqli_query($mysqli, $addTopicSql) or die(mysqli_error($mysqli));

$topicId = mysqli_insert_id($mysqli);
$_SESSION["topicId"] = $topicId;
$_SESSION['topicTitle'] = $cleanTopicTitle;
$_SESSION['postText'] = $cleanPostText;

$addPostSql = "INSERT INTO posts (topicId, postText, postTimeCreated, postOwner) VALUES ('".$topicId."', '".$cleanPostText."', now(), '".$cleanTopicOwner."')";

$addPostRes = mysqli_query($mysqli, $addPostSql) or die(mysqli_error($mysqli));

mysqli_close($mysqli);

$displayBlock = "
<p> The <strong>" .$_POST["topicTitle"]. "</strong> topic has been created</p>
<form>
<input type='button' name='edit' id='edit' value='Edit Post'
onclick='location.href=\"editPost.php\"'>

<input type='button' name='delete' id='delete' value='Delete Post'
onclick='location.href=\"deletePost.php\"'>
</form>";

include 'BeginNav.php';
echo $displayBlock;
include 'EndNav.php';
?>