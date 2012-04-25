<?php
 /*
  * Filen gör det möjligt att göra inlägg på sidan
  */
  
    session_start();
    $username = $_SESSION['username'];
    require_once ("dbcx.php");
    $dbh = dbcx();
    
    $sql = "INSERT INTO `inlagg` (`text`, `username`, `ctime`) VALUES (:text, '$username', now())";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':text', $_POST['status']);
    $stmt->execute();
    
    HEADER("location: index.php");