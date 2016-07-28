# -*- coding:utf-8 -*-
# set，不能重复的无序集合
# 定义：variable = set()，传入的参数为一个list
l = [1, 3, 5]
s = set(l)
print(s)		# {1, 3, 5}

# 添加元素，add()方法
s.add(4)
print(s)		# {1, 3, 4, 5}

# 删除元素，remve()
s.remove(4)
print(s)		# {1, 3, 5}

# set求交集和并集
s1 = set([1, 2, 3])
s2 = set([2, 3, 4])
print(s1 & s2)	# {2, 3}		交集，用 &
print(s1 | s2)	# {1, 2, 3, 4}	并集，用 |