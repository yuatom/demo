<?php
/**
 * 深度优先算法，每一次都沿着某个点一直往下查找，查找不到时再返回到，查找与这个点平级的点的下一步
 * 查找A下的点，发现有B，查找B下一步能去的点，发现有C，查找C下一步能去的点，发现有D，查找D下一步能去的点，没有，返回到C
 * 查找C下面除了D的点，发现有F，查找F下面的，没有，返回到C
 * 查找C下面除了D和F的点，没有，返回到B
 * 查找B下面除了C的点，发现有E，查找E下面的点，没有，返回B
 * 查找B下面除了C和E的点，没有，返回A
 * 查找A下面除了B的点......
 *
 * 需要一个变量来记录当前层已经去过的点，即上面的“查找x下面除了y,z的点”中的y,z，因为当前层的下一层也许不能和当前层的点重复
 * 每次进入下一层时判断前面那层是否已经去过
 * 如果与当前层平级的点的下一层可以用到当前的点，那当前点下面那些查找完后要把当前点从变量中去除
 * 比如，全排列中，各个数字不能重复
 * 当第一位是1时，第二位可能是2或者3
 * 	第二位是2这个点的时候，记录2已经用过，进入到第三位，只能用3，即1 2 3，查找后返回去查找3的
 * 	第二位是3，如果2那个点递归完后没有把标记去除，那么第三位就不能再用2，即只是1 3
 * 		如果在2遍历完之后把标记去除，那么第三位还能再用2，即结果是1 3 2
 *  
 * 
 * 
 * function dfs($n, $step){
 * 		// 判断边界，结束返回
 * 		if(){
 * 		
 * 		}
 *
 * 		//尝试每一种可能
 * 		for($i = 1; $i <= $n; $i++){
 * 			// 这一步的操作
 * 			
 * 			// 继续下一步
 * 			dfs($n, step+1);
 * 		}
 * 		
 * }
 *
 */

/**
 * 输入一个数n，输出1~n的全排列
 * @param  int  $n     长度
 * @param  int $step   数字的位数，递归时调用
 * @return         
 */
function dfs($n, $step = 1)
{
	static $res = array();
	static $num = array();

	if($step == $n + 1){
		foreach ($res as $key => $value) {
			print($value . ' ');
		}
		print("\n");
		return;
	}

	for($i = 1; $i <= $n; $i++){
		if(empty($num[$i])){	// 前面还没有i
			$res[$step] = $i;
			$num[$i] = 1;		// 标记i已经被使用过，下一个号码不能用i

			dfs($n, $step + 1);	// 填充下一位

			/*
			要把刚才用过的数字放回
			当前step为i的深层已经遍历完，下一个可能是step时取i+1
			那么i要置为还没用的状态，以便step+1可以用i
			 */
			$num[$i] = 0;		
		}
	}
	return;
}

$n = 3;
//dfs($n);

/**
 * 计算1-9中，[xxx]+[xxx]=[xxx]
 * @param  integer $step [description]
 * @return [type]        [description]
 */
function dfs_cal_num($step = 1){

	$n = 9;	// 9个数
	static $num = array();
	static $res = array();

	if($step >= $n + 1){
		$a = $res[1] * 100 + $res[2] * 10 + $res[3];
		$b = $res[4] * 100 + $res[5] * 10 + $res[6];
		$c = $res[7] * 100 + $res[8] * 10 + $res[9];
		if(($a+$b) == $c){
			print($a . '+' . $b . '=' . $c);
			print("\n");
		}
		return;
	}


	for($i = 1; $i <= $n; $i++){
		if(empty($num[$i])){
			$res[$step] = $i;
			$num[$i] = 1;

			dfs_cal_num($step + 1);
			$num[$i] = 0;
		}
	}
	return;
}
//dfs_cal_num();

/**
 * 在地图中搜索某个点
 * @param  array  $map  地图，0可以走，1不可以走
 * @param  [type]  $resX [description]
 * @param  [type]  $resY [description]
 * @param  integer $x    [description]
 * @param  integer $y    [description]
 * @param  integer $step [description]
 * @return [type]        [description]
 */
function dfs_map($map, $resX, $resY, $x = 1, $y = 1, $step = 0){
	$next = [[0, 1], [1, 0], [0, -1], [-1, 0]];
	static $minStep;
	static $book = [[1,1]];

	if($x == $resX && $y == $resY){
		if($step < $minStep || empty($minStep)){
			$minStep = $step;
		}
		//$book = [[1,1]];
		return;
	}

	//print($x . ',' . $y . "\n");
	for ($i=0; $i < 4; $i++) { 
		// 下一个点
		$nextX = $x + $next[$i][0];
		$nextY = $y + $next[$i][1];

		// 边界，坐标从1开始，因此和map用到坐标时要减一
		if($nextX == 0 || $nextX > count($map) || $nextY == 0 || $nextY > count($map[$nextX - 1])){
			continue;
		}
		// print($nextX . ',' . $nextY . "\n");
		// print($map[$nextX-1][$nextY-1] . "\n");
		if($map[$nextX-1][$nextY-1] == 0 && empty($book[$nextX][$nextY])){
			print($nextX . ',' . $nextY . "\n");
			$book[$nextX][$nextY] = 1;
			dfs_map($map, $resX, $resY, $nextX, $nextY, $step + 1);
			$book[$nextX][$nextY] = 0;	// 当前step为i的深层已经遍历完，下一个可能是当前step取i+1，那么i要置为还没用的状态，以便step+1可以用i
		}
	}
	return $minStep;
}

$map = [
	[0, 0, 1, 0],
	[0, 0, 0, 0],
	[0, 0, 1, 0],
	[0, 1, 0, 0],
	[0, 0, 0, 0],
];
$resX = 4;
$resY = 3;
print(dfs_map($map, $resX, $resY) . "\n");


























