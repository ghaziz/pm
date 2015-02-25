<?php

/**
 * Created by PhpStorm.
 * User: Ghazi
 * Date: 23/02/2015
 * Time: 18:00 PM
 */
class ProjectHelper
{
	//status of project
	CONST OPEN = 0;
	CONST COMPLETED = 1;
	CONST ON_HOLD = 2;
	CONST CANCELLED = 4;
	
	//confirm status
	CONST NOT_CONFIRMED = 0;
	CONST CONFIRMED = 1;
	
	//this return the model that different for any user-permission-used in project-index
	public static function getModel()
    {
		$model = "";
		$type_employee = Yii::app()->user->typeOfUser;
		
		switch($type_employee){
			case UserHelper::ADMIN:
			$model = Project::model()->findAll();
			break;
			case UserHelper::EMPLOYER:
			$model = Project::model()->findAll("user_id=:id", array(':id'=>Yii::app()->user->id));
			break;
			case UserHelper::CONTRACTOR:
			$model = Project::model()->findAll("id_company=:id", array(':id'=>Yii::app()->company));
			break;	
			case UserHelper::EMPLOYEE:
			$model = Project::model()->findAll("id_company=:id", array(':id'=>Yii::app()->company));
			break;	
		}
        if($model==null){return array();}
		return $model;
	}
	
}