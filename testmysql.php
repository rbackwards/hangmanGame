<?php
	session_start();
	include("connectionInfo1.php");
	$first = "Ryan";
	$last = "Dickson";
	
	//create connection
	$conn = new mysqli($servername, $username, $password, $dbName);
	
	//check connection
	if($conn->connect_error) {
		die("Connection Failed: " . $conn->connect_error);
	}
	
	$sql = "Insert INTO TestTable (firstName, lastName) VALUES ('$first', '$last')";
	

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	  } else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	  }
	  
	  

	$sql = "SELECT * FROM TestTable";
	
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	  } else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	  }
	  
	  $conn->close();
	
?>