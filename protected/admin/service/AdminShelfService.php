<?php 
class AdminShelfService{
	const BLOCK_SIZE = 200;

	public function enableShelfPlanRecount() {
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$userConfigs = UserConfig::model ()->findAll ();
		
		//FIXME use interator instead
		for($i = 0; $i < count ( $userConfigs ); $i ++) {
			if(!$this->isShelfPlanRecountEnable()){
				return;
			}
			if((int)$userConfigs[$i]->enable_shelf_service === 0){
				continue;
			}
			$taobao_user_id = $userConfigs[$i]->taobao_user_id;
			$user = User::model ()->find ( 'taobao_user_id=:taobao_user_id', array (
					':taobao_user_id' => $taobao_user_id
			) );
			
// 			$count = self::BLOCK_SIZE;
// 			$pageNo = 1;
// 			$items = array ();
// 			while ( $count == self::BLOCK_SIZE ) {
// 				$req = new ItemsOnsaleGetRequest ();
// 				$req->setFields ( "num_iid,list_time,delist_time" );
// 				$req->setPageNo ( $pageNo ++ );
// 				$req->setOrderBy ( "list_time:desc" );
// 				$req->setPageSize ( self::BLOCK_SIZE );
// 				$resp = $c->execute ( $req, $user->access_token );
// 				$count = count ( $resp->items->item );
// 				$items = array_merge ( $items, $resp->items->item );
// 			}
			$topService = new TopService();
			$items = $topService->getItemListForPlanRecount($user->access_token);
			
			$shelfService = new ShelfService();
			$weekShelfStrategy = $shelfService->getSavedtWeekShelfStrategy($taobao_user_id);
			$weekShelfStrategy->recountShelfPlan($items, $taobao_user_id);
		}
	}
	
	public function isShelfPlanRecountEnable(){
		$adminConfig = AdminConfig::model ()->find ( 'config_key=:config_key', array (
				':config_key' => Consts::CONFIG_KEY_SHELF_PLAN_RECOUNT
		) );
		
		if ($adminConfig === null) {
			$adminConfig = new AdminConfig ();
			$adminConfig->config_key = Consts::CONFIG_KEY_SHELF_PLAN_RECOUNT;
			$adminConfig->config_value= "false";
			$adminConfig->save();
		}
		return $adminConfig->config_value === "true";
	}
	
	public function setShelfPlanRecountConfig($enable){
		$adminConfig = AdminConfig::model ()->find ( 'config_key=:config_key', array (
				':config_key' => Consts::CONFIG_KEY_SHELF_PLAN_RECOUNT
		) );
		
		if ($adminConfig === null) {
			$adminConfig = new AdminConfig ();
			$adminConfig->config_key = Consts::CONFIG_KEY_SHELF_PLAN_RECOUNT;
		}
		$adminConfig->config_value= $enable === true ? "true" : "false";
		$adminConfig->save();
	}
	
	public function enableListTask(){
		$topService = new TopService();
		while ( true ) {
			if (!$this->isListTaskEnable()) {
				return;
			}
			$nextListTime = date('Y-m-d H:i:s',strtotime('+30 second'));
			$listTasks = ListTask::model ()->findAll ( 'list_time<=:list_time', array (
					':list_time' => $nextListTime
			) );
			foreach($listTasks as $listTask){
				$access_token = Util::getAccessToken($listTask->taobao_user_id);
				$topService->applyListTask($listTask, $access_token);
				$listLog = new ListLog();
				$listLog->taobao_user_id = $listTask->taobao_user_id;
				$listLog->num_iid = $listTask->num_iid;
				$listLog->execute_time = $listTask->list_time;
				$listLog->save();
				$listTask->delete();
			}
			
			//FIXME remove later
			return;
		}
	}
	
	public function isListTaskEnable() {
		$adminConfig = AdminConfig::model ()->find ( 'config_key=:config_key', array (
				':config_key' => Consts::CONFIG_KEY_LIST_TASK 
		) );
		
		if ($adminConfig === null) {
			$adminConfig = new AdminConfig ();
			$adminConfig->config_key = Consts::CONFIG_KEY_LIST_TASK;
			$adminConfig->config_value = "false";
			$adminConfig->save ();
		}
		return $adminConfig->config_value === "true";
	}
	public function setListTaskConfig($enable) {
		$adminConfig = AdminConfig::model ()->find ( 'config_key=:config_key', array (
				':config_key' => Consts::CONFIG_KEY_LIST_TASK 
		) );
		
		if ($adminConfig === null) {
			$adminConfig = new AdminConfig ();
			$adminConfig->config_key = Consts::CONFIG_KEY_LIST_TASK;
		}
		$adminConfig->config_value = $enable === true ? "true" : "false";
		$adminConfig->save ();
	}
}
?>
