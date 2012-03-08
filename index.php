<?php
 /*
  * @author Adam Drechsel
  *
  * @todo fixa så att man kan gå till index.php utan att vara inloggad, får göra en sorts if-sats
  */
 
 session_start();
 var_dump($_SESSION);
  //Anslut till DB
  require_once "dbcx.php";
  $dbh = dbcx();
 

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
					<form method="post" action="">
						<textarea id="status" name="status" cols="55" rows="5" value="Uppdatera här!">
							Uppdatera här!
						</textarea><br>
						<input id="dela" type="submit" value="Dela" />
						<input id="uppload" type="submit" value="Lägg till" />
					</form>
			<div id="an1">
				<img src="ansikte1.jpg" class="ansikten" />
					<h3>Adam :</h3>
						<p class="status"> ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet 
				lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet
						</p>
			</div>
			<div id="an2">
				<img src="ansikte2.jpg" class="ansikten" />
				<h3>Linus :</h3>
					<p class="status">ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet 
				lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet
					</p>
			</div>
			<div id="inlaggold">
				<h3 id="inlaggold1">Äldre inlägg</h3>
			</div>
		</div>
	</div>
	<div id="bottom">
		<p id="copyright">Copyright © Adam drechsel</p>
	</div>
</body>
</html>