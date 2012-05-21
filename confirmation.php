<?php
 /*
  * Sidan som gör det möjligt med email-confirmation.
  * Man måste registrera sig och sedan verifiera sin registrering via email, man måste alltså
  * ha en fungerande email om man ska bli medlem
  *
  * @author Adam Drechsel
  *
  */
$passkey = $_GET['passkey'];

//hämta användare med motsvarande passkey
require_once("dbcx.php");
$dbh = dbcx();
$sql = "SELECT * FROM `temp_members_db` WHERE `confirm_code` = :passkey";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':passkey', $passkey);
$stmt->execute();
$user = $stmt->fetch();

if (empty($user)) {
	exit("Fel passkey");
} else {
	$email = $user['email'];
	$username = $user['username'];
	$pass = $user['password'];
	$salt = $user['salt'];
	
	//Lägg till användare i tabellen `users`
	$sql = "INSERT INTO `users`(`username`, `password`, `salt`, `email`)
					VALUES('$username', '$pass', '$salt', '$email')";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	
	//Ta bort användare från tabellen `temp_members_db`
	$sql = "DELETE FROM `temp_members_db` WHERE confirm_code = :passkey";
	$stmt = $dbh->prepare($sql);
	$stmt->bindParam(':passkey', $passkey);
	$stmt->execute();
}
 HEADER("location: register.php");
