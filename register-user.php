<?php
 /*
  * Koden som körs när man ska registrera en användare
  *
  * @author Adam Drechsel
  *
  */
session_start();

$_SESSION['reg-user_value'] = $_POST['username'];
$_SESSION['reg-pass_value'] = $_POST['password'];
$_SESSION['reg-pass2_value'] = $_POST['password2'];
$_SESSION['email_value'] = $_POST['email'];
//Är alla fält ifyllda?
if (!empty($_POST['username'])
	&& !empty($_POST['password'])
	&& !empty($_POST['password2'])
	&& !empty($_POST['email'])) {

		//connectar till DB te-12-adam
		require_once "dbcx.php";
		$dbh = dbcx();
		
		//Kollar om användarnamnet är ledigt
		$sql = "SELECT `username` FROM `users` WHERE `username` = :username";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->execute();
		$user = $stmt->fetch();
		
		//felkontroller
		$fel = 0;
		if ($user) {
			$_SESSION['reg-user_msg'] = "Användarnamnet är upptaget";
			$fel = 1;
		}
		if (strlen($_POST['username']) >= 10) {
			$_SESSION['reg-user_msg'] = "Användarnamnet är för långt. Max 9 tecken";
			$fel = 1;
		}
		if ($_POST['password'] != $_POST['password2']) {
			$_SESSION['reg-pass_msg'] = "Lösenorden är inte lika";
			$fel = 1;
		}
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$_SESSION['email_msg'] = "Email-adressen är inte giltlig";
			$fel = 1;
		}
		if ($fel) {
			header('Location: register.php');
		}
		
		//registrerar ny användare
		else {
			//genererar salt ifrån generate-salt.php
			require_once "generate-salt.php";
			$salt = generateSalt();
			$confirm_code = md5(uniqid(rand()));
			$username = $_POST['username'];
			$pass = crypt($_POST['password'], '$6$' . $salt . '$');
			$email = $_POST['email'];
			
			$sql = "INSERT INTO `temp_members_db`(`confirm_code`, `email`, `username`, `password`, `salt`) VALUES (:confirm_code, :email, :username, :password, :salt)";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':confirm_code', $confirm_code);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password', $pass);
			$stmt->bindParam(':salt', $salt);
			$stmt->execute();
			
			//skicka mail
			$to = $email;
			$subject = "Your confirmation link here";
			$header = "from: Adam Drechsel";
			$message =  	"Your confirmation link \r\n";
			$message .= "Click this link to activate your account \r\n";
			$message .= "http://ne.keryx.se/~te-12-adam/php-inlamning/confirmation.php?passkey={$confirm_code}";
			
			mail($to, $subject, $message, $header);
			
			$_SESSION['reg_msg'] = "Kolla din email för att slutföra din registrering";
			header('Location: register.php');
		}
	} else {
		$_SESSION['reg_msg'] = "Alla fällt är inte ifyllda";
		header("Location: register.php");
	}
