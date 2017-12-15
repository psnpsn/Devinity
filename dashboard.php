<?php
require('utils/config.php');

if( !$user->is_logged_in() ) { 
	header('Location: login.php'); exit(); 
	}

//page title
$title='Welcome';

//include start of all documents start.php
require('layout/start.php'); 
?>

<h1>Devinity</h1>
<div>
	<h2><a href='play.php'>Play</a></h2>
	<h2>My scores</h2>
	<h2>Leadboard</h2>
	<h2><a href='logout.php'>Logout</a></h2>
</div>

<?php
//include end of all documents end.php
require('layout/end.php'); 
?>