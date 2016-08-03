<?php
/**
 * 快速排序
 */

function quick_sort(&$input, $left, $right){
	if($left >= $right){
		return ;
	}

	$temp = $input[$left];
	if(is_array($temp)){
		// 多维排序
		foreach ($input as $key => $value) {
			quick_sort($value, 0, count($value)-1);
			$input[$key] = $value;	// foreach中value是复制出来的，需要重新写到input里
		}
		//return;
	}else{
		$i = $left;
		$j = $right;

		while($i != $j){
			// 要把j放在i前面判断，这样在下面交换left和i元素的时候，才能保证i所在的元素比temp的小。
			while($temp <= $input[$j] && $i < $j){
				$j--;
			}
			while($temp >= $input[$i] && $i < $j){
				$i++;
			}
			if($i < $j){
				$t = $input[$i];
				$input[$i] = $input[$j];
				$input[$j] = $t;
			}
		}
		$input[$left] = $input[$i];
		$input[$i] = $temp;

		quick_sort($input, $left, $i);
		quick_sort($input, $i+1, $right);
	}
}

$input = [5, 8, 1, 9, 4, 3, 11, 6];

$input = [
	[5, 8, 1, 9, 4, 3, 11, 6],
	[5, 8, 1, 9, 4, 3, 11, 6],
	[5, 8, 1, 9, 4, 3, 11, 6],
	[5, 8, 1, 9, 4, 3, 11, 6],
	[5, 8, 1, 9, 4, 3, 11, 6],
];
var_dump($input);
quick_sort($input, 0, count($input) - 1);
var_dump($input);
