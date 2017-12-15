<?php
require('utils/config.php');

//check if is already logged in
if( $user->is_logged_in() ) { 
	header('Location: dashboard.php'); exit(); 
	}


//page title
$title='Login';

//include start of all documents start.php
require('layout/start.php'); 
?>

<!-- HTML -->

<?php
//include end of all documents end.php
require('layout/end.php'); 
?>