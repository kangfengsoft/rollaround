<?php
class AdminController extends Controller {
	public function actionEnableShelfPlanRecount() {
		$enable = Yii::app ()->request->getParam ( 'enable' );
		if ($enable != "true") {
			$enable = "false";
		}
		$adminShelfService = new AdminShelfService ();
		$shelfPlanRecountConfig = $adminShelfService->getShelfPlanRecountConfig ();
		if ($enable === $shelfPlanRecountConfig->config_value) {
			return;
		}
		$shelfPlanRecountConfig->config_value = $enable;
		$shelfPlanRecountConfig->save ();
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