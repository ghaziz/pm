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
        $types[UserHelper::Employee] = 'کارمند';
        $types[UserHelper::employer] = 'کارفرما';
        $types[UserHelper::Contractor] = 'پیمانگار';
        $types[UserHelper::admin] = 'مدیریت سایت';
        if ($index == null) {
            return $types;
        }
        return $types[$index];
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
            case UserHelper::admin:
                $model = Company::model()->findAll(array('order'=>'time'));
                break;
            case UserHelper::employer:
                $model = Company::model()->findAll(array('order'=>'time'));
                break;
            case UserHelper::Contractor:
                $model = Company::model()->findAll("id=:id", array(':id'=>$user->id_company));
                break;
            case UserHelper::Employee:
                $model = Company::model()->findAll("id=:id", array(':id'=>$user->id_company));
                break;
        }
        if($model==null)return array();
        return $model;
    }
}