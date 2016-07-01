# -*- coding:utf-8 -*-
# 迭代，能够被迭代的数据类型，list,tuple,dict,set,str以及generator

from collections import Iterable
# 可以用isinstance()判断一个变量是否是Iterable对象
l = [1, 2, 3, 4, 5]
t = (1, 2, 3, 4, 5)
d = {'a': 1, 'b': 2, 'c': 3, 'd': 4, 'e': 5}
s1 = set([1, 2, 3, 4, 5])
s = "asdf1234"
g = (i for i in range(0, 11))

print(isinstance(l, Iterable))      # True
print(isinstance(t, Iterable))      # True
print(isinstance(d, Iterable))      # True
print(isinstance(s1, Iterable))     # True
print(isinstance(s, Iterable))      # True
print(isinstance(1, Iterable))      # False
print(isinstance(g, Iterable))      # True


# list，对于没有key的list，迭代的是value
l = [1, 2, 3, 4, 5]

for i in l:
    print(i)    # 1 2 3 4 5

# 将list变成index--value形式
for i in enumerate(l):      # i为l中每个元素和index的组合，（index, value）
    print(i)                # (0, 1) 

for index,value in enumerate(l): # 迭代出索引和值
    print(index)
    print(value)

# 迭代两个变量
for x, y in [(1, 1), (2, 4), (3, 9)]:
    print(x, y)

# dict，有key的dict，迭代的是key
d = {'a': 1, 'b': 2, 'c': 3, 'd': 4, 'e': 5}
for k in d:
    print(k)        # a b c d e
    
for k in d:
    print(d[k])     # 1 2 3 4 5

# 直接迭代dict的value
for v in d.values():
    print(v)        # 1 2 3 4 5
    
# d.values() 将dict的value转为一个list
print(d.values())   # print(d.values())


# string，迭代字符串
s = "asdf1234"
for i in s:
    print(i)        # a s d f 1 2 3 4

# generator
# 定义生成器，通过括号
g = (i for i in range(0, 11))
# 循环获取
for i in g:
    print(i)                    # 相当于循环调用next


# 迭代器Iterator
# Python的Iterator对象表示的是一个数据流
# Iterator对象可以被next()函数调用并不断返回下一个数据，直到没有数据时抛出StopIteration错误
# 可以把这个数据流看做是一个有序序列，但我们却不能提前知道序列的长度，只能不断通过next()函数实现按需计算下一个数据
# 所以Iterator的计算是惰性的