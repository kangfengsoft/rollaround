<?php
class WeekShelfStrategy {
	public $dayShelfStrategyList;
	public $currentDay;
	public $itemsCount;
	function __construct($shelfStrategyList = null) {
		$this->currentDay = date ( "w" );
		if ($shelfStrategyList == null) {
			return;
		}
		foreach ( $shelfStrategyList as $value ) {
			$this->dayShelfStrategyList [$value->day] = new DayShelfStrategy ( $value );
		}
	}
	public function addDayShelfStrategy($dayShelfStrategy) {
		$this->dayShelfStrategyList [$dayShelfStrategy->getDay ()] = $dayShelfStrategy;
	}
	public function fillRemainPercent() {
		$sum = 0;
		$count = 0;
		$nonZeroCount = 0;
		for($day = 0; $day < 7; $day ++) {
			if (! isset ( $this->dayShelfStrategyList [$day] )) {
				$dayShelfStrategy = new DayShelfStrategy ();
				$dayShelfStrategy->setDay ( $day );
				$this->addDayShelfStrategy ( $dayShelfStrategy );
			}
			for($hour = 0; $hour < 24; $hour ++) {
				if ($this->dayShelfStrategyList [$day]->getPercent($hour) !== null) {
					$sum += $this->dayShelfStrategyList [$day]->getPercent ($hour);
					$count ++;
				}
				if (bcsub($this->dayShelfStrategyList [$day]->getPercent($hour),0,6) !== 0) {
					$nonZeroCount ++;
				}
			}
		}
		
		//do not remove there code. it's for test
// 		if (bcsub($sum,1,6)  > 0 || ($count == 24 * 7 && bcsub($sum,1,6) < 0)) {
// 			throw new Exception ( "illegal percent setting!" );
// 		}
		
// 		if($count == 24 * 7){
// 			return;
// 		}

		$isAllHourHasValue = false;
		if($count == 24 * 7){
			//usually it's from front layer, means user customized strategy
			$isAllHourHasValue = true;
		}
		if($isAllHourHasValue){
			$remainAvgPercent = (1 - $sum)/ $nonZeroCount;
			$remainAvgPercent = Util::floor ( $remainAvgPercent, 4 );
			$remainModValue = 1 - $sum - $remainAvgPercent * $nonZeroCount;
			$step = 0.0001;
			if($remainAvgPercent < 0){
				$step = -0.0001;
			}
			
			for($day = 0; $day < 7; $day ++) {
				for($hour = 0; $hour < 24; $hour ++) {
					$originPercent = $this->dayShelfStrategyList [$day]->getPercent ( $hour );
					if(bcsub($originPercent,0,6) === 0){
						continue;
					}
					
					$remainModValue = round ( $remainModValue, 4 );
					if(bcsub($remainModValue,0,6) != 0){
						$percent = $remainAvgPercent + $step;
						$remainModValue -= $step;
					}else{
						$percent = $remainAvgPercent;
					}
					$this->dayShelfStrategyList [$day]->setPercent ( $hour, $hour + 1, $percent + $originPercent );
				}
			}
		}else{
			//for programmically set percent
			// for example, 1/3 = 0.3333
			// so 0.3333 is the $remainAvgPercent, 0.0001 is the $remainModValue;
			$remainAvgPercent = (1 - $sum) / (24 * 7 - $count);
			$remainAvgPercent = Util::floor ( $remainAvgPercent, 4 );
			$remainModValue = 1 - $sum - $remainAvgPercent * (24 * 7 - $count);
			for($day = 0; $day < 7; $day ++) {
				for($hour = 0; $hour < 24; $hour ++) {
					if ($this->dayShelfStrategyList [$day]->getPercent ( $hour ) === null) {
						$percent = round ( $remainModValue, 4 ) > 0 ? $remainAvgPercent + 0.0001 : $remainAvgPercent;
						$remainModValue -= 0.0001;
						$this->dayShelfStrategyList [$day]->setPercent ( $hour, $hour + 1, $percent );
					}
				}
			}
		}
		
		// just for test
		$sum = 0;
		for($day = 0; $day < 7; $day ++) {
			for($hour = 0; $hour < 24; $hour ++) {
				$sum += $this->dayShelfStrategyList [$day]->getPercent ( $hour );
			}
		}
		
		if (Util::floor ( $sum, 4 ) != 1) {
			throw new Exception ( "percentage sum is not equals to 1 !" );
		}
	}
	public function saveToDB() {
		for($day = 0; $day < 7; $day ++) {
			$shelfStrategy = $this->dayShelfStrategyList [$day]->toShelfStrategy ();
			$shelfStrategy->save ();
		}
	}
	public function getDayShelfStrategy($day) {
		return $this->dayShelfStrategyList [$day];
	}
	
	private function insertItems($items) {
		$onsaleItemsCount = count($items);
		for($day = 0; $day < 7; $day ++) {
			$this->dayShelfStrategyList[$day]->setOnsaleItemCount($onsaleItemsCount);
		}
		$countSum = 0;
		for($day = 0; $day < 7; $day ++) {
			for($hour = 0; $hour < 24; $hour ++) {
				$countSum += $this->dayShelfStrategyList[$day]->getHours()[$hour][DayShelfStrategy::HOUR_FIELD_PLANCOUNT];
			}
		}
		$remainCount = $onsaleItemsCount - $countSum;
		for($hour = 0; $hour < 24; $hour ++) {
			for($day = 0; $day < 7; $day ++) {
				if ($this->dayShelfStrategyList [$day]->getHours ()[$hour][DayShelfStrategy::HOUR_FIELD_PERCENT] !== (float)0) {
					if ($remainCount > 0) {
						$hourNode = &$this->dayShelfStrategyList [$day]->getHours ()[$hour];
						$hourNode[DayShelfStrategy::HOUR_FIELD_PLANCOUNT] ++;
					}
					$remainCount --;
				}
			}
		}
		foreach ( $items as $item ) {
			$day = date ( 'w', strtotime ( $item->list_time ) );
			$this->dayShelfStrategyList[$day]->insertItem($item);
		}
	}
	
	public function calculateShopScore($items){
		$this->insertItems($items);
		$totalItemCount = count($items);
		$deta = 0;
		for($day = 0; $day < 7; $day ++) {
			for($hour = 0; $hour < 24; $hour ++) {
				$planPercent = $this->dayShelfStrategyList[$day]->getHours()[$hour][DayShelfStrategy::HOUR_FIELD_PERCENT];
				$actualItemCount = isset($this->dayShelfStrategyList[$day]->getHours()[$hour][DayShelfStrategy::HOUR_FIELD_ITEMLIST]) ?
						count($this->dayShelfStrategyList[$day]->getHours()[$hour][DayShelfStrategy::HOUR_FIELD_ITEMLIST]) : 0;
				$actualPercent = (float)$actualItemCount/$totalItemCount;
				$deta += abs($actualPercent - $planPercent);
// 				$deta += ($actualPercent - $planPercent)*($actualPercent - $planPercent);
			}
		}
		$score = (int)((2-$deta)/2 * 100);
		return $score;
	}
	
	public function recountShelfPlan($items, $taobao_user_id) {
		$this->insertItems ( $items );
		$day = (date ( "w" ) + 1) % 7;
		$hourPointer = 23;
		$dayPointer = $day;
		for($hour = 23; $hour >= 0; $hour --) {
			$planCount = $this->dayShelfStrategyList [$day]->getHours ()[$hour] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT];
			$itemCount = !isset($this->dayShelfStrategyList [$day]->getHours ()[$hour] [DayShelfStrategy::HOUR_FIELD_ITEMLIST])? 
				0 : count ( $this->dayShelfStrategyList [$day]->getHours ()[$hour] [DayShelfStrategy::HOUR_FIELD_ITEMLIST] );
			if ($itemCount < $planCount) {
				$hourPointer = $hourPointer <= $hour ? $hourPointer : $hour;
				$needCount = $planCount - $itemCount;
				$CONST_NEED_COUNT = $planCount - $itemCount;
				while ( $needCount > 0 ) {
					$prePlanCount = $this->dayShelfStrategyList [$dayPointer]->getHours ()[$hourPointer] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT];
					$preItemCount = !isset($this->dayShelfStrategyList [$dayPointer]->getHours ()[$hourPointer] [DayShelfStrategy::HOUR_FIELD_ITEMLIST])?
						0:count ( $this->dayShelfStrategyList [$dayPointer]->getHours ()[$hourPointer] [DayShelfStrategy::HOUR_FIELD_ITEMLIST] );
					if ($preItemCount <= $prePlanCount) {
						$hourPointer --;
						if ($hourPointer < 0) {
							$hourPointer += 24;
							$dayPointer = $dayPointer == 0 ? 6 : $dayPointer - 1;
							if ($dayPointer == $day) {
								// go back, it should not happen
								break;
							} 
						}
					} else {
						$abundantCount = $preItemCount - $prePlanCount;
						$moveCount = ($needCount <= $abundantCount) ? $needCount : $abundantCount;
						$head = array_slice ( $this->dayShelfStrategyList [$dayPointer]->getHours ()[$hourPointer] [DayShelfStrategy::HOUR_FIELD_ITEMLIST], 0, $itemCount - $moveCount );
						$tail = array_slice ( $this->dayShelfStrategyList [$dayPointer]->getHours ()[$hourPointer] [DayShelfStrategy::HOUR_FIELD_ITEMLIST], $itemCount - $moveCount );
						
						$this->dayShelfStrategyList [$dayPointer]->getHours ()[$dayPointer] [DayShelfStrategy::HOUR_FIELD_ITEMLIST] = $head;
						// move some items
						foreach ( $tail as $value ) {
							$this->dayShelfStrategyList [$day]->getHours ()[$hour] [DayShelfStrategy::HOUR_FIELD_ITEMLIST] [] = $value;
						}
						$needCount -= $moveCount;
						if($needCount <= 0){
							$itemListCount = count($this->dayShelfStrategyList [$day]->getHours ()[$hour] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]);
							$addItemList = array_slice ( $this->dayShelfStrategyList [$day]->getHours ()[$hour] [DayShelfStrategy::HOUR_FIELD_ITEMLIST], $itemListCount-$CONST_NEED_COUNT );
							$this->addTimedTask($addItemList, $hour, $taobao_user_id);
						}
					}
				}
			}
		}
	}
	
	public function addTimedTask($itemList, $hour, $taobao_user_id){
		$secondInterval = (int)(3600 / count($itemList));
		if($secondInterval == 0){
			$secondInterval = 1;
		}
		
		$min = 0;
		$second = 0;
		foreach($itemList as $item){
			$listTask = ListTask::model()->find( 'num_iid=:num_iid', array (
			':num_iid' => $item->num_iid
			) );
			if($listTask === null){
				$listTask = new ListTask();
				$listTask->num_iid = $item->num_iid;
			}
			$listTask->taobao_user_id = $taobao_user_id;
			$taskYear = date ( "Y" );
			$taskMonth  = date ( "m" );
			$taskDay = date("d",strtotime("+1 day"));
			$listTask->list_time = date ( 'Y-m-d H:i:s', mktime($hour,$min,$second,$taskMonth,$taskDay,$taskYear) );
			$listTask->save();
			$second += $secondInterval;
			$min += $second / 60;
			if($min >=60){
				$min = 59;
			}
			$second %= 60;
		}
	}
}
?>