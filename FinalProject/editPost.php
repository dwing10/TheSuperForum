<?php 
session_start();
?>
<?php 
include 'connect.php';
doDB();
if(!$_POST){
    $displayBlock = "<h1>Edit Post</h1>";
    $savedId = $_SESSION['topicId'];
	$savedTitle = $_SESSION['topicTitle'];
	$savedPostText = $_SESSION['postText'];
	
	$getTopicSql = "SELECT * FROM topics WHERE topicId = $savedId;";
	$getTopicRes = mysqli_query($mysqli, $getTopicSql) or die(mysqli_error($mysqli));
	
	$getPostSql = "SELECT * FROM posts WHERE topicId = $savedId;";
    $getPostRes = mysqli_query($mysqli, $getPostSql) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($getTopicRes) < 1){
        $displayBlock .= "<p><em>There was an error retrieving your topic!</em></p>";
    }
    else{
        $rec = mysqli_fetch_array($getTopicRes);
		$displayId = stripslashes($rec['topicId']);
		$displayTitle = stripslashes($rec['topicTitle']);
		$displayBlock .= "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
		$displayBlock .="<p>Topic Title: <input type='text' id='topicTitle' name='topicTitle' value='".$displayTitle."'></p>";
		$postRec = mysqli_fetch_array($getPostRes);
		$displayPost = stripslashes($postRec['postText']);
		$displayBlock .="<p>Post Text: <textarea  style='vertical-align:text-top;' id='postText' name='postText'>".$displayPost."</textarea></p>";
		$displayBlock .= "<button type='submit' id='change' name='change' value='change'>Change entry</button></p>";
		$displayBlock .="</form>";
    }

    //free up the results
    mysqli_free_result($getPostRes);
    mysqli_free_result($getTopicRes);
}

else{
    $cleanTopicTitle = mysqli_real_escape_string($mysqli, $_POST['topicTitle']);
	$cleanPostText = mysqli_real_escape_string($mysqli, $_POST['postText']);

    //update topic
	$updateTopicSql = "UPDATE topics SET topicTitle = '".$cleanTopicTitle ."' WHERE topicId =".$_SESSION['topicId'];
	$updateTopicRes = mysqli_query($mysqli, $updateTopicSql) or die(mysqli_error($mysqli));

    //update post
	$updatePostSql = "UPDATE posts SET postText='" .$cleanPostText."' WHERE topicId= ".$_SESSION['topicId'];
	$updatePostRes = mysqli_query($mysqli, $updatePostSql) or die(mysqli_error($mysqli));

	//close connection to MySQL
	mysqli_close($mysqli);

	//create nice message for user
	$displayBlock ="<h2>Your posting has been modified...</h2>";
	$displayBlock.="<p>The topic title has been modified to: <strong><em>".$cleanTopicTitle."</em></strong><br>";
	$displayBlock.="The topic text has been modified to: <strong><em>".$cleanPostText."</em></strong></p>";
}
include 'BeginNav.php';
echo $displayBlock;
include 'EndNav.php';
?>