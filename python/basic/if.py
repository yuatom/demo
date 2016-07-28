# -*- coding:utf-8 -*-
age = 20
if age >= 18:
	print('adult')
else:
	print('teenager')


age = 3
if age >= 18:
	print('adult')
elif age >= 6:
	print('teenager')
else:
	print('kid')

x = True	
if x:	#只要x是非零数值、非空字符串、非空list等，就判断为True，否则为False
	print('not zero, not empty string/list')