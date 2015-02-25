<?php
$this->renderPartial('_form',array('model'=>$model,'id'=>'company-edit-form','action'=>$this->createUrl('company/edit',array('id'=>$model->id)),'title'=>'ویرایش شرکت'));
?>