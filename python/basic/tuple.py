# -*- coding:utf-8 -*-
# tuple，不可变的有序列表
# 除了定义之后元素不可变，其他都和list类似
# 因为tuple不可变，所以代码更安全。如果可能，能用tuple代替list就尽量用tuple
# tuple支持切片

print('==============================定义，使用()')
classmates = ('Michael', 'Bob', 'Tracy')
print(classmates)

t1 = ()			# 定义一个空的tuple
print(t1)		# ()

t2 = (1, 2)		# 定义有两个元素的tuple
print(t2)		# (1, 2)

t3 = (1)		# 定义一个只有一个数字元素的tuple?
print(t3)		# 输出是1！，(1)这个方式定义的不是tuple，而是表示运算符括号里面的1，预算结果也是1

t4 = (1,)		# 定义一个只有一个元素的tuple
print(t4)		# (1,)

# 当tuple的元素是list的时候
l = [1,2,3]
t5 = (1,l)
print(t5)			# (1, [1, 2, 3])
l.append(4)
print(t5)			# (1, [1, 2, 3, 4])，t5变了！其实t5保存的值没变，当元素是list时，保存的是list的地址

