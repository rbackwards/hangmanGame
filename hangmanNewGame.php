<?php
    session_start();

    unset($_SESSION['hangmanWord']);

    header("Location: hangmanGame.php");
    exit();
?>