<?php
if(!isset($_GET['name'])){
	die("Not logged in");
}else{
	$name = $_GET['name'];
}

$err="";
$pdo = new PDO('mysql:host=sql12.freesqldatabase.com;port=3306;dbname=sql12219242','sql12219242', 'CP4yM58Nti');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['add'])){
	$make=htmlentities($_POST['make']);
	$year=htmlentities($_POST['year']);
	$mileage=htmlentities($_POST['mileage']);
	
	if($make==''){
		$err="Make is required";
	}else if((!is_numeric($year)) || (!is_numeric($mileage))){
		$err="Mileage and year must be numeric";
	}else{
		$stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES ( :mk, :yr, :mi)');
		$stmt->execute(array(
        ':mk' => $make,
        ':yr' => $year,
        ':mi' => $mileage)
		);
		$err="Record Inserted";
		
		header("Location: view.php");
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<title>Vincent F. Monacillo - Automobile and Databases</title>	
</head>
<body>
<div class="container">

	<h1>Tracking Autos for <?php echo $name;?></h1>
	<p><?php echo $err;?></p>
	<form method="POST">
	<p>Make:<input type="text" name="make" size="60"/></p>
	<p>Year:<input type="text" name="year"/></p>
	<p>Mileage:<input type="text" name="mileage"/></p>
	<input type="submit" name="add" value="Add">
	<input type="submit" name="cancel" value="Cancel">
	</form>
</div>

</body>
</html>

