<?php 
class WeekShelfStrategy{
	private $dayShelfStrategyList;
	public function generateDefaultStrategy(){
		for($day=1;$day<6;$day++){
			$dayShelfStrategy = new DayShelfStrategy();
			$dayShelfStrategy->set($day);
			$dayShelfStrategy->setPercent(0, 9, 0);
			$dayShelfStrategy->setPercent(18, 22, 0.02);
			
		}
	}	
	
	public function getDayShelfStrategy($day){
		$dayShelfStrategyList[$day];
	}
}
?>