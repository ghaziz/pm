<?php
$this->renderPartial('_form',array('model'=>$model,'id'=>'project-edit-form','action'=>$this->createUrl('project/edit',array('id'=>$model->id)),'title'=>'ویرایش پروژه'));
?>