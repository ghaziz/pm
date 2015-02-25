<?php
/**
 * Created by PhpStorm.
 * User: ebrahim
 * Date: 21/02/2015
 * Time: 03:33 AM
 */

class AttachmentsHelper {
    public static function save($fileName,$bind_type,$bind_id=null){
        $attach  = new Attachments();
        $attach->setIsNewRecord(true);
        $attach->bind_type = $bind_type;
        $attach->bind_id = $bind_id;
        $attach->file = $fileName;
        $attach->user_id = Yii::app()->user->id;
        $attach->time = time();
        $attach->save();
        return $attach->id;
    }

    public static function updateTypeAndDescription($attachmentsId, $data)
    {
        $model = Attachments::model()->findByPk($attachmentsId);
        $model->file_type = CHtml::encode($data['file_type']);
        $model->description = CHtml::encode($data['desc']);
        if($model->update()){
            echo 'SUCCESS';
        }else{
            echo "ERROR";
        }
        Yii::app()->end();
    }

    public static function  isValidExtension($ext,$name)
    {
        $acceptableExtenstions = array("image/gif", "image/jpeg", "image/jpg", "image/x-png", "image/png", "application/octet-stream");
        return (in_array($ext, $acceptableExtenstions) && AttachmentsHelper::getFileExtension($ext,$name)!='unknown');
    }

    public static function getFileExtension($ext, $name)
    {
        switch ($ext) {
            case  "image/gif" :
                return "gif";
            case  "image/jpeg" :
                return "jpg";
            case  "image/jpg" :
                return "jpg";
            case  "image/x-png" :
                return "png";
            case  "image/png" :
                return "png";
            case
            "application/octet-stream":
                if (substr($name, -4) == '.zip')
                    return "zip";
                if (substr($name, -4) == '.docx')
                    return "docx";
                if (substr($name, -4) == '.doc')
                    return "doc";
                break;
                if (substr($name, -4) == '.pdf')
                    return "pdf";
                break;
                return "unknown";
        }
    }

    public static function availableTypeForBoundedFiles($bind_type, $selected = null)
    {
        $availabeTypes = array();
        switch ($bind_type) {
            case 'tasks':
                $availabeTypes = array('ضمیمه');
                break;
            case 'projects':
                $availabeTypes = array('درخواست', 'پروپوزال','اصل قرارداد','صورت جلسه');
                break;
        }
        if ($selected == null) {
            return CHtml::dropDownList('file_type', $availabeTypes[0], $availabeTypes);
        } else {
            return CHtml::dropDownList('file_type', $selected, $availabeTypes);
        }
    }

}