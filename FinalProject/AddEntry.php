<?php 
include 'connect.php';

if (!$_POST){
    $displayBlock = <<<END_OF_BLOCK
    <form method = "post" action="$_SERVER[PHP_SELF]">

    <fieldset>
    <legend>First Name:</legend><br/>
    <input type = "text" name = "f_name" size="30" maxlength="75" required="required" />
    </fieldset>

    <fieldset>
    <legend>Last Name:</legend><br/>
    <input type = "text" name = "l_name" size = "30" maxlength="75" required = "required" />
    </fieldset>

    <fieldset>
    <legend>Email Address:</legend><br/>
    <input type="email" name="email" size="30" maxlength="150" required="required"/>
    </fieldset>

    <fieldset>
    <legend>Username</legend><br/>
    <input type="text" name="username" size="30" maxlength="150" required="required"/>
    </fieldset>

    <fieldset>
    <legend>Password</legend><br/>
    <input type="text" name="password" size="30" maxlength="150" required="required"/>
    </fieldset>

    <button type="submit" name="submit" value="send">Submit</button>
    </form>
END_OF_BLOCK;

} else if ($_POST){
    if(($_POST['f_name'] == "") || ($_POST['l_name'] == "") || ($_POST['email'] == "") || ($_POST['username'] == "") || ($_POST['password'] == ""))
    {
        header("Location: AddEntry.php");
        exit;
    }

    doDB();

    $id = rand(1,1000);
    $safe_f_name = mysqli_real_escape_string($mysqli, $_POST['f_name']);
    $safe_l_name = mysqli_real_escape_string($mysqli, $_POST['l_name']);
    $safe_email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $safe_username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $safe_password = mysqli_real_escape_string($mysqli, $_POST['password']);

    $add_auth_users_sql = "INSERT INTO auth_users (id, f_name, l_name, email, username, password) 
    VALUES ('".$id."', '".$safe_f_name."', '".$safe_l_name."', '".$safe_email."', '".$safe_username."', '".$safe_password."')";
    $add_auth_users_res = mysqli_query($mysqli, $add_auth_users_sql) or die(mysqli_error($mysqli));

    mysqli_close($mysqli);
    $displayBlock = "<p>You have subscribed to The Super Forum!<br/>
    Would you like to <a href=\"theSuperForumLogin.html\">Return to Login</a>?</p<";
}
//include 'BeginNav.php';
//echo $displayBlock;
//include 'EndNav.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Add a User</title>
<link href="theSuperForumUserLogin.css" type="text/css" rel="stylesheet" />
</head>
<body>
<h1>Subscribe</h1>
<?php echo $displayBlock; ?>
</body>
</html>