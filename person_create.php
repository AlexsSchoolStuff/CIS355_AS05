	<?php 
	
	require '../../database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$numError = null;
		$passwordError = null;
		
		
		// keep track post values
		$name = $_POST['personName'];
		$password = $_POST['personPassword'];
		$passwordhash = MD5($password);
		
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		
		if (empty($password)) {
			$passwordError = 'Please enter a password';
			$valid = false;
		}
		


		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO AS05_person (personName, personPassword, personTitle) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$passwordhash, 0));
			Database::disconnect();
			header("Location: login.php");
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
		    			<h3>Add User</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="person_create.php" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="personName" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
					    <label class="control-label">Password</label>
					    <div class="controls">
					      	<input name="personPassword" type="password" placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
					      	<?php if (!empty($passwordError)): ?>
					      		<span class="help-inline"><?php echo $passwordError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					 
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Add</button>
						  <button type="button" class = "btn" onclick="history.back();">Back</button>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>