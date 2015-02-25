<?php

class TaskController extends Controller
{
    /* edited by ebrahim ver 1.1 */
    public function actionIndex()
    {
        if (!Yii::app()->user->isGuest) {
            RoleHelper::checkAccessControl('task', 'view', null, true, false);
            $model = TaskHelper::getModel();
            $this->render('index', array('model' => $model));
            LogHelper::proccess(LogHelper::VIEW, LogHelper::TASK, "مشاهده ی تسک ها");
        } else {
            $this->redirect(array('site/login'));
        }
    }

    /* edited by ebrahim ver 1.1 */
    public function actionNew()
    {
        RoleHelper::checkAccessControl('task', 'insert');
        $model = new Task;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'task-new-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Task'])) {
            $model->attributes = $_POST['Task'];
            $model->time = time();
            $type_user = Yii::app()->user->name;
            if ($type_user == UserHelper::ADMIN || $type_user == UserHelper::EMPLOYER) {
                $model->confirm_status = TaskHelper::CONFIRMED;
            } else {
                $model->confirm_status = TaskHelper::NOT_CONFIRMED;
            }
            $model->user_id = Yii::app()->user->id;

            if ($model->validate()) {
                $model->start_time = PM::convertJalaliToGeorgian($model->start_time);
                $model->end_time = PM::convertJalaliToGeorgian($model->end_time);

                if ($model->save(false)) {
                    LogHelper::proccess(LogHelper::INSERT, LogHelper::TASK, "ایجاد تسک جدید");
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
        RoleHelper::checkAccessControl('task', 'edit', $this);
        if (isset($_GET['id'])) {

            $model = Task::model()->findByPk($_GET['id']);

            if (isset($_POST['Task'])) {
                $model->attributes = $_POST['Task'];
                $model->time = time();
                $type_user = Yii::app()->user->name;
                if ($type_user == UserHelper::ADMIN || $type_user == UserHelper::EMPLOYER) {
                    $model->confirm_status = TaskHelper::CONFIRMED;
                } else {
                    $model->confirm_status = TaskHelper::NOT_CONFIRMED;
                }

                if ($model->validate()) {
                    $model->start_time = PM::convertJalaliToGeorgian($model->start_time);
                    $model->end_time = PM::convertJalaliToGeorgian($model->end_time);
                    if ($model->update(false)) {
                        LogHelper::proccess(LogHelper::EDIT, LogHelper::TASK, "تسک ویرایش شد");
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
        RoleHelper::checkAccessControl('task', 'view', $this);
        if (isset($_GET['id'])) {
            $model = Task::model()->findByPk($_GET['id']);
        }
        $this->renderPartial('info', array('model' => $model, false, true));
    }
    /* edited by ebrahim ver 1.1 */
    public function actionDel()
    {

        RoleHelper::checkAccessControl('task', 'delete', $this);
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $task = Task::model()->findByPk($id);
            if ($task->delete()) {
                LogHelper::proccess(LogHelper::DELETE, LogHelper::TASK, "تسک حذف شد");
            }
            $this->renderPartial('/site/success', null, false, true);
        }
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