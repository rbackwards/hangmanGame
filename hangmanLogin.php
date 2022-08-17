<?php
    session_start();
    include("connectionInfo.php");

    $formUsername = $_POST["Username"];
    $formPassword = $_POST["Password"];
    $sha = 'sha256';
    $salt = 0;
    


    //create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    #check if user exists
    $sql = "SELECT * FROM hangmanLogin WHERE username = '$formUsername'";

    $result = $conn->query($sql);

    

    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        
        $salt = $row['salt'];
        
        if ($row['password'] === hash($sha, $formPassword . $salt)){
            echo "passwords match";
            $_SESSION["user"] = $formUsername;
            header("Location: hangmanGame.php");
            exit();
        }
        else{
            echo "password does not match";
            $_SESSION['homeErrorMsg'] = "Password does not match!";
            header("Location: hangmanHome.php");
            exit();
        }
    }
    else{
        echo "No username";
        $_SESSION['homeErrorMsg'] = "No user by that name!";
        header("Location: hangmanHome.php");
        exit();
    }

    $conn->close;
?>