<?php 
class TopService {
	public function getSeller($accessToken) {
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$req = new UserSellerGetRequest ();
		$req->setFields ( "user_id,nick,avatar" );
		return $c->execute ( $req, $accessToken );
	}
	
	public function getOnlineGoodNum($access_token){
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$req = new ItemsOnsaleGetRequest ();
		$req->setFields ( "num_iid" );
		$req->setPageNo ( 1 );
		$req->setOrderBy ( "list_time:desc" );
		$req->setIsTaobao ( "true" );
		$req->setPageSize ( 1 );
// 		$req->setStartModified ( "2000-01-01 00:00:00" );
// 		$req->setEndModified ( "2020-01-01 00:00:00" );
		$resp = $c->execute ( $req, $access_token );
		return $resp->total_results;
	}
	
	public function getInventoryGoodNum($access_token){
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$req = new ItemsInventoryGetRequest();
		$req->setFields ( "num_iid" );
		$req->setPageNo ( 1 );
		$req->setOrderBy ( "list_time:desc" );
		$req->setIsTaobao ( "true" );
		$req->setPageSize ( 1 );
// 		$req->setStartModified ( "2000-01-01 00:00:00" );
// 		$req->setEndModified ( "2020-01-01 00:00:00" );
		$resp = $c->execute ( $req, $access_token );
		return $resp->total_results;
	}
	
	public function searchOnsaleItems($query, $access_token, $pageNo, $pageSize, $sortDir, $sortType){
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$req = new ItemsOnsaleGetRequest();
		$req->setFields ( "num_iid,price, delist_time, pic_url, title" );
		$req->setPageNo ( $pageNo );
		
		$req->setIsTaobao ( "true" );
		if($sortType !== ""){
			$req->setOrderBy ( $sortType.":".$sortDir);
		}
		$req->setQ( $query );
		$req->setPageSize ( $pageSize );
		$resp = $c->execute ( $req, $access_token );
		return $resp;
	}
	
	public function searchInventoryItems($query, $access_token, $pageNo, $pageSize){
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$req = new ItemsInventoryGetRequest();
		$req->setFields ( "num_iid,price, delist_time, pic_url, title" );
		$req->setPageNo ( $pageNo );
		$req->setOrderBy ( "title:desc" );
		$req->setIsTaobao ( "true" );
		$req->setQ( $query );
		$req->setPageSize ( $pageSize );
		$resp = $c->execute ( $req, $access_token );
		return $resp;
	}
	
	public function applyListTask($listTask, $access_token){
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$req = new ItemGetRequest();
		$req->setFields("num,list_time,approve_status");
		$req->setNumIid($listTask->num_iid);
		$resp = $c->execute ( $req, $access_token );
		$num = $resp->item->num;
		$list_time = $resp->item->list_time;
		
		//only adjust the item which is onsale.
		if($resp->item->approve_status != "onsale"){
			return;
		}
		
		//check if the item is already in right list time
		$actual_day = date ( 'w', strtotime ( $list_time ) );
		$actual_hour = (int)date ( 'H', strtotime ( $list_time ) );
		$task_day = date ( 'w', strtotime ( $listTask->list_time ) );
		$task_hour = (int)date ( 'H', strtotime ( $listTask->list_time ) );
		if($actual_day == $task_day && $actual_hour == $task_hour){
			//the item is already in right time
			return;
		}
		
		
		//FIXME is it necessary?
		$req = new ItemUpdateDelistingRequest();
		$req->setNumIid($listTask->num_iid);
		$resp = $c->execute ( $req, $access_token );
		
		$req = new ItemUpdateListingRequest();
		$req->setNumIid($listTask->num_iid);
		$req->setNum($num);
		$resp = $c->execute ( $req, $access_token );
	}
	
	public function getItemList($numIids, $access_token){
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$req = new ItemsListGetRequest();
		$req->setFields("title,pic_url,price,num_iid,delist_time");
		$req->setNumIids($numIids);
		return $c->execute ( $req, $access_token );
	}
	
	public function getItemListForPlanRecount($access_token){
		$PAGE_SIZE = 200;
		$count = $PAGE_SIZE;
		$pageNo = 1;
		$items = array ();
		
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		while ( $count == $PAGE_SIZE ) {
			$req = new ItemsOnsaleGetRequest ();
			$req->setFields ( "num_iid,list_time,delist_time" );
			$req->setPageNo ( $pageNo ++ );
			$req->setOrderBy ( "list_time:desc" );
			$req->setPageSize ( $PAGE_SIZE );
			$resp = $c->execute ( $req, $access_token );
			if($resp->total_results ===0){
				break;
			}
			$count = count ( $resp->items->item );
			$items = array_merge ( $items, $resp->items->item );
		}
		return $items;
	}
}
?>
