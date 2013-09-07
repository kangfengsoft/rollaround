<?php
class AdminController extends Controller {
	public function actionEnableShelfPlanRecount() {
		$enable = Yii::app ()->request->getParam ( 'enable' );
		$enable = $enable === "true" ? true : false;
		$adminShelfService = new AdminShelfService ();
		if ($enable === $adminShelfService->isShelfPlanRecountEnable()) {
			return;
		}
		$adminShelfService->setShelfPlanRecountConfig($enable);
		if( $enable ) {
				// TODO start timed task
			ignore_user_abort ( true );
			set_time_limit ( 0 );
			$adminShelfService = new AdminShelfService();
			$adminShelfService->enableShelfPlanRecount();
		} else {
			$this->redirect ( $this->createUrl ( "site/index" ) );
		}
	}
	
	public function actionEnableListTask(){
		$enable = Yii::app ()->request->getParam ( 'enable' );
		$enable = $enable === "true" ? true : false;
		$adminShelfService = new AdminShelfService ();
		if ($enable === $adminShelfService->isListTaskEnable()) {
			return;
		}
		
		$adminShelfService->setListTaskConfig($enable);
		if( $enable ) {
			// TODO start timed task
			ignore_user_abort ( true );
			set_time_limit ( 0 );
			$adminShelfService = new AdminShelfService();
			$adminShelfService->enableListTask();
		} else {
			$this->redirect ( $this->createUrl ( "site/index" ) );
		}
	}
}