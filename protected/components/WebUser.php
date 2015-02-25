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

    function getTypeOfUser()
    {
        if (Yii::app()->user->isGuest) {
            return 'مهمان';
        }
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->type_employee;
    }

    public function getId()
    {
        if(Yii::app()->user->isGuest)return -1;
        return parent::getId();
    }
    // Load user model.
    protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=Users::model()->findByPk($id);
        }
        return $this->_model;
    }
}
?>