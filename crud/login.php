<?php
session_start();

require "database.php";
$errorMessage = $_GET['errorMessage'];
if($_POST){
	$success = false;
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_ECXEPTION);
	$sql = "SELECT * FROM customer WHERE email = '$username' AND password = '$password' LIMIT 1";
	$q=$pdo->prepare($sql);
	$q->execute(array());
	$data = $q->fetch(PDO::FETCH_ASSOC);

	
	
	if($data){
		$_SESSION["username"] = $username;
		header("Location: success.php");
	}
	else{
		header("Location: login.php?errorMessage='Invalid sign in'");
		exit();
	}

}






?>
<html>

<form class="form-horizontal" action"login.php" method="post">
<p><?php echo $errorMessage?></p>
<input name="username" type="text" required>
<input name="password" type="password" required>
<button type="submit" class="btn btn-success" >Sign in</button>

</form>

</html>