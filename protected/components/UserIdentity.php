<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
	
	public function setToken($token) {
		// save date in database
		$user = User::model ()->find ( 'taobao_user_id=:taobao_user_id', array (
				':taobao_user_id' => $token->taobao_user_id 
		) );
		if ($user == null) {
			$user = new User ();
			$user->taobao_user_id = $token->taobao_user_id;
			$user->taobao_user_nick = $token->taobao_user_nick;
			$user->access_token = $token->access_token;
			$user->refresh_token = $token->refresh_token;
			$user->save ();
		}
		$this->setState ( 'id', $user->id );
		$this->setState ( 'access_token', $token->access_token );
		$this->setState ( 'nick', $token->taobao_user_nick );
		$this->setState ( 'json', json_encode ( $token ) );
	}
}