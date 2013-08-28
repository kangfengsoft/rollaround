<?php 
class AdminShelfService{
	const BLOCK_SIZE = 2;
	public function enableShelfAdjust(){
		
	}
	
	public function enableShelfPlanRecount() {
		// just for test
		$taobao_user_id = "3600303259";
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
		$this->recountShelfPlan($weekShelfStrategy, $items);
	}
	
	private function recountShelfPlan($weekShelfStrategy, $items){
		$weekShelfStrategy->insertItems($items);
	}
}
?>