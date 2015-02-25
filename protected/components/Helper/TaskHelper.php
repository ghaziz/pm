<?php

/**
 * Created by PhpStorm.
 * User: Ghazi
 * Date: 23/02/2015
 * Time: 18:00 PM
 */
class TaskHelper
{
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
			$model = Task::model()->findAll(array('order'=>'id_group'));
			break;
			case UserHelper::employer:
			$model = Task::model()->findAll(array('order'=>'id_group'));//select * from task where project_id in(select project_id in prom project where user_id =..)
			break;
			case UserHelper::Contractor:
			$model = Task::model()->findAll(array('order'=>'id_group'));//برگرداندن تسکهای مربوط به شرکتی که این پیمانکار در آن است
			break;	
			case UserHelper::Employee:
			$model = Task::model()->findAll(array('order'=>'id_group'));//برگرداندن تسکهای مربوط به شرکتی که این پیمانکار در آن است
			break;	
		}
		return $model;
	}
	
}