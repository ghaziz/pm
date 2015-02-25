<div class="md-content ">
	    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'task-new-form',
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
                    <h3>ثبت تسک جدید</h3>
                </div>
				<?php echo $form->errorSummary($model); ?>
				
				<div class="tab-container">
					 <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">اطلاعات تسک</a></li>
                    </ul>
					 <div class="tab-content">
					    <div class="tab-pane cont active" id="home">
						    <div class="form-group">
                                <?php echo $form->labelEx($model, 'title', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'title', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'title', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'percent_of_all', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'percent_of_all', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'percent_of_all', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'start_time', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'start_time', array('class' => 'form-control date-picker')); ?>
                                </div>
                                <?php echo $form->error($model, 'start_time', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'end_time', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'end_time', array('class' => 'form-control date-picker')); ?>
                                </div>
                                <?php echo $form->error($model, 'end_time', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'status', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->dropDownList($model, 'status', PM::getstatusOptions(), array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'status', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'id_project', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->dropDownList($model, 'id_project', PM::getProjecsList(), array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'id_project', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'id_group', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->dropDownList($model, 'id_group', PM::getGrouptask(), array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'id_group', array('class' => 'col-sm-3 control-label')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'price', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
								  <div class="input-group">
                                    <?php echo $form->textField($model, 'price', array('class' => 'form-control', 'placeholder' => 'هزینه ی پروژه')); ?>
									<span class="input-group-addon">ریال</span>
								  </div>
                                </div>
                                <?php echo $form->error($model, 'price', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'percent_prog', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'percent_prog', array('class' => 'form-control', 'placeholder' => 'درصد پیشرفت پروژه تاکنون')); ?>
                                </div>
                                <?php echo $form->error($model, 'percent_prog', array('class' => 'col-sm-3 control-label')); ?>
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
         <button type="button" class="btn btn-default btn-flat" onclick="sendAjaxForm('<?php echo $action;?>','<?php echo $id;?>')" >ذخیره</button>
    </div>
	<?php $this->endWidget(); ?>
</div>