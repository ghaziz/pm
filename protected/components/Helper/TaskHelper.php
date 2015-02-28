<?php

/**
 * Created by PhpStorm.
 * User: Ghazi
 * Date: 24/02/2015
 * Time: 16:00 PM
 */
class TaskHelper
{
	//status of task
	CONST OPEN = 0;
	CONST COMPLETED = 1;
	CONST ON_HOLD = 2;
	CONST CANCELLED = 3;
	//confirm status
	CONST NOT_CONFIRMED = 0;
	CONST CONFIRMED = 1;

    /* @var $companies Company[] */
	public static function getModel($status="")
    {
		$model = "";
		$type_employee = Yii::app()->user->typeOfUser;
		if($status == "")
		{		
		  switch($type_employee){
			case UserHelper::ADMIN:
			$model = Task::model()->findAll(array('order'=>'id_group'));
			break;
			case UserHelper::EMPLOYER:

            //get list of companies of this employer
            $companiesCriteria = new CDbCriteria();
            $companiesCriteria->select = 'id';
            $companiesCriteria->condition = 'user_id=:user_id';
            $companiesCriteria->params = array(':user_id'=>Yii::app()->user->id);
            $companies = Company::model()->findAll($companiesCriteria);

            $projects = array();

            foreach($companies as $company){
                $projects = array_merge($projects,$company->projects);
            }

            $tasks = array();

            foreach($projects as $project){
                $tasks = array_merge($tasks,$project->task);
            }
			$model = $tasks;
			break;
			case UserHelper::CONTRACTOR:
			case UserHelper::EMPLOYEE:
                //fix return only 1 company task
                //get list of companies of this employer
                $companies = Yii::app()->user->companiesModel;

                $projects = array();

                foreach($companies as $company){
                    $projects = array_merge($projects,$company->projects);
                }

                $tasks = array();

                foreach($projects as $project){
                    $tasks = array_merge($tasks,$project->tasks);
                }
                $model = $tasks;
			break;	
		  }
		}
		else{
		  switch($type_employee){
			case UserHelper::ADMIN:
			$model = Task::model()->findAll(array('order'=>'id_group'));
			break;
			case UserHelper::EMPLOYER:
			$model = Task::model()->findAll(array('order'=>'id_group'));//select * from task where project_id in(select project_id in prom project where user_id =..)
			break;
			case UserHelper::CONTRACTOR:
			$model = Task::model()->findAll(array('order'=>'id_group'));//برگرداندن تسکهای مربوط به شرکتی که این پیمانکار در آن است
			break;	
			case UserHelper::EMPLOYEE:
			$model = Task::model()->findAll(array('order'=>'id_group'));//برگرداندن تسکهای مربوط به شرکتی که این پیمانکار در آن است
			break;	
		  }
		}
		return $model;
	}
	
}