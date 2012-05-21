<?php
 /*
  * Inloggning till sidan
  * Hämtar information ifrån DB
  * Gör det möjligt att logga in, samt kontroller på om användaren finns o.s.v
  *
  * @author Adam Drechsel
  */
	session_start();

	//är alla fält ifyllda?
	if(!empty($_POST['user']) && !empty($_POST['pass'])) {
		require_once ("dbcx.php");
		$dbh = dbcx();
	
		// hämta lösenord + användarnamn + salt från DB
		$sql = "SELECT `password`, `username`, `salt` FROM `users` WHERE `username` = :username";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':username', $_POST['user']);
		$stmt->execute();
		$info = $stmt->fetch();
	

		// finns användaren?
		if (empty($info)) {
			$_SESSION['user_msg'] = "Användaren finns inte";
			header('Location: register.php');
		} else {
			if (crypt($_POST['pass'], '$6$' . $info['salt'] . '$') == $info['password']) {
				$_SESSION['username'] = htmlspecialchars($info['username']);
				header('Location: index.php');
				exit;
			} else{
				$_SESSION['pass_msg'] = "Fel lösenord";
				header('Location: register.php');
			}
		}
	} else {
		$_SESSION['msg'] = "Alla fält är inte ifyllda";
		header("Location: register.php");
	}