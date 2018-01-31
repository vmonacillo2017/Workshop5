<?php
require_once "pdo.php";

if (isset($_POST['logout'])){
    header('Location: index.php');
    return;
}

if ( isset($_POST['make']) && isset($_POST['year']) 
     && isset($_POST['mileage'])) {
    $sql = "INSERT INTO autos (make, year, mileage) 
              VALUES (:make, :year, :mileage)";
    echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':make' => $_POST['make'],
        ':year' => $_POST['year'],
        ':mileage' => $_POST['mileage']));
    echo "<tr><td>";
    echo '<i style="color:green;font-size:30px;">Record inserted successfully!</i>';
}

?>
<html>
<head>Vincent F. Monacillo</head>
<title>Vinz Automobile Tracker!</title>

<body>
<table border="1">
<?php
$stmt = $pdo->query("SELECT make, year, mileage FROM autos");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo($row['make']);
    echo("</td><td>");
    echo($row['year']);
    echo("</td><td>");
    echo($row['mileage']);
    echo("</td></tr>\n");
}
?>
</table>
<p>Add A New Automobile</p>
<form method="post">
<p>Make:
<input type="text" name="make" size="40"></p>
<p>Year:
<input type="text" name="year"></p>
<p>Mileage:
<input type="text" name="mileage"></p>
<p><input type="submit" value="Add New"/> 
<input type="submit" name="logout" value="Log out"/> </p>
</form>

</body>