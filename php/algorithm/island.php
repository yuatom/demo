<?php
/**
 * 地图上的海拔高度，0表示海平面，1~9都表示陆地，数字的大小表示海拔的高低。
 * 
 * 	1假设初始点在(6，4)处，现在需要计算出该点周围有多少个非0的格子，即该岛的面积。这里把初始点相邻的陆地是为一个岛。
 * 	2查找地图有多少个独立的岛 
 */

$map = [
	[1, 2, 1, 0, 0, 0, 0, 0, 2, 3],
	[3, 0, 2, 0, 1, 2, 1, 0, 1, 2],
	[4, 0, 1, 0, 1, 2, 3, 2, 0, 1],
	[3, 2, 0, 0, 0, 1, 2, 4, 0, 0],
	[0, 0, 0, 0, 0, 0, 1, 5, 3, 0],
	[0, 1, 2, 1, 0, 1, 5, 4, 3, 0],
	[0, 1, 2, 3, 1, 3, 6, 2, 1, 0],
	[0, 0, 3, 4, 8, 9, 7, 5, 0, 0],
	[0, 0, 0, 3, 7, 8, 6, 0, 1, 2],
	[0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
];
foreach ($map as $key => $value) {
	foreach ($value as $k => $v) {
		printf('%3d',$v);
	}
	print("\n");
}

print("======================================bfs\n");
// 计算面积
print(area_bfs($map, 6, 4));
print("\n");

// 返回区域
$m = area_color_bfs($map, 6, 4, -1);
foreach ($m as $key => $value) {
	foreach ($value as $k => $v) {
		printf('%3d',$v);
	}
	print("\n");
}


 print("======================================dfs\n");
 $book = [];
// 计算面积
 print(area_dfs($map, 6, 4));
 print("\n");

// 返回区域
$m = area_color_dfs($map, 6, 4, -1);
foreach ($m as $key => $value) {
	foreach ($value as $k => $v) {
		printf('%3d',$v);
	}
	print("\n");
}

print("======================================dfs_multi_color\n");
$book = [];
// 返回区域
$m = area_num_dfs($map);
foreach ($m as $key => $value) {
	foreach ($value as $k => $v) {
		printf('%3d',$v);
	}
	print("\n");
}
print("\n");

/**
 * 广度优先搜索，遇到不为0时添加到队列里
 * @param  [type] $map [description]
 * @param  [type] $x   [description]
 * @param  [type] $y   [description]
 * @return [type]      [description]
 */
function area_bfs($map, $x, $y){
	$next = [[0, -1], [0, 1], [1, 0], [-1, 0]];
	$book = [];
	$queue = [];

	$head = 1;
	$tail = 1;
	$sum = 0;

	$book[$x][$y] = 1;
	$queue[$tail] = [$x, $y];
	$sum++;
	$tail++;

	while($head < $tail){
		for ($i=0; $i < 4; $i++) { 
			$nextX = $queue[$head][0] + $next[$i][0];
			$nextY = $queue[$head][1] + $next[$i][1];

			if($nextX < 1 || $nextY < 1 || $nextX > count($map) || $nextY > count($map[$nextX - 1])){
				continue;
			}

			if($map[$nextX-1][$nextY-1] != 0 && empty($book[$nextX][$nextY])){
				$book[$nextX][$nextY] = 1;
				$queue[$tail] = [$nextX, $nextY];
				$tail++;
				$sum++;
			}
		}

		$head++;
	}
	return $sum;
}

/**
 * 着色，在地图上遍历到的点添加一个颜色标记
 * @param  [type] $map   [description]
 * @param  [type] $x     [description]
 * @param  [type] $y     [description]
 * @param  [type] $color [description]
 * @return [type]        [description]
 */
function area_color_bfs($map, $x, $y, $color){
	$next = [[0, -1], [0, 1], [1, 0], [-1, 0]];
	$book = [];
	$queue = [];

	$head = 1;
	$tail = 1;
	$sum = 0;

	$book[$x][$y] = 1;
	$queue[$tail] = [$x, $y];
	$map[$x-1][$y-1] = $color;
	$sum++;
	$tail++;

	while($head < $tail){
		for ($i=0; $i < 4; $i++) { 
			$nextX = $queue[$head][0] + $next[$i][0];
			$nextY = $queue[$head][1] + $next[$i][1];

			if($nextX < 1 || $nextY < 1 || $nextX > count($map) || $nextY > count($map[$nextX - 1])){
				continue;
			}

			if($map[$nextX-1][$nextY-1] != 0 && empty($book[$nextX][$nextY])){
				$book[$nextX][$nextY] = 1;
				$queue[$tail] = [$nextX, $nextY];
				$tail++;
				$sum++;

				// 着色
				$map[$nextX-1][$nextY-1] = $color;
			}
		}

		$head++;
	}
	return $map;
}

/**
 * 深度优先，计算面积
 * @param  [type] $map [description]
 * @param  [type] $x   [description]
 * @param  [type] $y   [description]
 * @return [type]      [description]
 */
function area_dfs($map, $x, $y){
	$next = [[0, -1], [0, 1], [1, 0], [-1, 0]];
	global $book;
	global $sum;

	if(empty($book)){
		$book[$x][$y] = 1;
		$sum = 1;
	}

	for ($i=0; $i < 4; $i++) { 
		$nextX = $x + $next[$i][0];
		$nextY = $y + $next[$i][1];

		if($nextX < 1 || $nextY < 1 || $nextX > count($map) || $nextY > count($map[$nextX-1])){
			continue;
		}
		if($map[$nextX-1][$nextY-1] != 0 && empty($book[$nextX][$nextY])){
			$book[$nextX][$nextY] = 1;
			$sum++;
			area_dfs($map, $nextX, $nextY);
		}
	}
	return $sum;
}

/**
 * 深度优先，着色
 * @param  [type] $map   [description]
 * @param  [type] $x     [description]
 * @param  [type] $y     [description]
 * @param  [type] $color [description]
 * @return [type]        [description]
 */
function area_color_dfs($map, $x, $y, $color){
	$next = [[0, -1], [0, 1], [1, 0], [-1, 0]];
	global $book;
	global $sum;

	for ($i=0; $i < 4; $i++) { 
		$nextX = $x + $next[$i][0];
		$nextY = $y + $next[$i][1];

		if($nextX < 1 || $nextY < 1 || $nextX > count($map) || $nextY > count($map[$nextX-1])){
			continue;
		}
		// print($nextX . ',' . $nextY . "\n");
		// print($map[$nextX-1][$nextY-1] . "\n");
		if($map[$nextX-1][$nextY-1] != 0 && empty($book[$nextX][$nextY])){
			$book[$nextX][$nextY] = 1;
			$sum++;
			$map[$nextX-1][$nextY-1] = $color;
			$map = area_color_dfs($map, $nextX, $nextY, $color);
		}
	}

	return $map;
}


/**
 * 深度优先，对不同区域着色
 * @param  [type] $map [description]
 * @return [type]      [description]
 */
function area_num_dfs($map){
	$color = -1;
	for($x = 1; $x < count($map); $x++){
		for ($y=1; $y < count($map[$x-1]); $y++) { 

			// 大于0的才进去
			if($map[$x-1][$y-1] > 0){
				$map = area_color_dfs($map, $x, $y, $color);
				$color--;
			}
		}
	}
	return $map;
}

































