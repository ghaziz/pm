<?php

class CompanyController extends Controller
{
    /* edited by ebrahim ver 1.1 */
    public function actionIndex()
    {
        if (!Yii::app()->user->isGuest) {
            //check permission
            RoleHelper::checkAccessControl('company', 'view', null, true, false);
            $model = CompanyHelper::getModel();
            //logging
            LogHelper::proccess(LogHelper::VIEW, LogHelper::COMPANY, "مشاهده ی لیست شرکت ها");
            $this->render('index', array('model' => $model));
        } else {
            $this->redirect(array('site/login'));
        }
    }

    /* edit by ebrahim ver 1.1 */
    public function actionNew()
    {
        RoleHelper::checkAccessControl('company', 'insert', $this);
        $model = new Company;
        $model->setScenario('new');

        // uncomment the following code to enable ajax-based validation

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'company-new-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['Company'])) {
            $model->attributes = $_POST['Company'];
            $model->foundation_notice = CUploadedFile::getInstance($model, 'foundation_notice');
            $model->user_id = Yii::app()->user->id;
            $model->time = time();
            if ($model->validate()) {
                $fileName = time() . '.' . $model->foundation_notice->getExtensionName();
                $savePath = PM::getAttachmentPath() . $fileName;
                $model->foundation_notice->saveAs($savePath);
                $model->foundation_notice = PM::getBaseAttachmentsPath() . $fileName;
                $model->save(false);
                // redirect to success page
                $this->renderPartial('/site/success', null, false, true);
                Yii::app()->end();
            }
        }
        $this->renderPartial('new', array('model' => $model, false, true));
//       $this->render('new',array('model'=>$model));
    }

    public function actionEdit()
    {
        if (isset($_GET['id'])) {
            $model = Company::model()->findByPk($_GET['id']);
            if (isset($_POST['Company'])) {
                $backUpFoundation_notice = $model->foundation_notice;
                $model->attributes = $_POST['Company'];
                $model->time = time();
                $model->foundation_notice = CUploadedFile::getInstance($model, 'foundation_notice');
                if ($model->validate()) {
                    if ($model->foundation_notice != null) {
                        $fileName = time() . '.' . $model->foundation_notice->getExtensionName();
                        $savePath = PM::getAttachmentPath() . $fileName;
                        $model->foundation_notice->saveAs($savePath);
                        $model->foundation_notice = PM::getBaseAttachmentsPath() . $fileName;
                    } else {
                        $model->foundation_notice = $backUpFoundation_notice;
                    }
                    $model->update(false);
                    // redirect to success page
                    $this->renderPartial('/site/success', null, false, true);
                    Yii::app()->end();
                }
            }
            $this->renderPartial('edit', array('model' => $model, false, true));
//       $this->render('new',array('model'=>$model));
        }
    }

    public function actionDel()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $user = Company::model()->findByPk($id);
//            $user->delete();
            $this->renderPartial('/site/success', null, false, true);
        }
    }

    public function accessRules()
    {
        return array(
            array('allow',  // allow authenticated  to perform 'index' and 'view' actions
                'users' => array('@'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function filters()
    {
        return array(
            'accessControl',
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