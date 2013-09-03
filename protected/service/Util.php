<?php 
class Util{
	public static function floor($num, $length = 0){
		$pow = pow(10, $length);
		$tmp = floor($num * $pow);
		$num = $tmp / $pow;
		return $num;
	}
	
	public static function getCurrentUser(){
		$user = User::model ()->find ( 'taobao_user_id=:taobao_user_id', array (
				':taobao_user_id' => Yii::app ()->user->taobao_user_id
		) );
		if($user === null){
			//401（未授权）
			throw new CHttpException(401,'未授权');
		}
		return $user;
	}
}
?>
