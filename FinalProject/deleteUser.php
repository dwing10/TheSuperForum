<?php 
include 'connect.php';
doDB();

if(!$_POST){
    $displayBlock = <<<END_OF_BLOCK
    <form method = "post" action="$_SERVER[PHP_SELF]">

    <fieldset>
    <legend>Username</legend><br/>
    <input type="text" name="username" size="30" maxlength="150" required="required"/>
    </fieldset>

    <fieldset>
    <legend>Password</legend><br/>
    <input type="text" name="password" size="30" maxlength="150" required="required"/>
    </fieldset>

    <button type="submit" name="submit" value="send">Unsubscribe</button>
    </form>
END_OF_BLOCK;
}
else if($_POST){
    if ($_POST['username'] == "" && $_POST['password'] == ""){
        header("Location: deleteEntry.php");
        exit;
    }

doDB();

$safe_username = mysqli_real_escape_string($mysqli, $_POST['username']);
$safe_password = mysqli_real_escape_string($mysqli, $_POST['password']);

$delete_auth_users_sql = "DELETE FROM auth_users WHERE username = '".$safe_username."' AND password = '".$safe_password."'";
$delete_auth_users_res = mysqli_query($mysqli, $delete_auth_users_sql) or die(mysqli_error($mysqli));

mysqli_close($mysqli);

$displayBlock = "<h3>You have been unsubscribed</h3><p>Return to <a href=\"theSuperForumLogin.html\">login</a></p>";
}
//include 'BeginNav.php';
//echo $displayBlock;
//include 'EndNav.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Delete a User</title>
<link href="theSuperForumUserLogin.css" type="text/css" rel="stylesheet" />
</head>
<body>
<h1>Unsubscribe</h1>
<?php echo $displayBlock; ?>
</body>
</html>
