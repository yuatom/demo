<?php
/**
 * 广度搜索
 * 查找某个点的下一步所有可能的点，然后在查找这些点的下一步的可能的点
 * 每次只查一层，查询完之后退回上一层，上一层查完了，就拿当前层的点来往下查
 * 例子：
 * 	已知点A，查询A下一步可能是B和C，查找完毕返回A那一层，发现没有可查，进入BC那一层；
 * 	查找B下一步的点，可能是D和E，查找完毕返回BC那一层，往下查找C下一步；
 * 	查找C下一步的店，可能是D和F，查找完毕返回BC那一层，发现没有可查，进入DEF那一层；
 * 	如此类推，像上面D有重复，可以用一个变量来存储查找过的点
 *
 * 算法实现：
 * 	可以使用队列来记录查找到的点，队列头表示当前查找的点，查找到点添加到队列尾
 * 	第一次查找的点会在队列头，这个点的下一级会在这个队列头之后，这个点的下一级的下一级，会这个点的下一级之后
 * 	用数字来表示层数，队列中节点的层数可能是：1 2 2 2 3 3 3 4 4 4 4 ...
 * 	即沿着队列头往下，就能遍历当前层的所有下一步可能，并添加到后面
 * 	每次查询完当前点的子节点，队列head移到下一位，即出队列
 */                  

class Node{
	public $x;
	public $y;
	public $parent;
	public $step;
}

function bfs_map($map, $resX, $resY, $x = 1, $y = 1){
	$next = [[0, 1], [1, 0], [0, -1], [-1, 0]];
	$flag = false;
	$book = [];		// 记录查找过的点
	$book[$x][$y] = 1;
	$queue = [];	// 队列
	$head = 1;
	$tail = 1;

	// 第一个点
	$node = new Node();
	$node->x = $x;
	$node->y = $y;
	$node->step = 0;
	$queue[$tail] = $node;
	$tail++;

	while($head <= $tail){
		for ($i=0; $i < 4; $i++) { 

			// 当前队列头的下一个点
			$nextX = $queue[$head]->x + $next[$i][0];
			$nextY = $queue[$head]->y + $next[$i][1];
			// 边界
			if($nextX < 1 || $nextY < 1 || $nextX > count($map) || $nextY > count($map[$x - 1])){
				continue;
			}
			//print($nextX . ',' . $nextY . "\n");
			//var_dump($book);
			if($map[$nextX-1][$nextY-1] == 0 && empty($book[$nextX][$nextY])){
				//print($nextX . ',' . $nextY . "\n");
				$book[$nextX][$nextY] = 1;	// 每个点只入队一次，因此要记录记录已经走过

				// 将当前的点添加到队列中
				$node = new Node();
				$node->x = $nextX;
				$node->y = $nextY;
				$node->step = $queue[$head]->step + 1;
				$queue[$tail] = $node;
				$tail ++;

				// 是否到达目的
				if($nextX == $resX && $nextY == $resY){
					$flag = true;
					break;
				}
			}

		}

		if($flag){
			break;
		}

		// 当一个点的下一步查找完了，队列往后移动
		$head++;
	}
	return $queue[$tail-1]->step;
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
print(bfs_map($map, $resX, $resY) . "\n");