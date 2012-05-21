<?php
    /*
    * Sidan som visas när man ska registrera sitt konto.
    * Man kan inte komma till index.php utan att ha gått via denna.
    * Man kan både registrera sig samt logga in på denna sidan
    *
    *
    * @author Adam Drechsel
    */
header("content-type: text/html;charset=utf-8");
session_start();
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
    </div>
	<div id="main">
		<div id="sida2">
			<div id="newsreg">
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
						<?php
							if(!empty($_SESSION['msg'])) {
								echo "<p>{$_SESSION['msg']}</p>";
								$_SESSION['msg'] = "";
							}
						?>
						<p>
						<label for="user">Användarnamn:</label>
						</p>
						<p>
						<input type="text" name="user" id="user" />
						<?php 
						if (!empty ($_SESSION['user_msg'])){
							echo $_SESSION['user_msg'];
							$_SESSION['user_msg'] = "";
						}
						?>
						</p>
						<p>
						<label for="pass">Lösenord:</label>
						</p>
						<p>
						<input type="password" name="pass" id="pass" />
						<?php 
						if (!empty ($_SESSION['pass_msg'])) {
							echo $_SESSION['pass_msg'];
							$_SESSION['pass_msg'] = "";
						}
						?>
						</p>
						<input type="submit" value="Logga in" />
					</form>
					<form action="register-user.php" method="post">
						<h2>Registrera</h2>
						<?php
						if(!empty($_SESSION['reg_msg'])) {
							echo "<p>{$_SESSION['reg_msg']}</p>";
							$_SESSION['reg_msg'] = "";
						}
						?>
						<p>
							<label for="reg-user">Användarnamn:</label>
						</p>
						<p>
						<input type="text" name="username" id="reg-user" value="<?php if(!empty($_SESSION['reg-user_value'])){echo $_SESSION['reg-user_value'];} ?>" />
							<?php
							if(!empty($_SESSION['reg-user_msg'])) {
								echo $_SESSION['reg-user_msg'];
								$_SESSION['reg-user_msg'] = "";
							}
							?>
						</p>
						<p>
							<label for="reg-pass">Lösenord:</label>
						</p>
						<p>
							<input type="password" name="password" id="reg-pass" value="<?php if(!empty($_SESSION['reg-pass_value'])){echo $_SESSION['reg-pass_value'];} ?>" />
						</p>
						<p>
							<label for="reg-pass2">Repetera lösenord</label>
						</p>
						<p>
							<input type="password" name="password2" id="reg-pass2" value="<?php if(!empty($_SESSION['reg-pass2_value'])){echo $_SESSION['reg-pass2_value'];} ?>" />
							<?php
							if(!empty($_SESSION['reg-pass_msg'])) {
								echo $_SESSION['reg-pass_msg'];
								$_SESSION['reg-pass_msg'] = "";
							}
							?>
						</p>
						<p>
							<label for="email">Email:</label>
						</p>
						<p>
							<input type="email" name="email" id="email" value="<?php if(!empty($_SESSION['email_value'])){echo $_SESSION['email_value'];} ?>" />
							<?php
							if(!empty($_SESSION['email_msg'])) {
								echo $_SESSION['email_msg'];
								$_SESSION['email_msg'] = "";
							}
							?>
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
<?php
	$_SESSION['reg-user_value'] = "";
	$_SESSION['reg-pass_value'] = "";
	$_SESSION['reg-pass2_value'] = "";
	$_SESSION['email_value'] = "";