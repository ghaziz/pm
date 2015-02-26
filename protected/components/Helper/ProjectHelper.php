<?php

/**
 * Created by PhpStorm.
 * User: Ghazi
 * Date: 24/02/2015
 * Time: 16:00 PM
 */
class ProjectHelper
{
	//status of project
	CONST OPEN = 0;
	CONST COMPLETED = 1;
	CONST ON_HOLD = 2;
	CONST CANCELLED = 3;
	
	//confirm status
	CONST NOT_CONFIRMED = 0;
	CONST CONFIRMED = 1;
	
	//1.0.2 added filter and order
	public static function getModel($status="",$order="")
    {
		$model = "";
		$user = Users::model()->findByPk(Yii::app()->user->id);
		$type_employee = $user->type_employee;
		
		if($type_employee == UserHelper::ADMIN)
		{
			if($status == "" && $order == "")
			{
				$model = Project::model()->findAll();
			}
			if($status != "" && $order == ""){
				$model = Project::model()->findAll("status=:status", array(':status'=>$status));
			}
			if($status == "" && $order!=""){
				$model = Project::model()->findAll(array('order' => $order));
			}
		}
		if($type_employee == UserHelper::EMPLOYER)
		{
			if($status == "" && $order == "")
			{
				$model = Project::model()->findAll("user_id=:id", array(':id'=>Yii::app()->user->id));
			}
			if($status != "" && $order == ""){
				$model = Project::model()->findAll("user_id=:id and status=:status", array(':id'=>Yii::app()->user->id, ':status'=>$status));
			}
			if($status == "" && $order!=""){
				$model = Project::model()->findAll("user_id=:id", array(':id'=>Yii::app()->user->id), array('order' => $order));
			}
		}
		if($type_employee == UserHelper::CONTRACTOR)
		{
			if($status == "" && $order == "")
			{
				$model = Project::model()->findAll("id_company=:id", array(':id'=>$user->id_company));
			}	
			if($status != "" && $order == ""){
				$model = Project::model()->findAll("id_company=:id and status=:status", array(':id'=>$user->id_company, ':status'=>$status));
			}
			if($status == "" && $order!=""){
				$model = Project::model()->findAll("id_company=:id", array(':id'=>$user->id_company), array('order' => $order));
			}			
		}
		if($type_employee == UserHelper::EMPLOYEE)
		{
			if($status == "" && $order == "")
			{
				$model = Project::model()->findAll("id_company=:id", array(':id'=>$user->id_company));
			}
			if($status != "" && $order == ""){
				$model = Project::model()->findAll("id_company=:id and status=:status", array(':id'=>$user->id_company, ':status'=>$status));
			}
			if($status == "" && $order!=""){
				$model = Project::model()->findAll("id_company=:id", array(':id'=>$user->id_company, 'order' => $order));
			}
		}
		return $model;
	}
	
}