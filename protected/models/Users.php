<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $name
 * @property string $family
 * @property string $birthday
 * @property string $phone
 * @property string $email
 * @property integer $type_employee
 * @property string $username
 * @property string $password
 * @property string $photo
 * @property integer $active
 * @property integer $time
 * @property string $id_company
 *
 * The followings are the available model relations:
 * @property Attach[] $attaches
 * @property Comment[] $comments
 * @property Company[] $companies
 * @property GroupTask[] $groupTasks
 * @property Project[] $projects
 * @property Report[] $reports
 * @property Roles $roles
 * @property Task[] $tasks
 * @property Company $idCompany
 */
class Users extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, family, email, type_employee, username, password', 'required'),
            array('type_employee, active, time', 'numerical', 'integerOnly' => true),
            array('name, family, email, username, password, photo', 'length', 'max' => 255),
            array('email', 'required'),
            array('email', 'length', 'max' => 200),
            array('email', 'email', 'message' => 'Email is not valid'),
            array('birthday, phone, id_company', 'length', 'max' => 10),
            array('email', 'unique', 'message' => 'Email already exists!'),
            array('username', 'uniqueUsername', 'message' => 'Username already exists!', 'on' => 'insert'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, family, birthday, phone, email, type_employee, username, password, photo, active, time, id_company', 'safe', 'on' => 'search'),
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
            'attaches' => array(self::HAS_MANY, 'Attach', 'user_id'),
            'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
            'companies' => array(self::HAS_MANY, 'Company', 'user_id'),
            'groupTasks' => array(self::HAS_MANY, 'GroupTask', 'user_id'),
            'projects' => array(self::HAS_MANY, 'Project', 'user_id'),
            'reports' => array(self::HAS_MANY, 'Report', 'user_id'),
            'roles' => array(self::HAS_ONE, 'Roles', 'user_id'),
            'tasks' => array(self::HAS_MANY, 'Task', 'user_id'),
            'idCompany' => array(self::BELONGS_TO, 'Company', 'id_company'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'کارفرمای ناظر پروژه',
            'name' => 'نام',
            'family' => 'نام خانوادگی',
            'birthday' => 'تاریخ تولد',
            'phone' => 'تلفن',
            'email' => 'ایمیل',
            'type_employee' => 'نوع کارمند',
            'username' => 'نام کاربری',
            'password' => 'رمز عبور',
            'photo' => 'عکس',
            'active' => 'فعال',
            'time' => 'Time',
            'id_company' => ' شرکت',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('family', $this->family, true);
        $criteria->compare('birthday', $this->birthday, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('type_employee', $this->type_employee);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('photo', $this->photo, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('time', $this->time);
        $criteria->compare('id_company', $this->id_company, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function uniqueEmail($attribute, $params)
    {
        // Set $emailExist variable true or false by using your custom query on checking in database table if email exist or not.
        // You can user $this->{$attribute} to get attribute value.

        $emailExist = Users::model()->exists('email=:email', array(':email' => $this->email));

        if ($emailExist)
            $this->addError('email', 'Email already exists');
    }

    public function uniqueUsername($attribute, $params)
    {
        // Set $emailExist variable true or false by using your custom query on checking in database table if email exist or not.
        // You can user $this->{$attribute} to get attribute value.

        $usernameExist = Users::model()->exists('username=:username', array(':username' => $this->username));

        if ($usernameExist)
            $this->addError('username', 'Username already exists');
    }
}
