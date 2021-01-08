<?php 
	require_once($_SERVER["DOCUMENT_ROOT"]."/src/Database.php");
	class Order extends Database{

		public function __construct(){
			parent::__construct();
			$this->table = "orders";
			$this->columns = [
				'id',
				'user_id',
				'status',
			];
		}
		public function insert($value){
			$books = json_decode($value['book_list'], true);
			unset($value['book_list']);
			parent::insert($value);
			$sql = '';
			foreach($books as $book){
				$sql .= "INSERT INTO order_details (order_id, book_id) VALUES ('$value[order_id]','$book[book_id]');";
			}
			$sql .= "delete from shopping_cart where user_id = ".$_SESSION['user']['id'];
			if($this->conn->multi_query($sql)){
				Helper::notification("Order has been created!", 1);
			}else{
				Helper::notification("There is a problem with your order!", 2);
				return parent::delete($value['order_id']);
			}
		}

		public function update($data){
			$update =  $this->conn->query("update $this->table set status='$data[status]' where id = '$data[id]'");
			if($update){
				Helper::notification("Order status has been changed!", 1);
			}
		}

	}


 ?>