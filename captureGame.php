<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<body>
<?php
	$first = $_POST["firstName"];
	$_SESSION["first"] = $first;
?>

<h1>Welcome to the Game <?php echo $first; ?></h1>

<form action="game.php" method="post">
	<input type="submit" value="Play">
</form>

</body>
</html>
