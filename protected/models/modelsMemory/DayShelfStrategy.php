<?php
class DayShelfStrategy {
	private $SEP = ",";
	private $id;
	private $uid;
	private $dayIndex;
	private $distribution = array ();
	function __construct($shelfStrategy = null) {
		if ($shelfStrategy == null) {
			return;
		}
		$this->id = $shelfStrategy->id;
		$this->uid = $shelfStrategy->uid;
		$this->dayIndex = $shelfStrategy->dayIndex;
		$this->distribution = explode ( ",", $shelfStrategy->distribution );
		foreach ( $this->distribution as $key => $value ) {
			$this->distribution [$key] = floatval ( $this->distribution [$key] );
		}
	}
	public function setDayIndex($dayIndex) {
		$dayIndex %= 7;
		$this->dayIndex = $dayIndex;
	}
	public function getDayIndex() {
		return $this->dayIndex;
	}
	
	// [start, end)
	public function setPercent($startHour, $endHour, $percent) {
		for($i = $startHour; $i < $endHour; $i ++) {
			$this->distribution [$i] = Util::floor ( $percent, 4 );
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
		$seperator = "";
		for($i = 0; $i < 24; $i ++) {
			$shelfStrategy->distribution .= $seperator . $this->distribution [$i];
			$seperator = $this->SEP;
		}
		return $shelfStrategy;
	}
}
?>