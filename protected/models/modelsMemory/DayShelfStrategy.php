<?php
class DayShelfStrategy {
	const HOUR_FIELD_PERCENT = 'percent'; 
	const HOUR_FIELD_ITEMLIST = 'itemlist';
	const HOUR_FIELD_PLANCOUNT = 'planCount';
	
	private $SEP = ",";
	public $id;
	public $taobao_user_id;
	public $day;
	public $hours = array ();
	private $onsaleItemCount;
	function __construct($shelfStrategy = null) {
		if ($shelfStrategy == null) {
			return;
		}
		$this->id = $shelfStrategy->id;
		$this->taobao_user_id = $shelfStrategy->taobao_user_id;
		$this->day = $shelfStrategy->day;
		$distribution = explode ( ",", $shelfStrategy->distribution );
		
		if (count ( $distribution ) != 24) {
			throw new Exception ( "illegle distribution length!" );
		} else {
		}
		
		foreach ( $distribution as $key => $value ) {
			if (! is_numeric ( $value )) {
				throw new Exception ( "illegle distribution data!" );
			}
			$this->hours [$key] [self::HOUR_FIELD_PERCENT] = floatval ( $value );
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
			$this->hours [$i][self::HOUR_FIELD_PERCENT] = Util::floor ( $percent, 4 );
		}
	}
	public function setTaobaoUserId($taobao_user_id) {
		$this->taobao_user_id = $taobao_user_id;
	}
	public function getHours() {
		return $this->hours;
	}
	public function toShelfStrategy() {
		$shelfStrategy = new ShelfStrategy ();
		$shelfStrategy->taobao_user_id = $this->taobao_user_id;
		$shelfStrategy->day = $this->day;
		$seperator = "";
		for($i = 0; $i < 24; $i ++) {
			$shelfStrategy->distribution .= $seperator . $this->hours [$i][self::HOUR_FIELD_PERCENT];
			$seperator = $this->SEP;
		}
		return $shelfStrategy;
	}
	
	public function getPercent($hour){
		if(isset($this->hours[$hour])){
			return null;
		}else{
			return $this->hours[$hour][self::HOUR_FIELD_PERCENT];
		}
	}
	
	/*
	 * $item json item from top
	 */
	public function insertItem($item){
		$hour = date ( 'H', strtotime ( $item->list_time ) );
		$this->hours[$hour][DayShelfStrategy::HOUR_FIELD_ITEMLIST][] = $item;
	}
	
	public function setOnsaleItemCount($onsaleItemCount) {
		$this->onsaleItemCount = $onsaleItemCount;
		for($hour = 0; $hour < 24; $hour ++) {
			$this->hours [$hour] [self::HOUR_FIELD_PLANCOUNT] = $this->hours [$hour] [self::HOUR_FIELD_PERCENT] * $onsaleItemCount;
		}
	}
	
// 	public static function checkDistribution($distribution) {
// 		$distribution = explode ( ",", $shelfStrategy->distribution );
// 		if (count ( $distribution ) != 24) {
// 			return false;
// 		} else {
// 			foreach ( $distribution as $value ) {
// 			}
// 		}
// 	}
}
?>