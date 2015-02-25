<?php

/**
 * Created by PhpStorm.
 * User: ebrahim
 * Date: 18/02/2015
 * Time: 01:02 PM
 */
class CompanyHelper
{
    public static function getChiefOfCompany($id)
    {
        $model = Users::model()->findByPk($id);
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

    public static function getTypeOfEmployee($index = null)
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
        }
        if ($index == null) {
            return $types;
        }else{
            $types[UserHelper::EMPLOYEE] = 'کارمند';
            $types[UserHelper::EMPLOYER] = 'کارفرما';
            $types[UserHelper::CONTRACTOR] = 'پیمانگار';
            $types[UserHelper::ADMIN] = 'مدیریت سایت';
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

    //this return the model that different for any user-permission-used in company-index
    /* edited by ebrahim 1.1 */
    public static function getModel()
    {
        $model = array();
        $user = Users::model()->findByPk(Yii::app()->user->id);
        $type_employee = $user->type_employee;

        switch($type_employee){
            case UserHelper::ADMIN:
                $model = Company::model()->findAll(array('order'=>'time'));
                break;
            case UserHelper::EMPLOYER:
                $model = Company::model()->findAll(array('order'=>'time'));
                break;
            case UserHelper::CONTRACTOR:
                $model = Company::model()->findAll("id=:id", array(':id'=>$user->id_company));
                break;
            case UserHelper::EMPLOYEE:
                $model = Company::model()->findAll("id=:id", array(':id'=>$user->id_company));
                break;
        }
        if($model==null)return array();
        return $model;
    }
}