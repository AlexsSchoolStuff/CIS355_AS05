<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: assignments.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$personError = null;
		$eventError = null;
		
		// keep track post values
		$personID = $_POST['assign_person_id'];
		$eventID = $_POST['assign_event_id'];
		
		// validate input
		$valid = true;
		if (empty($personID)) {
			$personError = "Please enter a person's ID";
			$valid = false;
		}
		
		if (empty($eventID)) {
			$eventError = 'Please enter an event ID';
			$valid = false;
		}
		
		
		// update data
		if ($valid) {
			
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE assignments set assign_person_id = ?, assign_event_id = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			echo "valid1";
			$q->execute(array($personID, $eventID, $id));
			echo "valid2";
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
		    			<h3>Update an Assignment</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="assign_update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($personError)?'error':'';?>">
					    <label class="control-label">Person ID</label>
					    <div class="controls">
					      	<input name="assign_person_id" type="text"  placeholder="Person ID" value="<?php echo !empty($personID)?$personID:'';?>">
					      	<?php if (!empty($personError)): ?>
					      		<span class="help-inline"><?php echo $personError;?></span>
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
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="assignments.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>