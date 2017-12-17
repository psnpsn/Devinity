<?php
require('utils/config.php');

//check if is already logged in
if( !$user->is_logged_in() ) { 
	header('Location: login.php'); exit(); 
	}



//page title
$title='Play';

//include start of all documents start.php
require('layout/start.php'); 
?>

<!-- HTML -->
<h1>Devinity</h1>
<h2><a href="levelone.php">Level 1</a></h2>
<h2><a href="leveltwo.php">Level 2</a></h2>
<h2><a href="levelthree.php">Level 3</a></h2>
<h2><a href="dashboard.php">Back</a></h2>


<?php
//include end of all documents end.php
require('layout/end.php'); 
?>