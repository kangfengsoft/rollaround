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
}
?>