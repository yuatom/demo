# -*- coding: utf-8 -*-
# list，可变的有序集合，类似索引数组
# list的元素可以是任意类型的，也可以是一个list
# 定义：
print('==============================定义，使用[]')
classmates = ['Michael', 'Bob', 'Tracy']
print(classmates)

print('==============================获取长度')
# 获取list的长度
length = len(classmates)
print(length)

print('==============================获取元素')
# 获取list元素，索引从0开始
print(classmates[0])
print(classmates[1])
print(classmates[2])
# 以负数的索引从list后面往前取，-1取最后一个元素，-2是倒数第二个
print(classmates[-1])
print(classmates[-2])
print(classmates[-3])

print('==============================增删元素')
classmates.append('Adam')		# append，从最后追加元素
print(classmates)

classmates.insert(1, 'Jack')	# 将元素插入到指定位置，该位置原来的元素及后面的元素往后移一位
print(classmates)

classmates.pop()				# 删除最后的元素
print(classmates)

classmates.pop(1)				# 删除指定位置的元素
print(classmates)

print('=================================切片，对list进行截取')
l = [1, 2, 3, 4, 5, 6, 7, 8, 9]
print(l)
# l[start:end:setp] 取从start开始，每step个取一个，直到end结束，不包括end，
print(l[0:3])           # [1, 2, 3] 取前面3位
print(l[:3])            # [1, 2, 3] 从0开始的话，0可以省略
print(l[-3:-1])         # [7, 8]    负数索引
print(l[0:5:2])         # [1, 3, 5] 从0开始，每隔两位取一个



print('=================================列表生成')
# 通过list()和range方法
l = list(range(0, 11))
print(l)                    # [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

# 循环遍历range()
l = []
for i in range(0, 11):
    l.append(i)
print(l)                    # [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

# 简写for循环： 表达式 for i in v 
l = [i for i in range(0, 11)]
print(l)                    # [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

# for循环中的表达式简写
l = [i * i for i in range(0, 11)]   # 计算平方
print(l)                            # [0, 1, 4, 9, 16, 25, 36, 49, 64, 81, 100]

# for循环简写中if:   表达式 for i in v if condition
l = [i * i for i in range(0, 11) if i % 2 == 0] # 偶数
print(l)                            # [0, 4, 16, 36, 64, 100]

# 多重循环:     表达式 外层的for 内层的for
l = [m + n for m in ['A', 'B', 'C'] for n in ['X', 'Y', 'Z']]   # for m in ['A', 'B', 'C']: for n in ['X', 'Y', 'Z'] : l.append(m + n)
print(l)            #['AX', 'AY', 'AZ', 'BX', 'BY', 'BZ', 'CX', 'CY', 'CZ']