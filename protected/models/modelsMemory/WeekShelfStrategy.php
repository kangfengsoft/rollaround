<?php
class WeekShelfStrategy {
	private $dayShelfStrategyList;
	public function createDefaultStrategy() {
		for($day = 1; $day < 6; $day ++) {
			$dayShelfStrategy = new DayShelfStrategy ();
			$dayShelfStrategy->set ( $day );
			$dayShelfStrategy->setPercent ( 0, 9, 0 );
			$dayShelfStrategy->setPercent ( 18, 22, 0.02 );
			$dayShelfStrategy->setUid ( Yii::app ()->user->id );
			$this->dayShelfStrategyList [$day] = $dayShelfStrategy;
		}
		
		// saturday and sunday
		for($day = 6; $day < 8; $day ++) {
			$dayShelfStrategy = new DayShelfStrategy ();
			$dayShelfStrategy->set ( $day % 7 );
			$dayShelfStrategy->setPercent ( 0, 10, 0 );
			$dayShelfStrategy->setPercent ( 17, 23, 0.02 );
			$dayShelfStrategy->setUid ( Yii::app ()->user->id );
			$this->dayShelfStrategyList [$day % 7] = $dayShelfStrategy;
		}
		
		$this->fillAllPercent ();
		for($day = 0; $day < 7; $day ++) {
			$shelfStrategy = $this->dayShelfStrategyList [$day]->toShelfStrategy ();
			$shelfStrategy->save ();
		}
	}
	
	private function fillAllPercent() {
		$sum = 0;
		$count = 0;
		for($day = 0; $day < 7; $day ++) {
			if (! isset ( $this->dayShelfStrategyList [$day] )) {
				$dayShelfStrategy = new DayShelfStrategy ();
				$dayShelfStrategy->set ( $day );
				$this->dayShelfStrategyList [$day] = $dayShelfStrategy;
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
		
		$remainAvgPercent = (1 - $sum) / (24 * 7 - $count);
		for($day = 0; $day < 7; $day ++) {
			for($hour = 0; $hour < 24; $hour ++) {
				if (! isset ( $this->dayShelfStrategyList [$day]->getDistribution ()[$hour] )) {
					$this->dayShelfStrategyList [$day]->setPercent ( $hour, $hour + 1, $remainAvgPercent );
				}
			}
		}
	}
	public function getDayShelfStrategy($day) {
		return $this->dayShelfStrategyList [$day];
	}
}
?>