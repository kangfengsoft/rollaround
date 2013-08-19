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
				'accessControl - login' 
		);
	}
	
	// FIXME
	// later will move to a filter class
	public function filterAccessControl($filterChain) {
		if (! Yii::app ()->user->isGuest) {
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
			
			$token = json_decode ( $this->curl ( Yii::app ()->params ['oauthTokenUrl'], $postfields ) );
			$identity = new UserIdentity ( 'demo', 'demo' );
			$identity->setToken ( $token );
			Yii::app ()->user->login ( $identity );
			$this->redirect ( $this->createUrl ( "site/index" ) );
// 			header ( 'Location: ' . Yii::app ()->params ['redirect_uri'] );
// 			$connection=Yii::app()->db;
		} else {
			$this->redirect ( $this->createUrl ( "site/login" ) );
		}
	}
	
	
	// POST请求函数
	public function curl($url, $postFields = null) {
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_FAILONERROR, false );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		
		if (is_array ( $postFields ) && 0 < count ( $postFields )) {
			$postBodyString = "";
			foreach ( $postFields as $k => $v ) {
				$postBodyString .= "$k=" . urlencode ( $v ) . "&";
			}
			unset ( $k, $v );
			curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
			curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
			curl_setopt ( $ch, CURLOPT_POST, true );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, substr ( $postBodyString, 0, - 1 ) );
		}
		$reponse = curl_exec ( $ch );
		if (curl_errno ( $ch )) {
			throw new Exception ( curl_error ( $ch ), 0 );
		} else {
			$httpStatusCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
			if (200 !== $httpStatusCode) {
				throw new Exception ( $reponse, $httpStatusCode );
			}
		}
		curl_close ( $ch );
		return $reponse;
	}
}