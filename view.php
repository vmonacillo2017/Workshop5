<?php
session_start();

if(isset($_GET['logout'])){
	session_start();
	session_destroy();
	
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Vincent F. Monacillo - Automobile and Database</title>

<h2>Automobiles</h2>
	<ul>
		<?php
		$pdo = new PDO('mysql:host=sql12.freesqldatabase.com;port=3306;dbname=sql12219242', 'sql12219242', 'CP4yM58Nti');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare("SELECT * from autos"); 
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
		$rows = $stmt->fetchAll();
		foreach( $rows  as $row ) {
			echo "<li>";
			echo $row['year']." ".$row['make']."/".$row['mileage'];
			echo "</li>";
			
		}
		?>
	</ul>
	<a href="add.php?name=<?php echo $_SESSION["username"]; ?>">Add New</a> | 
	<a href="view.php?logout">Logout</a>
