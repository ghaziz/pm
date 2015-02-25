<?php

class AttachmentsController extends Controller
{
    public function actionIndex()
    {
        if (isset($_GET['bind_type'])) {
            $action = Yii::app()->createUrl('attachments/attach', $_GET);
            $this->renderPartial('index', array('action' => $action), false, true);
        }
    }

    public function actionAttach()
    {
        if (isset($_GET['bind_type'], $_GET['bind_id'])) {
            $bind_id = $_GET['bind_id'];
            PM::isValidBindType($_GET['bind_type']);

            //todo check for permission bind type and bind type???
            $file = $_FILES['file'];
            if (AttachmentsHelper::isValidExtension($file['type'], $file['name'])) {
                $fileNameOnServer = $_GET['bind_type'] . '/' . time() . '-' . Yii::app()->user->id . '-' . $file['name'];
                if (move_uploaded_file($file['tmp_name'], PM::getAttachmentPath() . $fileNameOnServer)) {
                    $attachmentId = AttachmentsHelper::save(PM::getBaseAttachmentsPath() . $fileNameOnServer, $_GET['bind_type'], $bind_id);
                    PM::getOutputForSuccessUpload($_GET['bind_type'], $_GET['bind_id'], $attachmentId, $file);
                }
            }else{
                echo json_encode(array('status'=>Status::ERROR,'msg'=>'نوع فایل غیر مجاز است!'));
            }
        } else {
            die("Invalid upload request");
        }
    }

    public function actionUpdateTypeAndDescription()
    {
        if (isset($_GET['attachmentsId'])) {

            AttachmentsHelper::updateTypeAndDescription($_GET['attachmentsId'], $_POST);
        }

    }

    public function actionList()
    {
        if(isset($_GET['bind_type'],$_GET['bind_id'],$_GET['title'])){
            $model = Attachments::model()->findAll('bind_type=:bt and bind_id=:bi',array(
                ':bt'=>$_GET['bind_type'],
                ':bi'=>$_GET['bind_id']
            ));


            $this->render('list',array('model'=>$model,'title'=>$_GET['title']));
        }else{
            throw new CHttpException(404,'صفحه مورد نظر پیدا نشد');
        }
    }

    public function actionDel()
    {

    }

    public function init()
    {
//        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/jqueryUpload/css/style.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/js/dropper/jquery.fs.dropper.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/dropper/src/jquery.fs.dropper.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/dropper/src/app.js', CClientScript::POS_END);
        return parent::init();
    }

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */
}