<?php
class DayShelfStrategy {
	private $SEP = ",";
	private $id;
	private $uid;
	private $dayIndex;
	private $distribution = array ();
	function __construct($shelfStrategy) {
		$this->id = $shelfStrategy->id;
		$this->uid = $shelfStrategy->uid;
		$this->dayIndex = $shelfStrategy->dayIndex;
		$this->distribution = explode ( ",", $shelfStrategy->distribution );
		foreach($this->distribution as $key => $value){
			$this->distribution[$key] = floatval($this->distribution[$key]);
		}
	}
	public function set($dayIndex) {
		$this->dayIndex = $dayIndex;
	}
	
	// [start, end)
	public function setPercent($startHour, $endHour, $percent) {
		for($i = $startHour; $i < $endHour; $i ++) {
			$this->distribution [$i] = $percent;
		}
	}
	public function setUid($uid) {
		$this->uid = $uid;
	}
	public function getDistribution() {
		return $this->distribution;
	}
	public function toShelfStrategy() {
		$shelfStrategy = new ShelfStrategy ();
		$shelfStrategy->uid = $this->uid;
		$shelfStrategy->dayIndex = $this->dayIndex;
		$shelfStrategy->distribution = join ( $this->SEP, $this->distribution );
		return $shelfStrategy;
	}
}
?>