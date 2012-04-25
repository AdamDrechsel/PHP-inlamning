<?php
 /*
  * author Adam Drechsel
  *
  * @todo fixa så att man kan gå till index.php utan att vara inloggad, får göra en sorts if-sats
  */
 
session_start();
//Anslut till DB
require_once "dbcx.php";
$dbh = dbcx();

// Har man kommit via POST? = Antingen inloggning eller - om redan inloggad - uppdatering
// Inte via post?
// Inloggad? = Inte se loginform, se de jag följer(?)
// Inte inloggad = Se loginform, se senaste från alla (Publika/privata som extra feature i framtiden)

 /*function fetch_private_feed($username) {
    $dbh = dbcx();
    $sql = "SELECT * FROM `inlagg` ORDER BY ctime DESC LIMIT 0 , 30";
    // Framtid: JOIN users - för att hämta användardata till varje inlägg inkl avatar
    // Where skall få en "subscription" utökning - > Ny tabell krävs
    $stmt = $dbh->prepare($sql);
    // $stmt->bindParam();
    $stmt->execute();    
    return $stmt->fetchAll();

}
*/
function fetch_public_feed() {
        $dbh = dbcx();
        //$sql = "SELECT * FROM `inlagg` ORDER BY ctime DESC LIMIT 0 , 30";
        $stmt = $dbh->prepare("SELECT u.username, u.image, i.id, i.text, i.ctime FROM `users` AS u INNER JOIN (inlagg AS i) ON (i.username = u.username)
        ORDER BY ctime DESC LIMIT 0 , 30");
        // Framtid: JOIN users - för att hämta användardata till varje inlägg inkl avatar
        $stmt->execute();
        return $stmt->fetchAll();
}
if ( empty($_SESSION['username']) && empty($_POST) ) {
    var_dump($_SESSION);
    // Publik feed - ej inloggad, inget inloggningsförsök
    $feed = fetch_public_feed();
} elseif ( empty($_POST) ) {
    // Inloggad men tittar bara på sidan
   // $feed = fetch_private_feed();
    // vad vill du visa här?
    
} elseif ( empty($_SESSION['username']) ) {
    // Inlogningsförsök 
    // Kolla om försöket lyckats
    
    // Om det lyckas -> Visa privat feed
    $feed = fetch_private_feed();

    // Om det misslyckas -> Felmmeddelanden i formulär + publik feed

} else {
    // Uppdateringsförsök
    // Kontrollera max och min längd etc
    // Om kontroller stämmer -> INSERT INTO....
    // Lyckat? Visa privat feed
    
    // Misslyckat? Visa formulär igen (samt privat feed nedanför)
}

// $stmt->bindParam();
    /*$stmt->execute();
    $data = $stmt->fetchAll();
foreach ( $data as $value ) {
    $username = $value['username'];
    $text = $value['text'];
}
*/

?>
<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="utf-8" />
  <link rel=stylesheet HREF="index.css" TYPE="text/css">
  <title>PHP-inlämning</title>
</head>
<body>
    <p> Logged in as <?php echo $_SESSION['username'];?></p>
    <a href="logout.php">Logga ut </a>
	<div id="login">	
			<p>
				<label id="user" for="username">Username :</label>
				<input type="text" name="Username" id="username" value="" />
			</p>
			<p> 
				<label id="pass" for="password">Password :</label>
				<input type="password" name="pass" id="password" />
			</p>
			<p>
				<label id="remem" for="remember">Remember me</label>
				<input type="checkbox" name="remember" id="remember" />
			</p>
			<p id="reglog">
				<a id="reg" href="register.php">Register</a>
				<input id="log" type="submit" value="Login" />
			</p>
	</div>
	<div id="logga">
	</div>
	<div id="main">
		<div id="sida2">
			<div id="inlagg">
				<h2>Senaste inläggen</h2>
				<p> lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet</p>
			</div>
			<div id="klocka">
				<h2>Klocka</h2>
				<p id="time">02:14</p>
				<p id="namnsdag">Adam & Eva</p>
			</div>
			<div id="news">
				<h2>Site news</h2>
				<p>lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet 
				lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet
				lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet 
				lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet 
				lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet 
				lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet 
				lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet 
				lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet 
				lorem ipsum dolor sit amet lorem ipsum dolor sit amet </p>
			</div>
		</div>
		<div id="mitt">
			<div id="menu">
				<ul id="nav">
					<li><a href="">Home</a></li>
					<li><a href="">Info</a></li>
					<li><a href="">lorem</a></li>
					<li><a href="">ipsum</a></li>
					<li><a href="">dolor</a></li>
					<li><a href="">sit</a></li>
					<li><a href="">amet</a></li>
				</ul>
			</div>
				<h1 id="sitefeed">Site feeds</h1>
					<form method="post" action="inlagg.php">
						<textarea id="status" name="status" cols="55" rows="5" placeholder="Uppdatera här!"></textarea><br>
						<input id="dela" type="submit" value="dela" />
						<input id="uppload" type="submit" value="Lägg till" />
					</form>
            <?php foreach ( $feed as $inlagg ):
                

            ?>
			<div id="an1">
				<img src="ansikte1.jpg" class="ansikten" />
					<h3><a href="users.php?u=<?php echo $inlagg['username'];?>"><?php echo $inlagg['username']; ?>:</a></h3>
						<p class="status"><?php echo $inlagg['text']; ?>
						</p>
			</div>
            <?php endforeach; ?>
		</div>
	</div>
	<div id="bottom">
		<p id="copyright">Copyright © Adam drechsel</p>
	</div>
</body>
</html>