<?php
 /*
  * Inloggning till sidan
  * Hämtar information ifrån DB
  */
  
      // inloggad?
     session_start();
     
     require_once ("dbcx.php");
     $dbh = dbcx();

     // hämta lösenord + salt från DB
     $sql = "SELECT `password`, `username` FROM `users` WHERE `username` = :username";
     $stmt = $dbh->prepare($sql);
     $stmt->bindParam(':username', $_POST['user']);
     $stmt->execute();
     $info = $stmt->fetch();

     // finns användaren?
     if (empty($info)) {
        echo "Användaren finns inte";
     } else {
        if (crypt($_POST['pass'], $info['password']) == $info['password']) {
            $_SESSION['username'] = $info['username'];
            header('Location: index.php');
            exit;
         } else{
             $_SESSION['fel'] = "Fel lösenord";
            header('Location: register.php');             
        }
    }
    
 

 