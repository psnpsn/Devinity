<?php
include('password.php');
class User extends Password{
    private $_pdo;
    function __construct($pdo){
    	parent::__construct();
    	$this->_pdo = $pdo;
    }
	private function get_user_hash($username){
		try {
			$stmt = $this->_pdo->prepare('SELECT password, username, user_id FROM users WHERE username = :username');
			$stmt->execute(array('username' => $username));
			return $stmt->fetch();
		} catch(PDOException $e) {
		    echo '<p>'.$e->getMessage().'</p>';
		}
	}
	public function isValidUsername($username){
		// if (strlen($username) < 3) return false;
		// if (strlen($username) > 17) return false;
		// if (!ctype_alnum($username)) return false;
		return true;
	}
	public function login($username,$password){
		if (!$this->isValidUsername($username)) return false;
		if (strlen($password) < 3) return false;
		$row = $this->get_user_hash($username);
		if($this->password_verify($password,$row['password']) == 1){
		    $_SESSION['loggedin'] = true;
		    $_SESSION['username'] = $row['username'];
		    $_SESSION['user_id'] = $row['user_id'];
		    return true;
		}
	}
	public function logout(){
		session_destroy();
	}
	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}
}
?>