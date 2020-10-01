<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/src/Helper.php');
	class Database{	
		protected $conn, $utf = 'utf8'; // Database connection
		protected $table, $columns; // Database table
		protected $message = "", $status = 0; // Notification
		public function __construct(){
			$this->conn = new mysqli(DATABASE['server'], DATABASE['username'], DATABASE['password'], DATABASE['dbname']);
			$this->conn->set_charset($this->utf);
			if(!$this->conn) die("Connection Failed: ". mysqli_connect_error());
		}

		public function select($conditions = "", $select = '*'){
			$data = [];
			$rows = $this->conn->query('select '.$select.' from '.$this->table.' '.$conditions);
			while($row = $rows->fetch_assoc()) $data[] = $row;
			return json_encode($data);
		}

		public function update($data){
			return $this->conn->query("update $this->table set ".Helper::mapUpdate($this->columns, $data)." where id = '$data[id]'");
		}

		public function insert($value){
			return $this->conn->query("insert into $this->table (".join(", ",$this->columns).") values (".Helper::mapInsert($value).")");
		}

		public function delete($id){
			$check = $this->select("where id = $id");
			if(count(json_decode($check, true)) >= 1){
				$delete =  $this->conn->query("delete from $this->table where id = $id");
				Helper::notification("Data has been successfully removed!", 1);
				return 1;
			}
			//exit(header("location: ".Helper::currentURL()));
			return 0;
		}

		public function __destruct(){
			$this->conn->close();
		}
	}
 ?>