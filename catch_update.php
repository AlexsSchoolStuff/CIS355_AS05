<?php 
	

	
	require '../../database.php';
	
		$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: person.php");
	}
	
			$valid = true;
			$selectedPerson = $_POST["personName"];
			$selectedFish = $_POST["fishName"];
			if ($selectedPerson == "--Select Person--"){
				$valid = false;
			}
			if ($selectedFish == "--Select Fish--"){
				$valid = false;
			}
			if ($selectedPerson == null){
				$valid = false;
			}
			if ($selectedFish == null){
				$valid = false;
			}
			
			

			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM AS05_fish";
			$q = $pdo->prepare($sql);
			$q->execute();
			$results = $q->fetchAll();
			
			$sql2 = "SELECT personName, personID FROM AS05_person";
			$q2 = $pdo->prepare($sql2);
			$q2->execute();
			$results2 = $q2->fetchAll();
			
			
			if ($valid){	
			
			$sql4 = "SELECT personID from AS05_person WHERE personName = '" . $selectedPerson . "'";
			$q4 = $pdo->prepare($sql4);
			$q4->execute();
			$personID = $q4->fetchAll();
			
			$sql5 = "SELECT fishID from AS05_fish WHERE fishSpecies = '" . $selectedFish . "'";
			$q5 = $pdo->prepare($sql5);
			$q5->execute();
			$fishID = $q5->fetchAll();
			
			
			$sql3 = "UPDATE AS05_catch  set catchPersonID = ?, catchFishID = ? WHERE id = ?";
			$q3 = $pdo->prepare($sql3);
			
		
			$q3->execute(array($personID[0][0],$fishID[0][0], $id));
			Database::disconnect();
			header("Location: catch.php");
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
    		
	    			<form class="form-horizontal" action="catch_update.php?id=<?php echo $id?>" method="post">
					  
					  <select name = "fishName">
								<option>--Select Fish--</option>
								<?php foreach ($results as $output) { ?>
								<option><?php echo $output["fishSpecies"];
											  //echo " (";
											  //echo $output["fishWeight"];
											  
											  //echo "lbs)";
								?> </option>
								<?php }?>
							</select>
							<select name = "personName">
								<option>--Select Person--</option>
								<?php foreach ($results2 as $output) { ?>
								<option><?php echo $output["personName"];
								?> </option>
								<?php }?>
							</select>
						<?php
						echo $selectedPerson;
						echo "<br>";
						echo $selectedFish;
						echo "<br>";
						echo "valid = ";
						echo $valid;
						?>
					  
					  
					  
					  
					  
					  
					  
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <button type="button" class = "btn" onclick="history.back();">Back</button>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>