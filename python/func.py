# -*- coding:utf-8 -*-

# 定义函数，def name(params)
def my_abd(x):
	if x > 0:
		return x		# 返回值
	else:
		return -x


# 代码占位，当函数中或者一些代码结构暂时不做任何操作时，可以用占位，否则留空会报错
def func1():
	pass			# 不做任何操作

def func2(x):
	if x > 18:
		pass		# 其他结构中占位
	else:
		pass

# 返回多个值，返回一个tuple
def cal(x,y):
	return x+y, x-y

print(cal(2, 1))		# (3,1)
print(type(cal(2, 1)))	# <class 'tuple'>


# 定义函数时，需要确定函数名和参数个数；

# 如果有必要，可以先对参数的数据类型做检查；

# 函数体内部可以用return随时返回函数结果；

# 函数执行完毕也没有return语句时，自动return None。

# 函数可以同时返回多个值，但其实就是一个tuple。


# 默认参数，变化大的参数放前面，变化小的参数放后面
# 默认参数的传入默认按顺序，如果不按顺序时可传递参数名
def enroll(name, gender, age=6, city='Beijing'):
    print('name:', name)
    print('gender:', gender)
    print('age:', age)
    print('city:', city)

enroll('Sarah', 'F')				# 按默认传参，age和city使用默认值
enroll('Bob', 'M', 7)				# 按默认传参，city使用默认值
enroll('Adam', 'M', city='Tianjin')	# 按默认传参，city通过传递参数名进去，age使用默认值

# 默认参数必须指向不可变对象，否则每一次使用默认参数调用时，默认参数被修改后会被记住，下次调用时将使用新的值作为默认
def add_end(L=[]):
    L.append('END')
    return L

print(add_end([1, 2, 3]))			# [1, 2, 3, 'END']，没有使用默认参数，正常输出
print(add_end(['x', 'y', 'z']))		# ['x', 'y', 'z', 'END']，没有使用默认参数，正常输出
print(add_end())					# ['END'] 第一次使用默认参数，正常
print(add_end())					# ['END', 'END'], 第二次，默认参数的值被上一次调用改了
print(add_end())					# ['END', 'END', 'END'], 第三次，默认参数的值被上一次调用改了

def add_end(L=None):			# 默认值设置为不可变的None，能够以上问题
	if L is None:
		L = []
    L.append('END')
    return L