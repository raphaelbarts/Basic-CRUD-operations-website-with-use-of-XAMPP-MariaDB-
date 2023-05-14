<?php

$host="localhost";
$user="id20663314_records";
$password="6=vzclgJlZw74q&v";
$db="id20663314_pawfect";
$error="";
$success="";

session_start();

$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
	die("connection error");
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username=$_POST["username"];
    $password=$_POST["password"];

    $sql="select * from login where username='".$username."' AND password='".$password."' ";

    $result=mysqli_query($data,$sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION["username"] = $row["username"];
        $_SESSION["usertype"] = $row["usertype"];

        if ($row["usertype"] == "user") {
            header("Location: display.php");
        } elseif ($row["usertype"] == "admin") {
            header("Location: adminhome.php");
        }
	} else {
		$error = "Incorrect username or password.";
		$error_class = "active";
	  }
}

?>

<!DOCTYPE html>
<link rel="icon" type="image/x-icon" href="logo.png">
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="styless.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="script.js"></script>

  </head>
  <body>

  <!--white box container-->
	<div class="center">
  <!--inside of the container; the login form-->
  <img src="paw2.png" class="logo">
  <form action="#" method="post">
  <div class="error <?php echo $error_class; ?>"><?php echo $error; ?></div>
        <div class="field">
          <input type="text" name="username" required>
          <label>Email Address</label>
        </div>
        <div class="field">
        <input type="password" name="password" required>
          <label>Password</label>
        </div>

        <div class="forget">
          <a href="#"> Forgot Password? </a>
        </div>
      

        

        <div class="field">
          <input type="submit" value="Login">
        </div>
      </form>
  </div>
    </div>
  </body>
</html>
 