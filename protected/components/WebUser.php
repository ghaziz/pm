<?php

// this file must be stored in:
// protected/components/WebUser.php

class WebUser extends CWebUser {

    // Store model to not repeat query.
    private $_model;

    // Return first name.
    // access it by Yii::app()->user->first_name
    function getName(){
        if(Yii::app()->user->isGuest){
            return 'مهمان';
        }
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->name.' '.$user->family;
    }

    protected function loadUser($id = null)
    {
        if ($this->_model === null) {
            if ($id !== null)
                $this->_model = Users::model()->findByPk($id);
        }
        return $this->_model;
    }

    function getTypeOfUser()
    {
        if (Yii::app()->user->isGuest) {
            return 'مهمان';
        }
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->type_employee;
    }
    // Load user model.

    public function getId()
    {
        if (Yii::app()->user->isGuest) return -1;
        return parent::getId();
    }

    public function getImage()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->photo;
    }

    public function getCompany()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        if($user==null) return -1;
        return $user->id_company;
    }

    public function getCompaniesModel()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        if($user==null) return array();
        return array($user->idCompany);
    }

    public function getModel()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        if($user==null) return null;
        return $user;
    }

    public function getIsAdmin()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        if($user==null) return false;
        return $this->getTypeOfUser() == UserHelper::ADMIN;
    }

    public function getIsEmployer()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        if($user==null) return false;
        return $this->getTypeOfUser() == UserHelper::EMPLOYER;
    }

    public function getIsEmployee()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        if($user==null) return false;
        return $this->getTypeOfUser() == UserHelper::EMPLOYEE;
    }

    public function getIsContrator()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        if($user==null) return false;
        return $this->getTypeOfUser() == UserHelper::CONTRACTOR;
    }
}
?>