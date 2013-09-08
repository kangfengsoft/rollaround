<?php
class WeekShelfStrategyTest extends CDbTestCase {
	public $fixtures = array (
			'userConfigs' => 'UserConfig',
			'shelfStrategys' => 'ShelfStrategy' 
	);
	public function testRecountShelfPlan() {
		$taobao_user_id = $this->userConfigs ( '1' )['taobao_user_id'];
		$this->assertTrue ( $taobao_user_id === "3600303259" );
		$shelfService = new ShelfService ();
		$weekShelfStrategy = $shelfService->getWeekShelfStrategy ( $taobao_user_id );
		$this->assertTrue ( count ( $weekShelfStrategy->dayShelfStrategyList ) === 7 );
		
		$items = array();
		for($i = 1; $i < 10; $i ++) {
			$items [$i] = new stdClass ();
			$items [$i]->num_iid = 123;
			$items [$i]->list_time = "2013-9-8 00:00:01";
		}
		
		$weekShelfStrategy->recountShelfPlan ( $items, $taobao_user_id );
		//TODO
		//write assert
	}
}
?>