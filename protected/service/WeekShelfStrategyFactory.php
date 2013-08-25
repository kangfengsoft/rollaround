<?php 
class WeekShelfStrategyFactory {
	public static function createDefaultStrategy($taobao_user_id) {
		$weekShelfStrategy = new WeekShelfStrategy();
		for($day = 1; $day < 6; $day ++) {
			$dayShelfStrategy = new DayShelfStrategy ();
			$dayShelfStrategy->setDay ( $day );
			$dayShelfStrategy->setPercent ( 0, 9, 0 );
			$dayShelfStrategy->setPercent ( 18, 22, 0.02 );
			$dayShelfStrategy->setTaobaoUserId ($taobao_user_id);
			$weekShelfStrategy->addDayShelfStrategy($dayShelfStrategy);
		}
		
		// saturday and sunday
		for($day = 6; $day < 8; $day ++) {
			$dayShelfStrategy = new DayShelfStrategy ();
			$dayShelfStrategy->setDay ( $day );
			$dayShelfStrategy->setPercent ( 0, 10, 0 );
			$dayShelfStrategy->setPercent ( 17, 23, 0.02 );
			$dayShelfStrategy->setTaobaoUserId ( $taobao_user_id );
			$weekShelfStrategy->addDayShelfStrategy($dayShelfStrategy);
		}
		
		$weekShelfStrategy->fillRemainPercent ();
		return $weekShelfStrategy;
	}
}
?>