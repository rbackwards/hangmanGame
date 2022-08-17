<?php
	session_start();
	
	//resets variables
	session_unset();
	
	session_destroy();
?>

<!DOCTYPE html>

<html>
<body>
<p>Session variables reset</p>
<a href="testsession.php">Go back to testsession.php</a>
</body>
</html>