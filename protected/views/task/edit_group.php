<?php
$this->renderPartial('new_group',array('model'=>$model,'id'=>'group-edit-form','action'=>$this->createUrl('task/edit_group',array('id'=>$model->id)),'title'=>'ویرایش تسک'));
?>