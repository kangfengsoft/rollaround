<?php
class ShelfService {
	/*
	 * if $day = -1, return current day's data
	 */
	/*
	public function getDayStrategy($taobao_user_id = null, $day = null) {
		if ($day == null) {
			$day = date ( "w" );
		}
		if ($taobao_user_id == null) {
			$taobao_user_id = Yii::app ()->user->taobao_user_id;
		}
		$shelfStrategy = ShelfStrategy::model ()->find ( 'taobao_user_id=:taobao_user_id and day=:day', array (
				':taobao_user_id' => $taobao_user_id,
				':day' => $day 
		) );
		$dayShelfStrategy = null;
		if ($shelfStrategy == null) {
			$weekShelfStrategy = WeekShelfStrategyFactory::createDefaultStrategy ( $taobao_user_id );
			$weekShelfStrategy->saveToDB ();
			$dayShelfStrategy = $weekShelfStrategy->getDayShelfStrategy ( $day );
		} else {
			$dayShelfStrategy = new DayShelfStrategy ( $shelfStrategy );
		}
		return $dayShelfStrategy;
	}
	*/
	
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
		}
		$weekShelfStrategy->fillRemainPercent();
		$weekShelfStrategy->saveToDB();
	}
	public function saveAssignTask($num_iid, $day, $hour, $taobao_user_id) {
		$assignListTask = AssignListTask::model ()->find ( "num_iid=:num_iid AND taobao_user_id=:taobao_user_id AND exclude=:exclude", array (
				":num_iid" => $num_iid,
				":taobao_user_id" => $taobao_user_id,
				":exclude" => 0 
		) );
		if ($assignListTask === null) {
			$assignListTask = new AssignListTask ();
			$assignListTask->num_iid = $num_iid;
			$assignListTask->taobao_user_id = $taobao_user_id;
		}
		$assignListTask->day = $day;
		$assignListTask->hour = $hour;
		$assignListTask->save ();
	}
	
	public function deleteAssignTask($num_iid, $taobao_user_id){
		$assignListTask = AssignListTask::model() -> find("num_iid=:num_iid AND taobao_user_id=:taobao_user_id", array(
				":num_iid" => $num_iid,
				":taobao_user_id" => $taobao_user_id
		));
		if($assignListTask !== null){
			$assignListTask->delete();
		}
	}
	
	public function getAllAssignTasks($taobao_user_id){
		$assignListTasks = AssignListTask::model() -> findAll("taobao_user_id=:taobao_user_id AND exclude=:exclude", array(
				":taobao_user_id" => $taobao_user_id,
				":exclude" => 0
		));
		$numIids = array();
		$allItemList = array ();
		$access_token = Util::getAccessToken ( $taobao_user_id );
		$topService = new TopService ();
		$k = 0;
		foreach ( $assignListTasks as $assignListTask ) {
			$numIids [] = $assignListTask->num_iid;
			$k++;
			if (count ( $numIids ) === 20 || $k === count($assignListTasks)) {
				$itemList = $topService->getItemList ( join ( ",", $numIids ), $access_token );
				foreach ( $itemList->items->item as $item ) {
					$allItemList [] = $item;
				}
				$numIids = array ();
			}
		}
		$conbinedItemList = array();
		foreach($assignListTasks as $key=>$assignListTask){
			$conbinedItemList[$key] = array();
			$conbinedItemList[$key]["num_iid"] = $allItemList[$key]->num_iid;
			$conbinedItemList[$key]["title"] = $allItemList[$key]->title;
			$conbinedItemList[$key]["price"] = $allItemList[$key]->price;
			if(isset($allItemList[$key]->pic_url)){
				$conbinedItemList[$key]["pic_url"] = $allItemList[$key]->pic_url;
			}
			$conbinedItemList[$key]["day"] = $assignListTask->day;
			$conbinedItemList[$key]["hour"] = $assignListTask->hour;
		}
		return $conbinedItemList;
	}
	
	public function saveExcludeTask($num_iid, $taobao_user_id) {
		$assignListTask = AssignListTask::model ()->find ( "num_iid=:num_iid AND taobao_user_id=:taobao_user_id", array (
				":num_iid" => $num_iid,
				":taobao_user_id" => $taobao_user_id
		) );
		if ($assignListTask === null) {
			$assignListTask = new AssignListTask ();
			$assignListTask->num_iid = $num_iid;
			$assignListTask->taobao_user_id = $taobao_user_id;
		}
		$assignListTask->exclude = 1;
		$assignListTask->save ();
	}
	
	public function deleteExcludeTask($num_iid, $taobao_user_id){
		$assignListTask = AssignListTask::model() -> find("num_iid=:num_iid AND taobao_user_id=:taobao_user_id AND exclude=:exclude", array(
				":num_iid" => $num_iid,
				":taobao_user_id" => $taobao_user_id,
				":exclude" => 1
		));
		if($assignListTask !== null){
			$assignListTask->delete();
		}
	}
	
	public function getAllExcludeTasks($taobao_user_id){
		$assignListTasks = AssignListTask::model() -> findAll("taobao_user_id=:taobao_user_id AND exclude=:exclude", array(
				":taobao_user_id" => $taobao_user_id,
				":exclude" => 1
		));
		$numIids = array();
		$allItemList = array ();
		$access_token = Util::getAccessToken ( $taobao_user_id );
		$topService = new TopService ();
		foreach ( $assignListTasks as $assignListTask ) {
			$numIids [] = $assignListTask->num_iid;
			if (count ( $numIids ) === 20) {
				$itemList = $topService->getItemList ( join ( ",", $numIids ), $access_token );
				foreach ( $itemList->items->item as $item ) {
					$allItemList [] = $item;
				}
				$numIids = array ();
			}
		}
		return $allItemList;
	}

	public function getShopScore($taobao_user_id){
		$shopScore = ShopScore::model()->find("taobao_user_id=:taobao_user_id", array(
				":taobao_user_id" => $taobao_user_id
		));
		$todayDate = date ( 'Y-m-d', time ());
		$createDate = "";
		$scoreCreateDate = null;
		if($shopScore !== null){
			$createDate = date("Y-m-d",strtotime($shopScore->create_time)); 
		}else{
			$shopScore = new ShopScore();
			$shopScore->taobao_user_id = $taobao_user_id;
		}
		if($todayDate != $createDate){
			$shopScore->score = $this->calculateShopScore($taobao_user_id);
			$shopScore->create_time = date ( 'Y-m-d H:i:s', time ());
			$shopScore->save();
		}
		return $shopScore->score;
	}
	
	private function calculateShopScore($taobao_user_id){
		$topService = new TopService();
		$access_token = Util::getAccessToken ( $taobao_user_id );
		$items = $topService->getItemListForPlanRecount($access_token);
		
		$shelfService = new ShelfService();
		$weekShelfStrategy = $shelfService->getWeekShelfStrategy($taobao_user_id);
		return $weekShelfStrategy->calculateShopScore($items);
	}
}
?>
