# -*- coding:utf-8 -*-

# 当一次要创建一个比较大的列表时，会占用很大内存空间
# 可以使用生成器，一边循环一边计算的机制

# 生成列表list
l = [i for i in range(0, 11)]
print(l)                        # [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

# 定义生成器，通过括号
g = (i for i in range(0, 11))
print(g)                        # <generator object <genexpr> at 0x7f26afb2d288>

# 获取生成器的元素  next()函数，每次获取生成器的下一个元素
print(next(g))                  # 0

# 循环获取
for i in g:
    print(i)                    # 相当于循环调用next



# 定义生成器的另一个方式，和函数类似
# 一般的函数是顺序执行，遇到return时返回
# 生成器中返回使用的关键字是yield
# 调用next()时执行函数，遇到函数中yield时返回退出函数
# 下次调用next时，从上次yield退出处继续往下执行
def g1(max):
    i = 0
    while i < max:
        yield i
        i = i + 1

g = g1(5)
print(g)        # <generator object g1 at 0x7f56e515e240>
print(next(g))  # 0
print(next(g))  # 1
print(next(g))  # 2
print(next(g))  # 3
print(next(g))  # 4
# print(next(g))    # 该次执行后没有yield，返回StopIteration错误
