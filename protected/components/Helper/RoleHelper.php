<?php

/**
 * Created by PhpStorm.
 * User: Ghazi
 * Date: 23/02/2015
 * Time: 18:00 PM
 */

class RoleHelper
{

//    edited by ebrahim ver 1.1
    public static function checkAccessControl($controller,$action,$controllerObj=null,$showNoAccess=true,$isAjax=true)
    {
        $field = '';
		if( $controller == 'company' )
		{
			switch($action)
			{
				case 'view':
				$field = 'view_comp';
				break;
				case 'insert':
				$field = 'insert_comp';
				break;
				case 'delete':
				$field = 'delete_comp';
				break;
				case 'edit':
				$field = 'edit_comp';
				break;
			}
		}
		if( $controller == 'project' )
		{
			switch($action)
			{
				case 'view':
				$field = 'view_proj';
				break;
				case 'insert':
				$field = 'insert_proj';
				break;
				case 'delete':
				$field = 'delete_proj';
				break;
				case 'edit':
				$field = 'edit_proj';
				break;
			}
		}
		if( $controller == 'task' )
		{
			switch($action)
			{
				case 'view':
				$field = 'view_task';
				break;
				case 'insert':
				$field = 'insert_task';
				break;
				case 'delete':
				$field = 'delete_task';
				break;
				case 'edit':
				$field = 'edit_task';
				break;
			}
		}

		$count=Roles::model()->count("user_id=:uid and $field=:field",array(':uid'=>Yii::app()->user->id,':field'=>'1'));
		if((Yii::app()->user->name == UserHelper::ADMIN) || ($count == 1))
		{
            return true;
		}
        RoleHelper::redirect($controllerObj,$showNoAccess,$isAjax);
    }

    public static function checkUsersAccessControl($action,$extraField=null,$controllerObj=null,$showNoAccess=true,$isAjax=true){
        $typeOfUser = Yii::app()->user->typeOfUser;
        $result = true;
        if($typeOfUser == UserHelper::ADMIN){return true;}

        if ($action == 'new') {
            $result = $typeOfUser != UserHelper::EMPLOYER;
        }
        if ($action == 'edit') {
            if (Yii::app()->user->id == $extraField) {
                return true;
            }

            $typeOfUser = UserHelper::getTypeOfUser($extraField);
            $companyOfUser = CompanyHelper::getCompanyOfUser($extraField);

            if(Yii::app()->user->typeOfUser == UserHelper::EMPLOYER && $typeOfUser==UserHelper::CONTRACTOR
                && $companyOfUser == Yii::app()->user->company)return true;
            if(Yii::app()->user->typeOfUser == UserHelper::CONTRACTOR && $typeOfUser==UserHelper::EMPLOYEE
                && $companyOfUser == Yii::app()->user->company ) return true;
            $result = false;
        };
        if($action == 'create-this-type-of-user'){
            $typeOfUser = Yii::app()->user->typeOfUser;
            if($typeOfUser == UserHelper::ADMIN) return true;
            if($typeOfUser == UserHelper::EMPLOYER &&  $extraField==UserHelper::CONTRACTOR)return true;
            if($typeOfUser == UserHelper::CONTRACTOR &&  $extraField==UserHelper::EMPLOYEE)return true;
            $result = false;
        }

        if($action == 'view-permission-tab'){
            $typeOfUser = Yii::app()->user->typeOfUser;
            if($typeOfUser == UserHelper::ADMIN || $typeOfUser == UserHelper::EMPLOYEE ||$typeOfUser == UserHelper::CONTRACTOR )return true;
            if($typeOfUser == UserHelper::EMPLOYER)$result = false;
        }

        if($result) return true;
        RoleHelper::redirect($controllerObj,$showNoAccess,$isAjax);
    }

    private static function redirect($controllerObj=null, $showNoAccess=true, $isAjax=true)
    {
            if ($showNoAccess) {
                if ($isAjax) {
                    $controllerObj->renderPartial('/site/noaccess', null, false, true);
                    Yii::app()->end();
                } else {
                    throw new CHttpException(503, 'شما اجازه دسترسی به این قسمت را ندارید!');
                }
            } else {
                return false;
            }
    }
}