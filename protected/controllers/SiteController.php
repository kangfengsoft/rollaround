<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		$access_token = $this->getCurrentAccessToken ();
		$shelfService = new ShelfService ();
		$weekShelfStrategy = $shelfService->getWeekShelfStrategy ();
		
		$adminShelfService = new AdminShelfService ();
		$userConfig = $adminShelfService->getUserConfig ( Yii::app ()->user->taobao_user_id );
		
		$topService = new TopService ();
		$onlineGoodNum = $topService->getOnlineGoodNum ( $access_token );
		$inventoryGoodNum = $topService->getInventoryGoodNum ( $access_token );
		
		$this->render ( 'index', array (
				"weekShelfStrategy" => json_encode ( $weekShelfStrategy ),
				"enableShelfService" => $userConfig->enable_shelf_service,
				"onsaleGoodNum" => $onlineGoodNum,
				"inventoryGoodNum" => $inventoryGoodNum 
		) );
	}
	
	/**
	 * This is for save shelf strategy 
	 */
	public function actionSave()
	{
		if(isset($_POST['strategys']))
		{
			$strategy = $_POST['strategys'];
		}
		$shelfService = new ShelfService ();
		$weekShelfStrategy = $shelfService->saveWeekShelfStrategy($strategy);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	/*
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	*/
	public function actionLogin(){
	if (! Yii::app ()->user->isGuest) {
			$this->redirect ( $this->createUrl ( "site/index" ) );
		}
		$this->render('login');
	}
	
	/** 
	 * 展示自定义策略
	 * 
	 * 
	 * */
	public function actionCustom(){
		// 		$this->render('index');
		$shelfService = new ShelfService ();
		$weekShelfStrategy = $shelfService->getWeekShelfStrategy();
		$this->render('custom', array (
				"distribution" => json_encode($weekShelfStrategy)
		));
	}
	
	/**
	 * 指定宝贝
	 *
	 *
	 * */
	public function actionAssign(){
		$this->render('assign');
	}
	
	/**
	 * 得到所有商品
	 *
	 *
	 * */
	public function actionGetAllGood(){
		$topService = new TopService();
		$pageNo = $_GET['iDisplayStart']/$_GET['iDisplayLength'];
		$pageSize = $_GET['iDisplayLength'];
		if($_GET['iSortCol_1'] == 4){
			$sortType = $_GET['mDataProp_4'];
		}else{
			$sortType = "";
		};
		$sortDir = $_GET['sSortDir_1'];
		$sEcho = $_GET['sEcho'];
		$sSearch = $_GET['sSearch'];
		$access_token = $this->getCurrentAccessToken ();
		$goods = $topService->searchOnsaleItems($sSearch, $access_token, $pageNo, $pageSize, $sortDir, $sortType);
		$goods->sEcho = $sEcho;
		$goods->iTotalRecords = $goods->total_results;
		$goods->iTotalDisplayRecords = $goods->total_results;
		$goods->aaData = $goods->items->item;
		//unset($goods['items']);
		echo json_encode($goods);
	}
	
	/**
	 * 得到仓库中商品
	 *
	 *
	 * */
	public function actionGetInventoryGood(){
		$topService = new TopService();
		$pageNo = $_GET['iDisplayStart']/$_GET['iDisplayLength'];
		$pageSize = $_GET['iDisplayLength'];
		$sEcho = $_GET['sEcho'];
		$sSearch = $_GET['sSearch'];
		$access_token = $this->getCurrentAccessToken ();
		$goods = $topService->searchInventoryItems($sSearch, $access_token, $pageNo, $pageSize);
		$goods->sEcho = $sEcho;
		$goods->iTotalRecords = $goods->total_results;
		$goods->iTotalDisplayRecords = $goods->total_results;
		$goods->aaData = $goods->items->item;
		//unset($goods['items']);
		echo json_encode($goods);
	}
	
	/**
	 * 展示排除宝贝
	 *
	 *
	 * */
	public function actionExclude(){
		$this->render('exclude');
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionTestMail() {
		Yii::log("test log", 'error', '');
// 		$message = 'mail success!!!';
// 		$mailer = Yii::createComponent ( 'application.extensions.mailer.EMailer' );
// 		$mailer->Host = 'smtp.163.com';
// 		$mailer->IsSMTP ();
// 		$mailer->SMTPAuth = true;
// 		$mailer->From = 'kangfeng_soft@163.com'; // 设置发件地址
// 		$mailer->AddReplyTo ( 'kangfeng_soft@163.com' );
// 		$mailer->AddAddress ( 'kangfeng_soft@163.com' ); // 设置收件件地址
// 		$mailer->FromName = 'kf'; // 这里设置发件人姓名
// 		$mailer->Username = 'kangfeng_soft@163.com'; // 这里输入发件地址的用户名
// 		$mailer->Password = 'works123'; // 这里输入发件地址的密码
// 		$mailer->SMTPDebug = true; // 设置SMTPDebug为true，就可以打开Debug功能，根据提示去修改配置
// 		$mailer->CharSet = 'UTF-8';
// 		$mailer->Subject = Yii::t ( 'demo', 'Yii rulez!' ); // 设置邮件的主题
// 		$mailer->Body = $message;
// 		$mailer->Send ();
	}
}
