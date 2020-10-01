<?php 
	require_once($_SERVER["DOCUMENT_ROOT"]."/src/Database.php");
	class Book extends Database{
		public function __construct(){
			parent::__construct();
			$this->table = "books";
			$this->columns = [
				'book_name',
				'book_description',
				'price_before',
				'price_after',
				'rack_id',
				'quantity',
				'book_year',
				'publisher_id',
				'book_type_id',
				'book_image',
			];
		}

		function delete($id){
			$check = $this->select("where id = $id");
			$delete = parent::delete($id);
			if($delete){
				unlink(PUBLIC_PATH . json_decode($check, true)[0]['book_image']);
				exit(header("location: ".Helper::currentURL()));
			}
		}

		public function update($data){
			$tags = $data['tags'];
			$image = $data['book_image'];
			$prev_image = $data['current_image'];
			unset($data['book_image'], $data['tags'], $data['current_image']);
			// foreach($data as $key => $value){
			// 	if(empty($value) && $key != 'price_after'){
			// 		Helper::notification("Please check your the data correctly!");
			// 		return;
			// 	}
			// }
			if(!empty($image)){
				unlink(PUBLIC_PATH . $prev_image);
				$image = Helper::imageVerification($image, $data['book_name']);
				Helper::notification($image);
			}else{
				$image = Helper::renameImage($image, $data['book_name']) . substr($prev_image, strpos($prev_image, ".") + 1);
				$image_rename = 1;
			}
			
			$update = parent::update($data);
			if($update){
				$this->conn->query("update books set book_image = '$image' where id = '$data[id]';");
				if(isset($image_rename)) rename(PUBLIC_PATH . $prev_image, PUBLIC_PATH . $image);
				$this->conn->query("delete from books_tags where book_id = $data[id];");
				if(!empty($tags)){
						$sql = '';
						foreach($tags as $tag){
							$sql .= "INSERT INTO books_tags (book_id, tag_id) VALUES ('$data[id]', '$tag');";
						}
						mysqli_multi_query($this->conn, $sql);
					}
				Helper::notification("$data[book_name] has been successfully updated to database!", 1);
				return;
			}else{
				Helper::notification("Duplicate Entry Found!");
			}

		}

		public function insert($data){
			$tags = $data['tags'];
			$image = $data['book_image'];
			unset($data['book_image'], $data['tags']);
			foreach($data as $key => $value){
				if(empty($value) && $key != 'price_after'){
					Helper::notification("Please check your the data correctly!");
					return;
				}
			}
			$check = $this->select('where book_name = '.trim($data['book_name']));
			if(count(json_decode($check, true)) >= 1){
				//link(PUBLIC_PATH . $image);
				Helper::notification("This book is already exist!");
				return;
			}else{
				$image = Helper::imageVerification($image, $data['book_name']);
				if($image){
					$data['book_image'] = $image;
					$insert = parent::insert($data);
					if($insert){
						if(!empty($tags)){
							$sql = '';
							$last_id = $this->conn->insert_id;
							foreach($tags as $tag){
								$sql .= "INSERT INTO books_tags (book_id, tag_id) VALUES ('$last_id', '$tag');";
							}
							mysqli_multi_query($this->conn, $sql);
						}
						Helper::notification("$data[book_name] has been successfully added to database!", 1);
						return;
					}else{
						//link(PUBLIC_PATH . $image);
						// Helper::notification("This book is already exist!");
						// return;
					}
				}
			}
			
			return;
		}

	}

 ?>