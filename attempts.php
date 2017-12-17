<?php
require("utils/config.php");

if( isset($_GET['value']) & isset($_GET['level']) ){
	$level = $_GET['level'];
	$attempts = $_GET['value'];
	$result=$user->updateScore($level,$attempts);
	echo $result;
}

?>