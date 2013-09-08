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
		$req->setFields("num");
		$req->setNumIid($listTask->num_iid);
		$resp = $c->execute ( $req, $access_token );
		$num = $resp->item->num;
		
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
}
?>
