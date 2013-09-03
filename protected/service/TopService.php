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
		$req->setStartModified ( "2000-01-01 00:00:00" );
		$req->setEndModified ( "2020-01-01 00:00:00" );
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
		$req->setStartModified ( "2000-01-01 00:00:00" );
		$req->setEndModified ( "2020-01-01 00:00:00" );
		$resp = $c->execute ( $req, $access_token );
		return $resp->total_results;
	}
}
?>