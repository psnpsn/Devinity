<?php 
//include config
require_once('utils/config.php');

//check if is already logged in
if( $user->is_logged_in() ) { 
	header('Location: dashboard.php'); exit(); 
	}

//login form php script
if(isset($_POST['connect'])){
	if ( ($_POST['username']=="") or ($_POST['password']=="") ) { $error[] = 'please enter a username and password'; }
	else {
		$username = $_POST['username'];
		$password = $_POST['password'];
		if ( $user->isValidUser($username,$password)){
			if($user->login($username,$password)){
				$_SESSION['username'] = $username;
				header('Location: dashboard.php');
				exit;
			} else {
				$error[] = 'wrong username or password';
			}
		}else{
			$error[] = 'usernames must be Alphanumeric, and between 3-16 characters long';
		}
	}																															
}

//page title
$title='Login';

//include start of all documents start.php
require('layout/start.php'); 
?>	
	<h1>Devinity</h1>
	<form class="login" name="login" action="" method="POST">
		<div class="textfields">
			<label for="username">username</label><input type="text" name="username" id="username">
		</div>

		<div class="textfields">
			<label for="password">password</label><input type="password" name="password" id="password">
		</div>

		<div name="actions" class="actions">
			<input type="submit" name="connect" value="Login">
			<a href="#">I forgot my password</a>
		</div>
	</form>
	<div class="account">
		<p>
			<?php
				if(isset($error)){
					foreach($error as $error){
						echo $error;
					}
				}
				
			?> 
			No account? Create new account <a href="signup.php">here</a>
		</p>
	</div>

<?php
//include end of all documents end.php
require('layout/end.php'); 
?>