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
	CONST Employee = 0;
	CONST Contractor = 1;
	CONST employer = 2;
	CONST admin = 3;

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


}