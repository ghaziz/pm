<?php

/**
 * Created by PhpStorm.
 * User: ebrahim
 * Date: 18/02/2015
 * Time: 01:02 PM
 */
class CompanyHelper
{
    public static function getChiefOfCompany($companyId)
    {

        $model = Users::model()->find('type_employee=:te and id_company=:ic',array(':te'=>UserHelper::CONTRACTOR,':ic'=>$companyId));
        if($model!=null){
        return $model->name.' '.$model->family;
        }
        return 'نامشخص';
    }

    public static function getTypeOfCompany($index = null)
    {
        $types = array('سهامی خاص', 'تعاونی','تعاونی دانش بنیان');
        if ($index == null) {
            return $types;
        }
        return $types[$index];
    }

    public static function getTypeOfEmployee($index = null,$returnArray = false)
    {
        $typeOfCurrentUser = Yii::app()->user->typeOfUser;
        switch($typeOfCurrentUser){
            case UserHelper::ADMIN:
                $types[UserHelper::EMPLOYER] = 'کارفرما';
                $types[UserHelper::CONTRACTOR] = 'پیمانگار';
                $types[UserHelper::ADMIN] = 'مدیریت سایت';
                break;
            case UserHelper::EMPLOYER:
                $types[UserHelper::CONTRACTOR] = 'پیمانگار';
                break;
            case UserHelper::CONTRACTOR:
                $types[UserHelper::EMPLOYEE] = 'کارمند';
                break;
            default:
                $types = array();

        }
        if ($index == null) {
            return $types;
        }else{
            $types[UserHelper::EMPLOYEE] = 'کارمند';
            $types[UserHelper::EMPLOYER] = 'کارفرما';
            $types[UserHelper::CONTRACTOR] = 'پیمانگار';
            $types[UserHelper::ADMIN] = 'مدیریت سایت';
            if($returnArray)
            return array($index=>$types[$index]);
            return $types[$index];
        }

    }

    public static function getCompaniesList()
    {
        return CHtml::listData(Company::model()->findAll(), 'id', 'title');
    }

    public static function getCompanyName($company)
    {
        if($company==null){
            return 'تعیین نشده';
        }else{return $company->title;}
    }

    public static function getModel()
    {
        $model = array();
        $type_employee = Yii::app()->user->typeOfUser;

        switch($type_employee){
            case UserHelper::ADMIN:
                $model = Company::model()->findAll(array('order'=>'time'));
                break;
            case UserHelper::EMPLOYER:
//            case UserHelper::EMPLOYER:
//                $model = Company::model()->findAll(array('condition'=>'user_id=:user_id','order'=>'time',
//                    'params'=>array(':user_id'=>Yii::app()->user->id)));
//                break;
//            case UserHelper::CONTRACTOR:
//                $model = Yii::app()->user->companiesModel;
//                break;
                $model = Company::model()->findAll(array('order'=>'time'));
                break;
            case UserHelper::CONTRACTOR:
                $model = Company::model()->findAll("id=:id", array(':id'=>Yii::app()->user->company));
                break;
            case UserHelper::EMPLOYEE:
                $model = Company::model()->findAll("id=:id", array(':id'=>Yii::app()->user->company));
                break;
        }
        if($model==null)return array();
        return $model;
    }

    public static function getCompanyOfUser($id)
    {
        $user = Users::model()->findByPk($id);
        return $user->id_company;
    }
}