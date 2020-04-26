<?php 
include 'connect.php';
doDB();

if(!isset($_GET['topicId'])){
    header("Location: topicList.php");
    exit;
}

$safeTopicId = mysqli_real_escape_string($mysqli, $_GET['topicId']);

//verify topic exists
$verifyTopicSql = "SELECT topicTitle FROM topics WHERE topicId = '".$safeTopicId."'";
$verifyTopicRes = mysqli_query($mysqli, $verifyTopicSql) or die(mysqli_error($mysqli));

if(mysqli_num_rows($verifyTopicRes) < 1){
    //topic does not exist
    $displayBlock = "<p><em>You have selected an invalid topic.<br/>
    Please <a href=\"topicList.php\">try again</a></em></p>";
}
else{
    //get topic title
    while($topicInfo = mysqli_fetch_array($verifyTopicRes)){
        $topicTitle = stripslashes($topicInfo['topicTitle']);
    }

    $getPostSql = "SELECT postId, postText, DATE_FORMAT(postTimeCreated, '%b %e %y <br/>%r') AS fmt_postTimeCreated, postOwner FROM
    posts WHERE topicId = '".$safeTopicId."' ORDER BY postTimeCreated ASC";

    $getPostRes = mysqli_query($mysqli, $getPostSql) or die(mysqli_error($mysqli));

    $displayBlock = <<<END_OF_TEXT
    <p>Showing posts for the <strong>$topicTitle</strong> topic:</p>
    <table class="table table-hover">
    <tr>
    <th>Author</th>
    <th>Post</th>
    </tr>
END_OF_TEXT;

    while($postInfo = mysqli_fetch_array($getPostRes)){
        $postId = $postInfo['postId'];
        $postText = nl2br(stripslashes($postInfo['postText']));
        $postTimeCreated = $postInfo['fmt_postTimeCreated'];
        $postOwner = stripslashes($postInfo['postOwner']);

        $displayBlock .= <<<END_OF_TEXT
        <tr>
        <td>$postOwner<br/><br/>Created on:<br/>$postTimeCreated</td>
        <td>$postText<br/><br/>
        <a href="replyToPost.php?postId=$postId"><strong>REPLY TO POST</strong><a/>
        </td>
        </tr>
END_OF_TEXT;
    }
    //free results
    mysqli_free_result($getPostRes);
    mysqli_free_result($verifyTopicRes);

    //close connection
    mysqli_close($mysqli);

    //close table
    $displayBlock .= "</table";
    include 'BeginNav.php';
    echo '<h1>Posts in Topic</h1>';
    echo $displayBlock;
    include 'EndNav.php';
}
?>
<!--
<!DOCTYPE html>
<html>
<head>
<title>Posts in Topic</title>
<link href="theSuperForum.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	table {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th {
		border: 1px solid black;
		padding: 6px;
		font-weight: bold;
		background: #ccc;
	}
	td {
		border: 1px solid black;
		padding: 6px;
		vertical-align: top;
	}
	.num_posts_col { text-align: center; }
</style>
</head>
<body>
<h1>Posts in Topic</h1>
<//?php echo $display_block; ?>
<p>Would you like to <a href="theSuperForumMenu.html">return to main</a>?</p>
</body>
</html> -->
