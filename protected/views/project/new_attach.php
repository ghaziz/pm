
<div class="md-content ">
	    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'attach-new-form',
        'htmlOptions' => array('class' => 'form-horizontal','validateOnSubmit'=>true ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation' => true,

       )); ?>
	<div class="modal-header">
        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
	 <div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="header">
                    <h3>اطلاعات پروژه</h3>
                </div>
				<?php echo $form->errorSummary($model); ?>
				
				<div class="tab-container">
					<ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">اطلاعات پیوست</a></li>
                    </ul>
					 <div class="tab-content">
						<div class="tab-pane cont active" id="home">
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'type', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->dropDownList($model, 'type', PM::get_attachOptions(), array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'type', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'file', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->fileField($model, 'file', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'file', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'project_id', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->dropDownList($model, 'project_id', PM::getProjecsList(), array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'project_id', array('class' => 'col-sm-3 control-label')); ?>
                            </div>		
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'description', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textArea($model, 'description', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'description', array('class' => 'col-sm-3 control-label')); ?>
                            </div>								
							 
						</div>
					 </div>
				</div>

			</div>
		</div>
	 </div>
	 <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal">انصراف</button>
        <button type="button" class="btn btn-default btn-flat" onclick="sendAjaxForm('<?php echo $this->createAbsoluteUrl('project/attach');?>','attach-new-form')" >ذخیره</button>
    </div>
<?php $this->endWidget(); ?>	
</div>