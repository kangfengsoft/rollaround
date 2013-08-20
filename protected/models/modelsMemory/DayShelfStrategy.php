<?php
class DayShelfStrategy {
	// function __construct($shelfStrategy) {
	// $tmp = $shelfStrategy->distribution;
	// }
	private $day;
	private $distribution;
	public function set($day) {
		$this->day = $day;
	}
	
	// [start, end)
	public function setPercent($startHour, $endHour, $percent) {
		for($i = $startHour; $i < $endHour; $i ++) {
			$this->distribution [$i] = $percent;
		}
	}
	public function finish() {
		$sum = 0;
		$count = 0;
		for($i = 0; $i < 24; $i ++) {
			if ($this->distribution [$i] != null) {
				$sum += $this->distribution [$i];
				$count ++;
			}
		}
		if ($sum > 1 || ($count == 24 && $sum < 1)) {
			throw new Exception ( "total setted percent is bigger then 100%" );
		}
		
		$remainAvgPercent = (1 - $sum) / (24 - $count);
		for($i = 0; $i < 24; $i ++) {
			if ($this->distribution [$i] == null) {
				$this->distribution [$i] = $remainAvgPercent;
			}
		}
	}
}
?>