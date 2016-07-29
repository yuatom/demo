<?php
/*
一个N*N矩阵中有不同的正整数，经过这个格子，就能获得相应价值的奖励，从左上走到右下，只能向下向右走，求能够获得的最大价值。
例如：3 * 3的方格。

1 3 3
2 1 3
2 2 1

能够获得的最大价值为：11。
*/
function cal($input, $x = 1, $y = 1, $result = 0, $path = array()){
	static $max = 0;
	static $maxPath = array();
	$result += $input[$x][$y];
	array_push($path, [$x, $y]);
	if($x >= (count($input) - 1) && $y >= (count($input[$x]) - 1)){
		if($result > $max){
			$max = $result;
			$maxPath = $path;
		}
		//return [$max, $maxPath];
	}else if($x >= (count($input) - 1)){
		cal($input, $x, $y + 1, $result, $path);
	}else if($y >= (count($input[$x]) - 1)){
		cal($input, $x + 1, $y, $result, $path);
	}else{
		cal($input, $x + 1, $y, $result, $path);
		cal($input, $x, $y + 1, $result, $path);
	}
	return [$max, $maxPath];
}

$input = [0,[0,1,3,8],[0,2,10,3],[0,4,4,1]];
$res = cal($input);
var_dump($res[0]);
foreach ($res[1] as $key => $value) {
	echo $value[0] , ',' , $value[1];
	echo "\n";
}