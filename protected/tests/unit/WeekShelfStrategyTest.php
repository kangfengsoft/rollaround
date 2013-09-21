<?php
class WeekShelfStrategyTest extends CDbTestCase {
	public $fixtures = array (
			'userConfigs' => 'UserConfig',
			'shelfStrategys' => 'ShelfStrategy',
			'listTasks' => 'ListTask',
			'assignListTasks' => 'AssignListTask'
	);
	
	//small case: item count 10
	public function testRecountShelfPlanSmallCase() {
		$taobao_user_id = $this->userConfigs ( '1' )['taobao_user_id'];
		$this->assertTrue ( $taobao_user_id === "3600303259" );
		$shelfService = new ShelfService ();
		$weekShelfStrategy = $shelfService->getSavedtWeekShelfStrategy ( $taobao_user_id );
// 		$weekShelfStrategy = WeekShelfStrategyFactory::createDefaultStrategy ( $taobao_user_id );
		$this->assertTrue ( count ( $weekShelfStrategy->dayShelfStrategyList ) === 7 );
		
		$items = array();
		for($i = 1; $i <= 10; $i ++) {
			$items [$i] = new stdClass ();
			$items [$i]->num_iid = $i;
			//means the item is originly in saturday
			$items [$i]->list_time = "2013-9-7 00:00:01";
		}
		
		$day = 1;
		$weekShelfStrategy->recountShelfPlan ( $items, $taobao_user_id, $day);
			// echo json_encode($weekShelfStrategy->dayShelfStrategyList);
			
		// check plan_count
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [0]->hours [9] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 0 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [0]->hours [10] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 1 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [1]->hours [9] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 1 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [1]->hours [10] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 1 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [2]->hours [9] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 1 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [2]->hours [10] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 1 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [3]->hours [9] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 1 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [3]->hours [10] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 1 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [4]->hours [9] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 1 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [4]->hours [10] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 1 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [5]->hours [9] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 1 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [5]->hours [10] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 0 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [6]->hours [9] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 0 );
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [6]->hours [10] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 0 );
		//check recount item
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [9] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 1 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [10] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 1 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [6]->hours [0] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 8 );
		
		//check listTask total size in DB
		$listTasks = ListTask::model() -> findAll("taobao_user_id=:taobao_user_id", array(
				":taobao_user_id" => $taobao_user_id
		));
		$this->assertTrue ( count($listTasks) === 6 );
		
		//check new added list task
		$listTask = ListTask::model() -> find("taobao_user_id=:taobao_user_id AND num_iid=:num_iid", array(
				":taobao_user_id" => $taobao_user_id,
				":num_iid" => "10"
		));
		$this->assertTrue ( $listTask !== null );
		$this->assertTrue ( (int)date('w', strtotime($listTask->list_time)) === $day);
		$this->assertTrue ( (int)date('H', strtotime($listTask->list_time)) === 10 );
		
		$listTask = ListTask::model() -> find("taobao_user_id=:taobao_user_id AND num_iid=:num_iid", array(
				":taobao_user_id" => $taobao_user_id,
				":num_iid" => "9"
		));
		$this->assertTrue ( $listTask !== null );
		$this->assertTrue ( (int)date('w', strtotime($listTask->list_time)) === $day);
		$this->assertTrue ( (int)date('H', strtotime($listTask->list_time)) === 9 );
	}
	
	//big case: item count 10000
	public function testRecountShelfPlanBigCase() {
		$taobao_user_id = $this->userConfigs ( '1' )['taobao_user_id'];
		$this->assertTrue ( $taobao_user_id === "3600303259" );
		$shelfService = new ShelfService ();
		$weekShelfStrategy = $shelfService->getSavedtWeekShelfStrategy ( $taobao_user_id );
		// 		$weekShelfStrategy = WeekShelfStrategyFactory::createDefaultStrategy ( $taobao_user_id );
		$this->assertTrue ( count ( $weekShelfStrategy->dayShelfStrategyList ) === 7 );
		$items = array();
		for($i = 1; $i <= 1000; $i ++) {
			$items [$i] = new stdClass ();
			$items [$i]->num_iid = $i;
			//means the item is originly in saturday
			$items [$i]->list_time = "2013-9-7 00:00:01";
		}
		$day = 1;
		$weekShelfStrategy->recountShelfPlan ( $items, $taobao_user_id, $day);
// 		echo json_encode($weekShelfStrategy->dayShelfStrategyList);
			
		//check recount item
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [9] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 6 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [10] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 5 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [11] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 5 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [12] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 5 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [13] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 5 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [14] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 5 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [15] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 5 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [16] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 5 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [17] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 5 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [18] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 20 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [19] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 20 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [20] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 20 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [21] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 20 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [22] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 5 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [$day]->hours [23] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 5 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [6]->hours [0] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 864 );
		
		//check listTask total size in DB
		$detaDay = $day - date ( "w" );
		if ($detaDay < 0) {
			$detaDay += 7;
		}
		$taskYear = date ( "Y", strtotime ( "+".$detaDay." day" ) );
		$taskMonth = date ( "m", strtotime ( "+".$detaDay." day" ) );
		$taskDay = date ( "d", strtotime ( "+".$detaDay." day" ) );
		
		//hour 9  startTime
		$hour = 9;
		$min = 0;
		$second = 0;
		$startTime = date ( 'Y-m-d H:i:s', mktime($hour,$min,$second,$taskMonth,$taskDay,$taskYear) );
		//endtTime
		$hour = 10;
		$min = 0;
		$second = 0;
		$endtTime = date ( 'Y-m-d H:i:s', mktime($hour,$min,$second,$taskMonth,$taskDay,$taskYear) );
		$listTasks = ListTask::model ()->findAll ( 'list_time>=:startTime AND list_time<:endtTime', array (
				':startTime' => $startTime,
				':endtTime' => $endtTime
		) );
		$this->assertTrue ( count($listTasks) === 6 );
			
			// hour 10 ~ 17 startTime
		for($hour = 10; $hour <= 17; $hour ++) {
			$min = 0;
			$second = 0;
			$startTime = date ( 'Y-m-d H:i:s', mktime ( $hour, $min, $second, $taskMonth, $taskDay, $taskYear ) );
			// endtTime
			$min = 0;
			$second = 0;
			$endtTime = date ( 'Y-m-d H:i:s', mktime ( $hour + 1, $min, $second, $taskMonth, $taskDay, $taskYear ) );
			$listTasks = ListTask::model ()->findAll ( 'list_time>=:startTime AND list_time<:endtTime', array (
					':startTime' => $startTime,
					':endtTime' => $endtTime 
			) );
			$this->assertTrue ( count ( $listTasks ) === 5 );
		}
		
		// hour 18 ~ 21 startTime
		for($hour = 18; $hour <= 21; $hour ++) {
			$min = 0;
			$second = 0;
			$startTime = date ( 'Y-m-d H:i:s', mktime ( $hour, $min, $second, $taskMonth, $taskDay, $taskYear ) );
			// endtTime
			$min = 0;
			$second = 0;
			$endtTime = date ( 'Y-m-d H:i:s', mktime ( $hour + 1, $min, $second, $taskMonth, $taskDay, $taskYear ) );
			$listTasks = ListTask::model ()->findAll ( 'list_time>=:startTime AND list_time<:endtTime', array (
					':startTime' => $startTime,
					':endtTime' => $endtTime 
			) );
			$this->assertTrue ( count ( $listTasks ) === 20 );
		}
		
		// hour 22 ~ 23 startTime
		for($hour = 22; $hour <= 23; $hour ++) {
			$min = 0;
			$second = 0;
			$startTime = date ( 'Y-m-d H:i:s', mktime ( $hour, $min, $second, $taskMonth, $taskDay, $taskYear ) );
			// endtTime
			$min = 0;
			$second = 0;
			$endtTime = date ( 'Y-m-d H:i:s', mktime ( $hour + 1, $min, $second, $taskMonth, $taskDay, $taskYear ) );
			$listTasks = ListTask::model ()->findAll ( 'list_time>=:startTime AND list_time<:endtTime', array (
					':startTime' => $startTime,
					':endtTime' => $endtTime
			) );
			$this->assertTrue ( count ( $listTasks ) === 5 );
		}
		
	}
	
	public function testRecountShelfPlanWithExistTask() {
		$taobao_user_id = $this->userConfigs ( '1' )['taobao_user_id'];
		$this->assertTrue ( $taobao_user_id === "3600303259" );
		$shelfService = new ShelfService ();
		$weekShelfStrategy = $shelfService->getSavedtWeekShelfStrategy ( $taobao_user_id );
		// 		$weekShelfStrategy = WeekShelfStrategyFactory::createDefaultStrategy ( $taobao_user_id );
		$this->assertTrue ( count ( $weekShelfStrategy->dayShelfStrategyList ) === 7 );
	
		$items = array();
		for($i = 1; $i <= 10; $i ++) {
			$items [$i] = new stdClass ();
			$items [$i]->num_iid = $i;
			//means the item is originly in saturday
			$items [$i]->list_time = "2013-9-7 00:00:01";
		}
		$items [1]->num_iid = $this->listTasks ( '1' )['num_iid'];
		$items [2]->num_iid = $this->listTasks ( '2' )['num_iid'];
	
		$day = 0;
		$weekShelfStrategy->recountShelfPlan ( $items, $taobao_user_id, $day);
// 		echo json_encode($weekShelfStrategy->dayShelfStrategyList);
			
// 		// check $weekShelfStrategy
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [0]->hours [10] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 1 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [0]->hours [10] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 1 );
		
		$this->assertTrue ( $weekShelfStrategy->dayShelfStrategyList [2]->hours [0] [DayShelfStrategy::HOUR_FIELD_PLANCOUNT] == 0 );
		$this->assertTrue ( count($weekShelfStrategy->dayShelfStrategyList [2]->hours [0] [DayShelfStrategy::HOUR_FIELD_ITEMLIST]) == 2 );
		
		//check listTask total size in DB
		$listTasks = ListTask::model() -> findAll("taobao_user_id=:taobao_user_id", array(
				":taobao_user_id" => $taobao_user_id
		));
		$this->assertTrue ( count($listTasks) === 5 );
		
		//check assignListTask
		$listTask = ListTask::model() -> find("taobao_user_id=:taobao_user_id AND num_iid=:num_iid", array(
				":taobao_user_id" => $taobao_user_id,
				":num_iid" => $this->assignListTasks('1')['num_iid']
		));
		$this->assertTrue ( $listTask !== null );
		$this->assertTrue ( (int)date('w', strtotime($listTask->list_time)) === 0 );
		$this->assertTrue ( (int)date('H', strtotime($listTask->list_time)) === 0 );
		
		$listTask = ListTask::model() -> find("taobao_user_id=:taobao_user_id AND num_iid=:num_iid", array(
				":taobao_user_id" => $taobao_user_id,
				":num_iid" => $this->assignListTasks('2')['num_iid']
		));
		$this->assertTrue ( $listTask !== null );
		$this->assertTrue ( (int)date('w', strtotime($listTask->list_time)) === 1 );
		$this->assertTrue ( (int)date('H', strtotime($listTask->list_time)) === 1 );
		
		//check already listTask
		$listTask = ListTask::model() -> find("taobao_user_id=:taobao_user_id AND num_iid=:num_iid", array(
				":taobao_user_id" => $taobao_user_id,
				":num_iid" => $this->listTasks('1')['num_iid']
		));
		$this->assertTrue ( $listTask !== null );
		$this->assertTrue ( (int)date('w', strtotime($listTask->list_time)) === 2 );
		$this->assertTrue ( (int)date('H', strtotime($listTask->list_time)) === 0 );
		
		$listTask = ListTask::model() -> find("taobao_user_id=:taobao_user_id AND num_iid=:num_iid", array(
				":taobao_user_id" => $taobao_user_id,
				":num_iid" => $this->listTasks('2')['num_iid']
		));
		$this->assertTrue ( $listTask !== null );
		$this->assertTrue ( (int)date('w', strtotime($listTask->list_time)) === 2 );
		$this->assertTrue ( (int)date('H', strtotime($listTask->list_time)) === 0 );
		
		//check new added list task
		$listTask = ListTask::model() -> find("taobao_user_id=:taobao_user_id AND num_iid=:num_iid", array(
				":taobao_user_id" => $taobao_user_id,
				":num_iid" => "10"
		));
		$this->assertTrue ( $listTask !== null );
		$this->assertTrue ( (int)date('w', strtotime($listTask->list_time)) === $day );
		$this->assertTrue ( (int)date('H', strtotime($listTask->list_time)) === 10 );
	}
}
?>