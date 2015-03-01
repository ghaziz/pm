
	    <?php $form = $this->beginWidget('CActiveForm', array(
		 'id' => 'account-form',
         'action'=>$this->createUrl('users/account'),
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
					<h3>حساب کاربری</h3>
				 </div>
				  <div class="content">
				 <?php echo $form->errorSummary($model); ?>			
						    <div class="form-group">
                                <?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-6">
                                    <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                                </div>
                                <?php echo $form->error($model, 'username', array('class' => 'col-sm-3 control-label')); ?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">تغییر پسورد*</label>
                                <div class="col-sm-6">
									 <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder'=>'تغییر رمز عبور')); ?>
                                </div>
                                <?php echo $form->error($model, 'password', array('class' => 'col-sm-3 control-label')); ?>
                            </div>	
                            <div class="form-group">
                                <label class="col-sm-3 control-label">تکرار پسورد</label>
                                <div class="col-sm-6">
                                    <input type="password" name="repassword" class="form-control"  placeholder="تکرار رمز عبور">
                                </div>
                                <?php echo $form->error($model, 'birthday', array('class' => 'col-sm-3 control-label')); ?>
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