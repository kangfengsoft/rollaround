<?php
class ShelfServiceTest extends CDbTestCase{
	public $fixtures = array (
			'userConfigs' => 'UserConfig',
			'shelfStrategys' => 'ShelfStrategy',
	);
	public function testGetWeekShelfStrategy(){
		$taobao_user_id = $this->userConfigs('1')['taobao_user_id'];
		$this->assertTrue($taobao_user_id === "3600303259");
		$shelfService = new ShelfService();
		$weekShelfStrategy = $shelfService->getWeekShelfStrategy($taobao_user_id);
		$this->assertTrue(count($weekShelfStrategy->dayShelfStrategyList) === 7);
	}
}
?>