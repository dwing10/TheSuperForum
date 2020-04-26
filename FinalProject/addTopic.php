<?php 
include 'BeginNav.php';

echo '
<form method="post" action="doAddTopic.php">

<p><label for="topicOwner">Your Email Address:</label><br/>
<input type="email" id="topicOwner" name="topicOwner" size="40" maxlength="150" required="required" /></p>

<p><label for="topicTitle">Topic Title:</label><br/>
<input type="text" id="topicTitle" name="topicTitle" size="40" maxlength="150" required="required"/></P>

<p><label for="postText">Post Text:</label><br/>
<textarea id="postText" name="postText" rows="8" cols="40"></textarea></P>

<button type="submit" name="submit" value="submit">Add Topic</button>
<input type="button" name="menu" id="menu" value="Return to Menu" onclick="location.href=\'theSuperForumMenu.html\'">
</form>';

include 'EndNav.php';
?>