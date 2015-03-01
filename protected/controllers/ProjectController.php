<?php
/**
 * Created by PhpStorm.
 * User: Ghazi
 * Date: 24/02/2015
 * Time: 16:00 PM
 */

class ProjectController extends Controller
{
    //1.0.2 added filter and order
    public function actionIndex()
    {
        if(!Yii::app()->user->isGuest)
        {
            $status = "";
            $order = "";
            RoleHelper::checkAccessControl('project','view',$this,true,false);

                if(isset($_GET['status']) || isset($_GET['order']))
                {
                    if(isset($_GET['status']) && !isset($_GET['order']))
                    {
                        $model = ProjectHelper::getModel($_GET['status'],$order);
                    }
                    if(!isset($_GET['status']) && isset($_GET['order']))
                    {
                        $model = ProjectHelper::getModel($status,$_GET['order']);
                    }
                }
                else{
                    $model = ProjectHelper::getModel($status,$order);
                }
                LogHelper::proccess(LogHelper::VIEW, LogHelper::PROJECT, "مشاهده ی لیست پروژه ها");
                $this->render('index', array('model' => $model));

        }
        else
        {
            $this->redirect(array('site/login'));
        }

    }

    public function actionNew()
    {

        RoleHelper::checkAccessControl('project','insert',$this,true);

            $model = new Project;

            if(isset($_POST['ajax']) && $_POST['ajax']==='project-new-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if(isset($_POST['Project']))
            {
                $model->attributes=$_POST['Project'];
                $model->time = time();
                $type_user=Yii::app()->user->name;
                if($type_user == UserHelper::ADMIN  || $type_user == UserHelper::EMPLOYER)
                {
                    $model->confirm_status = ProjectHelper::CONFIRMED;
                }
                else{
                    $model->confirm_status = ProjectHelper::NOT_CONFIRMED;
                }

                if($model->validate())
                {
                    $model->start_time = PM::convertJalaliToGeorgian($model->start_time);
                    $model->end_time = PM::convertJalaliToGeorgian($model->end_time);

                    if($model->save(false))
                    {
                        mkdir('attachments/projects/'.$model->id);
                        LogHelper::proccess(LogHelper::INSERT, LogHelper::PROJECT, "ایجاد پروژه ی جدید");
                    }

                    $this->renderPartial('/site/success',null,false,true);
                    Yii::app()->end();
                }
            }
            $this->renderPartial('new',array('model'=>$model,false,true));
    }

    public function actionEdit()
    {

        RoleHelper::checkAccessControl('project','edit',$this);
            if (isset($_GET['id'])) {

                $model = Project::model()->findByPk($_GET['id']);

                if (isset($_POST['Project'])) {

                    $model->attributes=$_POST['Project'];
                    $model->time = time();
                    $type_user=Yii::app()->user->name;
                    if($type_user == UserHelper::ADMIN  || $type_user == UserHelper::EMPLOYER)
                    {
                        $model->confirm_status = ProjectHelper::CONFIRMED;
                    }
                    else{
                        $model->confirm_status = ProjectHelper::NOT_CONFIRMED;
                    }

                    if($model->validate())
                    {
                        $model->start_time = PM::convertJalaliToGeorgian($model->start_time);
                        $model->end_time = PM::convertJalaliToGeorgian($model->end_time);
                        if($model->update(false))
                        {
                            LogHelper::proccess(LogHelper::EDIT, LogHelper::PROJECT, "پروژه ویرایش شد");
                        }

                        $this->renderPartial('/site/success',null,false,true);
                        Yii::app()->end();
                    }

                }
                $model->start_time = PM::getJalali($model->start_time);
                $model->end_time = PM::getJalali($model->end_time);

                $this->renderPartial('edit', array('model' => $model, false, true));
            }
    }

    public function actionInfo(){
        RoleHelper::checkAccessControl('project','view',$this);

            if (isset($_GET['id'])) {
                $model = Project::model()->findByPk($_GET['id']);
            }
            $this->renderPartial('info', array('model' => $model, false, true));
    }

    public function actionDel(){
        RoleHelper::checkAccessControl('project','delete',$this);

            if(isset($_POST['id'])){
                $id = $_POST['id'];
                $project = Project::model()->findByPk($id);
                if($project->delete())
                {
                    LogHelper::proccess(LogHelper::DELETE, LogHelper::PROJECT, "پروژه حذف شد");
                }
                $this->renderPartial('/site/success',null,false,true);
            }
    }

    //1.0.2 added print
    public function actionprint()
    {

        if (isset($_GET['id'])) {
            $model = Project::model()->findByPk($_GET['id']);
            if($model!=null)
            {
                $this->render('print', array('model' => $model ));
            }
            else{
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