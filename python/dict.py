# -*- coding:utf-8 -*-

# dict类型，字典，类似其他语言的map，
# 定义：variable = {'key': value, 'key1': value}
print('===============================定义')
d = {'Micheal': 95, 'Bob': 75, 'Tracy': 85}
print(d)        # {'Tracy': 85, 'Micheal': 95, 'Bob': 75}

print('===============================获取元素的值')
print(d['Bob'])             # 75，这种方式如果key不存在会报错
print(d.get('Jack'))        # key不存在的话会返回None
print(d.get('Jack'), -1)    # 不存在则返回给定的默认值

print('===============================判断key是否存在')
# 使用 in 来判断key是否存在
print('Jack' in d)          # 不存在，返回False

print('==============================元素赋值')
d['Bob'] = 80   # 改修已有的元素
d['Jack'] = 90  # 新增元素
print(d)

print('===============================删除元素')
# 使用pop(key)方法
d.pop('Jack')
print(d)


