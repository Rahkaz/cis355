<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: login.php");
}
function Database(){include'database.php';$pdo=Database::connect();$sql='SELECT * FROM customer ORDER BY id DESC';foreach($pdo->query($sql)as $row){echo'<tr>';echo'<td>'.$row['name'].'</td>';echo'<td>'.$row['email'].'</td>';echo'<td>'.$row['mobile'].'</td>';echo'<td width=250>';echo'<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';echo' ';echo'<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';echo' ';echo'<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';echo'</td>';echo'</tr>';}
Database::disconnect();}


/* this is a function to create the layout of the index page
  function Database(){ include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM customers ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['name'] . '</td>';
                            echo '<td>'. $row['email'] . '</td>';
                            echo '<td>'. $row['mobile'] . '</td>';
							 echo '<td width=250>';
                                echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                                echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
  }*/
?>

<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
 
<body>

		
    <div class="container">
	<a href="https://github.com/Rahkaz/cis355">GITHUB</a>
	</br>
	</br>
	 <a  href="logout.php" class="btn btn-success" style="float: right;" >Log Out</a>
	
            <div class="row">
                <h3>PHP CRUD Grid</h3>
            </div>
            <div class="row">
			 <p>
                    <a href="create.php" class="btn btn-success">Create</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Mobile Number</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
				  /* we call the function here*/
                Database();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>