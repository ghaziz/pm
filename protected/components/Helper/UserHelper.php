<?php

/**
 * Created by PhpStorm.
 * User: Ghazi
 * Date: 23/02/2015
 * Time: 18:00 PM
 */
class UserHelper
{
	//type_employee
	CONST EMPLOYEE = 0;
	CONST CONTRACTOR = 1;
	CONST EMPLOYER = 2;
	CONST ADMIN = 3;

	//I have changed Yii::app()->user->getName() in webuser
    public static function getDisplayName($id)
    {
        if($id==-1){
            return 'مهمان';
        }
        if($id==Yii::app()->user->id){
            return Yii::app()->user->getName();
        }else{
            $user  = Users::model()->findByPk($id);
            return $user->name.' '.$user->family;
        }
    }

    public static function getModel()
    {
        $model = "";
        $type_employee = Yii::app()->user->typeOfUser;

        switch($type_employee){
            case UserHelper::ADMIN:
                $model = Users::model()->findAll();
                break;
            case UserHelper::EMPLOYEE:
                $model = Users::model()->find("id=:id", array(':id'=>Yii::app()->user->id));
                break;
            case UserHelper::CONTRACTOR:
                $model = Users::model()->findAll("id_company=:id", array(':id'=>Yii::app()->user->company));
                break;
            case UserHelper::EMPLOYER:
                $model = Users::model()->findAll("id_company=:id", array(':id'=>Yii::app()->user->company));
                break;
        }
        if($model==null){return array();};
        return $model;
    }

    public static function getTypeOfUser($id)
    {
        $user = Users::model()->findByPk($id);
        return $user->type_employee;
    }


}