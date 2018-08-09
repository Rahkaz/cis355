<?php

    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
   
        $emailError = null;
        $passwordError = null;
         
        // keep track post values
    
        $email = $_POST['email'];
        $password = $_POST['password'];
         
        // validate input
        $valid = true;
         
        if (empty($email)) {
            $passwordError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $passwordError = 'Please enter a valid Email Address';
            $valid = false;
        }
         
        if (empty($password)) {
            $passwordError = 'Please enter Password';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO customer (email,password) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($email,$password));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>

<html>
<head>
		<link   href="bootstrap/css/login-css.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
 
<body>  


  <div class="form">
  
    <form action"login.php" method="post">
	 <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                      
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email Address/Username" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
       <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                       
                        <div class="controls">
                            <input name="password" type="password"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
                            <?php if (!empty($passwordError)): ?>
                                <span class="help-inline"><?php echo $passwordError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
     
      <button type="submit" class="btn btn-success" >Join</button>
	
      <p class="message">Already a memeber? <a href="join.php">Log In</a></p>
    </form>
  </div>
  </body>
</html>