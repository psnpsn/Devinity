<?php

require('utils/config.php');

//check if is already logged in
if( $user->is_logged_in() ) { 
	header('Location: dashboard.php'); exit(); 
	}

//sign up form php script
if(isset($_POST['inscri'])){
	if( ($_POST['username']=="") or ($_POST['password']=="") or ($_POST['passwordver']=="") or ($_POST['email']=="") ){
		$error[] = 'please fill all fields';
	} else {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		if ($user->isValidUser($username,$password)){
			$user->signUp($username,$password,$email);
			header('Location: registered.php');
		} else {
			$error[]='username and password must be at leats 3 characters long and maximum 17';
			if($password != $passwordver) $error[]='passwords does not match';
		}
	}
}

//page title
$title='Sign Up';

//include start of all documents start.php
require('layout/start.php'); 
?>	

<h1>Devinity</h1>
	<form class="signup" name="signup" action="" method="POST">
		<div class="textfields">
			<label for="username">username</label><input type="text" name="username" id="username">
		</div>

		<div class="textfields">
			<label for="password">password</label><input type="password" name="password" id="password">
		</div>
		<div class="textfields">
			<label for="passwordver">repeat password</label><input type="password" name="passwordver" id="passwordver">
		</div>

		<div class="textfields">
			<label for="email">e-mail</label><input type="e-mail" name="email" id="email">
		</div>

		<div name="actions" class="actions">
			<input type="submit" name="inscri" value="Sign Up">
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
			Already a member? Login <a href="login.php">here</a>
		</p>
	</div>

<?php
//include end of all documents end.php
require('layout/end.php'); 
?>