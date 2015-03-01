<?php

/**
 * Created by PhpStorm.
 * User: Ghazi
 * Date: 24/02/2015
 * Time: 16:00 PM
 */
class TaskController extends Controller
{
    //1.0.2 added filter and order but not complete
    public function actionIndex()
    {
        if (!Yii::app()->user->isGuest) {
            RoleHelper::checkAccessControl('task', 'view', $this, true, false);

            if (isset($_GET['status'])) {
                $model = TaskHelper::getModel($_GET['status']);
            } else {
                $model = TaskHelper::getModel();
            }
            $this->render('index', array('model' => $model));
            LogHelper::proccess(LogHelper::VIEW, LogHelper::TASK, "مشاهده ی تسک ها");

        } else {
            $this->redirect(array('site/login'));
        }
    }

    public function actionNew()
    {
        RoleHelper::checkAccessControl('task', 'insert', $this);

        $model = new Task;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'task-new-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Task'])) {
            $model->attributes = $_POST['Task'];
            $model->time = time();
            $type_user = Yii::app()->user->typeOfUser;
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



    public function actionEdit()
    {
        RoleHelper::checkAccessControl('task', 'edit', $this);
        if (isset($_GET['id'])) {

            $model = Task::model()->findByPk($_GET['id']);

            if (isset($_POST['Task'])) {
                $model->attributes = $_POST['Task'];
                $model->time = time();
                $type_user = Yii::app()->user->name;
//                if ($type_user == UserHelper::ADMIN || $type_user == UserHelper::EMPLOYER) {
//                    $model->confirm_status = TaskHelper::CONFIRMED;
//                } else {
//                    $model->confirm_status = TaskHelper::NOT_CONFIRMED;
//                }

                if ($model->validate()) {
                    $model->start_time = PM::convertJalaliToGeorgian($model->start_time);
                    $model->end_time = PM::convertJalaliToGeorgian($model->end_time);
                    if ($model->update(false)) {
                        LogHelper::proccess(LogHelper::EDIT, LogHelper::TASK, "تسک ویرایش شد");
                        $this->renderPartial('/site/success', null, false, true);
                    }
                    Yii::app()->end();
                }
            }
            $model->start_time = PM::getJalali($model->start_time);
            $model->end_time = PM::getJalali($model->end_time);

            $this->renderPartial('edit', array('model' => $model, false, true));
        }
    }

    public function actionInfo()
    {
        RoleHelper::checkAccessControl('task', 'view', $this);
        if (isset($_GET['id'])) {
            $model = Task::model()->findByPk($_GET['id']);
        }
        $this->renderPartial('info', array('model' => $model, false, true));
    }

    public function actionDel()
    {

        if (RoleHelper::checkAccessControl('task', 'delete')) {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $task = Task::model()->findByPk($id);
                if ($task->delete()) {
                    LogHelper::proccess(LogHelper::DELETE, LogHelper::TASK, "تسک حذف شد");
                }
                $this->renderPartial('/site/success', null, false, true);
            }
        } else {
            $this->renderPartial('/site/noaccess', null, false, true);
        }
    }

    //1.0.2 this returns all tasks of a spacial project
    public function actionProjecttask()
    {
        $message = "";
        if (RoleHelper::checkAccessControl('task', 'view')) {
            if (isset($_GET['id'])) {

                $model = Task::model()->findAll("id_project=:id", array(':id' => $_GET['id']));
            }
            $this->render('Projecttask', array('model' => $model, 'title' => $_GET['title'], 'message' => $message));
        } else {
            $message = "شما اجازه ی مشاهده ی تسک ها را ندارید";
            $this->render('index', array('message' => $message));
        }
    }
	
	//v1.0.4
	public function actionGrouplist()
    {
        if (!Yii::app()->user->isGuest) {
		
            RoleHelper::checkAccessControl('task', 'view', $this, true, false);

            $model = GroupTask::model()->findAll(array('order'=>'time'));
            $this->render('grouplist', array('model' => $model));
            LogHelper::proccess(LogHelper::VIEW, LogHelper::TASK, "مشاهده ی گروه های تسک");

        } else {
            $this->redirect(array('site/login'));
        }
    }
	
	//v1.0.4
    public function actionNew_group()
    {
        RoleHelper::checkAccessControl('task', 'insert', $this);
        $model = new GroupTask;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'group-new-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['GroupTask'])) {
            $model->attributes = $_POST['GroupTask'];
            $model->time = time();
            $model->user_id = Yii::app()->user->id;

            if ($model->validate()) {
                if ($model->save(false)) {
                    LogHelper::proccess(LogHelper::INSERT_GROUP, LogHelper::GROUP_TASK, "گروه جدید اضافه شد");
                }
                $this->renderPartial('/site/success', null, false, true);
                Yii::app()->end();
            }
        }
        $this->renderPartial('new_group', array('model' => $model, false, true));
    }
	//v1.0.4
	public function actionEdit_group()
    {
		 RoleHelper::checkAccessControl('task', 'edit', $this);
		 if (isset($_GET['id'])) {
			$model = GroupTask::model()->findByPk($_GET['id']);
			if (isset($_POST['GroupTask'])) {
				$model->attributes = $_POST['GroupTask'];
				$model->time = time();
				if ($model->validate()) {
				    if ($model->update(false)) {
                        LogHelper::proccess(LogHelper::EDIT, LogHelper::GROUP_TASK, "گروه تسک ویرایش شد");
                    }
                    $this->renderPartial('/site/success', null, false, true);
                    Yii::app()->end();
				}
			}
		 $this->renderPartial('edit_group', array('model' => $model, false, true));
		 }
		 
    }
	//v1.0.4
    public function actionDelgroup()
    {
        if (RoleHelper::checkAccessControl('task', 'delete')) {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $task = GroupTask::model()->findByPk($id);
                if ($task->delete()) {
                    LogHelper::proccess(LogHelper::DELETE, LogHelper::GROUP_TASK, "گروه تسک حذف شد");
                }
                $this->renderPartial('/site/success', null, false, true);
            }
        } else {
            $this->renderPartial('/site/noaccess', null, false, true);
        }
    }
	//v1.0.4
	public function actiongrouptask()
    {
        $message = "";
        if (RoleHelper::checkAccessControl('task', 'view')) {
            if (isset($_GET['id'])) {

                $model = Task::model()->findAll("id_group=:id", array(':id' => $_GET['id']));
            }
			LogHelper::proccess(LogHelper::VIEW, LogHelper::GROUP_TASK, "تسک های گروه مشاهده شدند");
            $this->render('grouptask', array('model' => $model, 'title' => $_GET['title'], 'message' => $message));
        } else {
            $message = "شما اجازه ی مشاهده ی تسک ها را ندارید";
            $this->render('index', array('message' => $message));
        }
    }

    //1.0.2 added print
    public function actionprint()
    {

        if (isset($_GET['id'])) {
            $model = Task::model()->findByPk($_GET['id']);
            if ($model != null) {
                $this->render('print', array('model' => $model));
            } else {
                $this->render('print', array('model' => array()));
            }
        }
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