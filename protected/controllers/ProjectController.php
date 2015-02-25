<?php
/**
 * Created by PhpStorm.
 * User: Ghazi
 * Date: 23/02/2015
 * Time: 18:00 PM
 */
//I have added permission and log functions to any actions of this controller and checked isGuest just in index and check status of project in new and edit
class ProjectController extends Controller
{
    /* edited by ebrahim ver 1.1 */
    public function actionIndex()
    {
        if (!Yii::app()->user->isGuest) {
            RoleHelper::checkAccessControl('project', 'view', null, true, false);
            $model = ProjectHelper::getModel();
            //log
            LogHelper::proccess(LogHelper::VIEW, LogHelper::PROJECT, "مشاهده ی لیست پروژه ها");
            $this->render('index', array('model' => $model));
        } else {
            $this->redirect(array('site/login'));
        }
    }

    /* edited by ebrahim ver 1.1 */
    public function actionNew()
    {
        RoleHelper::checkAccessControl('project', 'insert');
        $model = new Project;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'project-new-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['Project'])) {
            $model->attributes = $_POST['Project'];
            $model->time = time();
            $type_user = Yii::app()->user->name;
            //check who is changing the project status
            if ($type_user == UserHelper::ADMIN || $type_user == UserHelper::EMPLOYER) {
                $model->confirm_status = ProjectHelper::CONFIRMED;
            } else {
                $model->confirm_status = ProjectHelper::NOT_CONFIRMED;
            }

            if ($model->validate()) {
                $model->start_time = PM::convertJalaliToGeorgian($model->start_time);
                $model->end_time = PM::convertJalaliToGeorgian($model->end_time);

                if ($model->save(false)) {
                    mkdir('attachments/projects/' . $model->id);
                    LogHelper::proccess(LogHelper::INSERT, LogHelper::PROJECT, "ایجاد پروژه ی جدید");
                }

                $this->renderPartial('/site/success', null, false, true);
                Yii::app()->end();
            }
        }
        $this->renderPartial('new', array('model' => $model, false, true));
    }

    /* edited by ebrahim ver 1.1 */
    public function actionEdit()
    {

        RoleHelper::checkAccessControl('project', 'edit', $this);
        if (isset($_GET['id'])) {

            $model = Project::model()->findByPk($_GET['id']);

            if (isset($_POST['Project'])) {

                $model->attributes = $_POST['Project'];
                $model->time = time();
                $type_user = Yii::app()->user->name;
                //check who is changing the project status
                if ($type_user == UserHelper::ADMIN || $type_user == UserHelper::EMPLOYER) {
                    $model->confirm_status = ProjectHelper::CONFIRMED;
                } else {
                    $model->confirm_status = ProjectHelper::NOT_CONFIRMED;
                }

                if ($model->validate()) {
                    $model->start_time = PM::convertJalaliToGeorgian($model->start_time);
                    $model->end_time = PM::convertJalaliToGeorgian($model->end_time);
                    if ($model->update(false)) {
                        LogHelper::proccess(LogHelper::EDIT, LogHelper::PROJECT, "پروژه ویرایش شد");
                    }

                    $this->renderPartial('/site/success', null, false, true);
                    Yii::app()->end();
                }

            }
            $model->start_time = PM::getJalali($model->start_time);
            $model->end_time = PM::getJalali($model->end_time);

            $this->renderPartial('edit', array('model' => $model, false, true));
        }
    }

    /* edited by ebrahim ver 1.1 */
    public function actionInfo()
    {
        RoleHelper::checkAccessControl('project', 'view', $this);
        if (isset($_GET['id'])) {
            $model = Project::model()->findByPk($_GET['id']);
        }
        $this->renderPartial('info', array('model' => $model, false, true));
    }

    /* edited by ebrahim ver 1.1 */
    public function actionDel()
    {

        RoleHelper::checkAccessControl('project', 'delete', $this);
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $project = Project::model()->findByPk($id);
            if ($project->delete()) {
                LogHelper::proccess(LogHelper::DELETE, LogHelper::PROJECT, "پروژه حذف شد");
            }
            $this->renderPartial('/site/success', null, false, true);
        }
    }

    public function actionAttach()
    {
        $model = new Attach;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'attach-new-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['Attach'])) {
            $model->attributes = $_POST['Attach'];
            $model->time = time();
            $model->file = CUploadedFile::getInstance($model, 'file');


            if ($model->validate()) {
                if ($model->file != null) {
                    $fileName = time() . '.' . $model->file->getExtensionName();
                    $savePath = PM::getAttachmentPath() . $fileName;
                    $model->file->saveAs($savePath);
                } else {
                    $fileName = 'no_avatar.png';
                }
                $model->file = PM::getBaseAttachmentsPath() . $fileName;

                if ($model->save(false)) {
                    LogHelper::proccess(LogHelper::ATTACH, LogHelper::PROJECT, "پیوست فایل جدید");
                }
                $this->renderPartial('/site/success', null, false, true);
                Yii::app()->end();
            }
        }

        $this->renderPartial('attach', array('model' => $model, false, true));
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