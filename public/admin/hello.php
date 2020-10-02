<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/AdminSession.php');
	$query = $_GET;
// replace parameter(s)
$query['d'] = 'new_value';
// rebuild url
$query_result = http_build_query($query);
// new link
print($_SERVER['PHP_SELF']);
	echo "<br><br><br><br>";
	function chess($x, $y){
		$temp = 0;
		for($i = 0; $i<$y; $i++){
			for($j = 0; $j < $x; $j++){
				$temp < 0 ? print("-".str_repeat("x", $x)) : print(str_repeat("x", $x)."-");
			}
			echo "<br>";
			$temp++;
			if($temp == $x) $temp *= -1;
		}
	}

	chess(2,8);

	function pairs($arr = []){
		$exist = [];
		for($x = 0; $x < count($arr); $x++){
			if(isset($exist[$arr[$x]])){
				$exist[$arr[$x]]+=1;
			}else{
				$exist[$arr[$x]]=1;
			}
		}
		$pairs = [];
		foreach($exist as $key => $data){
			if($data < 2) array_push($pairs, $key);
		}
		echo join(", ", $pairs);
	}	

	//pairs([1,1,1,2,3,4,4,56,3,2,5,7,9,10]);
 ?>