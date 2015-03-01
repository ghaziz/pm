<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property string $id
 * @property string $bind_type
 * @property string $context
 * @property string $parent
 * @property string $time
 * @property string $user_id
 * @property string $bind_id
 * @property integer $modified_by
 * @property integer $read
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Comment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bind_type, context, user_id, bind_id', 'required'),
			array('modified_by, read', 'numerical', 'integerOnly'=>true),
			array('bind_type', 'length', 'max'=>11),
			array('parent, time, user_id, bind_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, bind_type, context, parent, time, user_id, bind_id, modified_by, read', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'bind_type' => 'Bind Type',
			'context' => 'متن',
			'parent' => 'Parent',
			'time' => 'Time',
			'user_id' => 'User',
			'bind_id' => 'Bind',
			'modified_by' => 'Modified By',
			'read' => 'Read',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('bind_type',$this->bind_type,true);
		$criteria->compare('context',$this->context,true);
		$criteria->compare('parent',$this->parent,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('bind_id',$this->bind_id,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('read',$this->read);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
