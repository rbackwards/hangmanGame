<?php
	session_start();
	
	//resets variables
	session_unset();
	
	session_destroy();
?>

<html>
<body>
<p>You logged out!</p>
<a href="hangmanHome.php">HOME</a>
</body>
</html>
