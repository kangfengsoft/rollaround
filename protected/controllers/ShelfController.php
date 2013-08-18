<?php
class ShelfController extends Controller {
	/**
	 * Declares class-based actions.
	 */
	public $layout = '//layouts/column2';
	public function actionGetAll() {
		// 实例化TopClient类
		$c = new TopClient ();
		$c->appkey = Yii::app ()->params ['client_id'];
		$c->secretKey = Yii::app ()->params ['client_secret'];
		$sessionkey = Yii::app ()->user->access_token;
		$c->sessionkey = $sessionkey; // 如沙箱测试帐号sandbox_c_1授权后得到的sessionkey
		                             // 实例化具体API对应的Request类
		$req = new UserSellerGetRequest ();
		// $req->setFields ( "nick,user_id,type" );
		$req->setFields ( "user_id,nick,sex,seller_credit,type,has_more_pic,item_img_num,item_img_size,prop_img_num,prop_img_size,auto_repost,promoted_type,status,alipay_bind,consumer_protection,avatar,liangpin,sign_food_seller_promise,has_shop,is_lightning_consignment,has_sub_stock,is_golden_seller,vip_info,magazine_subscribe,vertical_market,online_gaming" );
		
		// 执行API请求并打印结果
		$resp = $c->execute ( $req, $sessionkey );
// 		echo "result:";
// 		print_r ( $resp );
// 		echo "<br>";
		$this->render('getAll',array('goodNum'=>$resp->user->seller_credit->good_num));
	}
}