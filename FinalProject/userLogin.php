<?php 
//check required fields
if(($_POST['username']=="") || ($_POST['password']=="")){
    header("Location: userLogin.php");
    exit;
}
$displayBlock = "";

//connect to server
//$mysqli = mysqli_connect("localhost", "root", "", "theSuperForum") or die(mysqli_error);
$mysqli = mysqli_connect("localhost", "lisabalbach_wingd", "CIT19020022", "lisabalbach_wingd") or die(mysqli_error);

//clean input
$safe_username = mysqli_real_escape_string($mysqli, $_POST['username']);
$safe_password = mysqli_real_escape_string($mysqli, $_POST['password']);

//create query
$sql = "SELECT f_name, l_name FROM auth_users WHERE username = '".$safe_username."' AND password = '".$safe_password."'";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

//get num of rows
if(mysqli_num_rows($result) == 1){
    header("Location: theSuperForumMenu.html");
    exit;
}
else
{
    $displayBlock = "<p>Your username and password are not valid</p>";
    $displayBlock .= "<p><a href='theSuperForumLogin.html'>Return to login</a></p>";
}

//close connection
mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html>
<head>
<title>User Login</title>
<link href="theSuperForumUserLogin.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php echo $displayBlock; ?>
</body>
</html>