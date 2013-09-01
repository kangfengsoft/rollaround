<?php

/**
 * This is the model class for table "user_config".
 *
 * The followings are the available columns in table 'user_config':
 * @property integer $id
 * @property string $taobao_user_id
 * @property integer $enable_shelf_service
 */
class UserConfig extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserConfig the static model class
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
		return 'user_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('taobao_user_id', 'required'),
			array('enable_shelf_service', 'numerical', 'integerOnly'=>true),
			array('taobao_user_id', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, taobao_user_id, enable_shelf_service', 'safe', 'on'=>'search'),
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
			'enable_shelf_service' => 'Enable Shelf Service',
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
		$criteria->compare('enable_shelf_service',$this->enable_shelf_service);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}