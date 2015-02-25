<?php
$this->renderPartial('_form',array('model'=>$model,'id'=>'task-edit-form','action'=>$this->createUrl('task/edit',array('id'=>$model->id)),'title'=>'ویرایش تسک'));
?>