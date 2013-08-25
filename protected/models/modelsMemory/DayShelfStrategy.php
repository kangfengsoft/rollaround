<?php
class DayShelfStrategy {
	private $SEP = ",";
	public $id;
	public $taobao_user_id;
	public $day;
	public $distribution = array ();
	function __construct($shelfStrategy = null) {
		if ($shelfStrategy == null) {
			return;
		}
		$this->id = $shelfStrategy->id;
		$this->taobao_user_id = $shelfStrategy->taobao_user_id;
		$this->day = $shelfStrategy->day;
		$this->distribution = explode ( ",", $shelfStrategy->distribution );
		
		if (count ( $this->distribution ) != 24) {
			throw new Exception ( "illegle distribution length!" );
		} else {
		}
		
		foreach ( $this->distribution as $key => $value ) {
			if (! is_numeric ( $value )) {
				throw new Exception ( "illegle distribution data!" );
			}
			$this->distribution [$key] = floatval ( $this->distribution [$key] );
		}
	}
	public function setDay($day) {
		$day %= 7;
		$this->day = $day;
	}
	public function getDay() {
		return $this->day;
	}
	
	// [start, end)
	public function setPercent($startHour, $endHour, $percent) {
		for($i = $startHour; $i < $endHour; $i ++) {
			$this->distribution [$i] = Util::floor ( $percent, 4 );
		}
	}
	public function setTaobaoUserId($taobao_user_id) {
		$this->taobao_user_id = $taobao_user_id;
	}
	public function getDistribution() {
		return $this->distribution;
	}
	public function toShelfStrategy() {
		$shelfStrategy = new ShelfStrategy ();
		$shelfStrategy->taobao_user_id = $this->taobao_user_id;
		$shelfStrategy->day = $this->day;
		$seperator = "";
		for($i = 0; $i < 24; $i ++) {
			$shelfStrategy->distribution .= $seperator . $this->distribution [$i];
			$seperator = $this->SEP;
		}
		return $shelfStrategy;
	}
	public static function checkDistribution($distribution) {
		$distribution = explode ( ",", $shelfStrategy->distribution );
		if (count ( $distribution ) != 24) {
			return false;
		} else {
			foreach ( $distribution as $value ) {
			}
		}
	}
}
?>