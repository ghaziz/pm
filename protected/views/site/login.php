<div class="col-sm-4 col-md-4">
</div>
<div class="col-sm-4 col-md-4" style="margin-top: 60px">
    <div class="block-flat">
        <div class="header">
            <h3 class="text-center">ورود</h3>
        </div>
        <div class="content">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array('class' => 'form-horizontal'),
            )); ?>

            <div class="form-group">
                <?php echo $form->label($model, 'username', array('class' => 'col-sm-6 control-label')); ?>
                <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'username', array('class' => 'col-sm-6 control-label')); ?>
            </div>

            <div class="form-group">
                <?php echo $form->label($model, 'password', array('class' => 'col-sm-6 control-label')); ?>
                <?php echo $form->passwordField($model, 'password', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'password', array('class' => 'col-sm-12 control-label')); ?>
            </div>

            <div class="form-group rememberMe">
                <?php echo $form->checkBox($model, 'rememberMe'); ?>
                <?php echo $form->label($model, 'rememberMe'); ?>
                <?php echo $form->error($model, 'rememberMe'); ?>
            </div>

            <div class="form-group buttons">
                <?php echo CHtml::submitButton('ورود',array('class'=>'btn btn-primary btn-block')); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div>
        <!-- form -->
    </div>
</div>
<div class="col-sm-4 col-md-4">