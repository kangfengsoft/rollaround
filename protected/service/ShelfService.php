<?php
class ShelfService {
	public function doJob() {
	}
	
	/*
	 * if $day = -1, return current day's data
	 */
	public function getDayStrategy($day = -1) {
		if ($day == - 1) {
			$day = date ( "w" );
		}
		$shelfStrategy = ShelfStrategy::model ()->find ( 'uid=:uid and dayIndex=:dayIndex', array (
				':uid' => Yii::app ()->user->id,
				':dayIndex' => $day 
		) );
		if ($shelfStrategy == null) {
			$weekShelfStrategy = new WeekShelfStrategy();
			$weekShelfStrategy->generateDefaultStrategy();
			$shelfStrategy = $weekShelfStrategy->getDayShelfStrategy();
		}
		return $shelfStrategy;
	}

	private function saveDefaultStrategy(){
		
	}
}
?>