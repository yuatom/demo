<?php
/**
 游戏的规则是这样的:将一副扑克牌平均分成两份,每人拿一份。小哼先拿出手中的 第一张扑克牌放在桌上,然后小哈也拿出手中的第一张扑克牌,并放在小哼刚打出的扑克牌 的上面,就像这样两人交替出牌。出牌时,如果某人打出的牌与桌上某张牌的牌面相同,即可将两张相同的牌及其中间所夹的牌全部取走,并依次放到自己手中牌的末尾。当任意一人 手中的牌全部出完时,游戏结束,对手获胜。
 假如游戏开始时,小哼手中有 6 张牌,顺序为 2 4 1 2 5 6,小哈手中也有 6 张牌,顺序 为 3 1 3 5 6 4,最终谁会获胜呢?
 */

class queue
{
	private $data = array();
	private $head = 0;
	private $tail = 0;

	public function __construct($input = array())
	{
		foreach ($input as $key => $value) {
			$this->enqueue($value);
		}
	}

	public function enqueue($node)
	{
		$this->data[$this->tail++] = $node;
	}

	public function dequeue()
	{
		if(!$this->isEmpty()){
			return $this->data[$this->head++];
		}
	}

	public function isEmpty()
	{
		return $this->head >= $this->tail;
	}

	public function getData()
	{
		$temp = [];
		for($i = $this->head; $i < $this->tail; $i++)
			$temp[] = $this->data[$i];
		return $temp;
	}

	public function size()
	{
		return $this->tail - $this->head;
	}

}

class stack
{
	private $data = array();
	private $top = 0;

	public function __construct($data = array())
	{
		foreach ($data as $key => $value) {
			$this->push($value);
		}
	}

	public function push($data)
	{
		$this->data[$this->top++] = $data;
	}

	public function pop()
	{	// 取的时候没有删除，只是移动指针
		if(!$this->isEmpty()){
			return $this->data[--$this->top];
		}
	}

	public function isEmpty()
	{
		return $this->top <= 0;
	}

	public function has($data)
	{
		// 由于取的时候没有删除，所以这里要从data里取出有效的
		$temp = array_slice($this->data, 0, $this->top);
		$key = array_keys($temp,$data);
		return !empty($key);
	}

	public function size()
	{
		return $this->top;
	}

	public function getData()
	{
		$temp = [];
		for($i = $this->top - 1; $i >= 0; $i--)
			$temp[] = $this->data[$i];
		return $temp;
	}
}

$q1 = new queue([2, 4, 1, 2, 5, 6]);
$q2 = new queue([3, 1, 3, 5, 6, 4]);

$s = new stack();

function game(queue $q, stack $s){
	$card = $q->dequeue();
	print($card);
	print("\n");
	if($s->has($card)){
		$q->enqueue($card);
		$temp = $s->pop();
		while($card != $temp){
			$q->enqueue($temp);
			if($s->isEmpty()){
				break;
			}
			$temp = $s->pop();
		}
		$q->enqueue($temp);		// 取走牌堆中相同的牌
		//$s->push($temp);		// 不取走牌堆中相同的牌
	}else{
		$s->push($card);
		if($q->isEmpty()){
			return true;
		}
	}
	return false;
}

$q = array($q1, $q2);
$index = 1;
while(!$q1->isEmpty() && !$q2->isEmpty()){
	$res1 = game($q1, $s);
	$res2 = game($q2, $s);
	if($res1 || $res2){
		break;
	}
	$index++;
}

if($q1->isEmpty()){
	print("2222222222222222\n");
}else{
	print("2222222222222222\n");
}
var_dump($q1->getData());
var_dump($q2->getData());
var_dump($s->getData());
echo "\n";
exit;


















