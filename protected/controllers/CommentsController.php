<?php

class CommentsController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionList()
    {
        $newModel = new Comment();
        if (isset($_GET['bind_type'], $_GET['bind_id'], $_GET['title'])) {
            $model = Comment::model()->findAll(array('condition'=>'bind_type=:bt and bind_id=:bi','params'=> array(
                ':bt' => $_GET['bind_type'],
                ':bi' => $_GET['bind_id']),'order'=>'time DESC'
            ));

            $this->render('list', array('model' => $model,'newModel'=>$newModel, 'title' =>$_GET['title']));
        } else {
            throw new CHttpException(404, 'صفحه مورد نظر پیدا نشد');
        }
    }

    public function actionNew()
    {
        $newModel = new Comment();
        if (isset($_POST['Comment'], $_GET['bind_id'], $_GET['bind_type'])) {
            $newModel->attributes = $_POST['Comment'];
            $newModel->time = time();
            $newModel->bind_id = $_GET['bind_id'];
            $newModel->bind_type = $_GET['bind_type'];
            $newModel->user_id = Yii::app()->user->id;
            $newModel->context = PM::purify($newModel->context);
            if ($newModel->validate()) {
                if ($newModel->save(false)) {
                    LogHelper::proccess(LogHelper::INSERT, LogHelper::COMMENT, "ایجاد نظر جدید");
                }
            }
        }
        //$url = $this->createUrl('comments/list',array('bind_type'=>$_GET['bind_type'],'bind_id'=>$_GET['bind_id'],'title'=>$_GET['title']));
        $this->redirect(array('site/index'));
    }

    public function actionDel()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $comment = Comment::model()->findByPk($id);
            RoleHelper::checkCommentsAccess('delete', $comment, $this);
            if ($comment->delete()) {
                LogHelper::proccess(LogHelper::DELETE, LogHelper::COMMENT, "نظر حذف شد");
            }
            $this->renderPartial('/site/success', null, false, true);
        }
    }

    public function actionEdit()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $comment = Comment::model()->findByPk($id);
        }
        if (isset($_POST['Comment'], $_GET['bind_id'], $_GET['bind_type'])) {
            $comment->attributes = $_POST['Comment'];
            $comment->time = time();
            $comment->modified_by = Yii::app()->user->id;
            $comment->context = PM::purify($comment->context);
            if ($comment->validate()) {
                if ($comment->update(false)) {
                    LogHelper::proccess(LogHelper::EDIT, LogHelper::COMMENT, "ویرایش نظر");
                    $url = $this->createUrl('comments/list',array('bind_type'=>$_GET['bind_type'],'bind_id'=>$_GET['bind_id'],'title'=>$_GET['title']));
                    $this->redirect($url);
                }
            }
        }else{
            $this->render('edit', array('model' => $comment,'title' =>$_GET['title']));
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