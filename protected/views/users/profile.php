
	    <?php $form = $this->beginWidget('CActiveForm', array(
		 'id' => 'profile-form',
         'action'=>$this->createUrl('users/profile'),
        'htmlOptions' => array('class' => 'form-horizontal group-border-dashed','validateOnSubmit'=>true ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation' => false,

       )); ?>
		
		<div class="row">
			<div class="col-md-12">
			 <div class="block-flat">
				<div class="header">							
					<h3>پروفایل</h3>
				 </div>
				  <div class="content">
				 <?php echo $form->errorSummary($model); ?>			
						    <div class="form-group">
                                <?php echo $form->labelEx($model, 'name', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'name', array('class' => 'col-sm-3 control-label')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'family', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'family', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'family', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'birthday', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'birthday', array('class' => 'form-control date-picker')); ?>
                                </div>
                                <?php echo $form->error($model, 'birthday', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'phone', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'phone', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'phone', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'emial', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'email', array('class' => 'col-sm-3 control-label')); ?>
                            </div>
							 <div class="form-group">
                                <label class="col-sm-3 control-label">عکس شما</label>
                                <div class="col-sm-6">
									<?php if(PM::getAttachmentPath().basename($model->photo) != PM::getAttachmentPath()."no_avatar.png"){ ?>
								     <img src="<?php echo $model->photo ?>" class="img-circle" alt="140x140" style="width: 140px; height: 140px;">
									<?php } else {?>
									<h4>شما عکسی انتخاب نکرده اید</h4>
									<?php } ?>
                                </div>
                             </div>
							 <div class="form-group">
                                <?php echo $form->label($model, 'photo', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->fileField($model, 'photo', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'photo', array('class' => 'col-sm-3 control-label')); ?>
                             </div>
							 <div class="form-group">
							  <div class="col-sm-12">
						         <button class="btn btn-primary btn-lg" type="submit">ثبت</button>
							 </div>
							 </div>
						</div>
					</div>
			</div>
		</div>
	<?php $this->endWidget(); ?>