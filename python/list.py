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