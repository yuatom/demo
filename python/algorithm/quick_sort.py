# -*- coding:utf-8 -*-
def quick_sort(input, left, right):
	if left >= right:
		return
	temp = input[left]
	i = left
	j = right
	while(i != j):

		# 右边的下标往左移，遇到小于flag时停下
		while input[j] >= temp and j > i:
			j -= 1

		# 左边的下标往右移，遇到大于flag时停下
		while input[i] <= temp and j > i:
			i += 1

		# 左右下标停下时，如果左仍然小于右，则将两个元素互换
		if i < j:
			t = input[i]
			input[i] = input[j]
			input[j] = t

	# 当左右相遇时，即到中位，将flag移到中位，将中位移到flag的位置
	input[left] = input[i]
	input[i] = temp;

	# 分成两个序列，去循环
	quick_sort(input, left, i)
	quick_sort(input, i + 1, right)


if __name__ == '__main__':
    array = [8,10,9,6,4,16,5,13,26,18,2,45,34,23,1,7,3]
    print(array)
    quick_sort(array,0,len(array)-1)
    print(array)