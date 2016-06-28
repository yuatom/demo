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