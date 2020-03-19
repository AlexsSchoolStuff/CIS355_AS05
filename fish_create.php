<?php 
	
	require '../../database.php';
	if ( !empty($_POST)) {

		// keep track validation errors
		$speciesError = null;
		$weightError = null;
		$LengthError = null;
		// keep track post values
		$species = $_POST['fishSpecies'];
		$weight = $_POST['fishWeight'];
		$length = $_POST['fishLength'];
		
		// validate input
		$valid = true;
		if (empty($species)) {
			$speciesError = 'Please enter a species';
			$valid = false;
		}

		
		if (empty($weight)) {
			$weightError = 'Please enter a weight';
			$valid = false;
		} 
		
		if (empty($length)) {
			$lengthError = 'Please enter a length';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->errorInfo();
			$sql = "INSERT INTO AS05_fish (fishSpecies, fishWeight, fishLength) VALUES(?, ?, ?)";
			$q = $pdo->prepare($sql)->execute(array($species,$weight,$length));
			Database::disconnect();
			header("Location: catch_create.php");
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
		    			<h3>Add a fish</h3>
		    		</div>
    		
					
	    			<form class="form-horizontal" action="fish_create.php" method="post">
					  <div class="control-group <?php echo !empty($speciesError)?'error':'';?>">
					    <label class="control-label">Species</label>
					    <div class="controls">
					      	<input name="fishSpecies" type="text"  placeholder="Species" value="<?php echo !empty($species)?$species:'';?>">
					      	<?php if (!empty($speciesError)): ?>
					      		<span class="help-inline"><?php echo $speciesError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($weightError)?'error':'';?>">
					    <label class="control-label">Weight (lbs)</label>
					    <div class="controls">
					      	<input name="fishWeight" type="text" placeholder="Weight" value="<?php echo !empty($weight)?$weight:'';?>">
					      	<?php if (!empty($weightError)): ?>
					      		<span class="help-inline"><?php echo $weightError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($lengthError)?'error':'';?>">
					    <label class="control-label">Length (in)</label>
					    <div class="controls">
					      	<input name="fishLength" type="text"  placeholder="Length" value="<?php echo !empty($length)?$length:'';?>">
					      	<?php if (!empty($lengthError)): ?>
					      		<span class="help-inline"><?php echo $lengthError;?></span>
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