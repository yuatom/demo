# -*- coding:utf-8 -*-
# 一个N*N矩阵中有不同的正整数，经过这个格子，就能获得相应价值的奖励，从左上走到右下，只能向下向右走，求能够获得的最大价值。
# 例如：3 * 3的方格。

# 1 3 3
# 2 1 3
# 2 2 1

# 能够获得的最大价值为：11。

import copy

max = 0
maxPath = [0];
def cal(input, x = 1, y = 1, result = 0, path = []):
	global max
	global maxPath
	if path is None:
		path = []
	result += input[x][y]
	path.append([x, y])
	if x >= len(input) - 1 and y >= len(input[x]) - 1:
		if result > max:
			max = result
			maxPath = path
		return
	elif x >= len(input) - 1 :
		cal(input, x, y+1, result, copy.deepcopy(path))
	elif y >= len(input[x]) - 1 :
		cal(input, x+1, y, result, copy.deepcopy(path))
	else:
		cal(input, x, y+1, result, copy.deepcopy(path))
		cal(input, x+1, y, result, copy.deepcopy(path))
	return

input = [0,[0,1,3,11],[0,2,10,3],[0,3,4,1]]
cal(input)
print(max)
print(maxPath)

