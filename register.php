<?php
header("content-type: text/html;charset=utf-8");
session_start();
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
    </div>
	<div id="main">
		<div id="sida2">
			<div id="klocka">
               <div id="sidebar">
				<p id="sitefeed">Klocka</p>
              </div> 
				<form name="clock" onSubmit="0">
  <div align="center"><center><p><input type="text" name="face" size="6" value> </p>
  </center></div>
</form>
				<p id="namnsdag">Adam & Eva</p>
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
				<p id="sitefeed">Registrering/Inloggning</p>
            </div>    
					<form action="login.php" method="post">
						<h2>Logga in</h2>
						<p>
						<label for="user">Username:</label>
						</p>
						<p>
						<input type="text" name="user" id="username" />
						</p>
						<p>
						<label for="pass">Password:</label>
						</p>
						<p>
						<input type="password" name="pass" id="password" />
                           <?php if (!empty ($_SESSION['fel'])){
                                echo $_SESSION['fel'];
                            }
                            ?>
						</p>
						<input type="submit" value="Logga in" />
					</form>
					<form action="register-user.php" method="post">
						<h2>Registrera</h2>
						<p>
						<label for="user">Username:</label>
						</p>
						<p>
						<input type="text" name="username" id="username" />
						</p>
						<p>
						<label for="pass">Password:</label>
						</p>
						<p>
						<input type="password" name="password" id="password" />
						</p>
						<input type="submit" value="Registrera" />
					</form>
		</div>
	</div>
	<div id="bottom">
		<p id="copyright">Copyright © Adam drechsel</p>
	</div>
</body>
</html>