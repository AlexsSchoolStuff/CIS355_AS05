<?php 
	
	require '../../database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: fish.php");
	}
	
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

	}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE AS05_fish  set fishSpecies = ?, fishWeight = ?, fishLength =? WHERE fishID = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($species, $weight, $length, $id));
			Database::disconnect();
			header("Location: fish.php");
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
		    			<h3>Update a Fish</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="fish_update.php?id=<?php echo $id?>" method="post">
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
					    <label class="control-label">Weight</label>
					    <div class="controls">
					      	<input name="fishWeight" type="text" placeholder="Weight" value="<?php echo !empty($weight)?$weight:'';?>">
					      	<?php if (!empty($weightError)): ?>
					      		<span class="help-inline"><?php echo $weightError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($lengthError)?'error':'';?>">
					    <label class="control-label">Length</label>
					    <div class="controls">
					      	<input name="fishLength" type="text"  placeholder="Length" value="<?php echo !empty($length)?$length:'';?>">
					      	<?php if (!empty($lengthError)): ?>
					      		<span class="help-inline"><?php echo $lengthError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="fish.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>