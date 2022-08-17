<?php
    session_start();
?>


<script>
function validateForm(){
    let pass1 = document.forms["registerForm"]["password"].value;
    let pass2 = document.forms["registerForm"]["repeatPassword"].value;

    if(pass1 != pass2){
        alert("Password does not match.");
        return false;
    }
}



</script>

<html>
<body>

<p> <?php echo $_SESSION["userNameExists"] ?></p>

<form name="registerForm" action="hangmanRegisterCapture.php" onsubmit="return validateForm()" method="post">
	<p>Username: <input type="text" name="Username"</input></p>
	<p>Password: <input type="text" name="Password"</input></p>
    <p>Repeat Password: <input type="text" name="repeatPassword"</input></p>
	<input type="submit" value="submit">

</body>
</html>