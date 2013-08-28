<?php
class AdminController extends Controller {
	public function actionEnableShelfPlanRecount() {
		$enable = Yii::app ()->request->getParam ( 'enable' );
		if ($enable != "true") {
			$enable = "false";
		}
		
		$adminConfig = AdminConfig::model ()->find ( 'config_key=:config_key', array (
				':config_key' => Consts::CONFIG_KEY_TIMED_TASK 
		) );
		
		if ($adminConfig == null) {
			$adminConfig = new AdminConfig ();
			$adminConfig->config_key = Consts::CONFIG_KEY_TIMED_TASK;
		}
		if( $enable == $adminConfig->config_value){
			return;
		}
		$adminConfig->config_value = $enable;
		$adminConfig->save ();
		if( $enable == "true") {
				// TODO start timed task
			ignore_user_abort ( true );
			set_time_limit ( 0 );
			$adminShelfService = new AdminShelfService();
			$adminShelfService->enableShelfPlanRecount();
		} else {
			$this->redirect ( $this->createUrl ( "site/index" ) );
		}
	}
	
	public function actionTest() {
		$adminConfig = new AdminConfig ();
		$adminConfig->config_key = "actionTest";
		$adminConfig->config_value = "actionTest";
		$adminConfig->save ();
	}
}