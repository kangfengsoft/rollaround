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
	public function actionGetOnsaleGoodNum() {
		$topService = new TopService();
		$accessToken = Util::getCurrentUser()->access_token;
		$onlineGoodNum = $topService->getOnlineGoodNum($this->user->$accessToken);
		$this->render ( 'onsaleGoodNum', array (
				'items' => $onlineGoodNum 
		) );
	}
	
	public function actionEnableShelfService() {
		$enable = Yii::app ()->request->getParam ( 'enable' );
		if ($enable === "true") {
			$enable = 1;
		} else {
			$enable = 0;
		}
		
		$taobao_user_id = Yii::app ()->user->taobao_user_id;
		$userConfig = UserConfig::model ()->find ( 'taobao_user_id=:taobao_user_id', array (
				':taobao_user_id' => $taobao_user_id 
		) );
		if ($userConfig === null) {
			$userConfig = new UserConfig ();
			$userConfig->taobao_user_id = $taobao_user_id;
		}
		$userConfig->enable_shelf_service = $enable;
		$userConfig->save ();
		$this->redirect ( $this->createUrl ( "site/index" ) );
	}
	
	public function actionSaveAssignTask() {
		$num_iid = Yii::app ()->request->getParam ( 'num_iid' );
		$day = Yii::app ()->request->getParam ( 'day' );
		$hour = Yii::app ()->request->getParam ( 'hour' );
		if(!isset( $num_iid ) || ! isset ( $day ) || ! isset ( $hour )) {
			// 400 错误请求 — 请求中有语法问题，或不能满足请求。
			Yii::log ( "illegal argument when SaveAssignTask!", 'warning', '' );
			throw new CHttpException ( 400, '参数非法' );
		}
		$taobao_user_id = Yii::app ()->user->taobao_user_id;
		$shelfService = new ShelfService();
		$shelfService -> saveAssignTask($num_iid, $day, $hour, $taobao_user_id);
		return "ok";
	}
	
	public function actionDeleteAssignTask(){
		$num_iid = Yii::app ()->request->getParam ( 'num_iid' );
		if (! isset ( $num_iid ) ) {
			// 400 错误请求 — 请求中有语法问题，或不能满足请求。
			Yii::log ( "illegal argument when DeleteAssignTask!", 'warning', '' );
			throw new CHttpException ( 400, '参数非法' );
		}
		$taobao_user_id = Yii::app ()->user->taobao_user_id;
		$shelfService = new ShelfService();
		$shelfService -> deleteAssignTask($num_iid, $taobao_user_id);
		
	}
	
	public function actionGetAllAssignTasks() {
		$taobao_user_id = Yii::app ()->user->taobao_user_id;
		//$sEcho = $_GET['sEcho'];
		$shelfService = new ShelfService();
		$aaData = $shelfService -> getAllAssignTask($taobao_user_id);
		
		
		//$count = count($aaData);
		$result = array(
				"aaData" => $aaData
		);
		echo json_encode($result);
	}
	
	public function actionSaveExcludeTask(){
		$num_iid = Yii::app ()->request->getParam ( 'num_iid' );
		if(!isset( $num_iid )) {
			// 400 错误请求 — 请求中有语法问题，或不能满足请求。
			Yii::log ( "illegal argument when SaveExcludeTask!", 'warning', '' );
			throw new CHttpException ( 400, '参数非法' );
		}
		$taobao_user_id = Yii::app ()->user->taobao_user_id;
		$shelfService = new ShelfService();
		$shelfService -> saveExcludeTask($num_iid, $taobao_user_id);
		return "ok";
	}
	
	public function actionDeleteExcludeTask(){
		$num_iid = Yii::app ()->request->getParam ( 'num_iid' );
		if (! isset ( $num_iid ) ) {
			// 400 错误请求 — 请求中有语法问题，或不能满足请求。
			Yii::log ( "illegal argument when DeleteExcludeTask!", 'warning', '' );
			throw new CHttpException ( 400, '参数非法' );
		}
		$taobao_user_id = Yii::app ()->user->taobao_user_id;
		$shelfService = new ShelfService();
		$shelfService -> deleteExcludeTask($num_iid, $taobao_user_id);
	}
	
	public function actionGetAllExcludeTasks() {
		$taobao_user_id = Yii::app ()->user->taobao_user_id;
		$shelfService = new ShelfService();
		$result = $shelfService -> getAllExcludeTasks($taobao_user_id);
		echo json_encode($result);
	}
}
