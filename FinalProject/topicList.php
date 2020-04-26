<?php 
include 'connect.php';
doDB();

$getTopicsSql = "SELECT topicId, topicTitle, DATE_FORMAT(timeCreated, '%b %e at %r') as fmt_createdTime, topicOwner FROM topics
ORDER BY timeCreated DESC";

$getTopicRes = mysqli_query($mysqli, $getTopicsSql) or Die(mysqli_error($mysqli));

if(mysqli_num_rows($getTopicRes) < 1)
{
    $displayBlock = "<p><em>No topics exist.</em></p>";
}
else{
    $displayBlock = <<<END_OF_TEXT
    <table class="table table-hover">
    <tr>
    <th>Topic Title</th>
    <th># of Posts</th>
    </tr>
END_OF_TEXT;

    while($topicInfo =  mysqli_fetch_array($getTopicRes)){
        $topicId = $topicInfo['topicId'];
        $topicTitle = stripslashes($topicInfo['topicTitle']);
        $createdTime = $topicInfo['fmt_createdTime'];
        $topicOwner = stripslashes($topicInfo['topicOwner']);

        $getNumOfPostSql = "SELECT COUNT(postId) AS postCount FROM posts WHERE topicId = '".$topicId."'";
        $getNumOfPostRes = mysqli_query($mysqli, $getNumOfPostSql) or die (mysqli_error($mysqli));

        while ($postInfo = mysqli_fetch_array($getNumOfPostRes)){
            $numPosts = $postInfo['postCount'];
        }

        $displayBlock .= <<<END_OF_TEXT
        <tr>
        <td><a href="showTopic.php?topicId=$topicId"><strong>$topicTitle</strong></a>
        <br/>
        Created on $createdTime by $topicOwner</td>
        <td class= "num_posts_col" style="text-align:center;">$numPosts</td>
        </tr>
END_OF_TEXT;
    }

    mysqli_free_result($getTopicRes);
    mysqli_free_result($getNumOfPostRes);

    mysqli_close($mysqli);

    $displayBlock .= "</table>";
}
include 'BeginNav.php';
echo $displayBlock;
include 'EndNav.php';
?>