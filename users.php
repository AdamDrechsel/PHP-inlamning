<?php
 /*
  * Sidan som visas när man klickar på en specifik användare
  * Man kan se inlägg som användaren har gjort tidigare o.s.v
  *
  * @author Adam Drechsel
  */
session_start();
//Anslut till DB
require_once "dbcx.php";
$dbh = dbcx();

// Har man kommit via POST? = Antingen inloggning eller - om redan inloggad - uppdatering
// Inte via post?
// Inloggad? = Inte se loginform, se de jag följer(?)
// Inte inloggad = Se loginform, se senaste från alla (Publika/privata som extra feature i framtiden)

 function fetch_private_feed($username) {
    $dbh = dbcx();
    $sql = "SELECT * FROM `inlagg` ORDER BY ctime DESC LIMIT 0 , 30";
    // Framtid: JOIN users - för att hämta användardata till varje inlägg inkl avatar
    // Where skall få en "subscription" utökning - > Ny tabell krävs
    $stmt = $dbh->prepare($sql);
    // $stmt->bindParam();
    $stmt->execute();    
    return $stmt->fetchAll();

}

function fetch_public_feed() {
        $dbh = dbcx();
        //$sql = "SELECT * FROM `inlagg` ORDER BY ctime DESC LIMIT 0 , 30";
        $stmt = $dbh->prepare("SELECT `text`, `username`, `ctime` FROM `inlagg` WHERE `username` = :username ORDER BY ctime DESC LIMIT 0 , 30");
        $stmt->bindParam(':username', $_GET['u']);
        // Framtid: JOIN users - för att hämta användardata till varje inlägg inkl avatar
        $stmt->execute();
        return $stmt->fetchAll();
}
//if ( empty($_SESSION['username']) && empty($_POST) ) {
    // Publik feed - ej inloggad, inget inloggningsförsök
    $feed = fetch_public_feed();


?>
<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="utf-8" />
  <link rel=stylesheet HREF="index.css" TYPE="text/css">
  <title>PHP-inlämning</title>
</head>
<body>
    <div id="topbar">
        <p id="logginname"> Logged in as <a href="users.php?u=<?php echo $_SESSION['username'];?>" class="links"> <?php echo $_SESSION['username'];?></a></p>
            <a id="logout" href="logout.php">Logga ut </a>
    </div>
	<div id="main">
		<div id="sida2">
			<div id="inlagg">
	          <div id="sidebar">
				<p id="sitefeed">Senaste inlägget av användaren</p>
              </div> 
                <?php echo <<<INLAGG
                <h3 id="sinlagg"><a href="users.php?u={$feed[0]['username']}" class="links">{$feed[0]['username']}:</a></h3>
                <p>{$feed[0]['text']}</p>
                <p>{$feed[0]['ctime']}</p>
INLAGG;
?>
			</div>
			<div id="news">
              <div id="sidebar">
				<p id="sitefeed">News</p>
              </div> 
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
			<div id="mittbar">
				<a href="index.php" class="links" id="huvudsida">Tillbaka till huvudsidan</a>
				<p id="sitefeed">Uppdateringar av <?php echo $_GET['u'] ?> </p>
			</div>
			<?php 
				if (empty($feed)) {
					echo "<p>användaren finns inte</p>";
        } else {
        	foreach ( $feed as $inlagg ):
      ?>    
			<div id="an1">
				<h3 id="name"><a href="users.php?u=<?php echo $inlagg['username'];?>" class="links"><?php echo $inlagg['username']; ?>:</a></h3>
				<div id="statusbild">
					<p class="statustid"><?php echo $inlagg['ctime']; ?></p>
					<p class="status"><?php echo $inlagg['text']; ?></p>
				</div>        
			</div>
			<?php
    		endforeach;
    		}
    	?>
    	</div>
    </div>
	<div id="bottom">
		<p id="copyright">Copyright © Adam drechsel</p>
	</div>
</body>
</html>