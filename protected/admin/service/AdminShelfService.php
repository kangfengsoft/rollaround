<?php 
class AdminShelfService{
	const BLOCK_SIZE = 200;

	public function getUserConfig($taobao_user_id){
		$userConfig = UserConfig::model ()->find ( 'taobao_user_id=:taobao_user_id', array (
				':taobao_user_id' => $taobao_user_id
		) );
		if ($userConfig === null) {
			$userConfig = new UserConfig ();
			$userConfig->taobao_user_id = $taobao_user_id;
			$userConfig->enable_shelf_service = 0;
			$userConfig->save ();
		}
		return $userConfig;
	}
	
	public function enableShelfPlanRecount() {
		$userConfigs = UserConfig::model ()->findAll ();
		
		//FIXME use interator instead
		for($i = 0; $i < count ( $userConfigs ); $i ++) {
			if($this->getShelfPlanRecountConfig()->config_value !== "true"){
				return;
			}
			if($userConfigs[$i]->enable_shelf_service === 0){
				continue;
			}
			$taobao_user_id = $userConfigs[$i]->taobao_user_id;
			$user = User::model ()->find ( 'taobao_user_id=:taobao_user_id', array (
					':taobao_user_id' => $taobao_user_id
			) );
			
			$c = new TopClient ();
			$c->appkey = Yii::app ()->params ['client_id'];
			$c->secretKey = Yii::app ()->params ['client_secret'];
			
			$count = self::BLOCK_SIZE;
			$pageNum = 1;
			$items = array ();
			while ( $count == self::BLOCK_SIZE ) {
				$req = new ItemsOnsaleGetRequest ();
				$req->setFields ( "num_iid,list_time,delist_time" );
				$req->setPageNo ( $pageNum ++ );
				$req->setOrderBy ( "list_time:desc" );
				$req->setIsTaobao ( "true" );
				$req->setPageSize ( self::BLOCK_SIZE );
				$req->setStartModified ( "2000-01-01 00:00:00" );
				$req->setEndModified ( "2020-01-01 00:00:00" );
				$resp = $c->execute ( $req, $user->access_token );
				$count = count ( $resp->items->item );
				$items = array_merge ( $items, $resp->items->item );
			}
			$shelfService = new ShelfService();
			$weekShelfStrategy = $shelfService->getWeekShelfStrategy($taobao_user_id);
			$weekShelfStrategy->recountShelfPlan($items);
		}
	}
	
	public function getShelfPlanRecountConfig(){
		$adminConfig = AdminConfig::model ()->find ( 'config_key=:config_key', array (
				':config_key' => Consts::CONFIG_KEY_SHELF_PLAN_RECOUNT
		) );
		
		if ($adminConfig == null) {
			$adminConfig = new AdminConfig ();
			$adminConfig->config_key = Consts::CONFIG_KEY_SHELF_PLAN_RECOUNT;
			$adminConfig->config_value= "false";
			$adminConfig->save();
		}
		return $adminConfig;
	}
}
?>