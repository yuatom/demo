# -*- coding:utf-8 -*-
# 函数名是一个指向函数地址的变量
# 变量可以指向函数 v = funName
# 函数也可以作为参数，使用时传入函数名

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


# 变量指向函数
a = abs(-10)		# 调用函数
a = abs				# 变量指向函数地址
b = a(-10)			# 调用函数




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


# 可变参数，参数数量可变，通过使用*
def calc(numbers):				# 传入一个list或者tuple
    sum = 0
    for n in numbers:
        sum = sum + n * n
    return sum

print(calc([1, 2, 3]))			# 传入一个list，list中的个数可变，但是参数前拼装成list
print(calc((1, 3, 5, 7)))		# 传入一个tuple

def calc(*numbers):				# 在参数前面加一个*，就可直接传入不同数量的参数
    sum = 0
    for n in numbers:
        sum = sum + n * n
    return sum

print(calc(1, 2, 3))			# 直接传入参数，不借用list或tuple
print(calc(*(1, 3, 5, 7)))		# 也可以将tuple或list通过添加*传入
# 通过可变参数，即加上*，在函数调用时会把参数自动组装为一个tuple


# ==============================================================================================================

# 关键字参数，可传入0或任意个含参数名的参数，通过使用**
def person(name, age, **kw):
	print('name:', name, 'age:', age, 'other:', kw)

person('Michael', 30)							# name: Michael age: 30 other: {}
person('Bob', 35, city='Beijing')				# name: Bob age: 35 other: {'city': 'Beijing'}
person('Adam', 45, gender='M', job='Engineer')	# name: Adam age: 45 other: {'job': 'Engineer', 'gender': 'M'}

# 通过 dict传入，需要添加**
extra = {'city': 'Beijing', 'job': 'Engineer'}
person('Jack', 24, **extra)



# ==============================================================================================================

# 命名关键字参数，关键字参数中传入的参数不受限制，通过命名关键字参数可以来限制参数
def person(name, age, *, city, job):
	print(name, age, city, job)

extra = {'city': 'Beijing', 'job': 'Engineer'}
person('Jack', 24, **extra)						# Jack 24 Beijing Engineer
#person('Jack', 24, city='Beijing', xxx='yyy')	# 报错TypeError: person() got an unexpected keyword argument 'xxx'


# 如果函数定义中已经有了一个可变参数，后面跟着的命名关键字参数就不再需要一个特殊分隔符*了
def person(name, age, *args, city, job):		# args是可变参数，city，和job在可变参数后，即为命名关键字参数
	print(name, age, args, city, job)

person('Jack', 24, city='Beijing', job='Engineer')		# Jack 24 () Beijing Engineer，必须传入city和job的参数名，否则会被当作位置参数

# 命名关键字参数可也设置默认值，要使用*作为命名关键字参数和位置参数的分隔，否则会被当初位置参数
def person(name, age, *, city='Beijing', job):	
    print(name, age, city, job)

# ==============================================================================================================

# 参数组合

def f1(a, b, c=0, *args, **kw):		# 可变参数和关键字参数
	print('a =', a, 'b =', b, 'c =', c, 'args =', args, 'kw =', kw)

def f2(a, b, c=0, *, d, **kw):		# 命名关键字参数，可变参数
	print('a =', a, 'b =', b, 'c =', c, 'd =', d, 'kw =', kw)

f1(1, 2)
f1(1, 2, c=3)
f1(1, 2, 3, 'a', 'b')
f1(1, 2, 3, 'a', 'b', x=99)
f2(1, 2, d=99, ext=None)

#对于任意函数，都可以通过类似func(*args, **kw)的形式调用它，无论它的参数是如何定义的。

args = [1,2,3,4]
kw = {'x':'y', 'y':'z'}
f1(*args, **kw)			# a = 1 b = 2 c = 3 args = (4,) kw = {'x': 'y', 'y': 'z'}

args = [1,2,3,4]
kw = {'x':'y', 'y':'z'}
#f2(*args, **kw)				# 报错，只有3个位置参数，但是arg里传了4个

args = [1,2,3]
kw = {'x':'y', 'y':'z'}
#f2(*args, **kw)				# 报错，位置参数没问题，但是后面需要一个关键字参数d，kw中没有给出

args = [1,2,3]
kw = { 'd':'z', 'x':'y'}		# a = 1 b = 2 c = 3 d = z kw = {'x': 'y'}
f2(*args, **kw)	

# 小结

# Python的函数具有非常灵活的参数形态，既可以实现简单的调用，又可以传入非常复杂的参数。

# 默认参数一定要用不可变对象，如果是可变对象，程序运行时会有逻辑错误！

# 要注意定义可变参数和关键字参数的语法：

# *args是可变参数，args接收的是一个tuple；

# **kw是关键字参数，kw接收的是一个dict。

# 以及调用函数时如何传入可变参数和关键字参数的语法：

# 可变参数既可以直接传入：func(1, 2, 3)，又可以先组装list或tuple，再通过*args传入：func(*(1, 2, 3))；

# 关键字参数既可以直接传入：func(a=1, b=2)，又可以先组装dict，再通过**kw传入：func(**{'a': 1, 'b': 2})。

# 使用*args和**kw是Python的习惯写法，当然也可以用其他参数名，但最好使用习惯用法。

# 命名的关键字参数是为了限制调用者可以传入的参数名，同时可以提供默认值。

# 定义命名的关键字参数在没有可变参数的情况下不要忘了写分隔符*，否则定义的将是位置参数。