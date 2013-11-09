<?php
class TimedTaskCommand extends CConsoleCommand {
	public function actionIndex($type = 1, $limit = 5) {
		echo "default index, type=" . $type;
	}
	public function actionRecountPlan() {
		//FIXME for test
		$t1 = microtime(true);
		
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$userConfigs = UserConfig::model ()->findAll ();
		
		for($i = 0; $i < count ( $userConfigs ); $i ++) {
			if (! $this->isShelfPlanRecountEnable ()) {
				return;
			}
			if (( int ) $userConfigs [$i]->enable_shelf_service === 0) {
				continue;
			}
			$taobao_user_id = $userConfigs [$i]->taobao_user_id;
			$user = User::model ()->find ( 'taobao_user_id=:taobao_user_id', array (
					':taobao_user_id' => $taobao_user_id 
			) );
			
			$topService = new TopService ();
			$items = $topService->getItemListForPlanRecount ( $user->access_token );
			
			$shelfService = new ShelfService ();
			$weekShelfStrategy = $shelfService->getSavedtWeekShelfStrategy( $taobao_user_id );
			$weekShelfStrategy->recountShelfPlan ( $items, $taobao_user_id );
		}
		
		//FIXME for test
		$t2 = microtime(true);
		echo 'RecountPlan finish in '.date('Y-m-d H:i:s').', cost time: '.(($t2-$t1)*1000)."ms\n";
	}
	
	public function actionExecuteListTask($timeInterval = 60) {
		//FIXME for test
		$t1 = microtime(true);
		
		$adminShelfService = new AdminShelfService();
		$topService = new TopService();
		if (!$adminShelfService->isListTaskEnable()) {
			return;
		}
		$nextListTime = date('Y-m-d H:i:s',strtotime('+'.$timeInterval.' second'));
		$listTasks = ListTask::model ()->findAll ( 'list_time<=:list_time', array (
				':list_time' => $nextListTime
		) );
// 		$listTasks = ListTask::model ()->findAll ();
		echo count($listTasks);
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
		
		//FIXME for test
		$t2 = microtime(true);
		echo 'executeListTask finish in '.date('Y-m-d H:i:s').', cost time: '.(($t2-$t1)*1000)."ms\n";
	}
	
	public function isShelfPlanRecountEnable() {
		$adminConfig = AdminConfig::model ()->find ( 'config_key=:config_key', array (
				':config_key' => Consts::CONFIG_KEY_SHELF_PLAN_RECOUNT 
		) );
		
		if ($adminConfig === null) {
			$adminConfig = new AdminConfig ();
			$adminConfig->config_key = Consts::CONFIG_KEY_SHELF_PLAN_RECOUNT;
			$adminConfig->config_value = "false";
			$adminConfig->save ();
		}
		return $adminConfig->config_value === "true";
	}
	
	public function actionResetShowcase() {
		//FIXME for test
		$t1 = microtime(true);
		
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$userConfigs = UserConfig::model ()->findAll ();
		$items = [];
		for($i = 0; $i < count ( $userConfigs ); $i ++) {
			//FIXME for test
// 			if (( int ) $userConfigs [$i]->enable_shelf_service === 0) {
// 				continue;
// 			}

			$taobao_user_id = $userConfigs [$i]->taobao_user_id;
			$user = User::model ()->find ( 'taobao_user_id=:taobao_user_id', array (
					':taobao_user_id' => $taobao_user_id
			) );
			
			//FIXME for test
			if(Yii::app ()->params ['testMode'] && !Util::startsWith($user->taobao_user_nick,"sandbox")){
				continue;
			}
			if(!Yii::app ()->params ['testMode'] && Util::startsWith($user->taobao_user_nick,"sandbox")){
				continue;
			}
				
			$topService = new TopService ();
// 			$items = $topService->getShowcaseItems ( $user->access_token );
// 			$numIids = [];
// 			for($i = 0;$i<count($items);$i++){
// 				$numIids[] = $items[$i]->num_iid;
// 			}
// 			$topService->deleteShowcaseItems($numIids, $user->access_token);
// 			$shopShowcase = $topService->getShopShowcase($user->access_token);
// 			$remainShowcase = $shopShowcase->shop->remain_count;
			$topService->useAllShowcase($user->access_token);
			
		}
		
		//FIXME for test
		$t2 = microtime(true);
		echo 'ResetShowcase finish in '.date('Y-m-d H:i:s').', cost time: '.(($t2-$t1)*1000)."ms\n";
	}
}
?>