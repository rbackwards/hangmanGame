<?php
    session_start();

    include("connectionInfo.php");

    //create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    $user = $_SESSION['user'];
    $score = $_SESSION['score'];
    $wordID = $_SESSION['wordID'];

    $sql = "SELECT * FROM hangmanLogin WHERE username='$user'";
    
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    $usernameID = $row['ID'];

    $sql = "INSERT INTO hangmanHighScore (usernameID, score, wordID) VALUES ('$usernameID', '$score', '$wordID')";

    $sql = "SELECT w.word, s.score, l.username FROM ((hangmanHighScore as s INNER JOIN hangmanLogin as l ON s.usernameID = l.ID) INNER JOIN hangmanWords as w ON s.wordID = w.ID) WHERE s.wordID = $wordID GROUP BY w.word, s.score, l.username ORDER BY s.score DESC LIMIT 10 ";

    $result = $conn->query($sql);

    if($_SESSION["winner"] == 1){
        $winnerTxt = "YOU WIN!";
    }
    else{
        $winnerTxt = "YOU LOSE!";
    }

?>



<html>
    <body>

    <h1><?php echo $winnerTxt;?></h1>

    <table>
        <tr>
            <th>TOP 10 High Scores</th>
        </tr>
        <tr>
            <th>Word</th>
            <th>Score</th>
            <th>User</th>
        </tr>
        <?php
        if($result = $conn->query($sql)) {
            while($row = $result->fetch_row()) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>";   
            }
            $result -> free_result();
        }
        ?>
        
    </table>    

    <a href="hangmanNewGame.php">New Game</a>

    </body>
</html>