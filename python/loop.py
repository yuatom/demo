# -*- coding:utf-8 -*-

# for x in ...
# 遍历 list
names = ['Michael', 'Bob', 'Tracy']
for name in names:
    print(name)

# 遍历一个整数list，计算总数
sum = 0
for x in [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]:
    sum = sum + x
print(sum)

# 如果要遍历从0到100，可使用range()函数
sum = 0
for x in range(101):	# 产生0到小于101的整数序列
    sum = sum + x
print(sum)


# while
sum = 0
n = 99
while n > 0:
    sum = sum + n
    n = n - 2
print(sum)