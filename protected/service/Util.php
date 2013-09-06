<?php 
class Util{
	public static function floor($num, $length = 0){
		$pow = pow(10, $length);
		$tmp = floor($num * $pow);
		$num = $tmp / $pow;
		return $num;
	}
	
	public static function getCurrentUser() {
		$sub_taobao_user_id = isset ( Yii::app ()->user->sub_taobao_user_id ) ? Yii::app ()->user->sub_taobao_user_id : null;
		$user = User::model ()->find ( 'taobao_user_id=:taobao_user_id AND sub_taobao_user_id=:sub_taobao_user_id', array (
				':taobao_user_id' => Yii::app ()->user->taobao_user_id,
				':sub_taobao_user_id' =>$sub_taobao_user_id
		) );
		if ($user === null) {
			// 401（未授权）
			Yii::log("can't get current user !", 'error', '');
			throw new CHttpException ( 401, '未授权' );
		}
		return $user;
	}
	
	public static function getAccessToken($taobao_user_id){
		$userList = User::model ()->findAll ( 'taobao_user_id=:taobao_user_id', array (
				':taobao_user_id' => Yii::app ()->user->taobao_user_id
		) );
		
		if(count($userList) === 0){
			Yii::log("can't get access_token!", 'error', '');
			throw new Exception ( "can't get access_token!" );
		}
		$access_token = '';
		foreach ($userList as $user){
			if($user->sub_taobao_user_id === null){
				return $user->access_token;
			}
			if(!isEmpty($user->access_token)){
				$access_token = $user->access_token;
			}
		}
		if(isEmpty($user->access_token)){
			Yii::log("no available access_token!", 'error', '');
			throw new Exception ( "no available access_token!" );
		}
		return $access_token;
	}
}
?>
