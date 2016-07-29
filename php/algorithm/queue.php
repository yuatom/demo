<?php
/*
规则是这样的:首先将第 1 个数删除,紧接着将第 2 个数放到 这串数的末尾,再将第 3 个数删除并将第 4 个数放到这串数的末尾,再将第 5 个数删除...... 直到剩下最后一个数,将最后一个数也删除。按照刚才删除的顺序,把这些删除的数连在一 起就是小哈的 QQ 啦。现在你来帮帮小哼吧。小哈给小哼加密过的一串数是“6 3 1 7 5 8 9 2 4”。
 */
$input = [6, 3, 1, 7, 5, 8, 9, 2, 4];
$head = 0;
$tail = count($input);

while ($head < $tail) {
	print($input[$head]);
	$head++;
	if($head >= $tail){
		break;
	}
	$input[$tail] = $input[$head];
	$tail++;
	$head++;
}
print("\n");
?>