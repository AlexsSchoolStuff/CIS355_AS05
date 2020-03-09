	<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$personError = null;
		$eventError = null;
		
		// keep track post values
		$personID = $_POST['assign_person_id'];
		$eventID = $_POST['assign_event_id'];
		
		// validate input
		
		//TODO: Make each input a drop down that shows which people and events exist
		
		$valid = true;
		if (empty($personID)) {
			$personError = "Please enter Person's ID";
			$valid = false;
		}
			else if (!is_numeric($personID)){
				$personError = 'Please enter a number';
				$valid = false;
		}
		
		
		if (empty($eventID)) {
			$eventError = 'Please enter event ID';
			$valid = false;
		}
		else if (!is_numeric($eventID)){
				$eventError = 'Please enter a number';
				$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO assignments (assign_person_id, assign_event_id) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($personID, $eventID));
			Database::disconnect();
			header("Location: assignments.php");
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
		    			<h3>Create an Assignment</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="assign_create.php" method="post">
					  <div class="control-group <?php echo !empty($personError)?'error':'';?>">
					    <label class="control-label">Person ID</label>
					    <div class="controls">
					      	<input name="assign_person_id" type="text"  placeholder="Person ID" value="<?php echo !empty($personID)?$personID:'';?>">
					      	<?php if (!empty($personError)): ?>
					      		<span class="help-inline"><?php echo $personError	;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($eventError)?'error':'';?>">
					    <label class="control-label">Event ID</label>
					    <div class="controls">
					      	<input name="assign_event_id" type="text" placeholder="Event ID" value="<?php echo !empty($eventID)?$eventID:'';?>">
					      	<?php if (!empty($eventError)): ?>
					      		<span class="help-inline"><?php echo $eventError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="assignments.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>