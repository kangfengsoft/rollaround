<?php
class AdminController extends Controller {
	public function actionEnableShelfPlanRecount() {
		$enable = Yii::app ()->request->getParam ( 'enable' );
		if ($enable != "true") {
			$enable = "false";
		}
		$adminShelfService = new AdminShelfService ();
		$adminConfig = $adminShelfService->getShelfPlanRecountConfig ();
		if ($enable === $adminConfig->config_value) {
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
	
	public function actionEnableShelfTask(){
		$enable = Yii::app ()->request->getParam ( 'enable' );
		if ($enable != "true") {
			$enable = "false";
		}
		$adminShelfService = new AdminShelfService ();
		$adminConfig = $adminShelfService->getListTaskConfig ();
		if ($enable === $adminConfig->config_value) {
			return;
		}
		$adminConfig->config_value = $enable;
		$adminConfig->save ();
		if( $enable == "true") {
			// TODO start timed task
			ignore_user_abort ( true );
			set_time_limit ( 0 );
			$adminShelfService = new AdminShelfService();
			$adminShelfService->enableShelfTask();
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