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
  
  <script language="JavaScript">

var timerID = null;
var timerRunning = false;

function stopclock (){
        if(timerRunning)
                clearTimeout(timerID);
        timerRunning = false;
}

function showtime () {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds()
        var timeValue = hours
        timeValue += ((minutes < 10) ? ":0" : ":") + minutes
        timeValue += ((seconds < 10) ? ":0" : ":") + seconds
        document.clock.face.value = timeValue;
        timerID = setTimeout("showtime()",1000);
        timerRunning = true;
}
function startclock () {
        stopclock();
        showtime();
}

</script>
</head>
<body onLoad="startclock()">
    <div id="topbar">
        <p id="logginname"> Logged in as <a href="users.php?u=<?php echo $feed['username'];?>" id="links"> <?php echo $_SESSION['username'];?></a></p>
            <a id="logout" href="logout.php">Logga ut </a>
    </div>
	<div id="main">
		<div id="sida2">
			<div id="inlagg">
				<h2>Senaste inlägget</h2>
                <?php echo <<<INLAGG
                <h3 id="sinlagg"><a href="users.php?u={$feed[0]['username']}" id="links">{$feed[0]['username']}:</a></h3>
                <p>{$feed[0]['text']}</p>
                <p>{$feed[0]['ctime']}</p>
INLAGG;
?>
			</div>
			<div id="klocka">
				<h2>Klocka</h2>
				<form name="clock" onSubmit="0">
  <div align="center"><center><p><input type="text" name="face" size="6" value> </p>
  </center></div>
</form>
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
				<h1 id="sitefeed">Site feeds</h1>
					<form method="post" action="inlagg.php">
						<textarea id="status" name="status" cols="55" rows="5" placeholder="Uppdatera här!"></textarea><br>
						<input id="dela" type="submit" value="dela" />
						<input id="uppload" type="submit" value="Lägg till" />
					</form>
            <?php foreach ( $feed as $inlagg ):
                

            ?>
			<div id="an1">
					<h3 id="name"><a href="users.php?u=<?php echo $inlagg['username'];?>" id="links"><?php echo $inlagg['username']; ?>:</a></h3>
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