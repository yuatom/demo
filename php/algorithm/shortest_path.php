<?php
/**
 * 求一个图之中，两个的最短路径
 * 		1用一个数组来表示图中各点的距离
 * 			a[i][j]表示i到j之间边距离，0表示ij为同一点，inf表示无法到达。
 * 				1	2	3	4
 * 			1	0	2	6	4
 * 			2	inf 0	3	inf
 * 			3	7	inf 0	1
 * 			4	5	inf 12	0
 */

print("============================floyd_warshall==============================\n");

/**
 * 求两个点之间最短的距离，比如求i到j的距离
 * 如果引入第三个点作为中继点，使得a[i][k]+$[k][j] < a[i][j]，即此时可更新ij的最短距离
 * 时间复杂度为N3
 * @return [type] [description]
 */
function floyd_warshall($map, $p){
	for ($k=0; $k < count($map); $k++) { 
		// 能通过k来缩短距离
		for ($i=0; $i < count($map); $i++) { 
			for ($j=0; $j < count($map); $j++) { 
				if ($map[$i][$j] > $map[$i][$k] + $map[$k][$j]) {
					$map[$i][$j] = $map[$i][$k] + $map[$k][$j];
				}
			}
		}
	}

	foreach ($map[$p] as $k => $v) {
		print($v);
		print("\n");
	}
}
$map = [
	[0,    1,    12,   9999, 9999, 9999],
	[9999, 0,    9,    3,    9999, 9999],
	[9999, 9999, 0,    9999, 5,    9999],
	[9999, 9999, 4,    0,    13,   15],
	[9999, 9999, 9999, 0,    9999, 4],
	[9999, 9999, 9999, 9999, 9999, 9],
];
$time = microtime(true);
floyd_warshall($map, 0);
print(microtime(true) - $time . "\n");


print("============================dijikstra==============================\n");

/**
 * 通过边实现松弛
 * 同样用一个二维数组来保存顶点之间的边的距离
 * 		1	2	3	4	5	6
 * 	1	0	1	12	inf inf inf
 * 	2	inf	0	9	3	inf inf
 * 	3	inf inf	0	inf	5	inf
 * 	4	inf	inf	4	0	13	15
 * 	5	inf	inf inf	inf	0	4
 * 	6	inf inf inf inf inf 0
 * 
 * 另外再用一个一维数组来保存某个顶点到其他顶点之间的距离，比如第一个顶点到其他边的距离
 * 		1	2	3	4	5	6
 * 	dis 0	1	12	inf inf inf
 * 	初始化时，到456的距离都是无法到达
 * 	1先找出最近的顶点，即2，然后计算出，通过2，到其他顶点之间的距离
 * 		比如到3的距离，原来是inf，通过2之后是a[1][2] + a[2][3] = 10
 * 		比如到4的距离，原来是inf，通过2之后是a[1][2] + a[2][4] = 4
 * 		如此递推，得到新的dis数组
 *   	 	1	2	3	4	5	6
 * 	    dis 0	1	10	4	inf inf 
 *      以上更新新的距离的专业术语叫做松弛，以上对2的所有出边完成了松弛
 *  2之后再从除了刚才松弛过的2之外的顶点中，找出距离1最短的点，进行出边松弛，即4
 *  	从4中的过程，即对所有的边都进行了松弛
 *
 * 该算法不能解决距离为负的边，因为负的边会改变已经更新的点路程
 * 时间复杂度N2
 * @param  [type] $map [description]
 * @return [type]      [description]
 */
function dijikstra($map, $p){
	$dis = [];	// 记录p到各店的最短距离
	$book = [];	// 记录那些点的距离是确定，1表示确定

	// 初始化距离
	foreach ($map[$p] as $key => $value) {
		$dis[$key] = $value;
	}
	
	$book[$p] = 1;	// p到自己的距离是确定的

	// 循环松弛i点的出边
	for ($i=0; $i < count($map); $i++) { 
		// 找到还未松弛的点种，距离p最近的点
		$min = 9999;
		$nearP;
		for ($j=0; $j < count($map); $j++) { 
			if(empty($book[$j]) && $dis[$j] < $min){
				$min = $dis[$j];
				$nearP = $j;
			}
		}
		$book[$nearP] = 1;
		
		// 最这个点的出边进行松弛
		for ($j=0; $j < count($map); $j++) { 
			// 计算p到j之间，通过k来缩短距离
			// 只有当k能到达j时才进行计算
			if($map[$nearP][$j] < 9999){
				// a[i][k]+$[k][j] < a[i][j]
				if($dis[$j] > $dis[$nearP] + $map[$nearP][$j]){
					$dis[$j] = $dis[$nearP] + $map[$nearP][$j];
				}
			}
		}


	}

	foreach ($dis as $value) {
		print($value . "\n");
	}
}
$map = [
	[0,    1,    12,   9999, 9999, 9999],
	[9999, 0,    9,    3,    9999, 9999],
	[9999, 9999, 0,    9999, 5,    9999],
	[9999, 9999, 4,    0,    13,   15],
	[9999, 9999, 9999, 0,    9999, 4],
	[9999, 9999, 9999, 9999, 9999, 9],
];
$time = microtime(true);
dijikstra($map, 0);
print(microtime(true) - $time . "\n");


print("============================bellman_ford==============================\n");

/**
 * bellman_ford以邻接表方式来实现松弛
 * 该方式中，要进行n次所有边的松弛，n为顶点个数
 *
 * 时间复杂度N*M，N是顶点个数，M是图中的边数
 * 
 * 以数组形式实现邻接表
 * 	引入三个数组，u, v, w：
 * 		u[i], v[i], w[i]三者的意思是，第i条边是从u[i]顶点指向v[i]顶点，且权值为w[i];
 * 	引入first和next数组：
 * 		first[u[i]]是顶点u[i]第一条边的编号，next[i]是编号i的边的吓一条边的编号；
 * 	演示：
 * 						1	2	3	4	5	6	7
 * 	1读入第i=1条边1 4 9
 * 				u 		1
 * 				v 		4
 * 				w 		9
 * 				first 	*1*
 * 				next
 * 	2读入第i=2条边4 3 8
 * 				u 		1	4
 * 				v 		4	3
 * 				w 		9	8
 * 				first 	1			*2*
 * 				next
 * 	3读入第i=3条边1 2 5，first[u[i]]的值为1，即first[1]保存最新的边的编号（i=3），first[u[i]]原来的边退到next[i]
 * 				u 		1	4	1
 * 				v 		4	3	2
 * 				w 		9	8	5
 * 				first 	*3*			2
 * 				next 			*1*
 * 	4读入第i=4条边1 3 7
 * 				u 		1	4	1	1
 * 				v 		4	3	2	3
 * 				w 		9	8	5	7
 * 				first 	*4*			2
 * 				next 			1	*3*
 * 				
 * 邻接表的这种形式，可以很容易地找出某个顶点的所有边，比如找出1点的所有边
 * $k[] = $first[1];
 * while($k){
 * 		// 当前边的信息
 * 		// $u[$k]是k边的一个顶点，
 * 		// $v[$k]是另一个顶点，
 * 		// $w[$k]是k边的长度/权值
 * 		print($u[$k],$v[$k],$w[$k]);	
 * 		$k = $next[$k];					// 下一条边
 * }
 * 
 * @param  [type] $map [description]
 * @param  [type] $p   [description]
 * @return [type]      [description]
 */
function bellman_ford($map, $p){
	// 定义数组
	$u = $v = $w = [];
	$dis = $bak = [];	// 距离数组

	// 初始化数组，将map转换到那些数组数据
	$num = 0;	// 边的编号
	foreach ($map as $key => $value) {
		foreach ($value as $k => $vl) {
			$u[$num] = $key;	// 边的起点
			$v[$num] = $k;		// 边的终点
			$w[$num] = $vl;		// 边的长度
			$num++;
		}
	}

	// 初始化距离数组，初始化为最大值
	for ($i=0; $i < count($map); $i++) { 
		$dis[$i] = 9999;
	}
	$dis[$p] = 0;	// 到p自己的距离为0

	// 对所有的边进行n-1次松弛
	for ($i=0; $i < count($map); $i++) { 

		// 要针对所有的点进行松弛，及为n-1次，n为顶点个数
		// 有可能在某次松弛时候，dis的值不会再变，即还没到达n-1次，dis里的值已经是最短的了
		// 在这里添加一个松弛前的dis，用来和该次松弛的后dis进行对比
		// 如果松弛前后没有变化，即不用再进行后续的松弛
		foreach ($dis as $key => $value) {
			$bak[$key] = $value;
		}

		// 对所有的边的顶点进行一轮松弛
		for ($j=0; $j < $num; $j++) { 
			// p到j边的终点，是否大于，p到j边的起点加上j边的长度
			// 也就是a[i][v] > $a[i][u] + $a[u][v]
			// $w[$j]也就是$a[u][v]的值，两点的长度长度
			if ($dis[$v[$j]] > $dis[$u[$j]] + $w[$j]) {
				$dis[$v[$j]] = $dis[$u[$j]] + $w[$j];
			}
		}

		// 检查松弛后是否有变化
		$hasChanged = false;
		foreach ($dis as $key => $value) {
			if ($value != $bak[$key]) {
				$hasChanged = true;
			}
		}

		// 如果dis已经没有变化，就不再松弛后面的点
		if(!$hasChanged){
			break;
		}
	}

	// 检测是否有负权边，即在确定了最短的dis之后，再进行一个松弛，距离还有可能改变
	$flag = 0;
	for ($i=0; $i < $num; $i++) { 
		if($dis[$v[$i]] > $dis[$u[$i]] + $w[$i]){
			$flag = 1;
		}
	}

	if($flag){
		print("有负权回路\n");
	}else{
		foreach ($dis as $key => $value) {
			print($value . "\n");
		}
	}
}
$map = [
	[0,    1,    12,   9999, 9999, 9999],
	[9999, 0,    9,    3,    9999, 9999],
	[9999, 9999, 0,    9999, 5,    9999],
	[9999, 9999, 4,    0,    13,   15],
	[9999, 9999, 9999, 0,    9999, 4],
	[9999, 9999, 9999, 9999, 9999, 9],
];

$time = microtime(true);
bellman_ford($map, 0);
print(microtime(true) - $time . "\n");




print("============================bellman_ford_queue==============================\n");

/**
 * bellman_ford中，要对所有的边进行n-1次松弛，但其实只需要对改变了最短路程的点的边进行松弛
 * 因此可以用一点队列来维护需要改变了最短路程的点
 * 再利用邻接表中的first和next来进行优化
 * 最差时的时间复杂度N*M，N是顶点个数，M是图中的边数，
 * @param  [type] $map [description]
 * @param  [type] $p   [description]
 * @return [type]      [description]
 */
function bellman_ford_queue($map, $p){
	// 定义数组
	$u = $v = $w = $first = $next = [];
	$dis = [];	// 距离数组

	// 队列，保存需要松弛的顶点
	$queue = [];
	$head = 0;
	$tail = 0;

	$book = [];	// 记录某个点是否在队列中

	// 初始化first，-1表示还没有边
	for($i=0; $i < count($map); $i++){
		$first[$i] = -1;
	}

	// 初始化数组，将map转换到那些数组数据
	$num = 0;	// 边的编号
	foreach ($map as $key => $value) {
		foreach ($value as $k => $vl) {
			$u[$num] = $key;	// 边的起点
			$v[$num] = $k;		// 边的终点
			$w[$num] = $vl;		// 边的长度
			$next[$num] = $first[$u[$num]];	// 取上一条边的编号
			$first[$u[$num]] = $num;		// 取当前边作为最新一条，上一条边以及被next保存
			$num++;
		}
	}

	// 初始化距离数组，初始化为最大值
	for ($i=0; $i < count($map); $i++) { 
		$dis[$i] = 9999;
	}
	$dis[$p] = 0;	// 到p自己的距离为0

	// 第一个顶点入队列
	$queue[$tail] = $p;
	$tail ++;
	$book[$p] = 1;

	// 对队列中的点的边松弛
	while($head < $tail){
		// 取该顶点的第一条边，first[顶点]
		$k = $first[$queue[$head]];
		while(!empty($k) && $k != -1){
			// 如果对边的另一个顶点松弛成功，表示另一个顶点的边也要松弛，进队列
			if($dis[$v[$k]] > $dis[$u[$k]] + $w[$k]){
				$dis[$v[$k]] = $dis[$u[$k]] + $w[$k];
				if(empty($book[$v[$k]])){
					$queue[$tail] = $v[$k];
					$tail++;
					$book[$v[$k]] = 1;
				}
			}
			// 取该顶点的下一条边
			$k = $next[$k];
		}
		// 将松弛过的点移出队列
		$book[$queue[$head]] = 0;
		$head++;
	}

	// 输出结果
	foreach ($dis as $key => $value) {
		print($value . "\n");
	}
}
$map = [
	[0,    1,    12,   9999, 9999, 9999],
	[9999, 0,    9,    3,    9999, 9999],
	[9999, 9999, 0,    9999, 5,    9999],
	[9999, 9999, 4,    0,    13,   15],
	[9999, 9999, 9999, 0,    9999, 4],
	[9999, 9999, 9999, 9999, 9999, 9],
];

$time = microtime(true);
bellman_ford_queue($map, 0);
print(microtime(true) - $time . "\n");



/**
 * 
 */



























