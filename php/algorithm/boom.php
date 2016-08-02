<?php
/**
 * 炸弹人，找出可以放置炸弹的能炸最多目标的
 * #是墙
 * .是平地，可以放置炸弹
 * G是目标
 */


$map = [
	['#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#'],
	['#', 'G', 'G', '.', 'G', 'G', 'G', '#', 'G', 'G', 'G', '.', '#'],
	['#', '#', '#', '.', '#', 'G', '#', 'G', '#', 'G', '#', 'G', '#'],
	['#', '.', '.', '.', '.', '.', '.', '.', '#', '.', '.', 'G', '#'],
	['#', 'G', '#', '.', '#', '#', '#', '.', '#', 'G', '#', 'G', '#'],
	['#', 'G', 'G', '.', 'G', 'G', 'G', '.', '#', '.', 'G', 'G', '#'],
	['#', 'G', '#', '.', '#', 'G', '#', '.', '#', '.', '#', '.', '#'],
	['#', '#', 'G', '.', '.', '.', 'G', '.', '.', '.', '.', '.', '#'],
	['#', 'G', '#', '.', '#', 'G', '#', '#', '#', '.', '#', 'G', '#'],
	['#', '.', '.', '.', 'G', '#', 'G', 'G', 'G', '.', 'G', 'G', '#'],
	['#', 'G', '#', '.', '#', 'G', '#', 'G', '#', '.', '#', 'G', '#'],
	['#', 'G', 'G', '.', 'G', 'G', 'G', '#', 'G', '.', 'G', 'G', '#'],
	['#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#', '#'],
];


var_dump(dfs_boom($map, 4, 4));
var_dump(bfs_boom($map, 4, 4));

/**
 * 深度优先算法，每一次都沿着某个点一直往下查找，查找不到时再返回到，查找与这个点平级的点的下一步
 * @param  [type] $map [description]
 * @param  [type] $x   [description]
 * @param  [type] $y   [description]
 * @return [type]      [description]
 */
function dfs_boom($map, $x, $y){
	$next = [[0, 1], [1, 0], [0, -1], [-1, 0]];
	static $book;		// 用来记录那些点计算过
	static $max = 0;
	static $maxX;
	static $maxY;

	if(empty($book)){
		$book = [[$x, $y]];
	}

	// 计算当前点的分数
	$sum = getSum($map, $x, $y);
	if($sum > $max){
		$max = $sum;
		$maxX = $x;
		$maxY = $y;
	}

	for ($i=0; $i < 4; $i++) { 
		$nextX = $x + $next[$i][0];
		$nextY = $y + $next[$i][1];

		// 判断边界
		if($nextX < 1 || $nextY < 1 || $nextX >= count($map) || $nextY >= count($map[$nextX-1])){
			continue;
		}

		// 可放置，并且没计算过的点
		if($map[$nextX-1][$nextY-1] == '.' && empty($book[$nextX][$nextY])){
			$book[$nextX][$nextY] = 1;	// 记录计算过的点
			dfs_boom($map, $nextX, $nextY);	// 查找下一步
		}
	}
	return array($max, $maxX, $maxY);
}

/**
 * 广度优先算法，每一次只查当前这个点的下一步的所有可能，再返回去查找与这个点平级的点的下一步的可能。
 * @param  [type] $map [description]
 * @param  [type] $x   [description]
 * @param  [type] $y   [description]
 * @return [type]      [description]
 */
function bfs_boom($map, $x, $y){
	$next = [[0, 1], [1, 0], [0, -1], [-1, 0]];

	$queue;
	$book = [[$x, $y]];	// 用来记录那些点已经计算过

	$head = 1;
	$tail = 1;

	$node = new Node();
	$node->x = $x;
	$node->y = $y;
	$queue[$tail] = $node;
	$tail++;

	$max = getSum($map, $x, $y);
	$maxX = $x;
	$maxY = $y;

	while($head < $tail){
		for ($i=0; $i < 4; $i++) { 
			$nextX = $queue[$head]->x + $next[$i][0];
			$nextY = $queue[$head]->y + $next[$i][1];
			if($nextX < 1 || $nextY < 1 || $nextX >= count($map) || $nextY >= count($map[$nextX-1])){
				continue;
			}

			if($map[$nextX-1][$nextY-1] == '.' && empty($book[$nextX][$nextY])){
				$book[$nextX][$nextY] = 1;	// 记录计算过的点

				// 把当前的点记录到队列中				
				$node = new Node();
				$node->x = $nextX;
				$node->y = $nextY;
				$queue[$tail] = $node;
				$tail++;

				$sum = getSum($map, $nextX, $nextY);
				if($sum > $max){
					$max = $sum;
					$maxX = $nextX;
					$maxY = $nextY;
				}
			}
		}
		$head++;
	}
	return array($max, $maxX, $maxY);
}

class Node{
	public $x;
	public $y;
	public $parent;
}


function getSum($map, $x, $y){
	$sum = 0;

	// 从四个方向一直走

	$nextX = $x;
	$nextY = $y;
	while($map[$nextX-1][$nextY-1] != '#'){
		if($map[$nextX-1][$nextY-1] == 'G'){
			$sum++;
		}
		$nextX++;
	}

	$nextX = $x;
	$nextY = $y;
	while($map[$nextX-1][$nextY-1] != '#'){
		if($map[$nextX-1][$nextY-1] == 'G'){
			$sum++;
		}
		$nextX--;
	}

	$nextX = $x;
	$nextY = $y;
	while($map[$nextX-1][$nextY-1] != '#'){
		if($map[$nextX-1][$nextY-1] == 'G'){
			$sum++;
		}
		$nextY++;
	}

	$nextX = $x;
	$nextY = $y;
	while($map[$nextX-1][$nextY-1] != '#'){
		if($map[$nextX-1][$nextY-1] == 'G'){
			$sum++;
		}
		$nextY--;
	}

	return $sum;
}