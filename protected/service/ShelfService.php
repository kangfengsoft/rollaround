<?php
class ShelfService {
	public function doJob() {
	}
	
	/*
	 * if $day = -1, return current day's data
	 */
	// public function getDayStrategy($taobao_user_id = null, $day = null) {
	// if ($day == null) {
	// $day = date ( "w" );
	// }
	// if ($taobao_user_id == null) {
	// $taobao_user_id = Yii::app ()->user->taobao_user_id;
	// }
	// $shelfStrategy = ShelfStrategy::model ()->find ( 'taobao_user_id=:taobao_user_id and day=:day', array (
	// ':taobao_user_id' => $taobao_user_id,
	// ':day' => $day
	// ) );
	// $dayShelfStrategy = null;
	// if ($shelfStrategy == null) {
	// $weekShelfStrategy = WeekShelfStrategyFactory::createDefaultStrategy($taobao_user_id);
	// $weekShelfStrategy->saveToDB();
	// $dayShelfStrategy = $weekShelfStrategy->getDayShelfStrategy ( $day );
	// } else {
	// $dayShelfStrategy = new DayShelfStrategy ( $shelfStrategy );
	// }
	// return $dayShelfStrategy;
	// }
	public function getWeekShelfStrategy($taobao_user_id = null) {
		if ($taobao_user_id == null) {
			$taobao_user_id = Yii::app ()->user->taobao_user_id;
		}
		$shelfStrategyList = ShelfStrategy::model ()->findAll ( 'taobao_user_id=:taobao_user_id', array (
				':taobao_user_id' => $taobao_user_id 
		) );
		$weekShelfStrategy = null;
		if (count ( $shelfStrategyList ) == 0) {
			$weekShelfStrategy = WeekShelfStrategyFactory::createDefaultStrategy ( $taobao_user_id );
			$weekShelfStrategy->saveToDB ();
		} else {
			$weekShelfStrategy = new WeekShelfStrategy ( $shelfStrategyList );
		}
		return $weekShelfStrategy;
	}
	public function saveWeekShelfStrategy($distributionList) {
		$taobao_user_id = Yii::app ()->user->taobao_user_id;
		$weekShelfStrategy = new WeekShelfStrategy();
		for($day = 0; $day < 7; $day ++) {
			$shelfStrategy = ShelfStrategy::model ()->find ( 'taobao_user_id=:taobao_user_id and day=:day', array (
					':taobao_user_id' => $taobao_user_id,
					':day' => $day 
			) );
			if ($shelfStrategy == null) {
				$shelfStrategy = new ShelfStrategy ();
				$shelfStrategy->taobao_user_id = $taobao_user_id;
				$shelfStrategy->day = $day;
			}
			$shelfStrategy->distribution = $distributionList [$day];
			$dayShelfStrategy = new DayShelfStrategy($shelfStrategy);
			$weekShelfStrategy->addDayShelfStrategy($dayShelfStrategy);
			$weekShelfStrategy->fillRemainPercent();
			
		}
		$weekShelfStrategy->saveToDB();
	}
}
?>