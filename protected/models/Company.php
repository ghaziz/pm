<?php

/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property string $id
 * @property string $title
 * @property string $year_foundation
 * @property integer $type
 * @property string $addr
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $website
 * @property string $phone_head
 * @property string $foundation_notice
 * @property string $time
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property Project[] $projects
 * @property Users[] $users
 */
class Company extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, type, addr, email, user_id,', 'required'),
			array('foundation_notice', 'required', 'on'=>'new'),
			array('type', 'numerical', 'integerOnly'=>true),
            array('email', 'email', 'message'=>'Email is not valid'),
			array('title, phone, fax, phone_head', 'length', 'max'=>100),
			array('year_foundation', 'length', 'max'=>50),
			array('addr, email, website, foundation_notice', 'length', 'max'=>255),
			array('time, user_id', 'length', 'max'=>10),
            array('foundation_notice', 'file', 'types'=>'doc, docx, zip, rar, jpg, png','allowEmpty'=>true,'maxSize'=>5*1024*1024),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, year_foundation, type, addr, phone, fax, email, website, phone_head, foundation_notice, time, user_id', 'safe', 'on'=>'search'),
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
			'projects' => array(self::HAS_MANY, 'Project', 'id_company'),
			'users' => array(self::HAS_MANY, 'Users', 'id_company'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'نام شرکت',
			'year_foundation' => 'سال تاسیس',
			'type' => 'نوع شرکت',
			'addr' => 'آدرس',
			'phone' => 'تلفن',
			'fax' => 'فکس',
			'email' => 'ایمیل',
			'website' => 'وب سایت',
			'phone_head' => 'تلفن مدیر',
			'foundation_notice' => 'آگهی تاسیس',
			'time' => 'Time',
			'user_id' => 'ایجاد شده توسط',
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
		$criteria->compare('year_foundation',$this->year_foundation,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('addr',$this->addr,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('phone_head',$this->phone_head,true);
		$criteria->compare('foundation_notice',$this->foundation_notice,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('user_id',$this->user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
