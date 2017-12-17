<?php
class User {
    private $_pdo;
    function __construct($pdo){
    	$this->_pdo = $pdo;
    }
	private function get_user($username,$password){
		try {
			$stmt = $this->_pdo->prepare('SELECT password, username, user_id, best_one, best_two, best_three FROM users WHERE username = :username AND password = :password');
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
		} catch(PDOException $e) {
			echo '<p> '.$e->getMessage().'</p>';
		    return false;
		}
		return true;
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
		    $_SESSION['best_one'] = $row['best_one'];
		    $_SESSION['best_two'] = $row['best_two'];
		    $_SESSION['best_three'] = $row['best_three'];
		    return true;
		} else return false;
	}

	public function signUp($username,$password,$email){
		if (!$this->isValidUser($username,$password)) return false;
		if (strlen($password) < 3) return false;
		$this->create_user($username,$password,$email);
	}

	public function updateScore($level,$n){
		if ($_SESSION['best_'.$level] > $n){	
			if ($this->update_bestscore($level,$n)){
				$_SESSION['best_'.$level]=$n;
				return true;
			}
		}
		return false;
	}

	private function update_bestscore($level,$n){
		try {
			$column = 'best_'.$level;
			$stmt = $this->_pdo->prepare("UPDATE users SET ".$column." = :n WHERE user_id = :user_id");
			$stmt->execute(array('n' => $n , 'user_id' => $_SESSION['user_id']));
		} catch(PDOException $e) {
		    echo '<p> '.$e->getMessage().'</p>';
		    return false;
		}
		return true;
	}

	public function bestscore($level){
		try {
			$column = 'best_'.$level;
			$stmt = $this->_pdo->prepare("SELECT username,".$column." FROM users WHERE ".$column." = ( SELECT MIN(".$column.") FROM users )");
			$stmt->execute();
			return $stmt->fetch();
		} catch(PDOException $e) {
		    echo '<p> '.$e->getMessage().'</p>';
		    return false;
		}
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