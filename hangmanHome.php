<?php
	session_start();
?>

<html>
<body>

<p> <?php echo $_SESSION["homeErrorMsg"] ?></p>

<form action="hangmanLogin.php" method="post">
	<p>Username: <input type="text" name="Username"</input></p>
	<p>Password: <input type="password" name="Password"</input></p>
	<input type="submit" value="Submit">

<a href="hangmanRegister.php">Register</a>

</body>
</html>