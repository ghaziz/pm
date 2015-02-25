<?php

/**
 * This is the model class for table "roles".
 *
 * The followings are the available columns in table 'roles':
 * @property string $user_id
 * @property integer $insert_comp
 * @property integer $delete_comp
 * @property integer $edit_comp
 * @property integer $view_comp
 * @property integer $insert_proj
 * @property integer $delete_proj
 * @property integer $edit_proj
 * @property integer $view_proj
 * @property integer $insert_task
 * @property integer $delete_task
 * @property integer $edit_task
 * @property integer $view_task
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Roles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'roles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('insert_comp, delete_comp, edit_comp, view_comp, insert_proj, delete_proj, edit_proj, view_proj, insert_task, delete_task, edit_task, view_task', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, insert_comp, delete_comp, edit_comp, view_comp, insert_proj, delete_proj, edit_proj, view_proj, insert_task, delete_task, edit_task, view_task', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'insert_comp' => 'درج شرکت',
			'delete_comp' => 'حذف شرکت',
			'edit_comp' => 'ویرایش شرکت',
			'view_comp' => 'مشاهده شرکت',
			'insert_proj' => 'درج پروژه',
			'delete_proj' => 'حذف پروژه',
			'edit_proj' => 'ویرایش پروژه',
			'view_proj' => 'مشاهده پروژه',
			'insert_task' => 'درج وظیفه',
			'delete_task' => 'حذف وظیفه',
			'edit_task' => 'ویرایش وظیفه',
			'view_task' => 'مشاهده وظیفه',
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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('insert_comp',$this->insert_comp);
		$criteria->compare('delete_comp',$this->delete_comp);
		$criteria->compare('edit_comp',$this->edit_comp);
		$criteria->compare('view_comp',$this->view_comp);
		$criteria->compare('insert_proj',$this->insert_proj);
		$criteria->compare('delete_proj',$this->delete_proj);
		$criteria->compare('edit_proj',$this->edit_proj);
		$criteria->compare('view_proj',$this->view_proj);
		$criteria->compare('insert_task',$this->insert_task);
		$criteria->compare('delete_task',$this->delete_task);
		$criteria->compare('edit_task',$this->edit_task);
		$criteria->compare('view_task',$this->view_task);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Roles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
