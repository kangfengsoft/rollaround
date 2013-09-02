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
}
?>