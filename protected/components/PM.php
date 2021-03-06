<?php

/**
 * Created by PhpStorm.
 * User: ebrahim
 * Date: 17/02/2015
 * Time: 12:07 AM
 */
class PM
{
    //return name+family
    public static function getUserName($index)
    {
        $model = Users::model()->findByPk($index);
        return $model->name . " " . $model->family;
    }

    //return project name
    public static function getProjectName($index)
    {
        $model = Project::model()->findByPk($index);
        return $model->title;
    }

    //return group name
    public static function getGroupName($index)
    {
        $model = GroupTask::model()->findByPk($index);
        return $model->title;
    }

    //status of project
    public static function getTypeOfStatus($model)
    {
        $type = '';
        switch ($model->status) {
            case ProjectHelper::OPEN:
                $type = 'باز';
                break;
            case ProjectHelper::COMPLETED:
                $type = 'اتمام';
                break;
            case ProjectHelper::ON_HOLD:
                $type = 'متوقف';
                break;
            case ProjectHelper::CANCELLED:
                $type = 'کنسل شده';
                break;
            default:
                $type = 'نامشخص';
                break;
        }

        return $type;
    }

    //list of company
    public static function getCompaniesList()
    {
        $companies = array();
        if(Yii::app()->user->typeOfUser == UserHelper::ADMIN || Yii::app()->user->typeOfUser == UserHelper::EMPLOYER){
            $models = Company::model()->findAll();
            foreach ($models as $model) {
                $companies[$model['id']] = $model['title'];
            }
        }else{
            $model = Company::model()->findByPk(Yii::app()->user->company);
            $companies[$model['id']] = $model['title'];
        }
        return $companies;
    }

    //list of project
    public static function getProjecsList()
    {
        $projects = array();
        if(Yii::app()->user->typeOfUser == UserHelper::ADMIN){
            $models = Project::model()->findAll();
            foreach ($models as $model) {
                $projects[$model['id']] = $model['title'];
            }
        }else{
            $companyModel = Company::model()->findByPk(Yii::app()->user->company);
            $models = $companyModel->projects;
            foreach ($models as $model) {
                $projects[$model['id']] = $model['title'];
            }
        }
        return $projects;

    }

    //list of task group
    public static function getGrouptask()
    {
        $groups = array();
        $models = GroupTask::model()->findAll();
        foreach ($models as $model) {
            $groups[$model['id']] = $model['title'];
        }
        return $groups;

    }

    public static function getEmployersList()//karfarma ha + ADMIN baraie taein karfama dar sabte proje
    {

        $typeOfUser = Yii::app()->user->typeOfUser;
        $employers = array();
        $models = array();
        if($typeOfUser==UserHelper::ADMIN){
            $models = Users::model()->findAll(array(
                'condition' => 'type_employee = :type',
                'params' => array(':type' => UserHelper::EMPLOYER)
            ));
        }
        if($typeOfUser==UserHelper::EMPLOYER){
            $models = array(Yii::app()->user->model);
        }

        foreach ($models as $model) {
            $employers[$model['id']] = $model['name'] . " " . $model['family'];
        }
        if ($employers == null) return array();
        return $employers;

    }

    //status of project
    public static function getstatusOptions()
    {
        return array(
            ProjectHelper::OPEN => 'شروع',
            ProjectHelper::COMPLETED => 'اتمام',
            ProjectHelper::ON_HOLD => 'متوقف',
            ProjectHelper::CANCELLED => 'کنسل شده',
        );
    }

    //options of file attachment
    public static function get_attachOptions()
    {
        return array(
            AttachHelper::AFFIXTURE => 'ضمیمه',
            AttachHelper::MINUTES => 'صورت جلسه',
        );
    }

    //important! remain days of projects and tasks
    public static function remain_days($start, $end)
    {
        if($start>$end){return 'اتمام!';}
        $remainDay = ($end - $start)/86400;
        return ceil($remainDay.' روز');
    }

    public static function getAttachmentPath()
    {
        $path = dirname(Yii::app()->getBasePath()) . '/attachments/';
        $path = str_replace('\\', '/', $path);// Replace backslashes with forwardslashes
        $path = preg_replace('/\/+/', '/', $path);// Combine multiple slashes into a single slash
        return $path;
    }

    public static function getBaseAttachmentsPath()
    {
        return Yii::app()->baseUrl . '/attachments/';
    }

    public static function convertJalaliToGeorgian($dateTime)
    {
        $dateTime = date_parse($dateTime);
        if ($dateTime['month'] === false || $dateTime['day'] === false || $dateTime['year'] === false) {
            return time();
        }
        return Yii::app()->jdate->mktime(0, 0, 0, $dateTime['month'], $dateTime['day'], $dateTime['year']);
    }

    public static function getJalali($timeStamp)
    {
        if ($timeStamp == null) {
            return Yii::app()->jdate->date('y/m/d');
        } else {
            return Yii::app()->jdate->date('y/m/d', $timeStamp);
        }
    }

    public static function getCompanytitle($index)
    {
        $model = Company::model()->findByPk($index);
        return $model->title;
    }

    public static function convert($string)
    {
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $num = range(0, 9);
        return str_replace($persian, $num, $string);
    }

    public static function isValidBindType($bind_type)
    {
        $valid_bind_types = array('projects', 'tasks', 'comments');
        if (!in_array($bind_type, $valid_bind_types)) die('invalid bind type');
    }

    public static function getOutputForSuccessUpload($bind_type, $bind_id, $attachmentsId, $file)
    {
        $action = Yii::app()->createUrl('attachments/updateTypeAndDescription', array(
            'attachmentsId' => $attachmentsId,
        ));
        $possibleBoundedTypes = AttachmentsHelper::availableTypeForBoundedFiles($bind_type);
        $out = <<<EOT
        <tr id="up{$attachmentsId}">
        <td>{$file['name']}</td>
        <td>{$possibleBoundedTypes}</td>
        <td><textarea name='desc' col='6'></textarea></td>
        <td><a title="ذخیره" href="#" onclick="UpdateTypeAndDescription('{$action}','{$attachmentsId}')"><i class="fa fa-save"></i></a></td>
        </tr>
EOT;
        echo json_encode(array('out' => $out, 'fileName' => $file['name'], 'status' => 'success'));
        Yii::app()->end();
    }

    public static function purify($text){
        $parser = new CHtmlPurifier();
        return $parser->purify($text);
    }
	
	public static function count_cmnt($bind_type,$bind_id)
	{
		$count = Comment::model()->count(array('condition'=>'bind_type=:bt and bind_id=:bi','params'=> array(
                ':bt' => $bind_type,
                ':bi' => $bind_id) ));
		return $count;
	}
	
	public static function count_unread_cmnt()
	{
		$count = 0;
		if(Yii::app()->user->typeOfUser == UserHelper::ADMIN || Yii::app()->user->typeOfUser == UserHelper::EMPLOYER)
		{
		 $models = 	Comment::model()->findAll();
		 foreach($models as $model)
		 {
			if(($model->user->type_employee == UserHelper::CONTRACTOR || $model->user->type_employee == UserHelper::EMPLOYEE) && $model->read==CommentHelper::UNREAD){
				$count++;
			}
		 }
		}
	    if(Yii::app()->user->typeOfUser == UserHelper::CONTRACTOR || Yii::app()->user->typeOfUser == UserHelper::EMPLOYEE)
		{
		 $models = 	Comment::model()->findAll();
		 foreach($models as $model)
		 {
			if(($model->user->type_employee == UserHelper::ADMIN  || $model->user->type_employee == UserHelper::EMPLOYER) && $model->read==CommentHelper::UNREAD){
				$count++;
			}
		 }
		}
		
		return $count;
	}
		
	public static function unread_cmnts()
	{
		$comments = array();
		if(Yii::app()->user->typeOfUser == UserHelper::ADMIN || Yii::app()->user->typeOfUser == UserHelper::EMPLOYER)
		{
		 $models = 	Comment::model()->findAll();
		 foreach($models as $model)
		 {
			if(($model->user->type_employee == UserHelper::CONTRACTOR || $model->user->type_employee == UserHelper::EMPLOYEE) && $model->read==CommentHelper::UNREAD){
				$comments[] = $model;
			}
		 }
		}
	    if(Yii::app()->user->typeOfUser == UserHelper::CONTRACTOR || Yii::app()->user->typeOfUser == UserHelper::EMPLOYEE)
		{
		 $models = 	Comment::model()->findAll();
		 foreach($models as $model)
		 {
			if(($model->user->type_employee == UserHelper::ADMIN  || $model->user->type_employee == UserHelper::EMPLOYER) && $model->read==CommentHelper::UNREAD){
				$comments[] = $model;
			}
		 }
		}
		
		return $comments;
	}
	
	public static function ago($time, $after = false)
    {
        $periods = array("ثانیه", "دقیقه", "ساعت", "روز", "هفته", "ماه", "سال", "دهه");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = time();

        $difference = abs($now - $time);
        $tense = "قبل";
        if ($after == true)
            $tense = "دیگر";

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($difference != 1) {
            $periods[$j] .= "";
        }

        return "$difference $periods[$j]  $tense";
    }


}