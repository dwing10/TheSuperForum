<?php 
include 'connect.php';
doDB();

if(!$_POST){
    if(!isset($_GET['postId'])){
        header("Location: topicList.php");
        exit;
    }

    $safePostId = mysqli_real_escape_string($mysqli, $_GET['postId']);

    $verifySql = "SELECT ft.topicId, ft.topicTitle FROM posts AS fp LEFT JOIN topics as ft ON fp.topicId = ft.topicId WHERE fp.postId = '".$safePostId."'";
    $verifyRes = mysqli_query($mysqli, $verifySql) or die(mysqli_error($mysqli));

    if(mysqli_num_rows($verifyRes) < 1){
        header("Location: topicList.php");
        exit;
    }
    else{
        while($topicInfo = mysqli_fetch_array($verifyRes)){
            $topicId = $topicInfo['topicId'];
            $topicTitle = stripslashes($topicInfo['topicTitle']);
        }
        include 'BeginNav.php';
?>
<h1>Post Your Reply in <?php echo $topicTitle;?></h1>
<form method="post" action ="<?php echo $_SERVER['PHP_SELF']; ?>">
<p><label for="postOwner">Your Email Address</label><br/> 
<input type="email" id="postOwner" name="postOwner" size="40" maxlength="150" required="required"></p> 
<p><label for="postText">Post Text:</label><br/>
<textarea id="postText" name="postText" rows="8" cols"40" required = "required"></textarea></p>
<input type="hidden" name="topicId" value="<?php echo $topicId; ?>">
<button type="submit" name="submit" value="submit">Add Post</button>
</form>
<?php
include 'EndNav.php';

//free results
mysqli_free_result($verifyRes);

//close connection
mysqli_close($mysqli);
    }
}
else if ($_POST){
    if ((!$_POST['topicId']) || (!$_POST['postText']) || (!$_POST['postOwner'])){
        header("Location: topicList.php");
        exit;
    }

    //create safe values for use
    $safeTopicId = mysqli_real_escape_string($mysqli, $_POST['topicId']);
    $safePostText = mysqli_real_escape_string($mysqli, $_POST['postText']);
    $safePostOwner = mysqli_real_escape_string($mysqli, $_POST['postOwner']);

    //add the post
    $addPostSql = "INSERT INTO posts (topicId, postText, postTimeCreated, postOwner) VALUES
    ('".$safeTopicId."', '".$safePostText."', now(), '".$safePostOwner."')";

    $addPostRes = mysqli_query($mysqli, $addPostSql) or die(mysqli_error($mysqli));

    //close connection
    mysqli_close($mysqli);

    //redirect user to topic
    header("Location: showTopic.php?topicId=".$_POST['topicId']);
    exit;
}
?>