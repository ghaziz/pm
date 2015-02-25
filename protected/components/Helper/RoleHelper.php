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
		if((Yii::app()->user->name == UserHelper::admin) || ($count == 1))
		{
			return true;
		}
		else{
            if ($showNoAccess) {
                if($isAjax){
                $controllerObj->renderPartial('/site/noaccess', null, false, true);
                Yii::app()->end();
                }else{
                    throw new CHttpException(503,'شما اجازه دسترسی به این قسمت را ندارید!');
                }
            } else {
                return false;
            }

		}
    }


}