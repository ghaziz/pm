<?php

/**
 * Created by PhpStorm.
 * User: Ghai
 * Date: 23/02/2015
 * Time: 18:00 PM
 */
class LogHelper
{

	//type of operation
	CONST INSERT = 0;
	CONST DELETE = 1;
	CONST EDIT = 2;
	CONST VIEW = 3;
	CONST LOGIN = 4;
	CONST LOGOUT = 5;
	CONST ATTACH = 6;
	CONST DOWNLOAD = 7;
	CONST INSERT_GROUP = 8;
	
	//type of category
	CONST COMPANY = 0;
	CONST PROJECT = 1;
	CONST TASK = 2;
	CONST USER= 3;
	CONST REPORT = 4;
	CONST ATTACHMENT= 5;
    const COMMENT = 6;

    public static function proccess($level,$category,$message)
	{
		$user_id = Yii::app()->user->id;
		$time = time();
		$ip = Yii::app()->request->userHostAddress;
		
		$log = new Log();
		$log->setIsNewRecord(true);
		$log->user_id = $user_id;
		$log->level = $level;
		$log->category = $category;
		$log->message = $message;
		$log->time = $time;
		$log->ip = $ip;
		
		$log->save();
		
	}
	
}