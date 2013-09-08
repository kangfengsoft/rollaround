<?php

/**
 * This is the model class for table "assign_list_task".
 *
 * The followings are the available columns in table 'assign_list_task':
 * @property integer $id
 * @property string $taobao_user_id
 * @property string $num_iid
 * @property integer $day
 * @property integer $hour
 * @property integer $exclude
 */
class AssignListTask extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AssignListTask the static model class
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
		return 'assign_list_task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('taobao_user_id, num_iid, day, hour', 'required'),
			array('day, hour, exclude', 'numerical', 'integerOnly'=>true),
			array('taobao_user_id, num_iid', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, taobao_user_id, num_iid, day, hour, exclude', 'safe', 'on'=>'search'),
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
			'num_iid' => 'Num Iid',
			'day' => 'Day',
			'hour' => 'Hour',
			'exclude' => 'Exclude',
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
		$criteria->compare('num_iid',$this->num_iid,true);
		$criteria->compare('day',$this->day);
		$criteria->compare('hour',$this->hour);
		$criteria->compare('exclude',$this->exclude);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}