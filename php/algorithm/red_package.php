<?php

/**
 * 默认额度在0.01和剩余平均值*2之间。
 */
class RedPackage{

	private $leftMoney;
	private $leftSize;

	private $min = 0.01;
	private $max ;

	public function __construct($totalMoney, $size, $max = 0, $min = 0){
		$this->leftMoney = $totalMoney;
		$this->leftSize = $size;

		if(!empty($max) && $max > 0){
			$this->setMax($max);
		}

		if(!empty($min) && $min > 0){
			$this->setMin($min);
		}
	}

	private function setMax($max)
	{
		$avg = round($this->leftMoney / $this->leftSize, 2);
		if($max < $avg){
			// throw 小于平均值
		}
		$this->max = $max;
	}

	private function setMin($min)
	{
		$this->min = $min;
	}

	/**
	 * 获取当前红包的值
	 * @param  [type] $leftMoney [description]
	 * @param  [type] $current   [description]
	 * @return [type]            [description]
	 */
	public function getRandomMoney()
	{
		if($this->leftSize == 1){
			$this->leftSize --;
			$money = $this->leftMoney;
			$this->leftMoney = 0;
		}else{
			$max = $this->getMax();
			$min = $this->getMin();

			$money = round(mt_rand($min * 100, $max * 100) / 100, 2);
			$money = $money <= $this->min ? $this->min : $money;
			$this->leftMoney = round($this->leftMoney - $money, 2);
		}
		$this->leftSize --;	
		return $money;
	}

	public function getAll()
	{
		$money = array();
		for(; $this->leftSize > 0 ;){
			$money[] = $this->getRandomMoney();
		}
		return $money;
	}

	private function getMax()
	{
		if(empty($this->max)){
			$max = round($this->leftMoney / $this->leftSize * 2, 2);
		}else{
			$max = $this->max;
		}
		return $max;
	}

	/**
	 * 如果红包在一定的区间内，防止前面取到的金额太小，导致后面的红包平均值比最大值还大
	 * @return [type] [description]
	 */
	private function getMin()
	{
		$max = $this->getMax();
		$leftSizeAfter = $this->leftSize - 1;
		$min = $this->leftMoney - $max * $leftSizeAfter;
		$min = $min >= $this->min ? $min : $this->min;
		return $min;
	}
}

$red = new RedPackage(100,10, 12, 6);
//$red = new RedPackage(100,10);
$money = $red->getAll();
$total = 0;
print("====================================================\n");
foreach ($money as $key => $value) {
	$total += $value;
	print($value."\n");
}

print("Total money: " . $total . "\n");


// 计算方差
$avg = round($total / count($money), 2);
$sum = 0;
foreach ($money as $key => $value) {
	$sum += pow($value - $avg, 2);
}
$variance = $sum / count($money);
print("Variance: " . $variance."\n");




















