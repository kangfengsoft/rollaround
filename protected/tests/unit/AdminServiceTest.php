<?php
// class NewTest extends CTestCase{
class NewTest extends CDbTestCase{
	public $fixtures = array (
			'userConfigs' => 'UserConfig' 
	);
	public function testEnableShelfPlanRecount(){
		$adminShelfService = new AdminShelfService();
// 		$result = $adminShelfService->enableShelfPlanRecount();
		
		$this->assertTrue($this->userConfigs('config1')['id'] ==2);
// 		$this->assertTrue(count($result) == 1);
	}
}
?>