<?php
$this->renderPartial('_form',array('model'=>$model,'role'=>$role,'id'=>'user-new-form','action'=>$this->createUrl('users/new'),'title'=>'ثبت کاربر جدید'));
?>