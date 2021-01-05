<?php 
	require_once($_SERVER["DOCUMENT_ROOT"]."/src/Database.php");
	class Shoppingcart extends Database{
		public function __construct(){
			parent::__construct();
			$this->table = "shopping_cart";
			$this->columns = [
				"user_id",
			];
			if(empty(json_decode($this->select('where user_id = '.$_SESSION['user']['id'])))){
				parent::insert($_SESSION['user']['id']);
			}
		}

		public function insert($value){
			$shopping_cart = json_decode($this->select("where user_id = '".$_SESSION['user']['id']."'"), true)[0]['id'];
			$sql = "insert into shopping_cart_details (shopping_cart_id, book_id) values ('$shopping_cart','$value')";
			if($this->conn->query($sql)){
				Helper::notification("Successfully added!", 1);
			}
		}

		public function deleteBook($id){
			$check = json_decode($this->select("where user_id = '".$_SESSION['user']['id']."'"), true);
			if(count($check) >= 1){
				$delete =  $this->conn->query("delete from shopping_cart_details where book_id = '$id' and shopping_cart_id = '".$check[0]['id']."'");
				Helper::notification("Data has been successfully removed!", 1);
				return 1;
			}
			//exit(header("location: ".Helper::currentURL()));
			return 0;
		}
	}	

 ?>