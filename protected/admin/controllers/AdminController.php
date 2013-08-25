<?php
class SiteController extends Controller {
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionEnableTimedTask() {
		$enable = Yii::app()->request->getParam('enable');
		$this->render ( 'index', array(
				'enable' => !$enable
		));
	}
}