<?php
header("content-type: text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="sv">
<head>
  <link rel=stylesheet HREF="index.css" TYPE="text/css">
  <title>PHP-inlämning</title>
</head>
<body>
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
				<p>abdo ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet 
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
					<li><a href="index.php">Home</a></li>
					<li><a href="">Info</a></li>
					<li><a href="">lorem</a></li>
					<li><a href="">ipsum</a></li>
					<li><a href="">dolor</a></li>
					<li><a href="">sit</a></li>
					<li><a href="">amet</a></li>
				</ul>
			</div>
			<h3>Register</h3>
		</div>
	</div>
	<div id="bottom">
		<p id="copyright">Copyright © Adam drechsel</p>
	</div>
</body>
</html>