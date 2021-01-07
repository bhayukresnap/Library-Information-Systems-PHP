<?php 
	class Helper{
		public static function notification($message, $type = 0){
			$notification = array(
				"message"=>$message,
				"type"=>$type == 1 ? "success" : "danger",
				"icon"=>$type == 1 ? "check" : "exclamation-circle",
				"title"=> $type == 1 ? "Success : " : "Failed : ",
			);
			$_SESSION['notification'] = json_encode($notification);
		}

		public static function currentURL(){
			return "//".$_SERVER['HTTP_HOST'].strtok($_SERVER['REQUEST_URI'], '?');
		}

		public static function id_order_generator(){
			$temp_id = mt_rand(1,999999999);
			$zero = str_repeat("0", 9 - strlen($temp_id));
			return "ID".$zero.$temp_id;
		}

		public static function mapUpdate($columns, $data){
			if(isset($data["id"])) unset($data["id"]);
			return join(", ", array_map(function($key, $value){
				return $key." = \"".$value."\"";
			}, $columns, $data));
		}

		public static function mapInsert($data){
			if(isset($data["id"])) unset($data["id"]);
			if(!is_array($data)) return "'".$data."'";
			return join(", ", array_map(function($value){
				return "\"".$value."\"";
			}, $data));
		}

		public static function renameImage($image, $book_name){
			if(is_array($image)){
				$extension = pathinfo($image['name'], PATHINFO_EXTENSION);
			}else{
				$extension = "";
			}
			$image_name = IMG_PATH_DIR . preg_replace("/[^A-Za-z0-9?!]/", "_", strtolower(basename($book_name)));
			$full_path = $image_name . "." . $extension;
			return $full_path;
		}

		public static function pagePagination($value){
			$query = $_GET;
			$query['page'] = $value;
			$query_result = http_build_query($query);
			return $url = str_replace("/public", "", $_SERVER['PHP_SELF']).'?'.$query_result;
		}

		public static function imageVerification($image, $book_name){
			$message = '';
			$path = pathinfo($image['name'], PATHINFO_EXTENSION);
			$full_path = Helper::renameImage($image, $book_name);
			if(!empty($image['name'])){
				if(file_exists(PUBLIC_PATH.$full_path)){
					$message = "Book name is already exist!";
				}else{
					if($image['size'] < IMG_SIZE){
						if(in_array($path, IMG_EXTENSIONS)){
							if(move_uploaded_file($image['tmp_name'], PUBLIC_PATH.$full_path)){
								return $full_path;
							}
						}else{
							$message = "Please check your image format!";
						}
					}else{
						$message = "Please check your image size!";
					}
				}
			}else{
				$message = 'Image cannot be empty!';
			}
			!empty($message) ? Helper::notification($message) : "";	
			return 0;					
		}

	}
 ?>