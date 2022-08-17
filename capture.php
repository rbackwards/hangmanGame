<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<body>
	<?php
		$first = $_POST["firstName"];
		$last = $_POST["lastName"];
		
		echo "Got first and last name : " . $first . " " . $last . "<br>";
		
		$_SESSION["first"] = $first;
		$_SESSION["last"] = $last;
		
		echo "Set session variables<br>";
		
	?>
	<a href="testsession.php">Go to testsession.php</a>
	
</body>
</html>