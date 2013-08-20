<?php
class ShelfController extends Controller {
	/**
	 * Declares class-based actions.
	 */
	public $layout = '//layouts/column2';
	public function actionGetGoodNum() {
		// 实例化TopClient类
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$req = new UserSellerGetRequest ();
		// $req->setFields ( "nick,user_id,type" );
		$req->setFields ( "user_id,nick,sex,seller_credit,type,has_more_pic,item_img_num,item_img_size,prop_img_num,prop_img_size,auto_repost,promoted_type,status,alipay_bind,consumer_protection,avatar,liangpin,sign_food_seller_promise,has_shop,is_lightning_consignment,has_sub_stock,is_golden_seller,vip_info,magazine_subscribe,vertical_market,online_gaming" );
		
		// 执行API请求并打印结果
		$resp = $c->execute ( $req, Yii::app ()->user->access_token );
		$this->render ( 'seller_credit_goodNum', array (
				'seller_credit_goodNum' => $resp->user->seller_credit->good_num 
		) );
	}
	public function actionGetOnsaleGoods() {
		$shelfService = new ShelfService();
		$result = $shelfService->getDayStrategy();
		
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$req = new ItemsOnsaleGetRequest ();
		$req->setFields ( "num_iid,title,price,list_time,delist_time" );
		$req->setPageNo ( 1 );
		$req->setOrderBy ( "list_time:desc" );
		$req->setIsTaobao ( "true" );
		$req->setPageSize ( 100 );
		$req->setStartModified ( "2000-01-01 00:00:00" );
		$req->setEndModified ( "2020-01-01 00:00:00" );
		$resp = $c->execute ( $req, Yii::app ()->user->access_token );
		$this->render ( 'getOnsaleGoods', array (
				'items' => json_encode ( $resp->items ) 
		) );
	}
}
