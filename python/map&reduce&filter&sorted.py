# -*- coding: utf-8 -*-

# map()函数，接受两个参数，一个是函数一个是Iterable
# map将函数作用在Iterable每一个元素上，再将结果拼装成Iterator返回

def f(x):
    return x * x

l = [1, 2, 3, 4, 5]
r = map(f, l)
print(r)                # <map object at 0x7f23c2b25f28>
print(list(r))          # [1, 4, 9, 16, 25]，r是一个Iterator，属于惰性序列，需要通过list函数将它计算并返回


# reduce()函数（functools包中），接受两个参数，一个函数和一个序列，函数必须接收两个参数
# reduce()中将函数作用于序列前面两个元素，再将结果和序列的下一个元素继续传入给函数，以及做累积计算，最后返回结果
# 相当于 reduce(f, x) = f(f(f(f(x1, x2), x3) ,x4)

from functools import reduce
def add(x, y):
    return x + y
l = [1, 2, 3, 4, 5]
print(reduce(add, l))       # 15，做累计


# filter()函数，接受两个参数，一个函数一个序列
# 将函数作用于序列的每一个元素，根据函数的返回是True还是False，决定是否保留这个元素
# 最后将所有保留下来的元素保存在一个Iterator中返回
def is_odd(x):
    return x % 2 == 1   # 除2是否余1
l = [1, 2, 3, 4, 5]
print(list(filter(is_odd, l)))  # [1, 3, 5]


