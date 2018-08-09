<?php
session_start();

require "database.php";
$errorMessage = $_GET['errorMessage'];
if($_POST){


	$success = false;
	$username = $_POST['username'];
	$password = $_POST['password'];

	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM customer WHERE email = '$username' AND password = '$password' LIMIT 1";
	$q=$pdo->prepare($sql);
	$q->execute(array());
	$data = $q->fetch(PDO::FETCH_ASSOC);

	
	
	if($data){
		$_SESSION["username"] = $username;
		header("Location: index.php");
	}
	else{
		header("Location: login.php?errorMessage=Invalid");
		exit();
	}

}






?>
<html>
<head>
	<link   href="bootstrap/css/login-css.css" rel="stylesheet">
</head>
 
<body>
 
  <div class="form">
  
    <form action"login.php" method="post">
      <input name="username" type="text"  placeholder="username" required>
      <input name="password" type="password"  placeholder="password" required>
      <button type="submit" class="btn btn-success" >Sign in</button>
	  <p class="message"><a href="logout.php">Log Out</a></p>
      <p class="message">Not registered? <a href="join.php">Create an account</a></p>
	  <p class="message">Github:<a href="https://github.com/Rahkaz/cis355">HERE</a></p>
    </form>
  </div>
  </body>
<!---
<form class="form-horizontal" action"login.php" method="post">
<p></p> class="login-form" class="login-page"
<input name="username" type="text" required>
<input >
<button type="submit" class="btn btn-success" >Sign in</button>
<button href="join.php" class="btn btn-success" >Join</button>
<a href='logout.php'>Log Out</a>

</form-->

</html>