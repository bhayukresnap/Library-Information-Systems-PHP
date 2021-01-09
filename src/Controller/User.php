<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/Database.php');

	class User extends Database{
		public function __construct(){
			parent::__construct();
			$this->table = "users";
			$this->columns = [
				'email',
				'name',
				'password',
				'role_id'
			];
		}

		public function insert($value){
			$insert = parent::insert($value);
			if(!$insert){
				$this->message = "$value[email] is already exist!";
			}else{
				$this->message = "$value[email] has been added to database!";
				$this->status = 1;
			}
			Helper::notification($this->message, $this->status);
			exit(header("location: ".Helper::currentURL()));
		}

		public function login($email, $password){
			$email = mysqli_real_escape_string($this->conn, $email);
			$password = mysqli_real_escape_string($this->conn, $password);
			$conditions = "where email = '$email' and password = '$password'";
			$user = json_decode(parent::select($conditions), true);
			if($email){
				switch (count($user)) {
					case 0:
						$this->message = "Please check Neither email nor password!";
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

		public function update($data){
			$update =  $this->conn->query("update $this->table set role_id='$data[role_id]' where id = '$data[id]'");
			if($update){
				Helper::notification("Data has been changed!", 1);
			}
		}

	}

 ?>