<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property string $id
 * @property string $title
 * @property string $no_contract
 * @property string $start_time
 * @property string $end_time
 * @property string $price
 * @property string $no_individuals
 * @property integer $status
 * @property integer $confirm_status
 * @property integer $percent_prog
 * @property string $payment
 * @property string $time
 * @property string $id_company
 * @property string $user_id
 * @property string $description
 * @property string $affixture
 * @property string $minutes
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Users $user
 * @property Company $idCompany
 * @property Task[] $tasks
 */
class Project extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, no_contract, start_time, end_time, status', 'required'),
			array('status, confirm_status, percent_prog', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('no_contract, start_time, end_time, price, payment, time, id_company, user_id', 'length', 'max'=>10),
			array('no_individuals', 'length', 'max'=>2),
			array('affixture, minutes', 'length', 'max'=>200),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, no_contract, start_time, end_time, price, no_individuals, status, confirm_status, percent_prog, payment, time, id_company, user_id, description, affixture, minutes', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'id_project'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'idCompany' => array(self::BELONGS_TO, 'Company', 'id_company'),
			'tasks' => array(self::HAS_MANY, 'Task', 'id_project'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'عنوان پروژه',
			'no_contract' => 'شماره قرارداد',
			'start_time' => 'زمان شروع پروژه',
			'end_time' => 'زمان پایان پروژه',
			'price' => 'مبلغ پروژه',
			'no_individuals' => 'تعداد افراد',
			'status' => 'وضعیت پروژه',
			'confirm_status' => 'تایید توسط کارفرما',
			'percent_prog' => 'درصد پیشرفت پروژه',
			'payment' => 'مبلغ پرداخت شده',
			'time' => 'Time',
			'id_company' => 'شرکت مجری پروژه',
			'user_id' => 'کارفرمای ناظر پروژه',
			'description' => 'توضیحات',
			'affixture' => 'ضمایم قرارداد',
			'minutes' => 'صورت جلسات',
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
		$criteria->compare('no_contract',$this->no_contract,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('no_individuals',$this->no_individuals,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('confirm_status',$this->confirm_status);
		$criteria->compare('percent_prog',$this->percent_prog);
		$criteria->compare('payment',$this->payment,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('id_company',$this->id_company,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('affixture',$this->affixture,true);
		$criteria->compare('minutes',$this->minutes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
