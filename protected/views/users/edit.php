<?php
$this->renderPartial('_form',array('model'=>$model,'role'=>$role,'id'=>'user-edit-form','action'=>$this->createUrl('users/edit',array('id'=>$model->id)),'title'=>'ویرایش کاربر'));
?>