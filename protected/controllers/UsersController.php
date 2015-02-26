<?php

class UsersController extends Controller
{
    public function actionIndex()
    {
        $model = UserHelper::getModel();
        LogHelper::proccess(LogHelper::VIEW, LogHelper::USER, "مشاهده ی لیست کاربران");
        $this->render('index',array('model'=>$model));
    }

    public function actionNew()
    {
        RoleHelper::checkUsersAccessControl('new',null,$this);
        $model = new Users();
        $role  = new Roles();
        // uncomment the following code to enable ajax-based validation

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-new-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        if (isset($_POST['Users'],$_POST['Roles'])) {
            //set user time
            $model->attributes = $_POST['Users'];
            RoleHelper::checkUsersAccessControl('create-this-type-of-user',$model->type_employee,$this);
            $model->time = time();
            $model->active = 1;
            $model->photo = CUploadedFile::getInstance($model,'photo');
            if($model->validate())
            {
                $model->birthday = PM::convertJalaliToGeorgian($model->birthday);
                if($model->photo!=null){
                $fileName = time().'.' . $model->photo->getExtensionName();
                $savePath = PM::getAttachmentPath().$fileName;
                $model->photo->saveAs($savePath);
                }else{
                    $fileName = 'no_avatar.png';
                }
                $model->photo = PM::getBaseAttachmentsPath().$fileName;
                if ($model->save(false)) {
                    LogHelper::proccess(LogHelper::INSERT, LogHelper::USER, "ایجاد کاربر جدید");
                }
                $role->user_id = $model->id;
                $role->attributes = $_POST['Roles'];
                $role->save();
                // redirect to success page
                $this->renderPartial('/site/success',null,false,true);
                Yii::app()->end();
            }
        }
        $this->renderPartial('new', array('model' => $model,'role'=>$role), false, true);
//       $this->render('new',array('model'=>$model));

    }

    public function actionEdit()
    {
        if (isset($_GET['id'])) {
            RoleHelper::checkUsersAccessControl('edit',$_GET['id'],$this);
            $model = Users::model()->findByPk($_GET['id']);
            $role  = Roles::model()->findByPk($_GET['id']);
            if (isset($_POST['Users'],$_POST['Roles'])) {
                //set user time
                $backUpPhoto = $model->photo;
                $model->attributes = $_POST['Users'];
                RoleHelper::checkUsersAccessControl('create-this-type-of-user',$model->type_employee,$this);
                $model->birthday = PM::convertJalaliToGeorgian($model->birthday);
                $model->photo = CUploadedFile::getInstance($model, 'photo');
                if ($model->validate()) {
                    if ($model->photo != null) {
                        $fileName = time().'.' . $model->photo->getExtensionName();
                        $savePath = PM::getAttachmentPath() .  $fileName;
                        $model->photo->saveAs($savePath);
                        $model->photo = PM::getBaseAttachmentsPath() . $fileName;
                    }else{
                        $model->photo = $backUpPhoto;
                    }
                    $model->update(false);
                    $role->attributes = $_POST['Roles'];
                    if(RoleHelper::checkUsersAccessControl('view-permission-tab',null,null,false)){
                        $role->save();
                    }

                    // redirect to success page
                    $this->renderPartial('/site/success', null, false, true);
                    Yii::app()->end();
                }
            }
            $model->birthday = PM::getJalali($model->birthday);
            $this->renderPartial('edit', array('model' => $model,'role'=>$role), false, true);
//       $this->render('new',array('model'=>$model));
        }
    }

    public function actionDel(){
        if(isset($_POST['id'])){
        RoleHelper::checkUsersAccessControl('edit',$_POST['id'],$this);
        $id = $_POST['id'];
        $user = Users::model()->findByPk($id);
        $user->active = 0;
        $user->update();
        $this->renderPartial('/site/success',null,false,true);
        }
    }

    public function actionDelPic(){
        if(isset($_POST['id'])){
            RoleHelper::checkUsersAccessControl('edit',$_POST['id'],$this);
            $id = $_POST['id'];
            $user = Users::model()->findByPk($id);
            $user->photo = PM::getBaseAttachmentsPath() . 'no_avatar.png';
            $user->update();
            $this->renderPartial('/site/success',null,false,true);
        }
    }

    public function actionInfo(){
        if (isset($_GET['id'])) {
            RoleHelper::checkUsersAccessControl('edit',$_GET['id'],null,$this);
            $model = Users::model()->findByPk($_GET['id']);
        }
        $this->renderPartial('info', array('model' => $model, false, true));
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