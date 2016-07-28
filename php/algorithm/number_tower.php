<?php
/*
一个高度为N的由正整数组成的三角形，从上走到下，求经过的数字和的最大值。
每次只能走到下一层相邻的数上，例如从第3层的6向下走，只能走到第4层的2或9上。

   5
  8 4
 3 6 9
7 2 9 5

例子中的最优方案是：5 + 8 + 6 + 9 = 28
*/
function cal($input, $depth = 0, $index = 0, $sum = 0, $path = []){
	static $max = 0;
	static $maxPath = [];
	if($depth >= count($input)){
		if($sum > $max){
			$maxPath = $path;
			$max = $sum;
		}
	}else{
		$sum += $input[$depth][$index];
		array_push($path,[$depth, $index]);

		cal($input, $depth + 1, $index, $sum, $path);
		cal($input, $depth + 1, $index + 1, $sum, $path);
	}
	return [$max, $maxPath];
}


$input = [[5], [8, 4], [3, 6, 9], [7, 2, 9, 5]];
$res = cal($input);
//var_dump($res);exit;
echo "<pre>";
var_dump($res[0]);
foreach ($res[1] as $key => $value) {
	echo $value[0] , ',' , $value[1];
	echo "<br>";
}
