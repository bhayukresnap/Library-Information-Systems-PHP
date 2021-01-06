<?php 
	require_once($_SERVER["DOCUMENT_ROOT"]."/src/Database.php");
	class Order extends Database{

		public function __construct(){
			parent::__construct();
			$this->table = "orders";
			$this->columns = [
				"id",
				"user_id",
				"date",
				"status",
			];
		}

	}


 ?>