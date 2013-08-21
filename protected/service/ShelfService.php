<?php
class ShelfService {
	public function doJob() {
	}
	
	/*
	 * if $day = -1, return current day's data
	 */
	public function getDayStrategy($uid = null, $day = null) {
		if ($day == null) {
			$day = date ( "w" );
		}
		if($uid == null){
			$uid = Yii::app ()->user->id;
		}
		$shelfStrategy = ShelfStrategy::model ()->find ( 'uid=:uid and dayIndex=:dayIndex', array (
				':uid' => $uid,
				':dayIndex' => $day 
		) );
		$dayShelfStrategy = null;
		if ($shelfStrategy == null) {
			$weekShelfStrategy = new WeekShelfStrategy();
			$weekShelfStrategy->createDefaultStrategy();
			$dayShelfStrategy = $weekShelfStrategy->getDayShelfStrategy($day);
		}else{
			$dayShelfStrategy = new DayShelfStrategy($shelfStrategy);
		}
		return $dayShelfStrategy;
	}
}
?>