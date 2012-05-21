<?php
 /*
  * Själva huvudsidan, gör det möjligt att uppdatera sin status, samt kolla på andras uppdateringar 
  * Man kan även klicka sig vidare till andra användare och se vad dom har skrivit tidigare.
  *
  * @author Adam Drechsel
  *
  *
  */
 
session_start();
//Anslut till DB
require_once "dbcx.php";
$dbh = dbcx();
// kollar ifall du är inloggad, om inte, gå till register.php
if(!isset($_SESSION['username'])){
    HEADER("location: register.php");
}

// funktioner som gör det möjligt att uppdatera statusar, har två olika, för i framtid kunna ha en sida som man inte behöver vara
// inloggad på, tänkte det från början men det blev inte som jag ville, så körde med detta istället.
 function fetch_private_feed() {
    $dbh = dbcx();
    $sql = "SELECT * FROM `inlagg` ORDER BY ctime DESC LIMIT 0 , 30";
    // Framtid: JOIN users - för att hämta användardata till varje inlägg inkl avatar
    // Where skall få en "subscription" utökning - > Ny tabell krävs
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':inlagg', $_POST['inlagg'] );
    $stmt->execute();    
    return $stmt->fetchAll();

}


function fetch_public_feed() {
        $dbh = dbcx();
        //$sql = "SELECT * FROM `inlagg` ORDER BY ctime DESC LIMIT 0 , 30";
        $stmt = $dbh->prepare("SELECT u.username, u.image, i.id, i.text, i.ctime FROM `users` AS u INNER JOIN (inlagg AS i) ON (i.username = u.username)
        ORDER BY ctime DESC LIMIT 0 , 30");
        // Framtid: JOIN users - för att hämta användardata till varje inlägg inkl avatar
        $stmt->execute();
        return $stmt->fetchAll();
}
// kollar om du är inloggad eller ej, lite onödigt nu men bra för framtiden.
if ( empty($_SESSION['username']) && empty($_POST) ) {
    // Publik feed - ej inloggad, inget inloggningsförsök
    $feed = fetch_public_feed();
} elseif ( empty($_POST) ) {
    // Inloggad men tittar bara på sidan
    $feed = fetch_private_feed();    
} elseif ( empty($_SESSION['username']) ) {
    // Inlogningsförsök 
    // Kolla om försöket lyckats
    
    // Om det lyckas -> Visa privat feed
    $feed = fetch_private_feed();

    // Om det misslyckas -> Felmmeddelanden i formulär + publik feed

}

?>
<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="utf-8" />
  <link rel=stylesheet HREF="index.css" TYPE="text/css">
  <title>PHP-inlämning</title>
 
<body>
    <div id="topbar">
    <!-- Här fixar jag så att man ser sitt användarnamn samt en link så att man kan se sina tidigare uppdateringar -->
        <p id="logginname"> Logged in as <a href="users.php?u=<?php echo $_SESSION['username'];?>" class="links"> <?php echo $_SESSION['username'];?></a></p>
            <a id="logout" href="logout.php">Logga ut </a>
    </div>
	<div id="main">
		<div id="sida2">
			<div id="inlagg">
              <div id="sidebar">
				<p id="sitefeed">Senaste inlägget</p>
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
				<p id="sitefeed">Uppdateringar</p>
            </div>    
					<form method="post" action="inlagg.php">
						<textarea id="status" name="status" cols="55" rows="5" placeholder="Uppdatera här!"></textarea><br>
						<input id="dela" type="submit" value="dela" />
					</form>
            <?php foreach ( $feed as $inlagg ):
                

            ?>
			<div id="an1">
					<h3 id="name"><a href="users.php?u=<?php echo htmlspecialchars($inlagg['username']);?>" class="links"><?php echo $inlagg['username']; ?>:</a></h3>
                            <div id="statusbild">
                                    <p class="statustid"><?php echo $inlagg['ctime']; ?></p>
                                    <p class="status"><?php echo $inlagg['text']; ?></p>    
                            </div>        
			</div>
            <?php endforeach; ?>
		</div>
	</div>
	<div id="bottom">
		<p id="copyright">Copyright © Adam drechsel</p>
	</div>
</body>
</html>