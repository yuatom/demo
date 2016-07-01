# -*- coding:utf-8 -*-

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