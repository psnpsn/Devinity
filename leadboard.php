<?php
require('utils/config.php');

//check if is already logged in
if( !$user->is_logged_in() ) { 
	header('Location: login.php'); exit(); 
	}

$row_one = $user->bestscore('one');
$row_two = $user->bestscore('two');
$row_three = $user->bestscore('three');


//page title
$title='Play';

//include start of all documents start.php
require('layout/start.php'); 
?>

<!-- HTML -->
<h1>Devinity</h1>
<h2>Level 1 - <span class="orange"><?php echo $row_one[0]." ".$row_one[1]; ?></span></h2>
<h2>Level 2 - <span class="orange"><?php echo $row_two[0]." ".$row_two[1]; ?></span></h2>
<h2>Level 3 - <span class="orange"><?php echo $row_three[0]." ".$row_three[1]; ?></span></h2>
<h2><a href="dashboard.php">Back</a></h2>


<?php
//include end of all documents end.php
require('layout/end.php'); 
?>