<?php

// get conncetion parameters from .ini file
$params = parse_ini_file('database.ini');

session_start();

try {
	// create pdo 
		$context = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
                $params['host'], 
                $params['port'], 
                $params['database'], 
                $params['user'], 
                $params['password']);
 
        $pdo = new PDO($context);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	
} catch(PDOException $e) {
	//show error
    echo '<h1>'.$e->getMessage().'</h1>';
    exit;
}

//include the user class and create user wit connection
include('class/user.php');
$user = new User($pdo);

?>