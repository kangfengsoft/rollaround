<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $id
 * @property string $taobao_user_id
 * @property string $taobao_user_nick
 * @property string $sub_taobao_user_id
 * @property string $sub_taobao_user_nick
 * @property string $access_token
 * @property string $r1_expires_in
 * @property string $r2_expires_in
 * @property string $w1_expires_in
 * @property string $w2_expires_in
 * @property string $re_expires_in
 * @property string $refresh_token
 * @property string $create_time
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('taobao_user_id, taobao_user_nick, access_token, refresh_token, create_time', 'required'),
			array('taobao_user_id, taobao_user_nick, sub_taobao_user_id, sub_taobao_user_nick, access_token, refresh_token', 'length', 'max'=>100),
			array('r1_expires_in, r2_expires_in, w1_expires_in, w2_expires_in, re_expires_in', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, taobao_user_id, taobao_user_nick, sub_taobao_user_id, sub_taobao_user_nick, access_token, r1_expires_in, r2_expires_in, w1_expires_in, w2_expires_in, re_expires_in, refresh_token, create_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'taobao_user_id' => 'Taobao User',
			'taobao_user_nick' => 'Taobao User Nick',
			'sub_taobao_user_id' => 'Sub Taobao User',
			'sub_taobao_user_nick' => 'Sub Taobao User Nick',
			'access_token' => 'Access Token',
			'r1_expires_in' => 'R1 Expires In',
			'r2_expires_in' => 'R2 Expires In',
			'w1_expires_in' => 'W1 Expires In',
			'w2_expires_in' => 'W2 Expires In',
			're_expires_in' => 'Re Expires In',
			'refresh_token' => 'Refresh Token',
			'create_time' => 'Create Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('taobao_user_id',$this->taobao_user_id,true);
		$criteria->compare('taobao_user_nick',$this->taobao_user_nick,true);
		$criteria->compare('sub_taobao_user_id',$this->sub_taobao_user_id,true);
		$criteria->compare('sub_taobao_user_nick',$this->sub_taobao_user_nick,true);
		$criteria->compare('access_token',$this->access_token,true);
		$criteria->compare('r1_expires_in',$this->r1_expires_in,true);
		$criteria->compare('r2_expires_in',$this->r2_expires_in,true);
		$criteria->compare('w1_expires_in',$this->w1_expires_in,true);
		$criteria->compare('w2_expires_in',$this->w2_expires_in,true);
		$criteria->compare('re_expires_in',$this->re_expires_in,true);
		$criteria->compare('refresh_token',$this->refresh_token,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}