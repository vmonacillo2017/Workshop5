<?php
require_once "pdo.php";

// p' OR '1' = '1

if ( isset($_POST['cancel'] ) ) {
    
    header("Location: index.php");
    return;
}

$failure = false;

if ( isset($_POST['email']) && isset($_POST['password'])  ) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
      $failure = "<p> Invalid! Email must contain at-sign (@)</p>";
    }
    //echo("<p>Handling POST data...</p>\n");
    $e = $_POST['email'];
    $p = $_POST['password'];

    $sql = "SELECT name FROM users
       WHERE email = '$e'
       AND password = '$p'";

    //echo "<p>$sql</p>\n";

    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //var_dump($row);
    //echo "-->\n";
    if ( $row === FALSE ) {
       echo "<h1>Login incorrect.</h1>\n";
    } else {
       echo "<p>Login success.</p>\n";
       header("Location: autos.php? name =" .urlencode($_POST['name']));
       return;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Vincent F. Monacillo - Automobile and Database</title>
<p>Please Login</p>
<form method="post">
<p>Email:
<input type="text" size="40" name="email"></p>
<p>Password:
<input type="password" size="40" name="password"></p>
<p><input type="submit" value="Login" />
<input type="submit" name="cancel" value="Cancel" />
<a href="<?php echo($_SERVER['PHP_SELF']);?>">Refresh</a></p>
</form>

