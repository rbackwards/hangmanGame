<?php
session_start();
include("connectionInfo.php");

$formUsername = $_POST["Username"];
$formPassword = $_POST["Password"];
$salt = strval(rand(0,9999));
$sha = 'sha256';
$hashPassword = hash($sha, $formPassword . $salt);


//create connection
$conn = new mysqli($servername, $username, $password, $dbName);


#check if username exists
$sql = "SELECT * FROM hangmanLogin WHERE username = '$formUsername'";

$result = $conn->query($sql);

if ($result->num_rows > 0){
    $_SESSION["userNameExists"] = "Username already exists!";
    echo "Username already exists";
    header("Location: hangmanRegister.php");
    exit();
}

#Insert data
$sql = "INSERT INTO hangmanLogin (username, password, salt) VALUES ('$formUsername', '$hashPassword', '$salt')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    $_SESSION["user"] = $formUsername;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close;

header("Location: hangmanGame.php");
exit();
?>