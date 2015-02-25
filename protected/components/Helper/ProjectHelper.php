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
		$user = Users::model()->findByPk(Yii::app()->user->id);
		$type_employee = $user->type_employee;
		
		switch($type_employee){
			case UserHelper::admin:
			$model = Project::model()->findAll();
			break;
			case UserHelper::employer:
			$model = Project::model()->findAll("user_id=:id", array(':id'=>Yii::app()->user->id));
			break;
			case UserHelper::Contractor:
			$model = Project::model()->findAll("id_company=:id", array(':id'=>$user->id_company));
			break;	
			case UserHelper::Employee:
			$model = Project::model()->findAll("id_company=:id", array(':id'=>$user->id_company));
			break;	
		}
		return $model;
	}
	
}