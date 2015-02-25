<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property string $id
 * @property string $title
 * @property integer $status
 * @property integer $confirm_status
 * @property integer $percent_of_all
 * @property integer $percent_prog
 * @property string $price
 * @property string $files
 * @property string $start_time
 * @property string $end_time
 * @property string $time
 * @property string $description
 * @property string $id_project
 * @property string $user_id
 * @property string $id_group
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property GroupTask $idGroup
 * @property Users $user
 * @property Project $idProject
 */
class Task extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, status, start_time, end_time, id_project, user_id', 'required'),
			array('status, confirm_status, percent_of_all, percent_prog', 'numerical', 'integerOnly'=>true),
			array('title, files', 'length', 'max'=>255),
			array('price', 'length', 'max'=>2),
			array('start_time, end_time, time, id_project, user_id, id_group', 'length', 'max'=>10),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, status, confirm_status, percent_of_all, percent_prog, price, files, start_time, end_time, time, description, id_project, user_id, id_group', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'id_task'),
			'idGroup' => array(self::BELONGS_TO, 'GroupTask', 'id_group'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'idProject' => array(self::BELONGS_TO, 'Project', 'id_project'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'عنوان تسک',
			'status' => 'وضعیت',
			'confirm_status' => 'Confirm Status',
			'percent_of_all' => 'درصد تسک از کل پروژه',
			'percent_prog' => 'درصد پیشرفت',
			'price' => 'هزینه',
			'files' => 'فایل مربوطه',
			'start_time' => 'زمان شروع',
			'end_time' => 'زمان پایان',
			'time' => 'تاریخ ثبت ',
			'description' => 'توضیحات',
			'id_project' => 'تسک مربوط به کدام پروژه است',
			'user_id' => 'کاربر ثبت کننده',
			'id_group' => 'گروه تسک',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('confirm_status',$this->confirm_status);
		$criteria->compare('percent_of_all',$this->percent_of_all);
		$criteria->compare('percent_prog',$this->percent_prog);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('files',$this->files,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('id_project',$this->id_project,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('id_group',$this->id_group,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
