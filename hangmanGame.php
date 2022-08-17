<?php
    session_start();

    include("connectionInfo.php");

  

    //create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    $lettersGuessed=array();


    if(!isset($_SESSION['hangmanWord']) && empty($_SESSION['hangmanWord'])){
        $randNum = rand(1,25);
        $_SESSION['wordID'] = $randNum;

        $sql = "SELECT word FROM hangmanWords WHERE id ='$randNum'";

        $result = $conn->query($sql);
    
        $row = $result->fetch_assoc();

        #set session variables
        $_SESSION['winner'] = '';
        $_SESSION['hangmanWord'] = $row['word'];
        $_SESSION['lives'] = 6;
        $_SESSION['guessCount'] = 0;
        $_SESSION['letterGuessed'] =array();
        $_SESSION['wordGuessed'] ='';
        $_SESSION['score'] = 0;
        $wordLength = strlen($_SESSION['hangmanWord']);

        #set word guessed
        for($x=0;$x<$wordLength;$x++){
            $_SESSION['wordGuessed'][$x] = '_';
        }
    }
    
    $wordLength = strlen($_SESSION['hangmanWord']);
    echo $_SESSION['hangmanWord'];
    #echo $wordLength;

    
    
    if(array_key_exists('guess', $_POST)) {
        $guessCorrect = false;
        $_SESSION['guessCount']++;
        $str = $_POST['guessTxt'];
        
        array_push($_SESSION['letterGuessed'], $str);
        $arrayLength = count($_SESSION['letterGuessed']);
        
        echo "Word length is: " . $wordLength;
        
        #check if letter is correct
        for($i=0;$i<$wordLength;$i++){

           if($str == $_SESSION['hangmanWord'][$i]){
               $_SESSION['wordGuessed'][$i] = $str;
               $guessCorrect = true;
               $_SESSION['score'] += 100;
           } 
        }

        if($guessCorrect == false){
            $_SESSION['lives']--;
            $_SESSION['score'] -= 10;
        }
        if($_SESSION['lives'] == 0){
            $_SESSION['winner'] = 0;
            header("Location: hangmanGameover.php");
            exit();
        }

        if($_SESSION['hangmanWord'] == $_SESSION['wordGuessed']){
            $_SESSION['winner'] = 1;
            header("Location: hangmanGameover.php");
            exit();
        }
    
    }
    $conn->close;

    #echo "    " . $_SESSION['hangmanWord'] . " " . $_SESSION['wordGuessed'];
    #echo $_SESSOIN['winner'];
?>


<html>
<body>
<h1>Hangman!</h1>
<p>Welcome <b><?php echo $_SESSION['user']?></b></p>

<p>Lives Left: <?php echo $_SESSION['lives'] ?></p>
<p>Letters guessed: <?php for($x=0;$x<$arrayLength;$x++){
            echo $_SESSION['letterGuessed'][$x];
        } ?></p>
<p>Score: <?php echo $_SESSION['score']; ?></p>        
<br>
<h2>Word:  <?php for($x=0;$x<$wordLength;$x++){
            echo $_SESSION['wordGuessed'][$x] . " ";
        };
?></h2>


<form method="post">
    <p>Guess a letter:<input type="text" name="guessTxt"></input>
    <input type="submit" name="guess" value="Guess"></input></p>
</form>

<a href="hangmanNewGame.php">New Game</a>
<a href="hangmanLogOut.php">Logout</a>

</body>
</html>
