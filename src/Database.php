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

		public function display($conditions = "", $select = '*'){
			$start = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] - 1 : 0;
			$limit = " limit ".($start * LIMIT_PER_PAGE).", ". LIMIT_PER_PAGE;
			$data = $this->select($conditions.$limit, $select);
			return json_encode(array(
				'data'=> json_decode($data, true),
				'page'=> $this->pagination($conditions),
			));
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

		public function pagination($conditions){
			$temp = ''; $data = [];
			$count = count(json_decode($this->select($conditions), true));
			$total_pages = ceil($count / LIMIT_PER_PAGE);
			if($total_pages <= 1) return "";
			$active = ''; $next = ''; $url = ''; $previous = '';
			$temp .= '<div class="d-flex justify-content-center mt-4">';
			$temp .= 	'<div>';
			$temp .=		'<ul class="pagination pagination-sm ">';
			if(!isset($_GET['page']) || empty($_GET['page']) || $_GET['page'] == 1){
				$next = Helper::pagePagination(2);
				$previous_disabled = "d-none";
			}else{
				if($_GET['page'] == $total_pages){
					$next_disabled = 'd-none';
				}
				$next = Helper::pagePagination($_GET['page'] + 1);
				$previous = Helper::pagePagination($_GET['page'] - 1);
			}
			$temp .= 	'<li class="page-item '.(isset($previous_disabled) ? $previous_disabled : "").'"><a class="page-link" href="'.$previous.'">«</a></li>';
			for($i = 1; $i <= $total_pages; $i++){
				$url = Helper::pagePagination($i);
				if(isset($_GET['page']) && !empty($_GET['page'])){
					if($_GET['page'] == $i){
						$active = 'active';
						$url = '#';
					}					
				}else{
					if($i == 1){
						$active = 'active';
						$url = '#';
					}
				}	
				$temp .= 		'<li class="page-item '.$active.'"><a class="page-link" href="'.$url.'">'.$i.'</a></li>';			
				$active = '';
			}
			$temp .= 			'<li class="page-item '.(isset($next_disabled) ? $next_disabled : "").'"><a class="page-link" href="'.$next.'">»</a></li>';
			$temp .= 		'</ul>';
			$temp .= 	'</div>';
			$temp .= '</div>';
			return $temp;
		}

		public function __destruct(){
			$this->conn->close();
		}
	}
 ?>