
<?php


session_start(); 

require '../../database.php';

if ( !empty($_POST)) { 


	$username = $_POST['username']; 
	$password = $_POST['password'];
	$passwordhash = MD5($password);

		

	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM AS05_person WHERE personName = ? AND personPassword = ?";

	$q = $pdo->prepare($sql);

	$q->execute(array($username,$passwordhash));
	$data = $q->fetchAll();
	var_dump($data);
	var_dump($_SESSION);
	
	if(!empty($data)) { 
		$_SESSION['personID'] = $data[0]['personID'];
		$sessionid = $data[0]['personID'];
		$_SESSION['personTitle'] = $data[0]['personTitle'];
		Database::disconnect();
		header("Location: myaccount.php");

		exit();
	}
	else { // otherwise go to login error page
		Database::disconnect();
		echo "<font color= 'red'>Incorrect Username or Password</font>";
		
	}

	}
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Login</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="login.php" method="post">
					  
					    <label class="control-label">Username: </label>
					    <div class="controls">
					      	<input name="username" type="text"  placeholder="Username" >
					      	<br><br>
					
					    </div>
				
					   <label class="control-label">Password: </label>
					    <div class="controls">
					      	<input name="password" type="password"  placeholder="Password" >
					      	
					
					    </div>
					  
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Login!</button>
						  <a class="btn btn-info" href="person_create.php">Create New Account</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>