<?php
 /*
  * Filen gör det möjligt att göra inlägg på sidan
  * @author Adam Drechsel
  */
  
    session_start();
    $username = $_SESSION['username'];
    $text = htmlspecialchars($_POST['status']);
    require_once ("dbcx.php");
    $dbh = dbcx();
    
    $sql = "INSERT INTO `inlagg` (`text`, `username`, `ctime`) VALUES (:text, :username, now())";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':text', $text);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    
    HEADER("location: index.php");