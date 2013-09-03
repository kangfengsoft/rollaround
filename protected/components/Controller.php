<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {
	/**
	 *
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 *      meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/column2';
	/**
	 *
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array ();
	/**
	 *
	 * @var array the breadcrumbs of the current page. The value of this property will
	 *      be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 *      for more details on how to specify this property.
	 */
	public $breadcrumbs = array ();
	
	// FIXME
	// can we put it in concrete controller?
	public function filters() {
		return array (
				'accessControl' 
		);
	}
	
	public $currentUser;
	
	// FIXME
	// later will move to a filter class
	public function filterAccessControl($filterChain) {
		if (! Yii::app ()->user->isGuest) {
			$this->currentUser = Util::getCurrentUser();
			$filterChain->run ();
			return;
		}
		
		if (isset ( $_REQUEST ['code'] )) {
			$code = $_REQUEST ['code']; // 通过访问https://oauth.taobao.com/authorize获取code
			$grant_type = 'authorization_code';
			                                                     
			// 请求参数
			$postfields = array (
					'grant_type' => $grant_type,
					'client_id' => Yii::app ()->params ['client_id'],
					'client_secret' => Yii::app ()->params ['client_secret'],
					'code' => $code,
					'redirect_uri' => Yii::app ()->params ['redirect_uri'] 
			);
			$c = new TopClient ();
			$token = json_decode ( $c->curl(Yii::app ()->params ['oauthTokenUrl'], $postfields) );
			$identity = new UserIdentity ( 'demo', 'demo' );
			$identity->setToken ( $token );
			//FIXME save the purchase time
			Yii::app ()->user->login ( $identity,  $token->r1_expires_in);
			$this->currentUser = Util::getCurrentUser();
			$this->redirect ( $this->createUrl ( "site/index" ) );
		} else {
			//$this->redirect ( $this->createUrl ( "site/login" ) );
			$this->redirect ( Yii::app()->params['oauthAuthorizeUrl']);
		}
	}
}