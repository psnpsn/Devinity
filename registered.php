<?php
require('utils/config.php');

//page title
$title='Login';

//include start of all documents start.php
require('layout/start.php'); 
?>	

<h1>Devinity</h1>
	<div>
		<p>
			Registration success, you will be redirected to the login page...
			<?php
			 header( "refresh:3; url=login.php" );
			 ?>
		</p>
	</div>

<?php
//include end of all documents end.php
require('layout/end.php'); 
?>