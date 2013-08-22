<?php
class WeekShelfStrategy {
	private $dayShelfStrategyList;
	public function addDayShelfStrategy($dayShelfStrategy) {
		$this->dayShelfStrategyList [$dayShelfStrategy->getDayIndex ()] = $dayShelfStrategy;
	}
	public function fillRemainPercent() {
		$sum = 0;
		$count = 0;
		for($day = 0; $day < 7; $day ++) {
			if (! isset ( $this->dayShelfStrategyList [$day] )) {
				$dayShelfStrategy = new DayShelfStrategy ();
				$dayShelfStrategy->setDayIndex ( $day );
				$this->addDayShelfStrategy ( $dayShelfStrategy );
			}
			for($hour = 0; $hour < 24; $hour ++) {
				if (isset ( $this->dayShelfStrategyList [$day]->getDistribution ()[$hour] )) {
					$sum += $this->dayShelfStrategyList [$day]->getDistribution ()[$hour];
					$count ++;
				}
			}
		}
		
		if ($sum > 1 || ($count == 24 * 7 && $sum < 1)) {
			throw new Exception ( "illegal percent setting!" );
		}
		
		// for example, 1/3 = 0.3333
		// so 0.3333 is the $remainAvgPercent, 0.0001 is the $remainModValue;
		$remainAvgPercent = (1 - $sum) / (24 * 7 - $count);
		$remainAvgPercent = Util::floor ( $remainAvgPercent, 4 );
		$remainModValue = 1 - $sum - $remainAvgPercent * (24 * 7 - $count);
		for($day = 0; $day < 7; $day ++) {
			for($hour = 0; $hour < 24; $hour ++) {
				if (! isset ( $this->dayShelfStrategyList [$day]->getDistribution ()[$hour] )) {
					$percent = round($remainModValue,4) > 0 ? $remainAvgPercent + 0.0001 : $remainAvgPercent;
					$remainModValue -= 0.0001;
					$this->dayShelfStrategyList [$day]->setPercent ( $hour, $hour + 1, $percent );
				}
			}
		}
		
		// just for test
		$sum = 0;
		for($day = 0; $day < 7; $day ++) {
			for($hour = 0; $hour < 24; $hour ++) {
				$sum += $this->dayShelfStrategyList [$day]->getDistribution ()[$hour];
			}
		}
		
		if (round($sum,0) != 1) {
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
}
?>