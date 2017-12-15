<?php
class User {
    private $_pdo;
    function __construct($pdo){
    	$this->_pdo = $pdo;
    }
	private function get_user($username,$password){
		try {
			$stmt = $this->_pdo->prepare('SELECT password, username, user_id FROM users WHERE username = :username AND password = :password');
			$stmt->execute(array('username' => $username, 'password' => $password));
			return $stmt->fetch();
		} catch(PDOException $e) {
		    echo '<p> '.$e->getMessage().'</p>';
		    return false;
		}
	}

	private function create_user($username,$password,$email){
		try{
			$stmt = $this->_pdo->prepare("INSERT INTO users (username,password,email,creation_date) VALUES ( :username , :password , :email , NOW() )");
			$stmt->execute(array('username' => $username, 'password' => $password, 'email' => $email));
			return true;
		} catch(PDOException $e) {
			echo '<p> '.$e->getMessage().'</p>';
		    return false;
		}
	}

	public function isValidUser($username,$password){
		if (strlen($username) < 3) return false;
		if (strlen($username) > 17) return false;
		if (!ctype_alnum($username)) return false;
		if (strlen($password) < 3) return false;
		if (strlen($password) > 17) return false;
		return true;
	}


	public function login($username,$password){
		if (!$this->isValidUser($username,$password)) return false;
		if (strlen($password) < 3) return false;
		$row = $this->get_user($username,$password);
		if($row != false){
		    $_SESSION['loggedin'] = true;
		    $_SESSION['username'] = $row['username'];
		    $_SESSION['user_id'] = $row['user_id'];
		    return true;
		} else return false;
	}

	public function signUp($username,$password,$email){
		if (!$this->isValidUser($username,$password)) return false;
		if (strlen($password) < 3) return false;
		$this->create_user($username,$password,$email);
	}

	public function logout(){
		session_destroy();
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
		return false;
	}
}
?>