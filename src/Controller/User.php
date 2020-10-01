<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/Database.php');

	class User extends Database{
		public function __construct(){
			parent::__construct();
			$this->table = "users";
		}

		public function login($email, $password){
			$email = mysqli_real_escape_string($this->conn, $email);
			$password = mysqli_real_escape_string($this->conn, $password);
			$conditions = "where email = '$email' and password = '$password'";
			$user = json_decode(parent::select($conditions), true);
			if($email){
				switch (count($user)) {
					case 0:
						$this->message = "Your account isn't exist!";
						break;
					case 1:
						$_SESSION['user'] = $user[0];
						exit(header('Location: /index.php'));
						break;
					default:
						$this->message = "Something's wrong with your account";
						break;
				}
			}else{
				$this->message = "Email can not be empty!";
			}
			
			if($this->message){
				Helper::notification($this->message);
				exit(header("Location: /login"));
			}
			
		}

	}

 ?>