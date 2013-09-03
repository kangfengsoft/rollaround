<?php 
class Util{
	public static function floor($num, $length = 0){
		$pow = pow(10, $length);
		$tmp = floor($num * $pow);
		$num = $tmp / $pow;
		return $num;
	}
}
?>