# 保存python文件的编码
# -*- coding: utf-8 -*-


# ord()获取字符的整数表示，chr()将整数编码的字符转成字符
print(ord('A'))		# 65
print(chr(65))		# A
print(ord('中'))	# 支持中文 20013
print('==========================')

# 普通的字符在内存中以Unicode形式保存，一个字符对应若干个字节
# 字符的byte形式，以字节为单位
x = 'ABC'.encode('ascii')	# 将英文字符的以ascii编码转换成bytes格式
print(x)					# b'ABC'
x = b'ABC'					# 直接定义成bytes格式的
print(x)					# b'ABC'
print(x.decode('ascii'))	# 解码，输出ABC


x = '中文'.encode('utf-8')	# 中文字符超过了ascii编码范围，要用utf-8编码才能转换成bytes
print(x)					# b'\xe4\xb8\xad\xe6\x96\x87' 中文的utf编码
print(x.decode('utf-8'))	# 解码，输出中文

# 如果读取到以bytes格式的字节流，可以用decode解码

print('==========================')

# len(str)，计算字符长度
# str格式的字符串会计算字符个数
print(len('ABC'))	# 3
print(len('中文'))	# 2

# bytes格式的会计算字节长度
print(len('ABC'.encode('ascii')))	# 3，一个英文字符经过utf-8编码后会占用1个字节
print(len('中文'.encode('utf-8')))	# 6，一个中文字符经过utf-8编码后会占用3个字节

print('==========================')

# 字符的格式化输出，以%来添加占位符
# %s 字符串，要替换的变量也可以是其他类型，但都会被转换字符串
# %d 整数
# %f 浮点数	默认小数点后6位
# %x 十六进制整数
# 字符串后面跟着几个变量或者值，顺序对应字符串中占位符的顺序
print('Hello, %s' % 'world')
print('Hi, %s, you have $%d.' % ('Michael', 1000000))

# 指定数字的小数点或者位数
print('%03d' % 2)	# 总共输入三位数，左补零
print('%.3f' % 3)	# 小数点后保留3个小数

# 对于%的处理
print('sss%')			# 没使用占位符能够正常输出
#print('sss%d %' % 7)	# 使用了占位符，会报错
print('sss%d %%' % 7)	# 使用%转义