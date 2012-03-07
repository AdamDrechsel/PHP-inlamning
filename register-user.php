<?php
//connectar till DB te-12-adam
require_once "dbcx.php";
$dbh = dbcx();

//Kollar om användarnamnet är ledigt
$sql = "SELECT `username` FROM `users` WHERE `username` = :username";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':username', $_POST['username']);
$stmt->execute();
$user = $stmt->fetch();
if ($user) {
    echo "Användarnamnet är upptaget";
}

//registrerar ny användare
else {
    //genererar salt ifrån generate-salt.php
    require_once "generate-salt.php";
    $salt = generateSalt();
    $pass = crypt($_POST['password'], '$6$' . $salt . '$');
    $sql = "INSERT INTO `users`(`username`, `password`) VALUES (:username, :password)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':password', $pass);
    $stmt->execute();
}
