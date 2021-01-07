<?php 
	define("DATABASE",[
		"server"=>"localhost",
		"username"=>"root",
		"password"=>"",
		"dbname"=>"library",
	]);

	define("BACK", "javascript://history.go(-1)");
	define("LIMIT_PER_PAGE", 20);
	define("IMG_SIZE", 1048576);
	define("IMG_PATH_DIR", '/images/');
	define("IMG_EXTENSIONS", ['jpg', 'jpeg', 'png', 'gif']);
	define("PUBLIC_PATH", $_SERVER['DOCUMENT_ROOT']."/public/");
	date_default_timezone_set("Asia/Bangkok");
	define("DATE", date("Y-m-d h:i:s"));
 ?>