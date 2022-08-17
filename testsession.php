<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
	if(isset($_SESSION["first"])) {
		"My session variables are: " . $_SESSION["first"] . " " . $_SESSION["last"] . "<br>";
	} else {
		echo "Session variables not set<br>";
	}
?>
<a href="resetsession.php">Go to resetsession.php</a>
</body>
</html>
